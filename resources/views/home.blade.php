@extends('layouts.app')

@section('title', 'Al Munawwara Islamic School')

@section('styles')
<style>
    /* Hero Section CSS */
    .hero {
        position: relative;
        min-height: 700px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
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
            min-height: 500px;
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
        .announcements-column {
            grid-template-columns: 1fr;
        }
        .album-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Homepage Events Layout Styling */
    .events-split-layout {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 50px;
        align-items: start;
    }
    @media (max-width: 768px) {
        .events-split-layout {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
</style>
@endsection

@section('content')
<!-- HERO SECTION -->
<section class="hero">
    @if($heroType === 'video')
        <video class="hero-video" autoplay muted loop playsinline>
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
            <div class="hero-buttons" style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
                <a href="https://enrollment.amis.edu.ph" class="btn btn-hero">Enroll Now</a>
                <a href="{{ route('academics.calendar') }}" class="btn btn-hero" style="background: rgba(255, 255, 255, 0.18); color: white; border-color: rgba(255, 255, 255, 0.5); backdrop-filter: blur(4px); display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    School Calendar S.Y. 2026-2027
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ANNOUNCEMENTS & NEWS -->
<section class="section news-announcements">
    <div class="container">
        <h2 class="section-title">Latest News & Announcements</h2>
        <p class="section-subtitle" style="margin-bottom: 8px;">Stay updated with the latest happenings at AMIS</p>
        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{ route('news.index') }}" style="color: #059669; font-weight: 700; font-size: 0.95rem; text-decoration: underline; text-underline-offset: 4px; transition: color 0.2s;" onmouseover="this.style.color='#047857'" onmouseout="this.style.color='#059669'">View All News & Announcements →</a>
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
                    <h3>No Latest News & Announcements</h3>
                    <p>Check back soon for updates from AMIS</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- UPCOMING EVENTS SECTION -->
<section class="section homepage-events" style="background: white; border-top: 1px solid #e2e8f0; padding: 75px 0;">
    <div class="container">
        <div class="events-split-layout">
            
            <!-- Left: Title Column -->
            <div>
                <span style="display: inline-block; background: #e6f4ea; color: #059669; padding: 4px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; border: 1px solid #a7f3d0;">Calendar</span>
                <h2 style="font-size: 2.25rem; font-weight: 800; color: #0f172a; line-height: 1.25; margin-bottom: 15px;">Upcoming & Recent Events</h2>
                <p style="color: #475569; font-size: 1rem; line-height: 1.7; margin-bottom: 25px;">Stay up to date with the latest school programs, academic timelines, sports activities, and special events happening at Al Munawwara Islamic School.</p>
                <div style="display: flex; flex-direction: column; gap: 12px; align-items: flex-start;">
                    <a href="{{ route('academics.calendar') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #059669; color: white; padding: 12px 22px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; text-decoration: none; transition: background 0.2s; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);" onmouseover="this.style.background='#047857'" onmouseout="this.style.background='#059669'">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        View Calendar of Activities S.Y. 2026-2027 →
                    </a>
                    <a href="{{ route('events.index') }}" style="color: #059669; font-weight: 700; font-size: 0.9rem; text-decoration: underline; text-underline-offset: 4px; transition: color 0.2s;" onmouseover="this.style.color='#047857'" onmouseout="this.style.color='#059669'">View All Events →</a>
                </div>
            </div>
            
            <!-- Right: Event List Column -->
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @php
                    $homepageEvents = \App\Models\Announcement::where(function ($query) {
                            $query->whereNull('publish_date')
                                  ->orWhere('publish_date', '<=', now());
                        })
                        ->where(function ($query) {
                            $query->where('category', 'like', '%event%')
                                  ->orWhere('category', 'like', '%sport%')
                                  ->orWhere('category', 'like', '%activity%')
                                  ->orWhere('category', 'like', '%program%');
                        })
                        ->orderBy('publish_date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
                @endphp
                
                @if($homepageEvents->count() > 0)
                    @foreach($homepageEvents as $evt)
                        @php
                            $evtDate = $evt->publish_date ?? $evt->created_at;
                            $evtMonth = $evtDate ? $evtDate->format('M') : 'AN';
                            $evtDay = $evtDate ? $evtDate->format('d') : '--';
                        @endphp
                        <a href="{{ route('announcement.show', $evt->uuid ?? $evt->id) }}" style="display: flex; align-items: center; gap: 20px; text-decoration: none; padding: 15px; border-radius: 12px; border: 1px solid #f1f5f9; transition: all 0.3s; background: white;" class="homepage-event-row" onmouseover="this.style.borderColor='#059669';this.style.background='#f8fafc'" onmouseout="this.style.borderColor='#f1f5f9';this.style.background='white'">
                            
                            <!-- Calendar Date Overlay -->
                            <div style="flex-shrink: 0; background: white; border: 1px solid #e2e8f0; border-radius: 10px; width: 60px; height: 60px; display: flex; flex-direction: column; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                                <div style="background: #059669; color: white; width: 100%; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; text-align: center; padding: 2px 0;">{{ $evtMonth }}</div>
                                <div style="color: #0f172a; font-size: 1.2rem; font-weight: 800; line-height: 1.1;">{{ $evtDay }}</div>
                            </div>
                            
                            <!-- Text Details -->
                            <div style="flex-grow: 1;">
                                <div style="font-size: 0.75rem; font-weight: 700; color: #059669; text-transform: uppercase; margin-bottom: 4px;">{{ $evt->category ?? 'Event' }}</div>
                                <h3 style="font-size: 1.1rem; font-weight: 700; color: #1e293b; margin: 0; line-height: 1.35; margin-bottom: 4px;">{{ $evt->title }}</h3>
                                
                                @if($evt->event_dates || $evt->event_venue || $evt->is_online)
                                    <div style="display: flex; flex-direction: column; gap: 2px; font-size: 0.8rem; color: #64748b; margin-top: 4px;">
                                        @if($evt->event_dates)
                                            <span style="display: flex; align-items: center; gap: 4px;">
                                                <span>📅</span> {{ $evt->event_dates }}
                                            </span>
                                        @endif
                                        @if($evt->is_online)
                                            <span style="display: flex; align-items: center; gap: 4px; color: #059669; font-weight: 600;">
                                                <span>💻</span> Online Class / Virtual
                                            </span>
                                        @elseif($evt->event_venue)
                                            <span style="display: flex; align-items: center; gap: 4px;">
                                                <span>📍</span> {{ $evt->event_venue }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Arrow Indicator -->
                            <div style="color: #cbd5e1; font-weight: bold; font-size: 1.2rem; padding-right: 5px;">→</div>
                        </a>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 50px 30px; border: 1px dashed #e2e8f0; border-radius: 16px; background: #f8fafc;">
                        <span style="font-size: 2rem;">📅</span>
                        <h4 style="font-size: 1rem; color: #1e293b; margin: 10px 0 5px; font-weight: 700;">No Events Scheduled</h4>
                        <p style="color: #64748b; font-size: 0.85rem; margin: 0;">Please check back soon for school calendar activities.</p>
                    </div>
                @endif
            </div>
            
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
    });
</script>
@endsection
