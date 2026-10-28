@extends('layouts.app')

@section('title', 'Gentle Reminder: Preserving Islamic Identity & Moral Values | AMIS')
@section('meta_description', 'Official advisory from the AMIS Shariah Advisory Department (ASAD) reminding all Muslim students and employees to preserve their Islamic identity, uphold the guidance of the Qur\'an and Sunnah, and maintain respectful coexistence.')

@section('styles')
<style>
    .advisory-page {
        min-height: 100vh;
        background: #f8fafc;
    }
    .breadcrumb-header {
        background: linear-gradient(135deg, #064e3b 0%, #047857 60%, #059669 100%);
        padding: 22px 0;
        margin-top: 0;
        position: relative;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 0.88rem;
        flex-wrap: wrap;
    }
    .breadcrumb a {
        color: rgba(255, 255, 255, 0.88);
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb a:hover {
        color: #ffffff;
        text-decoration: underline;
    }
    .breadcrumb .separator {
        color: rgba(255, 255, 255, 0.5);
    }
    .advisory-article-container {
        max-width: 920px;
        margin: 0 auto;
        padding: 40px 20px 80px 20px;
    }
    .advisory-header-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05);
        padding: clamp(24px, 4vw, 42px);
        margin-bottom: 32px;
    }
    .advisory-badges {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }
    .badge-shariah {
        background: #fef3c7;
        border: 1px solid #fde68a;
        color: #b45309;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-dept {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #047857;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 750;
    }
    .badge-sy {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #475569;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 700;
    }
    .advisory-main-title {
        font-size: clamp(1.8rem, 3.2vw, 2.65rem);
        font-weight: 850;
        color: #0f172a;
        line-height: 1.25;
        letter-spacing: -0.02em;
        margin: 0 0 16px 0;
    }
    .advisory-meta-row {
        display: flex;
        align-items: center;
        gap: 16px;
        color: #64748b;
        font-size: 0.88rem;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
    }
    .poster-showcase-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.08);
        margin-bottom: 36px;
    }
    .poster-image-box {
        background: #064e3b;
        position: relative;
        text-align: center;
        padding: 18px 12px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .poster-image-box img {
        max-width: 100%;
        max-height: 820px;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        display: block;
    }
    .poster-toolbar {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 16px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .advisory-body-content {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        padding: clamp(24px, 4vw, 42px);
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05);
        font-size: 1.05rem;
        line-height: 1.85;
        color: #334155;
    }
    .arabic-callout-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
        border: 1.5px solid #a7f3d0;
        border-radius: 18px;
        padding: 24px 28px;
        margin: 28px 0;
        position: relative;
    }
    .arabic-text {
        font-family: 'Amiri', 'Traditional Arabic', 'Scheherazade New', 'Geeza Pro', serif;
        font-size: 1.65rem;
        line-height: 2.1;
        color: #065f46;
        direction: rtl;
        text-align: right;
        margin-bottom: 14px;
        font-weight: 700;
    }
    .arabic-translation {
        font-size: 0.96rem;
        color: #064e3b;
        font-weight: 600;
        border-top: 1px dashed #a7f3d0;
        padding-top: 12px;
        margin-top: 12px;
    }
    .key-principles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 18px;
        margin: 28px 0;
    }
    .principle-item {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
    }
    .principle-item h4 {
        margin: 0 0 8px 0;
        color: #0f172a;
        font-size: 1.05rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .principle-item p {
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.6;
        color: #475569;
    }
    .nav-actions-card {
        margin-top: 36px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        padding: 20px 24px;
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
    }
</style>
@endsection

@section('content')
<div class="advisory-page">
    <!-- Breadcrumb Navigation Bar -->
    <div class="breadcrumb-header">
        <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('events.index') }}">Featured Programs &amp; Events</a>
                <span class="separator">/</span>
                <span>Shariah Advisory: Preserving Islamic Identity</span>
            </div>
        </div>
    </div>

    <!-- Article Container -->
    <div class="advisory-article-container">
        
        <!-- Header Info Card -->
        <div class="advisory-header-card">
            <div class="advisory-badges">
                <span class="badge-shariah">🕌 Official Shariah Advisory</span>
                <span class="badge-dept">AMIS Shariah Advisory Department (ASAD)</span>
                <span class="badge-sy">Academic Year 2026 - 2027</span>
            </div>

            <h1 class="advisory-main-title">
                Gentle Reminder: Preserving Islamic Identity &amp; Moral Values
            </h1>

            <p style="font-size: 1.08rem; color: #475569; line-height: 1.7; margin: 0 0 18px 0; font-weight: 500;">
                A respectful seasonal guidance from the <strong>AMIS Shariah Advisory Department (ASAD)</strong> reminding our Muslim learners, educators, families, and wider community on upholding Islamic principles with grace, wisdom, and respectful coexistence.
            </p>

            <div class="advisory-meta-row">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; background: #ecfdf5; color: #059669; font-weight: 800; font-size: 0.8rem;">
                        ✓
                    </span>
                    <strong style="color: #0f172a;">AMIS Shariah Advisory Department</strong>
                </div>
                <div>•</div>
                <div>Al Munawwara Islamic School</div>
                <div>•</div>
                <div style="display: flex; align-items: center; gap: 6px;">
                    <span>📅</span> October 2026
                </div>
            </div>
        </div>

        <!-- Official Infographic Poster Showcase -->
        <div class="poster-showcase-card">
            <div class="poster-image-box">
                <a href="/images/highlights/asad-gentle-reminder-2026.jpg" target="_blank" title="Click to view full resolution image">
                    <img src="/images/highlights/asad-gentle-reminder-2026.jpg" 
                         alt="AMIS Shariah Advisory Department - Gentle Reminder on Islamic Identity and Moral Values" 
                         class="skip-skeleton" 
                         data-no-skeleton="true">
                </a>
            </div>
            <div class="poster-toolbar">
                <div style="font-size: 0.84rem; color: #64748b; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                    Official Institutional Document &bull; ASAD Advisory
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <a href="/images/highlights/asad-gentle-reminder-2026.jpg" 
                       download="AMIS-Shariah-Advisory-Gentle-Reminder.jpg" 
                       style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; background: #059669; color: #ffffff; text-decoration: none; font-size: 0.84rem; font-weight: 750; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25); transition: background 0.2s;"
                       onmouseover="this.style.background='#047857'"
                       onmouseout="this.style.background='#059669'">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Download Poster
                    </a>
                    <a href="/images/highlights/asad-gentle-reminder-2026.jpg" 
                       target="_blank" 
                       style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; background: #ffffff; border: 1.5px solid #cbd5e1; color: #334155; text-decoration: none; font-size: 0.84rem; font-weight: 700; transition: all 0.2s;"
                       onmouseover="this.style.borderColor='#059669'; this.style.color='#059669';"
                       onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#334155';">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                        Open Full Size
                    </a>
                </div>
            </div>
        </div>

        <!-- Full Advisory Text & Scriptural Insights -->
        <div class="advisory-body-content">
            
            <p style="font-size: 1.25rem; font-weight: 750; color: #064e3b; margin-top: 0; margin-bottom: 24px; font-style: italic;">
                Assalamu alaykum wa rahmatullahi wa barakatuh.
            </p>

            <p>
                As the year-end holiday season approaches, including occasions such as Halloween and Christmas, the <strong>AMIS Shariah Advisory Department (ASAD)</strong>, established by Al Munawwara Islamic School (AMIS), respectfully reminds all Muslim students and employees in schools, government agencies, private companies, and other institutions to <strong>refrain from participating in celebrations, activities, or practices that are associated with the religious beliefs, symbols, and customs of other religions</strong>.
            </p>

            <p>
                Let us uphold the teachings of Islam while maintaining kindness, courtesy, and respect toward people of other faiths. We can promote harmonious relationships and respect others without compromising our Islamic principles.
            </p>

            <!-- Sunnah Guidance Box -->
            <div class="arabic-callout-card">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                    <span style="background: #059669; color: white; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.82rem; font-weight: 800;">📖</span>
                    <strong style="color: #064e3b; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">Guidance from the Noble Sunnah</strong>
                </div>

                <div class="arabic-text">
                    عَبْدِ اللَّهِ بْنِ عُمَرَ رَضِيَ اللَّهُ عَنْهُمَا قَالَ: قَالَ رَسُولُ اللَّهِ ﷺ:<br>
                    «مَنْ تَشَبَّهَ بِقَوْمٍ فَهُوَ مِنْهُمْ»
                </div>

                <div class="arabic-translation">
                    <em>Man tashabbaha biqawmin fahuwa minhum.</em><br>
                    <strong>“Whoever imitates a people is one of them.”</strong> — (Narrated by Abu Dawud, Hadith 4031)
                </div>

                <p style="margin: 14px 0 0 0; font-size: 0.92rem; color: #1e3a2f; line-height: 1.7;">
                    <strong>Explanation:</strong> This hadith warns Muslims against imitating the distinctive religious practices, symbols, and customs of other religions when doing so expresses identification with those religious beliefs or rituals. However, not every form of imitation is prohibited in Islam: Learning beneficial knowledge, using modern technology, wearing ordinary professional or everyday attire, and adopting cultural customs that do not conflict with Islam are permissible. The ruling depends on what is being imitated and the underlying spiritual purpose.
                </p>
            </div>

            <!-- Qur'anic Guidance Box -->
            <div class="arabic-callout-card" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border-color: #fde68a;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                    <span style="background: #d97706; color: white; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.82rem; font-weight: 800;">✨</span>
                    <strong style="color: #92400e; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">Guidance from the Holy Qur'an</strong>
                </div>

                <div class="arabic-text" style="color: #92400e;">
                    ﴿وَلَا تَتَّبِعْ أَهْوَاءَهُمْ عَمَّا جَاءَكَ مِنَ الْحَقِّ﴾
                </div>

                <div class="arabic-translation" style="color: #78350f; border-color: #fde68a;">
                    <strong>“And do not follow their desires away from the truth that has come to you.”</strong> — (Surah Al-Ma'idah, 5:48)
                </div>

                <p style="margin: 14px 0 0 0; font-size: 0.92rem; color: #78350f; line-height: 1.7;">
                    <strong>Core Lesson:</strong> A Muslim should take pride in their Islamic identity, steadfastly follow the guidance of the Qur'an and Sunnah, and avoid participating in rituals or symbols rooted in beliefs contrary to the oneness of Allah (Tawhid).
                </p>
            </div>

            <h3 style="font-size: 1.35rem; font-weight: 850; color: #0f172a; margin: 32px 0 16px 0;">
                Three Guiding Principles for Our Community
            </h3>

            <div class="key-principles-grid">
                <div class="principle-item">
                    <h4><span>🤝</span> Kindness &amp; Courtesy</h4>
                    <p>Islam commands kindness, fairness, and peaceful interaction with non-Muslims in school, workplace, and the neighborhood.</p>
                </div>
                <div class="principle-item">
                    <h4><span>🛡️</span> Religious Boundary</h4>
                    <p>Refrain from wearing costumes, setting up religious decorations, or participating in festivities tied to other faiths' theological beliefs.</p>
                </div>
                <div class="principle-item">
                    <h4><span>🌱</span> Positive Representation</h4>
                    <p>Be an exemplary ambassador of Islam through high moral character (akhlaq), honesty, empathy, and academic excellence.</p>
                </div>
            </div>

            <!-- Closing Du'a -->
            <div style="background: #f8fafc; border-left: 4px solid #059669; padding: 20px 24px; border-radius: 0 16px 16px 0; margin-top: 32px;">
                <p style="margin: 0; font-style: italic; font-weight: 600; color: #065f46; font-size: 1.05rem; line-height: 1.7;">
                    “May Allah guide us to what pleases Him, strengthen our faith, and grant us wisdom to treat everyone with respect and understanding. Ameen.”
                </p>
                <div style="margin-top: 14px; font-size: 0.88rem; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.05em;">
                    AMIS Shariah Advisory Department (ASAD)<br>
                    <span style="font-weight: 600; color: #64748b; text-transform: none;">Al Munawwara Islamic School</span>
                </div>
            </div>

        </div>

        <!-- Navigation Actions at Bottom -->
        <div class="nav-actions-card">
            <a href="{{ route('home') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #059669; font-weight: 750; font-size: 0.92rem; text-decoration: none; padding: 8px 16px; border-radius: 10px; background: #ecfdf5; transition: all 0.2s;" onmouseover="this.style.background='#d1fae5'" onmouseout="this.style.background='#ecfdf5'">
                ← Back to Homepage
            </a>

            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('events.index') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #334155; font-weight: 700; font-size: 0.92rem; text-decoration: none;">
                    📅 All Events &amp; Programs
                </a>
                <span style="color: #cbd5e1;">•</span>
                <a href="{{ route('academics.calendar') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #334155; font-weight: 700; font-size: 0.92rem; text-decoration: none;">
                    🗓️ Academic Calendar
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
