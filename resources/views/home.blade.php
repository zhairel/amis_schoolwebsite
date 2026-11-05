@extends('layouts.app')

@section('title', 'Al Munawwara Islamic School')

@section('styles')
<style>
    /* Hero Section CSS */
    :root {
        --header-height: 125px;
    }
    .hero {
        position: relative;
        width: 100%;
        height: calc(100vh - var(--header-height, 125px));
        height: calc(100dvh - var(--header-height, 125px));
        min-height: calc(100vh - var(--header-height, 125px));
        min-height: calc(100dvh - var(--header-height, 125px));
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: #022c22;
    }
    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        z-index: 0;
    }
    .hero-video:fullscreen,
    .hero-video:-webkit-full-screen {
        object-fit: contain;
        background: #000;
        z-index: 999999;
    }
    .hero-slideshow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }
    .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    .hero-image.active {
        opacity: 1;
    }
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        color: white;
    }
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    .hero-subtitle {
        font-size: 1.35rem;
        margin-bottom: 40px;
        opacity: 0.95;
    }
    .btn-hero {
        background: white;
        color: var(--primary);
        padding: 14px 40px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: 2px solid white;
        display: inline-block;
    }
    .btn-hero:hover {
        background: transparent;
        color: white;
        transform: translateY(-2px);
    }
    .slide-indicators {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }
    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        padding: 0;
    }
    .indicator.active {
        background: white;
        width: 32px;
        border-radius: 6px;
    }

    /* Scroll Down Indicator */
    .hero-scroll-down {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }
    .hero-scroll-down:hover {
        color: #ffffff;
        transform: translateX(-50%) translateY(3px);
    }
    .scroll-mouse {
        width: 22px;
        height: 34px;
        border: 2px solid rgba(255, 255, 255, 0.7);
        border-radius: 12px;
        position: relative;
        display: flex;
        justify-content: center;
        transition: border-color 0.3s;
    }
    .hero-scroll-down:hover .scroll-mouse {
        border-color: #34d399;
    }
    .scroll-wheel {
        width: 3px;
        height: 6px;
        background: #34d399;
        border-radius: 2px;
        position: absolute;
        top: 6px;
        animation: scroll-wheel-anim 1.8s infinite ease-in-out;
    }
    @keyframes scroll-wheel-anim {
        0% { opacity: 1; transform: translateY(0); }
        50% { opacity: 0.3; transform: translateY(10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .scroll-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        opacity: 0.85;
    }

    /* News layout & card CSS */
    .news-announcements {
        background: var(--bg-light);
    }
    .news-layout {
        display: block;
        margin-top: 40px;
    }
    .facebook-balloon-container {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 2px solid rgba(5, 150, 105, 0.1);
        display: flex;
        flex-direction: column;
        height: 680px;
    }
    .balloon-header {
        background: linear-gradient(135deg, var(--primary) 0%, #047857 100%);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
        font-weight: 700;
    }
    .balloon-content {
        padding: 15px;
        background: white;
        flex-grow: 1;
        overflow: hidden;
    }
    .balloon-content iframe {
        width: 100%;
        height: 100%;
        border-radius: 12px;
    }
    .announcements-column {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 340px));
        gap: 24px;
        justify-content: center;
        justify-items: center;
    }
    .news-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        width: 100%;
        max-width: 340px;
    }
    .news-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
    }
    .news-image {
        width: 100%;
        aspect-ratio: 1/1;
        background: #f3f4f6;
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .news-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex-grow: 1;
    }
    .news-date {
        color: var(--primary);
        font-size: 0.7rem;
        font-weight: 700;
    }
    .news-card h3 {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-link {
        color: var(--primary);
        font-weight: 700;
        font-size: 0.8rem;
        margin-top: auto;
    }

    /* Calendar CSS */
    .calendar-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .calendar-container {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        display: grid;
        grid-template-columns: 150px 1fr;
        height: 600px;
        overflow: hidden;
    }
    .month-sidebar {
        background: var(--primary);
        color: white;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .month-vertical {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        margin-bottom: 16px;
    }
    .month-letter {
        font-size: 2rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .month-year {
        font-size: 1.125rem;
        font-weight: 500;
        margin-bottom: 30px;
    }
    .month-nav {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: auto;
    }
    .nav-btn-small {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    .nav-btn-small:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.3);
    }
    .nav-btn-small:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    .calendar-area {
        padding: 40px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .calendar-wrapper {
        width: 100%;
        max-width: 700px;
        height: 100%;
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-template-rows: auto repeat(6, 1fr);
        gap: 8px;
        width: 100%;
        height: 100%;
    }
    .day-header {
        text-align: center;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-light);
        padding: 12px 4px;
        text-transform: uppercase;
    }
    .day-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-direction: column;
        padding: 8px;
        font-size: 1rem;
        font-weight: 500;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        transition: all 0.2s ease;
    }
    .day-cell.has-events {
        border-color: var(--primary);
        background: rgba(5, 150, 105, 0.05);
    }
    .day-number {
        font-size: 1.3rem;
        font-weight: 700;
    }
    .day-cell.empty {
        background: transparent;
        border: none;
    }
    .event-counter {
        align-self: flex-end;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .event-counter:hover {
        background: #047857;
        transform: scale(1.1);
    }
    .event-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1010;
        padding: 20px;
    }
    .event-modal-content {
        background: white;
        border-radius: 16px;
        padding: 32px;
        max-width: 500px;
        width: 100%;
        border: 1px solid #cbd5e1;
        position: relative;
    }
    .event-modal-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 20px;
    }
    .event-list-modal {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .event-item-modal {
        padding: 16px;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }
    .event-item-modal.brigada { background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); }
    .event-item-modal.opening { background: linear-gradient(135deg, var(--primary) 0%, #10b981 100%); }
    .event-item-modal.test { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); }
    .event-item-modal.exam { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
    .event-item-modal.holiday { background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); }
    .event-item-modal.endterm { background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%); }

    /* Photo Album gallery CSS */
    .photo-album {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        position: relative;
        overflow: hidden;
    }
    .album-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .album-slideshow {
        position: relative;
        width: 100%;
        aspect-ratio: 1;
        overflow: hidden;
        background: #111827; /* Dark background placeholder */
    }
    
    /* Shimmering Skeleton Loader */
    .album-slideshow::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            #111827 25%,
            #1f2937 50%,
            #111827 75%
        );
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite linear;
        z-index: 2;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }
    
    /* Fade out skeleton once the active image has loaded */
    .album-slideshow.img-loaded::before {
        opacity: 0;
    }
    
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    /* Center loading spinner */
    .album-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 32px;
        height: 32px;
        border: 3px solid rgba(255, 255, 255, 0.1);
        border-top-color: #d97706; /* Gold brand accent */
        border-radius: 50%;
        animation: spin 1s infinite linear;
        z-index: 3;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .album-slideshow.img-loaded .album-spinner {
        opacity: 0;
    }
    
    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .album-slide-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        z-index: 1;
    }
    .album-slide-img.active.loaded {
        opacity: 1;
    }
    .slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30, 126, 52, 0.85) 0%, rgba(5, 150, 105, 0.75) 50%, rgba(16, 185, 129, 0.65) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
        padding: 20px;
        text-align: center;
        z-index: 5;
    }
    .album-slideshow:hover .slide-overlay {
        opacity: 1;
    }
    .album-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }
    .album-slideshow:hover .album-title {
        transform: translateY(0);
    }

    /* Responsiveness adjustments */
    @media (max-width: 968px) {
        .news-layout {
            grid-template-columns: 1fr;
        }
        .hero {
            height: calc(100dvh - var(--header-height, 100px));
            min-height: calc(100dvh - var(--header-height, 100px));
        }
        .hero-title {
            font-size: 2.25rem;
        }
        .hero-subtitle {
            font-size: 1.1rem;
        }
        .calendar-container {
            grid-template-columns: 1fr;
            height: auto;
        }
        .month-sidebar {
            flex-direction: row;
            justify-content: space-between;
            padding: 20px;
        }
        .month-vertical {
            flex-direction: row;
            margin-bottom: 0;
        }
        .month-year {
            margin-bottom: 0;
        }
        .month-nav {
            flex-direction: row;
            margin-top: 0;
        }
        .album-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .hero {
            height: calc(100dvh - var(--header-height, 90px));
            min-height: calc(100dvh - var(--header-height, 90px));
        }
        .hero-scroll-down {
            display: none;
        }
        .announcements-column {
            grid-template-columns: 1fr;
        }
        .album-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-height: 600px) {
        .hero {
            height: auto;
            min-height: 520px;
            padding: 50px 0;
        }
        .hero-scroll-down {
            display: none;
        }
    }
    

    /* School Notices Section CSS */
    .school-notices {
        background: white;
    }
    .school-notices-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        align-items: stretch;
    }
    .notice-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 26px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .notice-card:hover {
        transform: translateY(-4px);
        border-color: #059669 !important;
        box-shadow: 0 12px 28px rgba(5, 150, 105, 0.09) !important;
    }
    .notice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 8px;
    }
    .notice-badge {
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .notice-date {
        font-size: 0.78rem;
        color: #64748b;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .notice-title {
        font-size: 1.22rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.35;
        margin-bottom: 12px;
        letter-spacing: -0.3px;
    }
    .notice-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .notice-title a:hover {
        color: #059669;
    }
    .notice-excerpt {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.65;
        margin: 0 0 20px 0;
    }
    .notice-footer {
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }
    .notice-author {
        font-size: 0.76rem;
        color: #94a3b8;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .notice-read-more {
        color: #059669;
        font-weight: 800;
        font-size: 0.86rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s ease;
    }
    .notice-read-more:hover {
        color: #047857;
        transform: translateX(3px);
    }
    .notice-empty-state {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 18px;
        padding: 50px 24px;
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
    }
    .notice-empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        color: #059669;
    }
    @media (max-width: 768px) {
        .school-notices-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }
</style>
@endsection

@section('content')
<!-- HERO SECTION -->
<section class="hero" id="homeHero">
    @if($heroType === 'video')
        <video class="hero-video" id="heroVideo" autoplay muted loop playsinline preload="auto">
            <source src="/hero_video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
        <div class="hero-slideshow" id="heroSlideshow">
            <img src="/hero1.png" alt="Slide 1" class="hero-image active">
            <img src="/hero2.png" alt="Slide 2" class="hero-image">
            <img src="/hero3.jpg" alt="Slide 3" class="hero-image">
            <img src="/hero4.jpg" alt="Slide 4" class="hero-image">
        </div>
        <div class="slide-indicators" id="slideIndicators">
            <button class="indicator active" data-slide="0"></button>
            <button class="indicator" data-slide="1"></button>
            <button class="indicator" data-slide="2"></button>
            <button class="indicator" data-slide="3"></button>
        </div>
    @endif
    
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">{{ $heroTitle }}</h1>
            <p class="hero-subtitle">{{ $heroSubtitle }}</p>
            <div class="hero-buttons">
                <a href="https://aes.amis.edu.ph" class="btn btn-hero">Enroll Now</a>
            </div>
        </div>
    </div>

    <!-- Sleek Scroll Down Prompt -->
    <a href="#schoolNotices" class="hero-scroll-down" aria-label="Scroll to School Notices">
        <span class="scroll-mouse">
            <span class="scroll-wheel"></span>
        </span>
        <span class="scroll-label">Scroll Down</span>
    </a>
</section>

<!-- 1. SCHOOL NOTICES -->
<section class="section school-notices" id="schoolNotices" style="padding: 70px 0; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 720px; margin: 0 auto 40px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                <span style="display: inline-flex; align-items: center; gap: 6px; background: #ecfdf5; color: #059669; padding: 5px 14px; border-radius: 999px; font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: 1px solid #a7f3d0;">
                    <span style="display: inline-block; width: 7px; height: 7px; background: #059669; border-radius: 50%; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);"></span>
                    Official School Bulletin
                </span>
            </div>
            <h2 class="section-title" style="margin-bottom: 10px; font-size: 2.25rem; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">School Notices</h2>
            <p class="section-subtitle" style="color: #64748b; font-size: 1.02rem; margin: 0; line-height: 1.6;">Official school advisories, administrative notices, important reminders, and school-wide announcements</p>
        </div>

        @if(isset($schoolNotices) && $schoolNotices->count() > 0)
            <div class="school-notices-grid" @if($schoolNotices->count() === 1) style="max-width: 680px; margin: 0 auto;" @endif>
                @foreach($schoolNotices as $notice)
                    @php
                        $categoryLower = strtolower($notice->category ?? '');
                        $isAdvisory = str_contains($categoryLower, 'advisory');
                        $isReminder = str_contains($categoryLower, 'reminder');
                        $isUrgent = in_array(strtolower($notice->priority ?? ''), ['high', 'urgent']);
                        
                        // Badge & accent colors based on notice category and priority
                        if ($isUrgent || str_contains($categoryLower, 'important')) {
                            $accentColor = '#e11d48';
                            $badgeBg = '#ffe4e6';
                            $badgeColor = '#9f1239';
                            $badgeBorder = '#fecdd3';
                        } elseif ($isAdvisory) {
                            $accentColor = '#d97706';
                            $badgeBg = '#fef3c7';
                            $badgeColor = '#92400e';
                            $badgeBorder = '#fde68a';
                        } elseif ($isReminder) {
                            $accentColor = '#2563eb';
                            $badgeBg = '#eff6ff';
                            $badgeColor = '#1e40af';
                            $badgeBorder = '#bfdbfe';
                        } else {
                            $accentColor = '#059669';
                            $badgeBg = '#ecfdf5';
                            $badgeColor = '#065f46';
                            $badgeBorder = '#a7f3d0';
                        }
                    @endphp
                    <div class="notice-card" style="border-top: 4px solid {{ $accentColor }};">
                        <div>
                            <!-- Header: Category & Publication Date -->
                            <div class="notice-header">
                                <span class="notice-badge" style="background: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }};">
                                    @if($isAdvisory)
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                    @elseif($isReminder)
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                                    @else
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    @endif
                                    {{ $notice->category ?: 'Official Notice' }}
                                </span>

                                <span class="notice-date">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #059669; flex-shrink: 0;"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                    {{ optional($notice->publish_date ?? $notice->created_at)->format('F d, Y') }}
                                </span>
                            </div>

                            <!-- Notice Title -->
                            <h3 class="notice-title">
                                <a href="{{ route('announcement.show', $notice->uuid ?? $notice->id) }}">
                                    {{ $notice->title }}
                                </a>
                            </h3>

                            <!-- Short Description / Excerpt -->
                            <p class="notice-excerpt">
                                {{ Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags(str_replace(['</p>', '<br>', '<br/>', '<br />'], ' ', $notice->content)))), 140, '...') }}
                            </p>
                        </div>

                        <!-- Card Footer: Author & Read More Link -->
                        <div class="notice-footer">
                            <span class="notice-author">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #059669; flex-shrink: 0;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                {{ (!empty($notice->author) && !str_contains(strtolower($notice->author), 'admin')) ? $notice->author : 'AMIS IT Support' }}
                            </span>
                            <a href="{{ route('announcement.show', $notice->uuid ?? $notice->id) }}" class="notice-read-more">
                                <span>Read More</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Proper Empty State -->
            <div class="notice-empty-state">
                <div class="notice-empty-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h4 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 6px;">No Active School Notices</h4>
                <p style="font-size: 0.92rem; color: #64748b; margin: 0; line-height: 1.6;">There are currently no official school advisories or administrative notices published. Please check back regularly for updates.</p>
            </div>
        @endif
    </div>
</section>

<!-- ANNOUNCEMENTS & NEWS -->
<section class="section news-announcements">
    <div class="container">
        <h2 class="section-title">News & Info</h2>
        <p class="section-subtitle" style="margin-bottom: 8px;">Stay updated with the latest news, announcements, and info from AMIS</p>
        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{ route('news.index') }}" style="color: #059669; font-weight: 700; font-size: 0.95rem; text-decoration: underline; text-underline-offset: 4px; transition: color 0.2s;" onmouseover="this.style.color='#047857'" onmouseout="this.style.color='#059669'">View All News & Info →</a>
        </div>
        
        <div class="news-layout">
            <!-- Live Paginated Announcement Grid -->
            @if($announcements->count() > 0)
                <div class="announcements-column">
                    @foreach($announcements as $announcement)
                        <a href="{{ route('announcement.show', $announcement->uuid ?? $announcement->id) }}" class="news-card">
                            <div class="news-image">
                                @php
                                    $imgs = json_decode($announcement->image, true);
                                    $firstImg = is_array($imgs) ? ($imgs[0] ?? null) : $announcement->image;
                                @endphp
                                @if(is_array($imgs) && count($imgs) > 1)
                                    <div class="news-slideshow-container w-full h-full relative">
                                        @foreach($imgs as $idx => $img)
                                             <img src="{{ $img }}" alt="{{ $announcement->title }}" class="news-slide-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $idx === 0 ? 'opacity-100' : 'opacity-0' }}" loading="lazy">
                                        @endforeach
                                    </div>
                                @else
                                    <img src="{{ $firstImg ?? '/summer-class.png' }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover" loading="lazy">
                                @endif
                            </div>
                            <div class="news-content">
                                <div class="news-date">
                                    {{ strtoupper(optional($announcement->publish_date ?? $announcement->created_at)->format('F d, Y') ?? 'ANNOUNCEMENT') }}
                                </div>
                                <h3>{{ $announcement->title }}</h3>
                                <span class="news-link">Read More →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <!-- Dynamic Pagination -->
                <div class="pagination">
                    <a href="{{ $announcements->previousPageUrl() }}" class="pagination-btn {{ $announcements->onFirstPage() ? 'disabled-link' : '' }}" {!! $announcements->onFirstPage() ? 'style="pointer-events:none;opacity:0.4;"' : '' !!}>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    
                    @for ($page = 1; $page <= $announcements->lastPage(); $page++)
                        <a href="{{ $announcements->url($page) }}" class="pagination-number {{ $announcements->currentPage() === $page ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endfor
                    
                    <a href="{{ $announcements->nextPageUrl() }}" class="pagination-btn {{ !$announcements->hasMorePages() ? 'disabled-link' : '' }}" {!! !$announcements->hasMorePages() ? 'style="pointer-events:none;opacity:0.4;"' : '' !!}>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @else
                <div style="text-align: center; padding: 80px 40px;">
                    <h3>No News & Info Available</h3>
                    <p>Check back soon for updates from AMIS</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Hero Image Slideshow Logic
        const heroSlideshow = document.getElementById('heroSlideshow');
        if (heroSlideshow) {
            const slides = heroSlideshow.querySelectorAll('.hero-image');
            const indicators = document.querySelectorAll('#slideIndicators .indicator');
            let currentSlide = 0;
            
            function showSlide(idx) {
                slides.forEach((slide, i) => {
                    if (i === idx) {
                        slide.classList.add('active');
                        if (indicators[i]) indicators[i].classList.add('active');
                    } else {
                        slide.classList.remove('active');
                        if (indicators[i]) indicators[i].classList.remove('active');
                    }
                });
                currentSlide = idx;
            }
            
            indicators.forEach(ind => {
                ind.addEventListener('click', function() {
                    const slideIdx = parseInt(this.getAttribute('data-slide'));
                    showSlide(slideIdx);
                });
            });
            
            setInterval(() => {
                let next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }, 5000);
        }


        // Cycle news card slideshows automatically on homepage with seamless crossfade (NO white blink)
        const cardSlideshows = document.querySelectorAll('.news-slideshow-container');
        cardSlideshows.forEach(slideshow => {
            const slides = Array.from(slideshow.querySelectorAll('.news-slide-img'));
            if (slides.length > 1) {
                let activeIdx = 0;

                slideshow.style.background = '#e2e8f0';

                slides.forEach((slide, i) => {
                    slide.style.position = 'absolute';
                    slide.style.inset = '0';
                    slide.style.width = '100%';
                    slide.style.height = '100%';
                    slide.style.objectFit = 'cover';
                    slide.style.transition = 'opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                    slide.style.opacity = i === 0 ? '1' : '0';
                    slide.style.zIndex = i === 0 ? '2' : '1';
                });

                setInterval(() => {
                    const nextIdx = (activeIdx + 1) % slides.length;
                    const currentSlide = slides[activeIdx];
                    const nextSlide = slides[nextIdx];

                    // Bring next slide on top and fade in
                    nextSlide.style.zIndex = '3';
                    nextSlide.style.opacity = '1';

                    // After crossfade finishes, reset old slide position
                    setTimeout(() => {
                        currentSlide.style.opacity = '0';
                        currentSlide.style.zIndex = '1';
                        nextSlide.style.zIndex = '2';
                        activeIdx = nextIdx;
                    }, 1250);
                }, 4000 + Math.random() * 1500);
            }
        });

        // 3. Dynamic Header Height for Fullscreen Hero
        function updateHeroHeaderHeight() {
            const header = document.getElementById('siteHeader');
            if (header) {
                const height = header.offsetHeight;
                document.documentElement.style.setProperty('--header-height', height + 'px');
            }
        }
        updateHeroHeaderHeight();
        window.addEventListener('resize', updateHeroHeaderHeight, { passive: true });
        window.addEventListener('load', updateHeroHeaderHeight);

        // 4. Auto-pause hero video when scrolled out of view to eliminate lag & conserve resources
        const heroVideo = document.getElementById('heroVideo');
        if (heroVideo) {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            if (prefersReducedMotion.matches) {
                heroVideo.pause();
            }
            prefersReducedMotion.addEventListener('change', (e) => {
                if (e.matches) heroVideo.pause();
            });

            if ('IntersectionObserver' in window) {
                const heroSection = document.getElementById('homeHero') || heroVideo;
                const videoObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        const isFs = !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
                        if (isFs) return;

                        if (entry.isIntersecting) {
                            // Hero is visible in viewport - resume playback
                            heroVideo.play().catch(() => {});
                        } else {
                            // Hero is scrolled fully out of viewport - auto pause video to stop lag
                            heroVideo.pause();
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.05
                });
                videoObserver.observe(heroSection);
            }

            // Also pause video when switching tabs or minimizing browser
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    heroVideo.pause();
                } else {
                    const isFs = !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
                    if (isFs) {
                        heroVideo.play().catch(() => {});
                        return;
                    }
                    const heroSection = document.getElementById('homeHero') || heroVideo;
                    const rect = heroSection.getBoundingClientRect();
                    if (rect.bottom > 0 && rect.top < window.innerHeight) {
                        heroVideo.play().catch(() => {});
                    }
                }
            });
        }
    });
</script>
@endsection

