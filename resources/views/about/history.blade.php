@extends('layouts.app')

@section('title', 'Our History & Milestones | Al Munawwara Islamic School')

@section('styles')
<style>
    .history-page {
        min-height: 100vh;
        background: #f8fafc;
        padding-bottom: 5rem;
    }

    /* Hero Banner */
    .history-hero {
        background: radial-gradient(circle at 18% 20%, rgba(16, 185, 129, 0.25) 0%, transparent 45%),
                    radial-gradient(circle at 85% 80%, rgba(250, 204, 21, 0.14) 0%, transparent 45%),
                    linear-gradient(135deg, #022c22 0%, #064e3b 52%, #047857 100%);
        color: #ffffff;
        padding: 3.5rem 0 4.25rem;
        position: relative;
        overflow: hidden;
        border-bottom: 3px solid rgba(250, 204, 21, 0.35);
    }

    .history-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 1.5rem;
        background: rgba(255, 255, 255, 0.08);
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .history-breadcrumb a {
        color: #a7f3d0;
        text-decoration: none;
        font-weight: 600;
    }
    .history-breadcrumb a:hover {
        color: #ffffff;
        text-decoration: underline;
    }

    .history-hero-grid {
        display: grid;
        grid-template-columns: 1.35fr 0.65fr;
        gap: 2.5rem;
        align-items: center;
    }

    .history-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(250, 204, 21, 0.16);
        color: #fde047;
        border: 1px solid rgba(250, 204, 21, 0.4);
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .history-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2.1rem, 1.4rem + 2.4vw, 3.25rem);
        font-weight: 900;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin: 0 0 1rem;
        text-wrap: balance;
    }

    .history-hero p {
        font-size: clamp(1rem, 0.92rem + 0.35vw, 1.15rem);
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        max-width: 62ch;
        text-wrap: pretty;
    }

    .history-seal-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 20px;
        padding: 1.75rem;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.22);
    }
    .history-seal-card img {
        width: 96px;
        height: 96px;
        object-fit: contain;
        margin: 0 auto 0.85rem;
        display: block;
        background: #ffffff;
        border-radius: 50%;
        padding: 6px;
    }
    .history-seal-arabic {
        font-family: 'Amiri', serif;
        font-size: 1.5rem;
        color: #fde047;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .history-seal-year {
        font-size: 0.82rem;
        font-weight: 700;
        color: #a7f3d0;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    /* Key Milestone Stats Strip */
    .history-stats-strip {
        margin-top: -2rem;
        position: relative;
        z-index: 5;
        margin-bottom: 3rem;
    }
    .history-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1.15rem;
    }
    .history-stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.35rem 1.25rem;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        border-top: 4px solid #059669;
    }
    .history-stat-value {
        font-family: 'Outfit', sans-serif;
        font-size: 1.65rem;
        font-weight: 900;
        color: #065f46;
        line-height: 1.1;
    }
    .history-stat-label {
        font-size: 0.88rem;
        font-weight: 800;
        color: #0f172a;
    }
    .history-stat-desc {
        font-size: 0.78rem;
        color: #64748b;
        line-height: 1.45;
    }

    /* Main Content Layout */
    .history-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.75rem;
        max-width: 1080px;
        margin: 0 auto;
    }

    /* Narrative Story Card */
    .history-story-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: clamp(1.5rem, 3vw, 2.75rem);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
    }
    .history-section-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        padding: 0.3rem 0.85rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.75rem;
    }
    .history-story-card h2 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.55rem, 1.2rem + 1.2vw, 2.15rem);
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 1.25rem;
        line-height: 1.25;
        text-wrap: balance;
    }
    .history-narrative-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.75rem;
    }
    .history-narrative-col p {
        font-size: 1rem;
        line-height: 1.75;
        color: #334155;
        margin: 0 0 1.15rem;
        text-align: start;
        text-wrap: pretty;
    }
    .history-narrative-col p:last-child {
        margin-bottom: 0;
    }

    /* Timeline Section */
    .history-timeline-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: clamp(1.5rem, 3vw, 2.75rem);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
    }
    .history-timeline-header {
        margin-bottom: 2rem;
    }
    .history-timeline-header h2 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.55rem, 1.2rem + 1.2vw, 2.15rem);
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 0.4rem;
    }
    .history-timeline-header p {
        color: #64748b;
        font-size: 0.98rem;
        margin: 0;
    }

    .timeline-list {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 1.35rem;
        padding-left: 1.75rem;
        border-left: 3px solid #a7f3d0;
        margin-left: 0.75rem;
    }
    .timeline-item {
        position: relative;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.35rem 1.5rem;
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .timeline-item:hover {
        transform: translateX(4px);
        border-color: #059669;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.08);
    }
    .timeline-dot {
        position: absolute;
        left: calc(-1.75rem - 11px);
        top: 1.5rem;
        width: 19px;
        height: 19px;
        border-radius: 50%;
        background: #059669;
        border: 4px solid #ffffff;
        box-shadow: 0 0 0 2px #059669;
    }
    .timeline-year-badge {
        display: inline-block;
        background: #065f46;
        color: #ffffff;
        font-size: 0.76rem;
        font-weight: 800;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        letter-spacing: 0.04em;
        margin-bottom: 0.55rem;
    }
    .timeline-item h3 {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 0.45rem;
        line-height: 1.35;
    }
    .timeline-item p {
        font-size: 0.95rem;
        line-height: 1.68;
        color: #475569;
        margin: 0;
        text-align: start;
        text-wrap: pretty;
    }

    /* Islamic Developmental Approach Highlight Banner */
    .history-approach-banner {
        background: linear-gradient(135deg, #064e3b 0%, #047857 100%);
        color: #ffffff;
        border-radius: 22px;
        padding: clamp(1.75rem, 3vw, 2.5rem);
        display: grid;
        grid-template-columns: 1.35fr 0.65fr;
        gap: 2rem;
        align-items: center;
        box-shadow: 0 14px 32px rgba(6, 78, 59, 0.18);
    }
    .history-approach-banner h2 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.4rem, 1.1rem + 1vw, 1.9rem);
        font-weight: 800;
        margin: 0 0 0.75rem;
        color: #ffffff;
    }
    .history-approach-banner p {
        font-size: 0.98rem;
        line-height: 1.72;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        text-wrap: pretty;
    }
    .history-quick-links {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .history-quick-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.85rem 1.15rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.22);
        color: #ffffff;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .history-quick-link:hover {
        background: #facc15;
        color: #0f172a;
        border-color: #facc15;
        transform: translateX(4px);
    }

    @media (max-width: 900px) {
        .history-hero-grid,
        .history-narrative-grid,
        .history-approach-banner {
            grid-template-columns: 1fr;
        }
        .history-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 560px) {
        .history-stats-grid {
            grid-template-columns: 1fr;
        }
        .timeline-list {
            padding-left: 1.25rem;
        }
        .timeline-dot {
            left: calc(-1.25rem - 11px);
        }
    }
</style>
@endsection

@section('content')
<div class="history-page">
    <!-- Hero Header -->
    <section class="history-hero">
        <div class="container">
            <nav class="history-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('about.history') }}">About Us</a>
                <span>/</span>
                <span>History &amp; Milestones</span>
            </nav>

            <div class="history-hero-grid">
                <div>
                    <span class="history-kicker">Pioneering Islamic Education Since 2008</span>
                    <h1>The History &amp; Legacy of Al Munawwara Islamic School</h1>
                    <p>
                        From a historic 1996 Peace Agreement initiative to Davao City&rsquo;s first Department of Education (DepEd)-recognized private Islamic school, serving learners from Kindergarten 1 to Grade 12 across the Philippines and abroad.
                    </p>
                </div>

                <div class="history-seal-card">
                    <img src="{{ asset('logo.png') }}" alt="Al Munawwara Islamic School Official Seal">
                    <div class="history-seal-arabic">المدرسة المنورة الإسلامية</div>
                    <div style="font-weight: 800; font-size: 1rem; margin-bottom: 0.2rem;">Al Munawwara Islamic School</div>
                    <div class="history-seal-year">Established 2008 CE &bull; 1429 AH</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Highlights Strip -->
    <div class="container history-stats-strip">
        <div class="history-stats-grid">
            <div class="history-stat-card">
                <span class="history-stat-value">2008</span>
                <span class="history-stat-label">Year Established (1429 AH)</span>
                <span class="history-stat-desc">1st DepEd-recognized private Islamic school in Davao City</span>
            </div>
            <div class="history-stat-card">
                <span class="history-stat-value">DO 51, s. 2004</span>
                <span class="history-stat-label">DepEd Standard Madrasah</span>
                <span class="history-stat-desc">Pilot private madrasah integrating K–12 &amp; Islamic Studies</span>
            </div>
            <div class="history-stat-card">
                <span class="history-stat-value">K1 – Grade 12</span>
                <span class="history-stat-label">Complete Basic Education</span>
                <span class="history-stat-desc">Face-to-Face Campus &amp; Global Flexible Online Learning</span>
            </div>
            <div class="history-stat-card">
                <span class="history-stat-value">PEAC &bull; QAHE &bull; ACTD</span>
                <span class="history-stat-label">National &amp; Global Recognition</span>
                <span class="history-stat-desc">PEAC ESC Full Compliance, QAHE &amp; ACTD USA Accredited</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="history-layout">

            <!-- Founding Narrative Card -->
            <article class="history-story-card">
                <span class="history-section-tag">Founding Story</span>
                <h2>Rooted in Peace, Built for Academic &amp; Moral Excellence</h2>
                <div class="history-narrative-grid">
                    <div class="history-narrative-col">
                        <p>
                            <strong>Al Munawwara Islamic School (AMIS)</strong> was established in <strong>2008</strong> as a vital educational fruit of the <strong>1996 Moro National Liberation Front (MNLF) and Government of the Republic of the Philippines (GRP) Peace Agreement</strong>, which envisioned integrating traditional madrasahs into the formal Philippine educational system.
                        </p>
                        <p>
                            Pursuant to <strong>DepEd Order No. 51, Series of 2004</strong>, signed by former DepEd Secretary <strong>Mr. Edilberto C. de Jesus</strong>, traditional madrasahs were invited to become pilot private madrasahs implementing the Standard Madrasah Curriculum. Following four years of intensive institutional and curricular preparation, AMIS opened its doors in 2008 as the <strong>first-ever private Islamic school in Davao City duly recognized by the Department of Education (DepEd)</strong>.
                        </p>
                    </div>
                    <div class="history-narrative-col">
                        <p>
                            During its inaugural <strong>School Year 2008–2009</strong> and Summer 2009 term, the school offered <strong>Kindergarten, Preparatory, and Grade 1</strong> levels. It pioneered an 8-week Early Childhood Learning readiness curriculum alongside an <strong>Accelerated Islamic Studies Learning Program (ISAL)</strong> designed to help transferee learners catch up in Qur&rsquo;an, Arabic, and Islamic Studies.
                        </p>
                        <p>
                            Today, AMIS offers complete Basic Education from <strong>Kindergarten 1 to Grade 12 (Senior High School)</strong>, combining the Department of Education&rsquo;s <strong>K–12 and MATATAG / Revised K–10 Curriculum</strong> with a refined Standard Madrasah Curriculum, backed by <strong>PEAC ESC Certified Status</strong> and international accreditations from <strong>QAHE</strong> and <strong>ACTD USA</strong>.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Chronological Milestones Timeline -->
            <section class="history-timeline-section" aria-label="AMIS Historical Timeline">
                <div class="history-timeline-header">
                    <span class="history-section-tag">Chronological Journey</span>
                    <h2>Institutional Milestones (1996 – Present)</h2>
                    <p>Key turning points in the growth of Al Munawwara Islamic School</p>
                </div>

                <div class="timeline-list">
                    <div class="timeline-item">
                        <span class="timeline-dot"></span>
                        <span class="timeline-year-badge">1996 &bull; Peace Agreement Foundation</span>
                        <h3>MNLF–GRP Final Peace Agreement Educational Mandate</h3>
                        <p>The 1996 Peace Agreement establishes the national framework to integrate traditional Islamic madrasahs into the formal Philippine educational system while preserving Islamic identity and scholarship.</p>
                    </div>

                    <div class="timeline-item">
                        <span class="timeline-dot"></span>
                        <span class="timeline-year-badge">2004 &bull; DepEd Order No. 51, s. 2004</span>
                        <h3>Standard Curriculum for Elementary &amp; Private Madrasahs</h3>
                        <p>Issued by DepEd Secretary Edilberto C. de Jesus, institutionalizing the Standard Curriculum for Elementary Public Schools and Private Madaris and inviting pilot private Islamic schools across the country.</p>
                    </div>

                    <div class="timeline-item">
                        <span class="timeline-dot"></span>
                        <span class="timeline-year-badge">2008 (1429 AH) &bull; Official Founding</span>
                        <h3>Davao City&rsquo;s First DepEd-Recognized Private Islamic School</h3>
                        <p>After four years of preparation, Al Munawwara Islamic School is officially established in Davao City, launching with Kindergarten, Preparatory, Grade 1, and the Accelerated Islamic Studies Learning Program.</p>
                    </div>

                    <div class="timeline-item">
                        <span class="timeline-dot"></span>
                        <span class="timeline-year-badge">2010 – 2019 &bull; K–12 Expansion</span>
                        <h3>Full Elementary, Junior High &amp; Senior High School Programs</h3>
                        <p>AMIS expands year by year to deliver complete Basic Education from Kindergarten 1 through Grade 12, integrating DepEd academic standards with Arabic Language, Qur&rsquo;anic Studies, Aqeedah, Fiqh, Hadith, and Seerah.</p>
                    </div>

                    <div class="timeline-item">
                        <span class="timeline-dot"></span>
                        <span class="timeline-year-badge">2020 – Present &bull; Global &amp; Accredited Excellence</span>
                        <h3>PEAC ESC Certification, International Accreditation &amp; Global Flexible Learning</h3>
                        <p>AMIS earns PEAC ESC Full Compliance Certification (valid through 2030), international accreditation from QAHE and ACTD USA, and launches Flexible Online Learning (1st &amp; 2nd Shifts) serving Filipino Muslim families across the Philippines, the Middle East, and worldwide.</p>
                    </div>
                </div>
            </section>

            <!-- Islamic Developmental Approach Banner -->
            <section class="history-approach-banner">
                <div>
                    <span class="history-kicker" style="margin-bottom: 0.65rem;">Educational Philosophy</span>
                    <h2>The Islamic Developmental Approach</h2>
                    <p>
                        Al Munawwara Islamic School believes that the <strong>Islamic Developmental Approach</strong> leads to true academic excellence—nurturing creativity, critical inquiry, and holistic physical, social, intellectual, and spiritual growth anchored on the <strong>Holy Qur&rsquo;an and the Sunnah</strong>.
                    </p>
                </div>

                <div class="history-quick-links">
                    <a href="{{ route('about.philosophy') }}" class="history-quick-link">
                        <span>Philosophy, Vision, Mission &amp; Goals</span>
                        <span>&rarr;</span>
                    </a>
                    <a href="{{ route('about.certifications') }}" class="history-quick-link">
                        <span>DepEd, PEAC, QAHE &amp; ACTD Certifications</span>
                        <span>&rarr;</span>
                    </a>
                    <a href="{{ route('about.logo') }}" class="history-quick-link">
                        <span>AMIS Official Seal &amp; Symbolism</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
