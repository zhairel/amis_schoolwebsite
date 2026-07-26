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
        // Fetch active announcements sorted by priority and date (excluding events/activities)
        $announcements = Announcement::where(function ($query) {
                $query->whereNull('publish_date')
                      ->orWhere('publish_date', '<=', now());
            })
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('category', 'not like', '%event%')
                      ->where('category', 'not like', '%sport%')
                      ->where('category', 'not like', '%activity%')
                      ->where('category', 'not like', '%program%');
                })
                ->orWhereNull('category');
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
            ->paginate(6);

        $heroType = Setting::getValue('hero_type', 'slides');
        $heroTitle = Setting::getValue('hero_title', 'Al Munawwara Islamic School');
        $heroSubtitle = Setting::getValue('hero_subtitle', 'Enabling Our Students to Learn in Fid Dunya Wal Akhira');

        return view('home', compact('announcements', 'heroType', 'heroTitle', 'heroSubtitle'));
    }

    /**
     * Display the dedicated news list index page.
     */
    public function newsIndex()
    {
        $announcements = Announcement::where(function ($query) {
                $query->whereNull('publish_date')
                      ->orWhere('publish_date', '<=', now());
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
            ->paginate(10);

        return view('news_index', compact('announcements'));
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
                      ->orWhere('category', 'like', '%program%');
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
        return view('announcement_detail', compact('announcement'));
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        return view('about');
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
     */
    public function calendar()
    {
        return view('pages.calendar');
    }

    /**
     * Display Halaqah Online page.
     */
    public function halaqah()
    {
        return view('isal.halaqah');
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
}
