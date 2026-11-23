<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Announcement;
use Illuminate\Support\Str;

$title = 'ACADEMIC ADVISORY: Term 2 Examination (December 1, 2, 3, & 6, 2026)';
$notice = Announcement::firstOrNew(['title' => $title]);

if (!$notice->exists && empty($notice->uuid)) {
    $notice->uuid = (string) Str::uuid();
}

$notice->category = 'Official Advisory';
$notice->priority = 'urgent';
$notice->author = 'AMIS Academic Affairs';
$notice->publish_date = '2026-11-20 09:00:00';
$notice->image = json_encode([
    '/images/announcements/term-2-examination-dec-2026.webp',
    '/images/announcements/term-2-examination-dec-2026.jpg'
]);

$notice->content = '<p><strong>Assalaamu alaikum wa rahmatullahi wa barakatuh.</strong></p>' .
'<p>Please be guided by the following official academic advisory regarding the conduct of the <strong>TERM 2 EXAMINATION (S.Y. 2026&ndash;2027)</strong>:</p>' .
'<hr style="margin: 24px 0; border: none; border-top: 1px solid #e2e8f0;">' .
'<div style="background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 14px; padding: 22px 24px; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.04);">' .
    '<div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">' .
        '<span style="font-size: 1.5rem;">📅</span>' .
        '<h3 style="font-size: 1.25rem; font-weight: 800; color: #166534; margin: 0;">' .
            'Examination Dates: December 1, 2, 3, and 6, 2026' .
        '</h3>' .
    '</div>' .
    '<p style="margin: 0; color: #1e293b; line-height: 1.75; font-size: 0.98rem;">' .
        'All students across all grade levels (Kindergarten, Elementary, Junior High School, and Senior High School) are strongly encouraged to study diligently and review their lessons thoroughly. The <strong>Term 2 Examinations are formally graded</strong> and constitute a vital component of the term\'s overall academic performance.' .
    '</p>' .
'</div>' .
'<div style="background: #fffbeb; border: 1px solid #fef3c7; border-left: 5px solid #f59e0b; border-radius: 0 14px 14px 0; padding: 20px 24px; margin-bottom: 26px;">' .
    '<h4 style="margin: 0 0 10px 0; color: #92400e; font-weight: 800; font-size: 1.05rem; display: flex; align-items: center; gap: 8px;">' .
        '<span>💳</span> Important Reminder for Parents &amp; Guardians' .
    '</h4>' .
    '<p style="margin: 0; color: #78350f; line-height: 1.7; font-size: 0.96rem;">' .
        'Parents and guardians are kindly reminded to <strong>settle any outstanding school payments and tuition balances before the Term Examination week</strong> to ensure seamless examination clearance for students. For queries or verification, please coordinate directly with the AMIS Finance &amp; Accounting Office or utilize our official online payment channels.' .
    '</p>' .
'</div>' .
'<div style="margin: 28px 0; text-align: center;">' .
    '<a href="/calendar" style="display: inline-flex; align-items: center; gap: 8px; background: #059669; color: #ffffff; padding: 12px 26px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; text-decoration: none; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);">' .
        '<span>📋</span> View 2nd Term Examination Schedule &amp; Timetables &rarr;' .
    '</a>' .
'</div>' .
'<p style="margin-top: 24px; line-height: 1.7; color: #1e293b;">' .
    'May Allah (SWT) grant all our students clarity of mind, ease, focus, and exemplary success in all their examination subjects. <em>Ameen.</em>' .
'</p>' .
'<p style="margin-top: 30px; line-height: 1.65; color: #334155;">' .
    'Respectfully yours,<br>' .
    '<strong>AMIS ACADEMIC AFFAIRS &amp; ADMINISTRATION</strong><br>' .
    '<span style="color: #64748b; font-size: 0.92rem;">Al Munawwara Islamic School &bull; S.Y. 2026&ndash;2027</span><br>' .
    '<em style="color: #059669; font-size: 0.9rem;">Enabling Our Students To Learn Fid Dunya Wal Akhira</em>' .
'</p>';

$notice->save();

echo "Term 2 Exam Notice successfully saved!" . PHP_EOL;
echo "ID: " . $notice->id . PHP_EOL;
echo "UUID: " . $notice->uuid . PHP_EOL;
echo "Title: " . $notice->title . PHP_EOL;
echo "Priority: " . $notice->priority . PHP_EOL;
echo "Publish Date: " . $notice->publish_date . PHP_EOL;
