<?php

require file_exists(__DIR__ . '/../vendor/autoload.php') ? __DIR__ . '/../vendor/autoload.php' : __DIR__ . '/vendor/autoload.php';
$app = require file_exists(__DIR__ . '/../bootstrap/app.php') ? __DIR__ . '/../bootstrap/app.php' : __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Announcement;

$title = 'HOLIDAY ADVISORY: Asynchronous Learning (Nov 29) & Regular Holiday (Nov 30, 2026)';

$advisory = Announcement::firstOrNew(['title' => $title]);
$advisory->category = 'Official Advisory';
$advisory->priority = 'high';
$advisory->author = 'AMIS Administration';
$advisory->publish_date = '2026-11-23 13:40:00';
$advisory->image = json_encode([
    '/images/announcements/holiday-advisory-november-29-30-2026.webp',
    '/images/announcements/holiday-advisory-november-29-30-2026.jpg'
]);

$advisory->content = '<p><strong>Assalaamu alaikum wa rahmatullahi wa barakatuh.</strong></p>' .
'<p>Please be guided by the following <strong>Holiday Advisory and Class Schedule Arrangements</strong> for <strong>November 29 and 30, 2026 (S.Y. 2026–2027)</strong>:</p>' .

'<div style="background: #fefce8; border: 1.5px solid #fef08a; border-left: 5px solid #eab308; border-radius: 12px; padding: 18px 22px; margin: 24px 0;">' .
    '<div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">' .
        '<span style="font-size: 1.4rem;">⚠️</span>' .
        '<h3 style="margin: 0; color: #854d0e; font-size: 1.15rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Holiday Advisory • No Onsite Classes</h3>' .
    '</div>' .
    '<p style="margin: 0; color: #713f12; font-size: 0.95rem; line-height: 1.6;">' .
        'All students, parents, guardians, and faculty members are requested to take note of the scheduled learning arrangements and office closures below.' .
    '</p>' .
'</div>' .

'<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 26px 0;">' .

    '<!-- Card 1: November 29 -->' .
    '<div style="background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 14px; padding: 22px 24px; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.05);">' .
        '<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">' .
            '<span style="background: #dcfce7; color: #166534; font-weight: 800; font-size: 0.8rem; padding: 4px 12px; border-radius: 9999px; text-transform: uppercase;">' .
                'Asynchronous Learning' .
            '</span>' .
            '<span style="font-size: 1.6rem;">📅</span>' .
        '</div>' .
        '<h4 style="margin: 0 0 10px 0; color: #14532d; font-size: 1.25rem; font-weight: 800;">November 29, 2026</h4>' .
        '<p style="margin: 0 0 12px 0; color: #166534; font-weight: 700; font-size: 0.96rem;">Independent Study &amp; Activity Tasks</p>' .
        '<p style="margin: 0; color: #334155; line-height: 1.68; font-size: 0.94rem;">' .
            'Students will work independently on their assigned learning activities. There will be <strong>no class sessions</strong> (face-to-face or live online) on this day. Please ensure all designated modules and tasks are completed.' .
        '</p>' .
    '</div>' .

    '<!-- Card 2: November 30 -->' .
    '<div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 14px; padding: 22px 24px; box-shadow: 0 4px 12px rgba(185, 28, 28, 0.05);">' .
        '<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">' .
            '<span style="background: #fee2e2; color: #991b1b; font-weight: 800; font-size: 0.8rem; padding: 4px 12px; border-radius: 9999px; text-transform: uppercase;">' .
                'Regular Holiday' .
            '</span>' .
            '<span style="font-size: 1.6rem;">🛑</span>' .
        '</div>' .
        '<h4 style="margin: 0 0 10px 0; color: #7f1d1d; font-size: 1.25rem; font-weight: 800;">November 30, 2026</h4>' .
        '<p style="margin: 0 0 12px 0; color: #991b1b; font-weight: 700; font-size: 0.96rem;">School &amp; Office Closed</p>' .
        '<p style="margin: 0; color: #334155; line-height: 1.68; font-size: 0.94rem;">' .
            'In observance of the nationwide <strong>Regular Holiday (Bonifacio Day)</strong>, AMIS will hold <strong>no classes</strong>, and the school campus and administrative offices will be <strong>closed for regular onsite transactions</strong>.' .
        '</p>' .
    '</div>' .

'</div>' .

'<div style="background: #eff6ff; border: 1px solid #bfdbfe; border-left: 4px solid #2563eb; border-radius: 0 12px 12px 0; padding: 18px 22px; margin: 26px 0;">' .
    '<h4 style="margin: 0 0 8px 0; color: #1e40af; font-weight: 800; font-size: 1rem; display: flex; align-items: center; gap: 8px;">' .
        '<span>💳</span> Designated Online Payment Channels Remain Active' .
    '</h4>' .
    '<p style="margin: 0; color: #1e3a8a; line-height: 1.65; font-size: 0.94rem;">' .
        'While the physical school office is closed on November 30, parents and guardians may still conveniently make payments through the school\'s official and designated online payment channels. For transaction verification or queries, proof of payment may be submitted to the official finance channels.' .
    '</p>' .
'</div>' .

'<p style="margin-top: 24px; line-height: 1.7; color: #1e293b;">' .
    'Regular onsite classes and administrative office operations will resume immediately on the next scheduled school day.' .
'</p>' .

'<p style="margin-top: 20px; line-height: 1.6; color: #1e293b;">' .
    'Shukran for your continued cooperation and support. <em>Jazakumullahu khayran. BarakAllahu feekum.</em>' .
'</p>' .

'<p style="margin-top: 32px; line-height: 1.65; color: #334155;">' .
    'Respectfully yours,<br>' .
    '<strong>AL MUNAWWARA ISLAMIC SCHOOL ADMINISTRATION</strong><br>' .
    '<span style="color: #64748b; font-size: 0.92rem;">General Academic &amp; Administrative Affairs • S.Y. 2026–2027</span><br>' .
    '<span style="color: #059669; font-size: 0.9rem; font-style: italic;">Enabling Our Students To Learn Fid Dunya Wal Akhira</span>' .
'</p>';

$advisory->save();

echo "Holiday Advisory successfully saved! ID: " . $advisory->id . PHP_EOL;
echo "Title: " . $advisory->title . PHP_EOL;
echo "Publish Date: " . $advisory->publish_date . PHP_EOL;
