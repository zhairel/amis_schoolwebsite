<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Announcement;

$title = 'EARLY ENROLLMENT ADVISORY: School Year 2027–2028 (Starts December 1–31, 2026)';

$notice = Announcement::firstOrNew(['title' => $title]);
$notice->category = 'Official Advisory';
$notice->priority = 'urgent';
$notice->author = 'AMIS Admissions & Registrar';
$notice->publish_date = now();
$notice->event_dates = 'December 1–31, 2026';
$notice->event_venue = 'Al Munawwara Islamic School Campus & AES Online Portal (https://aes.amis.edu.ph)';
$notice->is_online = true;
$notice->image = json_encode([
    '/images/announcements/early-enrollment-sy2027-2028.webp',
    '/images/announcements/early-enrollment-sy2027-2028.jpg'
]);

$notice->content = '<p class="salutation-islamic" style="display: inline-flex; align-items: center; gap: 8px; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 9999px; padding: 6px 18px; font-weight: 700; font-size: 0.92rem; margin-bottom: 20px;"><span>Assalaamu alaikum wa rahmatullahi wa barakatuh.</span></p>' .
'<p class="article-lead" style="font-size: 1.15rem; line-height: 1.8; color: #1e293b; font-weight: 500; margin-bottom: 22px;"><strong>Al Munawwara Islamic School (AMIS)</strong> is pleased to announce that <strong>Early Enrollment for School Year 2027–2028</strong> will officially start on <strong>December 1 to 31, 2026</strong>! <strong>New students are all warmly welcome!</strong></p>' .
'<div style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%); border-radius: 16px; padding: 26px 28px; margin: 28px 0; color: white; box-shadow: 0 10px 25px -5px rgba(5, 150, 105, 0.3);">' .
    '<div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">' .
        '<span style="background: #facc15; color: #0f172a; font-size: 0.75rem; font-weight: 800; padding: 3px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em;">Exclusive Discount Offer</span>' .
        '<span style="font-size: 0.85rem; color: #a7f3d0; font-weight: 600;">Starts December 1, 2026</span>' .
    '</div>' .
    '<h3 style="color: white; font-size: 1.4rem; font-weight: 800; margin: 0 0 8px 0; line-height: 1.3;">Avail the 15% Early Enrollment Discount</h3>' .
    '<p style="color: #d1fae5; font-size: 0.95rem; margin: 0 0 20px 0; line-height: 1.6;">Secure your child’s slot early for S.Y. 2027–2028 and enjoy our special early enrollment tuition discounts.</p>' .
    '<div style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">' .
        '<a href="https://aes.amis.edu.ph" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: #facc15; color: #0f172a; padding: 12px 24px; border-radius: 10px; font-weight: 800; font-size: 0.95rem; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">' .
            '<span>Enroll Online via AES &rarr;</span>' .
        '</a>' .
        '<a href="tel:+639454185438" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.15); color: white; border: 1.5px solid rgba(255, 255, 255, 0.4); padding: 11px 22px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; text-decoration: none;">' .
            '<span>Inquire via Registrar</span>' .
        '</a>' .
    '</div>' .
'</div>' .
'<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px 24px; margin: 26px 0;">' .
    '<h4 style="margin: 0 0 14px 0; font-size: 1.1rem; font-weight: 800; color: #0f172a;">Discount Guidelines &amp; Conditions</h4>' .
    '<ul style="margin: 0; padding-left: 20px; color: #334155; line-height: 1.8; font-size: 0.95rem;">' .
        '<li><strong>For Old/Continuing Students:</strong> To enjoy the <strong>15% Early Enrollment Discount</strong> for SY 2027–2028, you must fully pay the <strong>July to December monthly payment</strong> (of SY 2026–2027) first upon enrollment.</li>' .
        '<li><strong>Siblings Discount:</strong>' .
            '<ul style="margin: 6px 0 6px 16px; list-style-type: disc;">' .
                '<li><strong>2nd Child:</strong> 10% Discount</li>' .
                '<li><strong>3rd Child:</strong> 15% Discount</li>' .
                '<li><strong>4th Child:</strong> 20% Discount</li>' .
            '</ul>' .
        '</li>' .
        '<li><strong>Additional Full Payment Discount:</strong> Enjoy an <strong>additional 5% Discount</strong> if you pay the <strong>FULL PAYMENT</strong> for the entire S.Y. 2027–2028!</li>' .
    '</ul>' .
'</div>' .
'<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin: 28px 0;">' .
    '<div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 14px; padding: 20px 22px;">' .
        '<div style="color: #166534; font-weight: 800; font-size: 0.82rem; text-transform: uppercase; margin-bottom: 8px;">Complete Basic Education Program</div>' .
        '<ul style="margin: 0; padding-left: 18px; color: #1e293b; line-height: 1.7; font-size: 0.92rem;">' .
            '<li>Kindergarten</li>' .
            '<li>Grades 1 – 6 (Elementary)</li>' .
            '<li>Grades 7 – 10 (Junior High School)</li>' .
            '<li>Grades 11 – 12 (Senior High School – Academic Track)</li>' .
        '</ul>' .
    '</div>' .
    '<div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 14px; padding: 20px 22px;">' .
        '<div style="color: #1e40af; font-weight: 800; font-size: 0.82rem; text-transform: uppercase; margin-bottom: 8px;">Curriculum Offered</div>' .
        '<ul style="margin: 0; padding-left: 18px; color: #1e293b; line-height: 1.7; font-size: 0.92rem;">' .
            '<li><strong>DepEd Curriculum:</strong> Recognized Standard Philippine Basic Education</li>' .
            '<li><strong>Refined Standard Madrasah Curriculum:</strong> Integrated Arabic Language &amp; Islamic Studies (ALIVE)</li>' .
        '</ul>' .
    '</div>' .
'</div>' .
'<div style="text-align: center; padding: 22px; background: #ecfdf5; border: 1.5px dashed #059669; border-radius: 14px; margin: 30px 0;">' .
    '<span style="display: block; font-size: 0.82rem; font-weight: 800; color: #047857; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px;">Enroll Early, Save More!</span>' .
    '<span style="font-size: 1.35rem; font-weight: 900; color: #064e3b; letter-spacing: -0.02em;">Secure Your Child’s Slot for SY 2027–2028 Today!</span>' .
'</div>' .
'<p style="margin-top: 26px; line-height: 1.6; color: #334155;">' .
    '<strong>AMIS Admissions &amp; Registrar’s Office</strong><br>' .
    '<span style="color: #64748b; font-size: 0.92rem;">Al Munawwara Islamic School • Ma-A, Davao City, Philippines</span><br>' .
    '<em style="color: #059669; font-size: 0.9rem;">Enabling Our Students To Learn In Fid Dunya Wal Akhira</em>' .
'</p>';

$notice->save();

echo "Notice created successfully with ID: " . $notice->id . PHP_EOL;
