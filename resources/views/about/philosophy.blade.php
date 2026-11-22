@extends('layouts.app')

@section('title', 'Philosophy, Vision, Mission, & Goals | Al Munawwara Islamic School')

@section('styles')
<style>
    .pvmg-page {
        min-height: 100vh;
        background: #f8fafc;
        padding-bottom: 5rem;
    }

    .pvmg-hero {
        background: radial-gradient(circle at 18% 20%, rgba(16, 185, 129, 0.25) 0%, transparent 45%),
                    linear-gradient(135deg, #022c22 0%, #064e3b 55%, #047857 100%);
        color: #ffffff;
        padding: 3.5rem 0 4rem;
        border-bottom: 3px solid rgba(250, 204, 21, 0.35);
    }

    .pvmg-breadcrumb {
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
    .pvmg-breadcrumb a {
        color: #a7f3d0;
        text-decoration: none;
        font-weight: 600;
    }

    .pvmg-kicker {
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
        margin-bottom: 0.85rem;
    }

    .pvmg-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2rem, 1.3rem + 2.2vw, 3rem);
        font-weight: 900;
        line-height: 1.15;
        margin: 0 0 0.85rem;
        text-wrap: balance;
    }

    .pvmg-hero p {
        font-size: 1.08rem;
        line-height: 1.65;
        color: rgba(255, 255, 255, 0.9);
        max-width: 64ch;
        margin: 0;
    }

    .pvmg-container {
        max-width: 1120px;
        margin: 2.75rem auto 0;
        display: flex;
        flex-direction: column;
        gap: 2.25rem;
    }

    .pvmg-top-grid {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 1.5rem;
    }

    .pvmg-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: clamp(1.5rem, 2.5vw, 2.25rem);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
    }

    .pvmg-card.vision-card {
        background: linear-gradient(145deg, #064e3b 0%, #047857 100%);
        color: #ffffff;
        border-color: #059669;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .pvmg-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        padding: 0.28rem 0.8rem;
        border-radius: 999px;
        font-size: 0.74rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.75rem;
        align-self: flex-start;
    }
    .vision-card .pvmg-tag {
        background: rgba(250, 204, 21, 0.2);
        color: #fde047;
        border-color: rgba(250, 204, 21, 0.45);
    }

    .pvmg-card h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.65rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 0.85rem;
    }
    .vision-card h2 {
        color: #ffffff;
    }

    .pvmg-card p {
        font-size: 1rem;
        line-height: 1.75;
        color: #334155;
        margin: 0;
        text-align: start;
        text-wrap: pretty;
    }
    .vision-card p {
        color: rgba(255, 255, 255, 0.94);
        font-size: 1.12rem;
        font-weight: 500;
    }

    /* Core Values 4-Card Row */
    .core-values-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1.15rem;
        margin-top: 1.25rem;
    }
    .core-value-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.35rem 1.2rem;
        transition: all 0.2s ease;
    }
    .core-value-item:hover {
        border-color: #059669;
        background: #f0fdf4;
        transform: translateY(-3px);
    }
    .core-value-letter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #059669;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 900;
        margin-bottom: 0.75rem;
    }
    .core-value-item h3 {
        font-size: 1.02rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 0.35rem;
    }
    .core-value-item p {
        font-size: 0.86rem;
        color: #475569;
        line-height: 1.55;
        margin: 0;
    }

    /* Mission Pillars */
    .mission-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.25rem;
        margin-top: 1.25rem;
    }
    .mission-pillar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.4rem;
        border-top: 4px solid #059669;
    }
    .mission-num {
        font-size: 0.76rem;
        font-weight: 800;
        color: #059669;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        display: block;
        margin-bottom: 0.5rem;
    }
    .mission-pillar p {
        font-size: 0.94rem;
        line-height: 1.7;
        color: #334155;
        margin: 0;
    }

    /* Goals Grid */
    .goals-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
        margin-top: 1.25rem;
    }
    .goal-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 1.1rem 1.15rem;
    }
    .goal-check {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        background: #d1fae5;
        color: #047857;
        font-size: 0.78rem;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .goal-item p {
        font-size: 0.92rem;
        line-height: 1.55;
        color: #334155;
        margin: 0;
    }

    @media (max-width: 960px) {
        .pvmg-top-grid,
        .mission-grid,
        .goals-grid {
            grid-template-columns: 1fr;
        }
        .core-values-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 560px) {
        .core-values-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="pvmg-page">
    <section class="pvmg-hero">
        <div class="container">
            <nav class="pvmg-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('about.history') }}">About Us</a>
                <span>/</span>
                <span>Philosophy, Vision, Mission &amp; Goals</span>
            </nav>
            <div>
                <span class="pvmg-kicker">Guiding Principles</span>
                <h1>Philosophy, Vision, Mission &amp; Core Values</h1>
                <p>Harmoniously integrating DepEd academic excellence with Islamic values guided by the Holy Qur&rsquo;an and the Sunnah of Prophet Muhammad (SAW).</p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="pvmg-container">

            <!-- Philosophy & Vision -->
            <div class="pvmg-top-grid">
                <article class="pvmg-card">
                    <span class="pvmg-tag">Educational Philosophy</span>
                    <h2>Our Philosophy</h2>
                    <p>
                        Al Munawwara Islamic School is committed to providing an education that harmoniously integrates academic excellence with Islamic values, guided by the Holy Qur&rsquo;an and the Sunnah of Prophet Muhammad (SAW). We believe that every learner should be equipped not only with knowledge, but also with the moral and spiritual foundation to live in accordance with Islamic principles—forming self-directed, lifelong learners who positively contribute to their communities.
                    </p>
                </article>

                <article class="pvmg-card vision-card">
                    <span class="pvmg-tag">Institutional Vision</span>
                    <h2>Our Vision</h2>
                    <p>
                        &ldquo;To establish an integrated school through the Islamic Developmental Approach towards Academic Excellence within the framework of the Holy Qur&rsquo;an and Sunnah of the Prophet Muhammad (SAW).&rdquo;
                    </p>
                </article>
            </div>

            <!-- Core Values (A-M-I-S) -->
            <section class="pvmg-card">
                <span class="pvmg-tag">The AMIS Identity</span>
                <h2>Our Core Values (A&bull;M&bull;I&bull;S)</h2>
                <div class="core-values-grid">
                    <div class="core-value-item">
                        <span class="core-value-letter">A</span>
                        <h3>Allah-Consciousness (Taqwa)</h3>
                        <p>Placing faith, remembrance of Allah, and righteous conduct at the center of learning and daily life.</p>
                    </div>
                    <div class="core-value-item">
                        <span class="core-value-letter">M</span>
                        <h3>Moral Integrity</h3>
                        <p>Upholding honesty, respect, discipline, and prophetic character (Akhlaq) inside and outside the classroom.</p>
                    </div>
                    <div class="core-value-item">
                        <span class="core-value-letter">I</span>
                        <h3>Innovation &amp; Excellence</h3>
                        <p>Embracing modern pedagogy, digital learning, and critical inquiry to prepare learners for global challenges.</p>
                    </div>
                    <div class="core-value-item">
                        <span class="core-value-letter">S</span>
                        <h3>Service to Ummah &amp; Nation</h3>
                        <p>Developing compassionate leaders who enrich their families, uplift their communities, and serve humanity.</p>
                    </div>
                </div>
            </section>

            <!-- Mission -->
            <section class="pvmg-card">
                <span class="pvmg-tag">Institutional Mandate</span>
                <h2>Our Mission</h2>
                <div class="mission-grid">
                    <div class="mission-pillar">
                        <span class="mission-num">Pillar 01 &bull; Integrated Academics</span>
                        <p>To provide a well-balanced instructional program that enables all children to reach their highest level of academic success using a curriculum aligned with the Philippine Department of Education&rsquo;s standards through the Islamic Developmental Approach.</p>
                    </div>
                    <div class="mission-pillar">
                        <span class="mission-num">Pillar 02 &bull; Qur&rsquo;an &amp; Arabic Mastery</span>
                        <p>To educate, reinforce, and develop the skills required for reading, memorizing, and comprehending the Arabic language, applying the teachings of the Holy Qur&rsquo;an and Sunnah to understand Islamic faith and practice.</p>
                    </div>
                    <div class="mission-pillar">
                        <span class="mission-num">Pillar 03 &bull; Holistic Islamic Character</span>
                        <p>To provide opportunities for learners to become self-directed, lifelong learners while developing their social, emotional, and physical potential and a lifelong Islamic personality.</p>
                    </div>
                </div>
            </section>

            <!-- Goals -->
            <section class="pvmg-card">
                <span class="pvmg-tag">Strategic Objectives</span>
                <h2>Our Institutional Goals</h2>
                <div class="goals-grid">
                    <div class="goal-item"><span class="goal-check">1</span><p>Instill the importance of putting God at the center of every student&rsquo;s life.</p></div>
                    <div class="goal-item"><span class="goal-check">2</span><p>Maintain a safe, inclusive, and educationally stimulating environment.</p></div>
                    <div class="goal-item"><span class="goal-check">3</span><p>Enhance all five aspects of a child&rsquo;s growth: physical, mental, emotional, spiritual, and social.</p></div>
                    <div class="goal-item"><span class="goal-check">4</span><p>Instill appreciation for Islamic culture, heritage, traditions, and moral values.</p></div>
                    <div class="goal-item"><span class="goal-check">5</span><p>Promote self-respect, mutual understanding, and respect for others.</p></div>
                    <div class="goal-item"><span class="goal-check">6</span><p>Make learning an engaging, meaningful, and inspiring experience.</p></div>
                    <div class="goal-item"><span class="goal-check">7</span><p>Equip every learner to be well-informed, God-conscious, confident, and caring.</p></div>
                    <div class="goal-item"><span class="goal-check">8</span><p>Produce graduates who inspire others and positively transform their communities.</p></div>
                    <div class="goal-item"><span class="goal-check">9</span><p>Enrich our partner families and actively serve the wider community.</p></div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
