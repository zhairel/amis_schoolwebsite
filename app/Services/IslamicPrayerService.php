<?php

namespace App\Services;

use Carbon\Carbon;

class IslamicPrayerService
{
    // Davao City Coordinates & Timezone
    public const DAVAO_LATITUDE = 7.0731;
    public const DAVAO_LONGITUDE = 125.6128;
    public const DAVAO_TIMEZONE = 8.0;

    /**
     * Calculate today's prayer times for Davao City, Philippines.
     */
    public static function getDavaoPrayerTimes(?Carbon $date = null): array
    {
        $date = $date ? $date->copy()->setTimezone('Asia/Manila') : Carbon::now('Asia/Manila');
        $dayOfYear = (int) $date->format('z') + 1; // 1-366

        $lat = self::DAVAO_LATITUDE;
        $lng = self::DAVAO_LONGITUDE;
        $tz = self::DAVAO_TIMEZONE;

        // Solar Declination & Equation of Time (Spencer / standard astronomical model)
        $b = 2 * M_PI * ($dayOfYear - 81) / 365.0;
        $eot = 9.87 * sin(2 * $b) - 7.53 * cos($b) - 1.5 * sin($b);
        $decl = 23.45 * sin(2 * M_PI * (284 + $dayOfYear) / 365.0);

        $declRad = deg2rad($decl);
        $latRad = deg2rad($lat);

        // Solar Noon (Dhuhr base)
        $noon = 12.0 + $tz - ($lng / 15.0) - ($eot / 60.0);

        // Helper: Hour angle for given sun altitude angle
        $hourAngle = function ($angle) use ($latRad, $declRad) {
            $cosHa = (sin(deg2rad($angle)) - sin($latRad) * sin($declRad)) / (cos($latRad) * cos($declRad));
            if ($cosHa > 1 || $cosHa < -1) {
                return 0;
            }
            return rad2deg(acos($cosHa)) / 15.0;
        };

        // Astronomical timings
        $haSunrise = $hourAngle(-0.833);
        $haFajr = $hourAngle(-18.0);
        $haIsha = $hourAngle(-18.0);

        // Asr (Shafi'i: shadow length factor = 1)
        $asrAngle = rad2deg(atan(1.0 + tan(abs($latRad - $declRad))));
        $haAsr = $hourAngle(90.0 - $asrAngle);

        $fajr = $noon - $haFajr;
        $sunrise = $noon - $haSunrise;
        $dhuhr = $noon;
        $asr = $noon + $haAsr;
        $maghrib = $noon + $haSunrise;
        $isha = $noon + $haIsha;

        $formatTime = function ($decimalHour) use ($date) {
            $h = (int) floor($decimalHour);
            $m = (int) round(($decimalHour - $h) * 60);
            if ($m >= 60) {
                $h += 1;
                $m = 0;
            }
            return $date->copy()->setTime($h, $m, 0);
        };

        $prayers = [
            'fajr' => [
                'name' => 'Fajr',
                'arabic' => 'الفجر',
                'time_obj' => $formatTime($fajr),
                'time_str' => $formatTime($fajr)->format('g:i A'),
            ],
            'sunrise' => [
                'name' => 'Sunrise',
                'arabic' => 'الشروق',
                'time_obj' => $formatTime($sunrise),
                'time_str' => $formatTime($sunrise)->format('g:i A'),
            ],
            'dhuhr' => [
                'name' => 'Dhuhr',
                'arabic' => 'الظهر',
                'time_obj' => $formatTime($dhuhr),
                'time_str' => $formatTime($dhuhr)->format('g:i A'),
            ],
            'asr' => [
                'name' => 'Asr',
                'arabic' => 'العصر',
                'time_obj' => $formatTime($asr),
                'time_str' => $formatTime($asr)->format('g:i A'),
            ],
            'maghrib' => [
                'name' => 'Maghrib',
                'arabic' => 'المغرب',
                'time_obj' => $formatTime($maghrib),
                'time_str' => $formatTime($maghrib)->format('g:i A'),
            ],
            'isha' => [
                'name' => 'Isha',
                'arabic' => 'العشاء',
                'time_obj' => $formatTime($isha),
                'time_str' => $formatTime($isha)->format('g:i A'),
            ],
        ];

        return $prayers;
    }

    /**
     * Compute current active or next upcoming prayer.
     */
    public static function getActivePrayerStatus(?Carbon $now = null): array
    {
        $now = $now ? $now->copy()->setTimezone('Asia/Manila') : Carbon::now('Asia/Manila');
        $prayers = self::getDavaoPrayerTimes($now);

        $fajr = $prayers['fajr']['time_obj'];
        $sunrise = $prayers['sunrise']['time_obj'];
        $dhuhr = $prayers['dhuhr']['time_obj'];
        $asr = $prayers['asr']['time_obj'];
        $maghrib = $prayers['maghrib']['time_obj'];
        $isha = $prayers['isha']['time_obj'];

        // Determine current active prayer
        if ($now->lt($fajr)) {
            $current = 'isha_prev';
            $nextKey = 'fajr';
            $nextTarget = $fajr;
        } elseif ($now->lt($sunrise)) {
            $current = 'fajr';
            $nextKey = 'sunrise';
            $nextTarget = $sunrise;
        } elseif ($now->lt($dhuhr)) {
            $current = 'sunrise';
            $nextKey = 'dhuhr';
            $nextTarget = $dhuhr;
        } elseif ($now->lt($asr)) {
            $current = 'dhuhr';
            $nextKey = 'asr';
            $nextTarget = $asr;
        } elseif ($now->lt($maghrib)) {
            $current = 'asr';
            $nextKey = 'maghrib';
            $nextTarget = $maghrib;
        } elseif ($now->lt($isha)) {
            $current = 'maghrib';
            $nextKey = 'isha';
            $nextTarget = $isha;
        } else {
            $current = 'isha';
            $nextKey = 'fajr';
            $nextTarget = self::getDavaoPrayerTimes($now->copy()->addDay())['fajr']['time_obj'];
        }

        $diffMinutes = max(1, (int) round($now->diffInMinutes($nextTarget, false)));
        $diffHours = (int) floor($diffMinutes / 60);
        $remMins = $diffMinutes % 60;
        $countdown = $diffHours > 0 ? "{$diffHours}h {$remMins}m" : "{$remMins}m";

        return [
            'current' => $current,
            'next' => $nextKey,
            'next_name' => $prayers[$nextKey]['name'] ?? 'Fajr',
            'next_arabic' => $prayers[$nextKey]['arabic'] ?? 'الفجر',
            'next_time' => $nextTarget->format('g:i A'),
            'countdown' => $countdown,
            'prayers' => $prayers,
        ];
    }

    /**
     * Calculate Gregorian to Hijri Date (Kuwaiti / Umm al-Qura astronomical algorithm).
     */
    public static function getHijriDate(?Carbon $date = null): array
    {
        $date = $date ? $date->copy()->setTimezone('Asia/Manila') : Carbon::now('Asia/Manila');
        $year = (int) $date->format('Y');
        $month = (int) $date->format('n');
        $day = (int) $date->format('j');

        if ($month <= 2) {
            $year -= 1;
            $month += 12;
        }

        $a = (int) floor($year / 100);
        $b = 2 - $a + (int) floor($a / 4);
        $jd = (int) floor(365.25 * ($year + 4716)) + (int) floor(30.6001 * ($month + 1)) + $day + $b - 1524;

        $l = $jd - 1948440 + 10632;
        $n = (int) floor(($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;
        $j = (int) (floor((10985 - $l) / 5316)) * (int) (floor((50 * $l) / 17719)) + (int) (floor($l / 5670)) * (int) (floor((43 * $l) / 15238));
        $l = $l - (int) (floor((30 - $j) / 15)) * (int) (floor((17719 * $j) / 50)) - (int) (floor($j / 16)) * (int) (floor((15238 * $j) / 43)) + 29;
        $m = (int) floor((24 * $l) / 709);
        $d = (int) ($l - floor((709 * $m) / 24));
        $y = (int) (30 * $n + $j - 30);

        $monthsEn = [
            1 => 'Muharram', 2 => 'Safar', 3 => 'Rabi al-Awwal', 4 => 'Rabi al-Thani',
            5 => 'Jumada al-Awwal', 6 => 'Jumada al-Thani', 7 => 'Rajab', 8 => 'Shaban',
            9 => 'Ramadan', 10 => 'Shawwal', 11 => 'Dhu al-Qadah', 12 => 'Dhu al-Hijjah',
        ];

        $monthsAr = [
            1 => 'محرم', 2 => 'صفر', 3 => 'ربيع الأول', 4 => 'ربيع الثاني',
            5 => 'جمادى الأولى', 6 => 'جمادى الثانية', 7 => 'رجب', 8 => 'شعبان',
            9 => 'رمضان', 10 => 'شوال', 11 => 'ذو القعدة', 12 => 'ذو الحجة',
        ];

        $mIndex = max(1, min(12, $m));
        $monthName = $monthsEn[$mIndex];
        $monthArabic = $monthsAr[$mIndex];

        return [
            'day' => $d,
            'month' => $mIndex,
            'month_name' => $monthName,
            'month_arabic' => $monthArabic,
            'year' => $y,
            'formatted_en' => "{$d} {$monthName} {$y} AH",
            'formatted_ar' => "{$d} {$monthArabic} {$y} هـ",
        ];
    }

    /**
     * Selected inspiring Ayahs & Hadiths reflecting AMIS core vision:
     * "Enabling our students to learn in Fid Dunya Wal Akhira".
     */
    public static function getDailyAyah(): array
    {
        $quotes = [
            [
                'arabic' => 'رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الْآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ',
                'translation' => 'Our Lord, give us in this world that which is good and in the Hereafter that which is good and protect us from the punishment of the Fire.',
                'reference' => 'Surah Al-Baqarah (2:201) — AMIS Core Vision: Fid Dunya Wal Akhira',
            ],
            [
                'arabic' => 'وَقُل رَّبِّ زِدْنِي عِلْمًا',
                'translation' => 'And say, "My Lord, increase me in knowledge."',
                'reference' => 'Surah Ta-Ha (20:114)',
            ],
            [
                'arabic' => 'يَرْفَعِ اللَّهُ الَّذِينَ آمَنُوا مِنكُمْ وَالَّذِينَ أُوتُوا الْعِلْمَ دَرَجَاتٍ',
                'translation' => 'Allah will raise those who have believed among you and those who were given knowledge, by degrees.',
                'reference' => 'Surah Al-Mujadila (58:11)',
            ],
            [
                'arabic' => 'إِنَّ الصَّلَاةَ كَانَتْ عَلَى الْمُؤْمِنِينَ كِتَابًا مَّوْقُوتًا',
                'translation' => 'Indeed, prayer has been decreed upon the believers a decree of specified times.',
                'reference' => 'Surah An-Nisa (4:103)',
            ],
            [
                'arabic' => 'مَنْ سَلَكَ طَرِيقًا يَلْتَمِسُ فِيهِ عِلْمًا سَهَّلَ اللَّهُ لَهُ بِهِ طَرِيقًا إِلَى الْجَنَّةِ',
                'translation' => 'Whoever takes a path upon which he seeks knowledge, Allah will make a path to Paradise easy for him.',
                'reference' => 'Sahih Muslim (2699)',
            ],
        ];

        // Pick one reliably based on day of year
        $index = (int) date('z') % count($quotes);
        return $quotes[$index];
    }
}
