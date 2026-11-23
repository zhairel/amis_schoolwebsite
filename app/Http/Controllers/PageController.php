<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        // 1. Fetch active School Notices (Official advisories, administrative notices, reminders, announcements)
        $rawNotices = Announcement::where(function ($query) {
                $query->whereNull('publish_date')
                      ->orWhere('publish_date', '<=', now());
            })
            ->where(function ($query) {
                $query->where('category', 'like', '%advisory%')
                      ->orWhere('category', 'like', '%notice%')
                      ->orWhere('category', 'like', '%reminder%')
                      ->orWhere('category', 'like', '%announcement%')
                      ->orWhere('category', 'like', '%memo%')
                      ->orWhere('category', 'like', '%circular%');
            })
            ->orderByRaw("
                CASE priority
                    WHEN 'urgent' THEN 1
                    WHEN 'high' THEN 2
                    WHEN 'normal' THEN 3
                    WHEN 'low' THEN 4
                    ELSE 5
                END ASC
            ")
            ->orderBy('publish_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Deduplicate notices sharing the same topic or primary banner (e.g. duplicate AMIS-GEM reminders)
        $seenNoticeKeys = [];
        $schoolNotices = $rawNotices
            ->reject(function ($notice) {
                // Skip temporary "9 Days Left" countdown duplicate (#287) in favor of the main AMIS-GEM notice (#276)
                return str_contains(strtolower($notice->title ?? ''), '9 days left');
            })
            ->filter(function ($notice) use (&$seenNoticeKeys) {
                $titleLower = strtolower($notice->title ?? '');
                $topicKey = null;
                if (str_contains($titleLower, 'amis-gem')) {
                    $topicKey = 'amis-gem';
                } elseif (str_contains($titleLower, 'musabaqah')) {
                    $topicKey = 'musabaqah';
                } elseif (str_contains($titleLower, 'early enrollment')) {
                    $topicKey = 'early-enrollment';
                }

                $imgs = json_decode($notice->image ?? '', true);
                $firstImg = is_array($imgs) ? ($imgs[0] ?? null) : $notice->image;
                $imgBase = $firstImg ? pathinfo($firstImg, PATHINFO_FILENAME) : null;

                if (($topicKey && isset($seenNoticeKeys[$topicKey])) || ($imgBase && isset($seenNoticeKeys[$imgBase]))) {
                    return false;
                }
                if ($topicKey) {
                    $seenNoticeKeys[$topicKey] = true;
                }
                if ($imgBase) {
                    $seenNoticeKeys[$imgBase] = true;
                }
                return true;
            })
            ->take(6)
            ->values();

        // 2. Fetch active News & Announcements (activities, achievements, events, student accomplishments, news articles)
        // Strictly excluding any notices to prevent duplication between sections
        $announcements = Announcement::where(function ($query) {
                $query->whereNull('publish_date')
                      ->orWhere('publish_date', '<=', now());
            })
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('category', 'not like', '%advisory%')
                      ->where('category', 'not like', '%notice%')
                      ->where('category', 'not like', '%reminder%')
                      ->where('category', 'not like', '%memo%')
                      ->where('category', 'not like', '%circular%')
                      ->where('category', 'not like', '%Official Announcement%');
                })
                ->orWhereNull('category');
            })
            ->whereNotIn('id', $rawNotices->pluck('id'))
            ->orderByRaw("
                CASE priority
                    WHEN 'urgent' THEN 1
                    WHEN 'high' THEN 2
                    WHEN 'normal' THEN 3
                    WHEN 'low' THEN 4
                    ELSE 5
                END ASC
            ")
            ->orderBy('publish_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $heroType = Setting::getValue('hero_type', 'slides');
        $heroTitle = Setting::getValue('hero_title', 'Al Munawwara Islamic School');
        $heroSubtitle = Setting::getValue('hero_subtitle', 'Enabling Our Students to Learn in Fid Dunya Wal Akhira');

        $calendarSchedule = \App\Services\SchoolCalendarService::getCurrentMonthSchedule();
        $upcomingEvents = \App\Services\SchoolCalendarService::getUpcomingEvents(8);
        $nextMonthSchedule = \App\Services\SchoolCalendarService::getNextMonthSchedule();

        return view('home', compact(
            'schoolNotices',
            'announcements',
            'heroType',
            'heroTitle',
            'heroSubtitle',
            'calendarSchedule',
            'upcomingEvents',
            'nextMonthSchedule'
        ));
    }

    /**
     * Display the dedicated news list index page.
     */
    public function newsIndex(Request $request)
    {
        $activeTab = strtolower(trim((string) $request->query('tab', 'all')));
        if (!in_array($activeTab, ['all', 'notices', 'news', 'events'], true)) {
            $activeTab = 'all';
        }
        $searchQuery = trim((string) $request->query('q', ''));

        $basePublished = fn () => Announcement::where(function ($query) {
            $query->whereNull('publish_date')
                  ->orWhere('publish_date', '<=', now());
        })->where('title', 'not like', '%9 Days Left%');

        // 1. Fetch Top 3 Visual Stories (Good News, JUST IN, AMIS News)
        $topStories = $basePublished()
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->where('image', '!=', '[]')
            ->where(function ($q) {
                $q->where('category', 'like', '%Good News%')
                  ->orWhere('category', 'like', '%JUST IN%')
                  ->orWhere('category', 'like', '%AMIS News%');
            })
            ->orderByRaw("
                CASE 
                    WHEN category LIKE '%Good News%' THEN 1
                    WHEN category LIKE '%JUST IN%' THEN 2
                    WHEN category LIKE '%AMIS News%' THEN 3
                    ELSE 4
                END ASC
            ")
            ->orderBy('publish_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // 2. Category tab counts
        $counts = [
            'all' => $basePublished()->count(),
            'notices' => $basePublished()->where(function ($q) {
                $q->where('category', 'like', '%advisory%')
                  ->orWhere('category', 'like', '%notice%')
                  ->orWhere('category', 'like', '%reminder%')
                  ->orWhere('category', 'like', '%announcement%')
                  ->orWhere('category', 'like', '%memo%')
                  ->orWhere('category', 'like', '%circular%');
            })->count(),
            'news' => $basePublished()->where(function ($q) {
                $q->where('category', 'like', '%news%')
                  ->orWhere('category', 'like', '%just in%');
            })->count(),
            'events' => $basePublished()->where(function ($q) {
                $q->where('category', 'like', '%event%')
                  ->orWhere('category', 'like', '%sport%')
                  ->orWhere('category', 'like', '%activity%')
                  ->orWhere('category', 'like', '%competition%');
            })->count(),
        ];

        // 3. Paginated announcements feed with tab & search filter
        $feedQuery = $basePublished();

        if ($activeTab === 'notices') {
            $feedQuery->where(function ($q) {
                $q->where('category', 'like', '%advisory%')
                  ->orWhere('category', 'like', '%notice%')
                  ->orWhere('category', 'like', '%reminder%')
                  ->orWhere('category', 'like', '%announcement%')
                  ->orWhere('category', 'like', '%memo%')
                  ->orWhere('category', 'like', '%circular%');
            });
        } elseif ($activeTab === 'news') {
            $feedQuery->where(function ($q) {
                $q->where('category', 'like', '%news%')
                  ->orWhere('category', 'like', '%just in%');
            });
        } elseif ($activeTab === 'events') {
            $feedQuery->where(function ($q) {
                $q->where('category', 'like', '%event%')
                  ->orWhere('category', 'like', '%sport%')
                  ->orWhere('category', 'like', '%activity%')
                  ->orWhere('category', 'like', '%competition%');
            });
        }

        if ($searchQuery !== '') {
            $feedQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('content', 'like', "%{$searchQuery}%")
                  ->orWhere('category', 'like', "%{$searchQuery}%");
            });
        }

        $announcements = $feedQuery
            ->orderBy('publish_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('news_index', compact('announcements', 'topStories', 'activeTab', 'searchQuery', 'counts'));
    }

    /**
     * Display the dedicated events grid index page.
     */
    public function eventsIndex()
    {
        $events = Announcement::where(function ($query) {
                $query->whereNull('publish_date')
                      ->orWhere('publish_date', '<=', now());
            })
            ->where(function ($query) {
                $query->where('category', 'like', '%event%')
                      ->orWhere('category', 'like', '%sport%')
                      ->orWhere('category', 'like', '%activity%')
                      ->orWhere('category', 'like', '%program%')
                      ->orWhere('category', 'like', '%competition%');
            })
            ->orderBy('publish_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('events_index', compact('events'));
    }

    /**
     * Display announcement detail.
     */
    public function announcementShow($id)
    {
        if (is_numeric($id)) {
            $announcement = Announcement::findOrFail($id);
            if ($announcement->uuid) {
                return redirect()->route('announcement.show', $announcement->uuid);
            }
        } else {
            $announcement = Announcement::where('uuid', $id)->firstOrFail();
        }

        $relatedAnnouncements = Announcement::where('id', '!=', $announcement->id)
            ->orderByDesc('publish_date')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        return response()
            ->view('announcement_detail', compact('announcement', 'relatedAnnouncements'))
            ->header('Cache-Control', 'public, max-age=3600');
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        return redirect()->route('about.history', [], 301);
    }

    /**
     * Display History page.
     */
    public function history()
    {
        return view('about.history');
    }

    /**
     * Display Philosophy, Vision, Mission, and Goals page.
     */
    public function philosophy()
    {
        return view('about.philosophy');
    }

    /**
     * Display Logo details page.
     */
    public function logo()
    {
        return view('about.logo');
    }

    /**
     * Display Why Islamic School page.
     */
    public function why()
    {
        return view('about.why');
    }

    /**
     * Display Certifications page.
     */
    public function certifications()
    {
        return view('about.certifications');
    }

    /**
     * Display Location page.
     */
    public function location()
    {
        return view('about.location');
    }

    /**
     * Display Academics page.
     */
    public function academics()
    {
        return view('academics');
    }

    /**
     * Display Basic Education page.
     */
    public function basicEducation()
    {
        return view('academics.basic_education');
    }

    /**
     * Display Calendar of Activities page.
     * Serves standalone 2nd Term Exam Scheduler by default (matching Vercel layout without website navbar).
     * If explicitly requesting ?view=visual or ?view=list, renders the classic event calendar.
     */
    public function calendar(Request $request)
    {
        if ($request->get('view') === 'visual' || $request->get('view') === 'list') {
            $dbEvents = Announcement::where(function ($query) {
                    $query->where('category', 'like', '%event%')
                          ->orWhere('category', 'like', '%sport%')
                          ->orWhere('category', 'like', '%activity%')
                          ->orWhere('category', 'like', '%program%');
                })
                ->get();

            return view('pages.calendar', compact('dbEvents'));
        }

        return response()->file(public_path('exam-schedule-2nd-term.html'), [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    /**
     * Display Halaqah Online page.
     */
    public function halaqah()
    {
        return view('isal.halaqah');
    }

    /**
     * Display Halaqah Parents page.
     */
    public function halaqahParents()
    {
        return view('isal.halaqah_parents');
    }

    /**
     * Display Admissions page.
     */
    public function admissions()
    {
        return view('admissions');
    }

    /**
     * Display Contact page.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display Global AMIS Community page.
     */
    public function globalCommunity()
    {
        return view('about.global_community');
    }

    /**
     * Display the dedicated Shariah Advisory page (ASAD Gentle Reminder).
     */
    public function shariahAdvisoryReminder()
    {
        return view('pages.shariah-advisory-reminder');
    }

    /**
     * Realtime API handler for saving and fetching 2nd Term Examination Schedule.
     */
    public function saveExamSchedule(Request $request)
    {
        $version = '20261123_v24_saliha_gmrc_clean_sync';
        $staticJsonPath = public_path('exam_data_2nd_term.json');
        $staticJsPath = public_path('exam_data_2nd_term.js');
        $tmpJsonPath = '/tmp/amis_exam_schedule.json';

        $corsHeaders = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        if ($request->isMethod('OPTIONS')) {
            return response('', 200, $corsHeaders);
        }

        if ($request->isMethod('POST')) {
            try {
                $rawContent = $request->getContent();
                $body = json_decode($rawContent, true);
                if (!is_array($body)) {
                    $body = $request->all();
                }

                $schedule = null;
                $lockedSections = [];
                $updatedAt = round(microtime(true) * 1000);

                if (isset($body[0]) && is_array($body[0])) {
                    $schedule = $body;
                } elseif (is_array($body)) {
                    if (isset($body['schedule']) && is_array($body['schedule'])) {
                        $schedule = $body['schedule'];
                    }
                    if (isset($body['locked_sections']) && is_array($body['locked_sections'])) {
                        $lockedSections = $body['locked_sections'];
                    }
                    if (isset($body['updated_at'])) {
                        $updatedAt = (float)$body['updated_at'];
                    }
                }

                if ((!$schedule || count($schedule) < 50) && empty($lockedSections)) {
                    return response()->json([
                        'ok' => false,
                        'error' => 'Invalid payload: expected schedule array (>= 50) or locked_sections array',
                    ], 400, $corsHeaders);
                }

                // If schedule provided, write to public JSON and JS
                if ($schedule && count($schedule) >= 50) {
                    $encodedJson = json_encode($schedule, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                    @file_put_contents($staticJsonPath, $encodedJson);
                    @file_put_contents($staticJsPath, "window.EXAM_DATA_2ND_TERM = " . $encodedJson . ";\n");
                } else {
                    // Load existing schedule to merge with locked_sections in tmp
                    if (file_exists($staticJsonPath)) {
                        $schedule = json_decode(@file_get_contents($staticJsonPath), true);
                    }
                }

                // Write to /tmp cache for fast realtime access
                $tmpData = [
                    'version' => $version,
                    'schedule' => $schedule,
                    'updated_at' => $updatedAt,
                    'locked_sections' => $lockedSections,
                ];
                @file_put_contents($tmpJsonPath, json_encode($tmpData));

                return response()->json([
                    'ok' => true,
                    'status' => 'success',
                    'version' => $version,
                    'count' => is_array($schedule) ? count($schedule) : 0,
                    'locked_sections_count' => count($lockedSections),
                    'updated_at' => $updatedAt,
                    'message' => 'Saved to AMIS realtime store',
                ], 200, $corsHeaders);
            } catch (\Throwable $e) {
                return response()->json([
                    'ok' => false,
                    'error' => $e->getMessage(),
                ], 500, $corsHeaders);
            }
        }

        // GET request
        $schedule = null;
        $lockedSections = [];
        $updatedAt = 0;

        // Try /tmp first
        if (file_exists($tmpJsonPath)) {
            try {
                $tmpRaw = @file_get_contents($tmpJsonPath);
                $tmpData = json_decode($tmpRaw, true);
                if (is_array($tmpData) && ($tmpData['version'] ?? '') === $version && is_array($tmpData['schedule'] ?? null) && count($tmpData['schedule']) > 50) {
                    $schedule = $tmpData['schedule'];
                    $lockedSections = is_array($tmpData['locked_sections'] ?? null) ? $tmpData['locked_sections'] : [];
                    $updatedAt = $tmpData['updated_at'] ?? (filemtime($tmpJsonPath) * 1000);
                }
            } catch (\Throwable $e) {}
        }

        // Fallback to static JSON file
        if (!$schedule && file_exists($staticJsonPath)) {
            try {
                $staticRaw = @file_get_contents($staticJsonPath);
                $staticData = json_decode($staticRaw, true);
                if (is_array($staticData) && count($staticData) > 50) {
                    $schedule = $staticData;
                    $updatedAt = filemtime($staticJsonPath) * 1000;
                }
            } catch (\Throwable $e) {}
        }

        return response()->json([
            'ok' => true,
            'status' => 'success',
            'version' => $version,
            'count' => is_array($schedule) ? count($schedule) : 0,
            'updated_at' => $updatedAt,
            'schedule' => $schedule,
            'locked_sections' => $lockedSections,
        ], 200, $corsHeaders);
    }
}

