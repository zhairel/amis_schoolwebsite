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
        // Fetch active announcements sorted by priority and date
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
            ->paginate(4); // 4 announcements per page as in Vue app

        $heroType = Setting::getValue('hero_type', 'slides');
        $heroTitle = Setting::getValue('hero_title', 'Al Munawwara Islamic School');
        $heroSubtitle = Setting::getValue('hero_subtitle', 'Enabling Our Students to Learn in Fid Dunya Wal Akhira');

        return view('home', compact('announcements', 'heroType', 'heroTitle', 'heroSubtitle'));
    }

    /**
     * Display announcement detail.
     */
    public function announcementShow($id)
    {
        $announcement = Announcement::findOrFail($id);
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
