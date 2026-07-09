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

        // 2. Seed initial announcements matching sampleNews from Vue Home.vue
        $announcements = [
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
