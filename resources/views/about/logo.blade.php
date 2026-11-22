@extends('layouts.app')

@section('title', 'Official School Seal & Logo Meaning | Al Munawwara Islamic School')

@section('styles')
<style>
    .logo-page {
        min-height: 100vh;
        background: #f8fafc;
        padding-bottom: 5rem;
    }

    .logo-hero {
        background: radial-gradient(circle at 20% 20%, rgba(16, 185, 129, 0.25) 0%, transparent 45%),
                    linear-gradient(135deg, #022c22 0%, #064e3b 55%, #047857 100%);
        color: #ffffff;
        padding: 3.5rem 0 4rem;
        border-bottom: 3px solid rgba(250, 204, 21, 0.35);
    }

    .logo-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 1.35rem;
        background: rgba(255, 255, 255, 0.08);
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .logo-breadcrumb a {
        color: #a7f3d0;
        text-decoration: none;
        font-weight: 600;
    }

    .logo-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2rem, 1.3rem + 2.2vw, 3rem);
        font-weight: 900;
        margin: 0 0 0.65rem;
    }
    .logo-hero p {
        font-size: 1.08rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    .logo-main-container {
        max-width: 1080px;
        margin: 2.5rem auto 0;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .logo-showcase-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: clamp(1.75rem, 3vw, 2.75rem);
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 2.25rem;
        align-items: center;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
    }
    .logo-seal-box {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: radial-gradient(circle, #f0fdf4 0%, #ffffff 70%);
        border: 2px solid #a7f3d0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        margin: 0 auto;
        box-shadow: 0 12px 30px rgba(5, 150, 105, 0.12);
    }
    .logo-seal-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .logo-arabic-title {
        font-family: 'Amiri', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #059669;
        margin: 0 0 0.35rem;
    }
    .logo-english-title {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.5rem, 1.2rem + 1vw, 2.1rem);
        font-weight: 900;
        color: #0f172a;
        margin: 0 0 0.45rem;
    }
    .logo-tagline {
        font-size: 1rem;
        font-weight: 600;
        color: #047857;
        font-style: italic;
        margin: 0 0 1rem;
    }
    .logo-intro-text {
        font-size: 0.96rem;
        line-height: 1.7;
        color: #475569;
        margin: 0;
    }

    .logo-elements-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.15rem;
    }
    .logo-element-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.35rem 1.4rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
        transition: all 0.2s ease;
    }
    .logo-element-card:hover {
        border-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(5, 150, 105, 0.08);
    }
    .logo-element-badge {
        min-width: 42px;
        height: 42px;
        padding: 0 0.5rem;
        border-radius: 12px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #047857;
        font-family: 'Outfit', sans-serif;
        font-weight: 900;
        font-size: 0.92rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .logo-element-card h3 {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 0.3rem;
    }
    .logo-element-card p {
        font-size: 0.92rem;
        line-height: 1.6;
        color: #475569;
        margin: 0;
    }

    @media (max-width: 820px) {
        .logo-showcase-card {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .logo-elements-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="logo-page">
    <section class="logo-hero">
        <div class="container">
            <nav class="logo-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('about.history') }}">About Us</a>
                <span>/</span>
                <span>Official School Seal</span>
            </nav>
            <h1>The AMIS Official Seal &amp; Symbolism</h1>
            <p>Every element of the Al Munawwara Islamic School seal reflects our Islamic identity, unity, and educational mission.</p>
        </div>
    </section>

    <div class="container">
        <div class="logo-main-container">
            <article class="logo-showcase-card">
                <div class="logo-seal-box">
                    <img src="/logo.png" alt="AMIS School Logo" onerror="this.src='/logo/AMIS_Logo.png'">
                </div>
                <div>
                    <div class="logo-arabic-title">المدرسة المنورة الإسلامية</div>
                    <h2 class="logo-english-title">AL MUNAWWARA ISLAMIC SCHOOL</h2>
                    <p class="logo-tagline">&ldquo;Enabling Our Students to Learn in Fid Dunya Wal Akhira&rdquo;</p>
                    <p class="logo-intro-text">
                        The Al Munawwara Islamic School seal embodies our commitment to academic and moral excellence. Each symbol represents the harmony of DepEd basic education standards and authentic Islamic scholarship established in 2008 (1429 AH).
                    </p>
                </div>
            </article>

            <div class="logo-elements-grid">
                <div class="logo-element-card">
                    <span class="logo-element-badge">&#9711;</span>
                    <div>
                        <h3>The Outer Circle</h3>
                        <p>Symbolizes <strong>Oneness (Tawhid)</strong> and unity—welcoming and embracing learners across all tribes, communities, and backgrounds.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">AR/EN</span>
                    <div>
                        <h3>Bilingual School Name</h3>
                        <p>Inscribed in Arabic and English in equal proportions to signify a balanced, integrated curriculum pursuant to <strong>DepEd Order No. 51, s. 2004</strong>.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">A</span>
                    <div>
                        <h3>A &mdash; Allah</h3>
                        <p>We bear witness that there is no deity worthy of worship except Allah (SWT), the source of all knowledge and wisdom.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">M</span>
                    <div>
                        <h3>M &mdash; Muhammad (SAW)</h3>
                        <p>We bear witness that Muhammad (SAW) is the Messenger of Allah and the ultimate exemplar of noble character.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">I</span>
                    <div>
                        <h3>I &mdash; Islam</h3>
                        <p>Islam and its five pillars strengthen our patience, discipline, moral integrity, and unwavering faith.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">S</span>
                    <div>
                        <h3>S &mdash; School</h3>
                        <p>The school serves as a sanctuary of knowledge, mentorship, and holistic guidance for the youth.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">2008</span>
                    <div>
                        <h3>2008 CE &bull; 1429 AH</h3>
                        <p>Commemorates the Gregorian (2008) and Hijri (1429 AH) founding year of Davao City&rsquo;s pioneer DepEd-recognized private Islamic school.</p>
                    </div>
                </div>

                <div class="logo-element-card">
                    <span class="logo-element-badge">&#9790;</span>
                    <div>
                        <h3>The Crescent Moon</h3>
                        <p>Represents <strong>Al Munawwara</strong> (&ldquo;The Radiant / Illuminated&rdquo;)—symbolizing light, enlightenment, and guidance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
