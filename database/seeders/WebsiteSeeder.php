<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Announcement;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed settings
        $settings = [
            'maintenance_mode' => 'false',
            'maintenance_message' => 'Al Munawwara Islamic School website is undergoing scheduled maintenance. We will be back online shortly.',
            'maintenance_signature' => 'AMIS IT Administration',
            'hero_type' => 'video',
            'hero_title' => 'Al Munawwara Islamic School',
            'hero_subtitle' => 'Enabling Our Students to Learn in Fid Dunya Wal Akhira',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $val]
            );
        }

        // 2. Seed initial announcements matching sampleNews from Vue Home.vue and school notices
        $announcements = [
            [
                'title' => 'ADVISORY: Temporary Lunch Arrangement Inside Classrooms Due to El Niño Heat',
                'content' => '<p>Assalaamu alaikum wa rahmatullahi wa barakatuh.</p><p>Please be informed that, due to the extreme heat brought about by the El Niño , students are temporarily allowed to eat their lunch inside their respective classrooms until further notice.</p><p>All students are reminded to observe proper cleanliness and waste disposal. After eating, all leftover food and other waste must be removed from the classrooms and properly disposed of in the designated garbage bins on the ground floor. Tables, chairs, and floors must be kept clean at all times.</p><p>Your cooperation in maintaining a clean and orderly learning environment is required.</p><p>For your information and guidance.</p><p>Shukran. BarakAllahu feekum.</p><p>– <strong>AMIS Administration</strong></p>',
                'category' => 'Official Advisory',
                'priority' => 'high',
                'image' => json_encode(['/coming-soon.png']),
                'publish_date' => '2026-11-04 01:00:00',
                'author' => 'AMIS Administration',
            ],
            [
                'title' => 'Gentle Reminder: Preserving Islamic Identity & Values',
                'content' => '<p>Assalaamu alaikum wa rahmatullahi wa barakatuh.</p><p>As the year-end holiday season approaches, the AMIS Shariah Advisory Department (ASAD) respectfully reminds all Muslim students and employees to preserve their Islamic identity, uphold the guidance of the Qur\'an and Sunnah, and refrain from participating in religious practices that contradict Islamic teachings — while always maintaining kindness, courtesy, and peaceful coexistence with people of other faiths.</p><p><strong>📖 Qur\'anic Verse:</strong> <em>"And do not follow their desires away from the truth that has come to you."</em> (Surah Al-Ma\'idah 5:48)<br><strong>🕌 Hadith:</strong> <em>"Man tashabbaha biqawmin fahuwa minhum."</em> ("Whoever imitates a people is one of them.")</p><p>– <strong>AMIS Shariah Advisory Department (ASAD)</strong></p>',
                'category' => 'Reminder',
                'priority' => 'normal',
                'image' => json_encode(['/images/highlights/asad-gentle-reminder-2026.jpg']),
                'publish_date' => '2026-10-28 09:00:00',
                'author' => 'AMIS Shariah Advisory Department (ASAD)',
            ],
            [
                'title' => 'Important Notice: Observance of Campus Cleanliness and Orderly Environment',
                'content' => '<p>Assalaamu alaikum wa rahmatullahi wa barakatuh.</p><p>All students, faculty, and campus staff are reminded to uphold our school value of cleanliness (Taharah) across all school facilities, corridors, and dining spaces. Please ensure that all waste is segregated properly into designated bins on the ground floor. Tables, chairs, and floors must be kept clean at all times.</p><p>Thank you for your valued cooperation in keeping our Islamic learning environment clean, safe, and pleasant for everyone.</p><p>– <strong>AMIS Administration</strong></p>',
                'category' => 'Important Notice',
                'priority' => 'normal',
                'image' => json_encode(['/coming-soon.png']),
                'publish_date' => '2026-10-20 08:00:00',
                'author' => 'AMIS Administration',
            ],
            [
                'title' => 'Summer Class 2026 - Enroll Now!',
                'content' => 'Make this summer productive and exciting! We offer One-on-One Sessions, Face-to-Face Learning, and Group Classes. Limited slots only!',
                'category' => 'news',
                'priority' => 'high',
                'image' => '/summer-class.png',
                'publish_date' => '2026-05-04 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Enrollment for SY 2026-2027 Now Open',
                'content' => 'We are now accepting applications for the upcoming school year. Limited slots available.',
                'category' => 'news',
                'priority' => 'high',
                'image' => '/enrollment.png',
                'publish_date' => '2026-04-10 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Sports Festival 2026',
                'content' => 'Join us for our annual sports day featuring various athletic competitions and activities.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/sportfest.png',
                'publish_date' => '2026-04-30 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Academic Excellence Award',
                'content' => 'Congratulations to our students for achieving outstanding results.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-25 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Parent-Teacher Conference',
                'content' => 'Join us for our quarterly parent-teacher conference.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-20 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'New Facilities Opening',
                'content' => 'We are excited to announce the opening of our new science laboratory.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-15 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Cultural Day Celebration',
                'content' => 'Experience diverse cultures through performances and exhibitions.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-12 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Scholarship Program 2026',
                'content' => 'Applications now open for our merit-based scholarship program.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-08 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Science Fair Winners',
                'content' => 'Congratulations to all participants and winners of our annual science fair.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-05 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Ramadan Activities 2026',
                'content' => 'Special programs and activities during the holy month of Ramadan.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-04-01 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Career Day 2026',
                'content' => 'Meet professionals from various fields and explore career opportunities.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-03-28 00:00:00',
                'author' => 'AMIS Admin',
            ],
            [
                'title' => 'Art Exhibition',
                'content' => 'Showcasing the creative talents of our students.',
                'category' => 'news',
                'priority' => 'normal',
                'image' => '/coming-soon.png',
                'publish_date' => '2026-03-25 00:00:00',
                'author' => 'AMIS Admin',
            ]
        ];

        // Clear old announcements to prevent duplicates on deployment seeding
        Announcement::query()->delete();

        foreach ($announcements as $ann) {
            Announcement::create($ann);
        }
    }
}
