<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        // All static pages
        $staticPages = [
            ['url' => '/',                                      'priority' => '1.0',  'changefreq' => 'daily'],
            ['url' => '/news',                                  'priority' => '0.9',  'changefreq' => 'daily'],
            ['url' => '/events',                                'priority' => '0.9',  'changefreq' => 'weekly'],
            ['url' => '/admissions',                            'priority' => '0.9',  'changefreq' => 'weekly'],
            ['url' => '/contact',                               'priority' => '0.7',  'changefreq' => 'monthly'],
            ['url' => '/about',                                 'priority' => '0.8',  'changefreq' => 'monthly'],
            ['url' => '/about/history',                         'priority' => '0.7',  'changefreq' => 'monthly'],
            ['url' => '/about/philosophy-vision-mission-goals', 'priority' => '0.7',  'changefreq' => 'monthly'],
            ['url' => '/about/school-logo',                     'priority' => '0.5',  'changefreq' => 'yearly'],
            ['url' => '/about/why-islamic-school',              'priority' => '0.7',  'changefreq' => 'monthly'],
            ['url' => '/about/certifications',                  'priority' => '0.6',  'changefreq' => 'monthly'],
            ['url' => '/about/location',                        'priority' => '0.6',  'changefreq' => 'yearly'],
            ['url' => '/academics',                             'priority' => '0.8',  'changefreq' => 'monthly'],
            ['url' => '/academics/basic-education',             'priority' => '0.7',  'changefreq' => 'monthly'],
            ['url' => '/isal/halaqah',                          'priority' => '0.8',  'changefreq' => 'weekly'],
        ];

        // Dynamic announcement/news/event pages
        $announcements = Announcement::where(function ($q) {
                $q->whereNull('publish_date')
                  ->orWhere('publish_date', '<=', now());
            })
            ->orderBy('updated_at', 'desc')
            ->get(['uuid', 'id', 'updated_at']);

        $content = view('sitemap', compact('staticPages', 'announcements'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
