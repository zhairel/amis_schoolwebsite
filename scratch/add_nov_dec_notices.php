<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Announcement;
use Illuminate\Support\Str;

// 1. Holiday Advisory
$holidayTitle = 'HOLIDAY ADVISORY: No Classes on November 29–30, 2026';
$holidayNotice = Announcement::firstOrNew(['title' => $holidayTitle]);
if (!$holidayNotice->exists && empty($holidayNotice->uuid)) {
    $holidayNotice->uuid = (string) Str::uuid();
}
$holidayNotice->category = 'Official Advisory';
$holidayNotice->priority = 'high';
$holidayNotice->author = 'AMIS Administration';
$holidayNotice->publish_date = '2026-11-20 08:00:00';
$holidayNotice->image = json_encode([
    '/images/announcements/holiday-advisory-nov-29-30-2026.webp',
    '/images/announcements/holiday-advisory-nov-29-30-2026.jpg'
]);

$holidayNotice->content = '<p><strong>Assalaamu alaikum wa rahmatullahi wa barakatuh.</strong></p>' .
'<p>Please be guided by the following schedule of classes and school operations for <strong>November 29 and November 30, 2026</strong>:</p>' .
'<hr style="margin: 24px 0; border: none; border-top: 1px solid #e2e8f0;">' .
'<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #059669; border-radius: 0 12px 12px 0; padding: 20px 22px; margin-bottom: 20px;">' .
    '<h3 style="font-size: 1.15rem; font-weight: 800; color: #065f46; margin: 0 0 8px 0;">' .
        'November 29, 2026 (Sunday) &mdash; Asynchronous Learning' .
    '</h3>' .
    '<p style="margin: 0; color: #1e293b; line-height: 1.7;">' .
        'Students will work independently on their assigned learning activities and tasks. There will be <strong>no physical or synchronous online class sessions</strong> on this day.' .
    '</p>' .
'</div>' .
'<div style="background: #fffbeb; border: 1px solid #fef3c7; border-left: 4px solid #f59e0b; border-radius: 0 12px 12px 0; padding: 20px 22px; margin-bottom: 24px;">' .
    '<h3 style="font-size: 1.15rem; font-weight: 800; color: #92400e; margin: 0 0 8px 0;">' .
        'November 30, 2026 (Monday) &mdash; Regular Holiday (Bonifacio Day)' .
    '</h3>' .
    '<p style="margin: 0; color: #78350f; line-height: 1.7;">' .
        'In observance of Bonifacio Day, AMIS will hold <strong>no classes</strong>, and the <strong>school office will be closed</strong> for regular on-site transactions.' .
    '</p>' .
    '<p style="margin: 10px 0 0 0; color: #92400e; font-size: 0.95rem; line-height: 1.6;">' .
        '<em>Note: You may still make school tuition and fee payments through the school\'s designated online payment channels.</em>' .
    '</p>' .
'</div>' .
'<p style="margin-top: 20px; line-height: 1.6;">' .
    'We encourage our students to use the asynchronous learning period productively in preparation for their upcoming academic requirements and examinations.' .
'</p>' .
'<p style="margin-top: 26px; line-height: 1.6; color: #334155;">' .
    '<strong>AMIS Administration</strong><br>' .
    '<span style="color: #64748b; font-size: 0.92rem;">Al Munawwara Islamic School &bull; S.Y. 2026&ndash;2027</span><br>' .
    '<em style="color: #059669; font-size: 0.9rem;">Enabling Our Students To Learn Fid Dunya Wal Akhira</em>' .
'</p>';

$holidayNotice->save();
echo "Holiday Notice saved! ID: " . $holidayNotice->id . " UUID: " . $holidayNotice->uuid . PHP_EOL;

// 2. Term 2 Examination Advisory
$examTitle = 'ACADEMIC ADVISORY: Term 2 Examination (December 1, 2, 3, & 6, 2026)';
$examNotice = Announcement::firstOrNew(['title' => $examTitle]);
if (!$examNotice->exists && empty($examNotice->uuid)) {
    $examNotice->uuid = (string) Str::uuid();
}
$examNotice->category = 'Official Advisory';
$examNotice->priority = 'urgent';
$examNotice->author = 'AMIS Academic Affairs';
$examNotice->publish_date = '2026-11-20 09:00:00';
$examNotice->image = json_encode([
    '/images/announcements/term-2-examination-dec-2026.webp',
    '/images/announcements/term-2-examination-dec-2026.jpg'
]);

$examNotice->content = '<p><strong>Assalaamu alaikum wa rahmatullahi wa barakatuh.</strong></p>' .
'<p>Please be informed that our <strong>TERM 2 EXAMINATION (S.Y. 2026&ndash;2027)</strong> will be officially conducted on <strong>December 1, 2, 3, and 6, 2026</strong>.</p>' .
'<hr style="margin: 24px 0; border: none; border-top: 1px solid #e2e8f0;">' .
'<div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px 22px; margin-bottom: 24px;">' .
    '<h3 style="font-size: 1.15rem; font-weight: 800; color: #166534; margin: 0 0 12px 0;">' .
        'Examination Dates: December 1, 2, 3, and 6, 2026' .
    '</h3>' .
    '<p style="margin: 0; color: #1e293b; line-height: 1.7;">' .
        'All students are strongly encouraged to study diligently and review their lessons thoroughly, as the <strong>Term 2 Examinations are formally graded</strong> and constitute a vital part of their academic assessment.' .
    '</p>' .
'</div>' .
'<div style="background: #fffbeb; border: 1px solid #fef3c7; border-left: 4px solid #f59e0b; border-radius: 0 12px 12px 0; padding: 18px 20px; margin-bottom: 24px;">' .
    '<h4 style="margin: 0 0 8px 0; color: #92400e; font-weight: 800; font-size: 1rem;">' .
        'Reminder for Parents &amp; Guardians:' .
    '</h4>' .
    '<p style="margin: 0; color: #78350f; line-height: 1.65;">' .
        'Parents and guardians are kindly reminded to <strong>settle any outstanding school payments and tuition balances before the Term Examination week</strong> to ensure smooth examination clearance for students. For assistance or questions regarding accounts, please coordinate directly with the AMIS Finance &amp; Accounting Office.' .
    '</p>' .
'</div>' .
'<p style="margin-top: 20px; line-height: 1.6;">' .
    'May Allah (SWT) grant all our students focus, clarity of mind, ease in understanding, and success in their examinations. <em>Ameen.</em>' .
'</p>' .
'<p style="margin-top: 26px; line-height: 1.6; color: #334155;">' .
    '<strong>AMIS Academic Affairs &amp; Administration</strong><br>' .
    '<span style="color: #64748b; font-size: 0.92rem;">Al Munawwara Islamic School &bull; S.Y. 2026&ndash;2027</span><br>' .
    '<em style="color: #059669; font-size: 0.9rem;">Enabling Our Students To Learn Fid Dunya Wal Akhira</em>' .
'</p>';

$examNotice->save();
echo "Exam Notice saved! ID: " . $examNotice->id . " UUID: " . $examNotice->uuid . PHP_EOL;
