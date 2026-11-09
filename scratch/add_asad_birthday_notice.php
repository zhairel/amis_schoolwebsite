<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Announcement;

$title = 'WARM REMINDER: On Birthday Celebrations';

$notice = Announcement::firstOrNew(['title' => $title]);
$notice->category = 'Islamic Reminder';
$notice->priority = 'normal';
$notice->author = 'AMIS Shariah Advisory Department (ASAD)';
$notice->publish_date = '2026-11-09 13:00:00';
$notice->image = json_encode([
    '/images/announcements/asad-reminder-on-birthday-celebrations.jpg'
]);

$notice->content = '<p><strong>Assalaamu alaikum wa rahmatullahi wa barakatuh.</strong></p>' .
'<p>In the spirit of upholding our Islamic identity and remaining faithful to the guidance of the Qur\'an and Sunnah, the <strong>AMIS Shariah Advisory Department (ASAD)</strong> would like to gently remind the AMIS community about the Islamic ruling on celebrating birthdays.</p>' .
'<p>The evidence from the Qur\'an and Sunnah indicates that celebrating birthdays is a form of <strong>bid\'ah</strong> (innovation in religion), which has no basis in the pure Shari\'ah. Therefore, it is <strong>not permitted</strong> to accept invitations to birthday celebrations, as this may involve supporting and encouraging practices that are not part of Islam.</p>' .
'<hr style="margin: 24px 0; border: none; border-top: 1px solid #e2e8f0;">' .
'<h3 style="font-size: 1.15rem; font-weight: 800; color: #047857; margin-bottom: 14px;">📖 GUIDANCE FROM THE QUR\'AN</h3>' .
'<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; margin-bottom: 22px;">' .
    '<div style="margin-bottom: 16px; padding-bottom: 14px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-start; gap: 16px;">' .
        '<blockquote style="margin: 0; font-style: italic; color: #1e293b; line-height: 1.65; flex-grow: 1;">' .
            '“Or have they partners with Allah (false gods) who have instituted for them a religion which Allah has not allowed...?”' .
        '</blockquote>' .
        '<span style="background: #e2e8f0; color: #334155; font-size: 0.8rem; font-weight: 700; padding: 4px 10px; border-radius: 6px; white-space: nowrap;">Al-Shura (42:21)</span>' .
    '</div>' .
    '<div style="margin-bottom: 16px; padding-bottom: 14px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-start; gap: 16px;">' .
        '<blockquote style="margin: 0; font-style: italic; color: #1e293b; line-height: 1.65; flex-grow: 1;">' .
            '“Then We have put you (O Muhammad) on a plain way of (Our) commandment. So follow that, and follow not the desires of those who know not. Verily, they can avail you nothing against Allah (if He wants to punish you). Verily, the wrongdoers are protectors to one another, but Allah is the Protector of the pious.”' .
        '</blockquote>' .
        '<span style="background: #e2e8f0; color: #334155; font-size: 0.8rem; font-weight: 700; padding: 4px 10px; border-radius: 6px; white-space: nowrap;">Al-Jathiyah (45:18-19)</span>' .
    '</div>' .
    '<div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px;">' .
        '<blockquote style="margin: 0; font-style: italic; color: #1e293b; line-height: 1.65; flex-grow: 1;">' .
            '“Follow what has been sent down unto you from your Lord, and follow not any awliya (protectors, helpers, etc.) besides Him. Little do you remember!”' .
        '</blockquote>' .
        '<span style="background: #e2e8f0; color: #334155; font-size: 0.8rem; font-weight: 700; padding: 4px 10px; border-radius: 6px; white-space: nowrap;">Al-A\'raf (7:3)</span>' .
    '</div>' .
'</div>' .
'<h3 style="font-size: 1.15rem; font-weight: 800; color: #047857; margin-bottom: 14px;">📚 GUIDANCE FROM THE SUNNAH</h3>' .
'<div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 18px 20px; margin-bottom: 22px;">' .
    '<p style="margin-top: 0; margin-bottom: 12px; color: #166534; font-weight: 600;">According to sahih reports, the Prophet (peace and blessings of Allah be upon him) said:</p>' .
    '<ul style="padding-left: 20px; margin: 0 0 14px 0; line-height: 1.7; color: #1e293b;">' .
        '<li style="margin-bottom: 10px;">' .
            '<em>“Whoever does something that is not a part of this matter of ours (i.e., Islam) will have it rejected.”</em> ' .
            '<span style="color: #64748b; font-size: 0.88rem; font-weight: 600;">(Reported by Muslim)</span>' .
        '</li>' .
        '<li>' .
            '<em>“The best of speech is the Book of Allah and the best of guidance is the guidance of Muhammad (peace and blessings of Allah be upon him). The most evil of things are those which have been newly invented (in religion), and every innovation is a going astray.”</em>' .
        '</li>' .
    '</ul>' .
    '<p style="margin: 0; color: #475569; font-size: 0.9rem; font-style: italic;">There are many other ahadith that convey the same meaning.</p>' .
'</div>' .
'<h3 style="font-size: 1.15rem; font-weight: 800; color: #047857; margin-bottom: 14px;">👥 ON IMITATION OF OTHER RELIGIONS</h3>' .
'<div style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 12px; padding: 18px 20px; margin-bottom: 24px;">' .
    '<p style="margin-top: 0; margin-bottom: 12px; color: #78350f; line-height: 1.65;">' .
        'Besides being bid\'ah and having no basis in shari\'ah, birthday celebrations also involve imitation of the Jews and Christians in their practices. The Prophet (peace and blessings of Allah be upon him) said:' .
    '</p>' .
    '<blockquote style="margin: 0 0 12px 0; padding-left: 14px; border-left: 4px solid #f59e0b; font-style: italic; color: #1e293b; line-height: 1.65;">' .
        '“You would follow the ways of those who came before you step by step, to such an extent that if they were to enter a lizard’s hole, you would enter it too.” They said, “O Messenger of Allah, (do you mean) the Jews and Christians?” He said, “Who else?”' .
        '<div style="font-size: 0.85rem; font-weight: 600; color: #64748b; margin-top: 4px; font-style: normal;">(Reported by al-Bukhari and Muslim)</div>' .
    '</blockquote>' .
    '<p style="margin: 12px 0 6px 0; color: #78350f; font-weight: 600;">The Prophet (peace and blessings of Allah be upon him) also said:</p>' .
    '<blockquote style="margin: 0; padding-left: 14px; border-left: 4px solid #f59e0b; font-style: italic; color: #1e293b; line-height: 1.65;">' .
        '“Whoever imitates a people is one of them.”' .
    '</blockquote>' .
'</div>' .
'<div style="background: #ecfdf5; border-left: 4px solid #059669; padding: 16px 20px; border-radius: 0 10px 10px 0; margin-bottom: 28px;">' .
    '<p style="margin: 0 0 8px 0; color: #065f46; font-weight: 600; line-height: 1.65;">' .
        'As Muslims, let us celebrate the blessings in our lives through acts that are pleasing to Allah, such as gratitude, sincere duas, charity, and good deeds.' .
    '</p>' .
    '<p style="margin: 0; color: #047857; font-style: italic; font-weight: 700;">' .
        'And Allah knows best.' .
    '</p>' .
'</div>' .
'<p style="margin-top: 30px; line-height: 1.6; color: #334155;">' .
    '<strong>AMIS Shariah Advisory Department (ASAD)</strong><br>' .
    '<span style="color: #64748b; font-size: 0.92rem;">Al Munawwara Islamic School • Davao City, Philippines</span>' .
'</p>';

$notice->save();

echo "Notice added successfully! ID: " . $notice->id . PHP_EOL;
