<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Announcement;
use Illuminate\Support\Str;

echo "=== ADD 3RD AMIS VIRTUAL INTERNATIONAL QUR'ANIC MUSABAQAH NOTICE ===\n";

$title = "EVENT ANNOUNCEMENT: 3rd AMIS Virtual International Qur'anic Musabaqah";

$notice = Announcement::where('title', 'like', '%Virtual International%Musabaqah%')
    ->orWhere('title', 'like', '%3rd AMIS%Musabaqah%')
    ->first();

if (!$notice) {
    echo "Creating new announcement record...\n";
    $notice = new Announcement();
    $notice->uuid = (string) Str::uuid();
} else {
    echo "Updating existing announcement #{$notice->id}...\n";
}

$notice->title = $title;
$notice->category = 'Official Announcement';
$notice->priority = 'urgent';
$notice->author = 'AMIS Musabaqah Committee';
$notice->publish_date = now();
$notice->event_dates = 'January 29–31, 2027 (Sha\'ban 21–23, 1448 AH)';
$notice->event_venue = 'via Microsoft Teams';
$notice->is_online = 1;

$notice->image = json_encode([
    '/images/announcements/amis-3rd-intl-musabaqah-2027.webp',
    '/images/announcements/amis-3rd-intl-musabaqah-2027.png',
]);

$notice->content = '
<p class="salutation-islamic" style="display: inline-flex; align-items: center; gap: 8px; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 9999px; padding: 6px 18px; font-weight: 700; font-size: 0.92rem; margin-bottom: 20px;">
    <span>Assalaamu alaykum wa rahmatullahi wa barakatuhu.</span>
</p>

<p class="article-lead" style="font-size: 1.15rem; line-height: 1.8; color: #0f172a; margin-bottom: 24px; font-weight: 500;">
    Al Munawwara Islamic School (AMIS) is pleased to announce its upcoming <strong>3rd AMIS Virtual International Qur\'anic Musabaqah</strong> (المسابقة القرآنية الدولية الافتراضية الثالثة) — a prestigious global gathering dedicated to nurturing young hearts through the memorization and beautiful recitation of the Noble Qur’an.
</p>

<!-- Event Branding Poster Card -->
<div class="musabaqah-featured-poster-card" style="margin: 20px 0 32px; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); background: #f8fafc; text-align: center;">
    <picture>
        <source srcset="/images/announcements/amis-3rd-intl-musabaqah-2027.webp" type="image/webp">
        <img src="/images/announcements/amis-3rd-intl-musabaqah-2027.png" 
             alt="3rd AMIS Virtual International Qur\'anic Musabaqah - The Qur\'an: Our Path to Paradise" 
             style="width: 100%; max-width: 600px; height: auto; display: block; margin: 0 auto; border-radius: 12px;" 
             loading="eager">
    </picture>
</div>

<!-- Theme Banner -->
<div style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%); color: white; border-radius: 14px; padding: 22px 26px; margin: 24px 0 30px; border-left: 6px solid #facc15; box-shadow: 0 4px 15px rgba(6, 78, 59, 0.2);">
    <div style="font-size: 0.82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.2px; color: #fde047; margin-bottom: 6px;">Event Theme</div>
    <div style="font-size: 1.35rem; font-weight: 800; line-height: 1.4; color: #ffffff; font-style: italic;">“The Qur\'an: Our Path to Paradise”</div>
    <div style="font-size: 0.95rem; color: #d1fae5; margin-top: 8px;">January 29–31, 2027 &bull; Sha\'ban 21–23, 1448 AH &bull; via Microsoft Teams</div>
</div>

<!-- Key Event Details Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; margin: 24px 0 32px;">
    <!-- Card 1: Activities -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">📖</div>
            <h4 style="margin: 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">Activities</h4>
        </div>
        <ul style="margin: 0; padding-left: 20px; color: #334155; line-height: 1.8; font-size: 0.95rem;">
            <li><strong>Hifdhul Qur\'an</strong> (Qur\'an Memorization)</li>
            <li><strong>Tilawatul Qur\'an</strong> (Qur\'an Reading)</li>
        </ul>
    </div>

    <!-- Card 2: Age Categories -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">👥</div>
            <h4 style="margin: 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">Age Categories</h4>
        </div>
        <ul style="margin: 0; padding-left: 20px; color: #334155; line-height: 1.8; font-size: 0.95rem;">
            <li><strong>Category "Sighar":</strong> Aged 6 to 8 years</li>
            <li><strong>Category "Yafie":</strong> Aged 9 to 13 years</li>
            <li><strong>Category "Shabab":</strong> Aged 14 to 18 years</li>
        </ul>
    </div>
</div>

<!-- Registration Callout Card -->
<div style="background: #f0fdf4; border: 2px solid #86efac; border-radius: 14px; padding: 24px; margin: 28px 0; text-align: center;">
    <div style="display: inline-block; background: #16a34a; color: white; font-size: 0.78rem; font-weight: 800; padding: 4px 14px; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px;">
        Registration Now Open
    </div>
    <h3 style="margin: 0 0 10px; font-size: 1.35rem; font-weight: 800; color: #14532d;">Secure Your Spot in the 3rd Musabaqah</h3>
    <p style="margin: 0 0 16px; color: #166534; font-size: 0.95rem; line-height: 1.6;">
        Registration Period: <strong>October 26, 2026 &ndash; January 17, 2027</strong>
    </p>
    <a href="https://tinyurl.com/AMIS3rdIntlMusabaqah2027" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: #15803d; color: white; text-decoration: none; font-weight: 800; padding: 12px 28px; border-radius: 8px; font-size: 1rem; box-shadow: 0 4px 12px rgba(21, 128, 61, 0.35);">
        <span>Register Online (tinyurl.com/AMIS3rdIntlMusabaqah2027) &rarr;</span>
    </a>
</div>

<!-- Inquiries & Contact Info -->
<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px 24px; margin: 24px 0;">
    <h4 style="margin: 0 0 12px; font-size: 1.05rem; font-weight: 800; color: #0f172a;">For Inquiries &amp; Coordination:</h4>
    <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.95rem; color: #334155;">
        <div><strong>Contact Person:</strong> +63 954 194 2929 &mdash; Ms. Silfah S. Negroprado</div>
        <div><strong>Email:</strong> <a href="mailto:amisinternationalmusabaqah@gmail.com" style="color: #059669; font-weight: 700; text-decoration: none;">amisinternationalmusabaqah@gmail.com</a></div>
        <div><strong>Facebook Page:</strong> Al Munawwara Islamic School - AMIS International Musabaqah</div>
        <div><strong>Organizer:</strong> Al Munawwara Islamic School (AMIS), Ma-a, Davao City, Philippines</div>
    </div>
</div>
';

$notice->save();

echo "Notice saved successfully with ID: {$notice->id} and UUID: {$notice->uuid}\n";
