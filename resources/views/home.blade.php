@extends('layouts.app')

@section('title', 'Al Munawwara Islamic School | Home')

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
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
    }
    .hero-subtitle {
        font-size: 1.35rem;
        margin-bottom: 40px;
        opacity: 0.95;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
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
        box-shadow: 0 10px 40px rgba(5, 150, 105, 0.08);
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
    }
    .news-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    .news-image {
        width: 100%;
        aspect-ratio: 4/3;
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
        object-fit: contain;
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
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
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
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
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
            <div class="hero-buttons">
                <a href="{{ route('admissions') }}" class="btn btn-hero">Enroll Now</a>
            </div>
        </div>
    </div>
</section>

<!-- ANNOUNCEMENTS & NEWS -->
<section class="section news-announcements">
    <div class="container">
        <h2 class="section-title">Latest News & Announcements</h2>
        <p class="section-subtitle">Stay updated with the latest happenings at AMIS</p>
        
        <div class="news-layout">
            <!-- Live Paginated Announcement Grid -->
            @if($announcements->count() > 0)
                <div class="announcements-column">
                    @foreach($announcements as $announcement)
                        <a href="{{ route('announcement.show', $announcement->id) }}" class="news-card">
                            <div class="news-image">
                                <img src="{{ $announcement->image ?? '/summer-class.png' }}" alt="{{ $announcement->title }}" loading="lazy">
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

<!-- CALENDAR SECTION -->
<section class="section calendar-section">
    <div class="container">
        <h2 class="section-title">DepEd School Year 2026 - 2027</h2>
        <p class="section-subtitle">Academic Calendar - Term 1 (Terms 2 & 3 Coming Soon)</p>
        
        <div class="calendar-container">
            <!-- Left: Month Vertical Sidebar -->
            <div class="month-sidebar">
                <div class="month-vertical" id="monthVertical">
                    <!-- Letters seeded dynamically -->
                </div>
                <p class="month-year" id="monthYear">2026</p>
                <div class="month-nav">
                    <button class="nav-btn-small" id="prevMonthBtn">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="nav-btn-small" id="nextMonthBtn">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Right: Calendar Grid -->
            <div class="calendar-area">
                <div class="calendar-wrapper">
                    <div class="calendar-grid" id="calendarGrid">
                        <!-- Days seeded dynamically -->
                    </div>
                    <div style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: var(--text-light); font-style: italic; border-top: 1px dashed #e5e7eb; padding-top: 15px;">
                        * Calendar schedules and activities for succeeding terms are coming soon.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event info modal container -->
<div class="event-modal" id="eventModal" style="display: none;">
    <div class="event-modal-content">
        <button class="close-btn" id="closeEventModal">✕</button>
        <h3 class="event-modal-title" id="eventModalTitle">Date</h3>
        <div class="event-list-modal" id="eventModalList">
            <!-- Modal list items filled dynamically -->
        </div>
    </div>
</div>

<!-- PHOTO ALBUM SECTION -->
<section class="photo-album">
    <div class="container">
        <h2 class="section-title">Life at AMIS</h2>
        <p class="section-subtitle">Moments that define our journey</p>
        
        <div class="album-grid">
            <!-- Album 1 -->
            <div class="album-slideshow" data-album="0">
                <img src="/albums/SportFest 2025/591753363_1378332790970238_4366905468227256693_n.jpg" class="album-slide-img active" loading="lazy">
                <img src="/albums/SportFest 2025/594810255_1378340514302799_3937983275975124545_n.jpg" class="album-slide-img" loading="lazy">
                <img src="/albums/SportFest 2025/595229775_1378332614303589_8850257664654745554_n.jpg" class="album-slide-img" loading="lazy">
                <div class="slide-overlay">
                    <h3 class="album-title">SportFest 2025</h3>
                </div>
            </div>
            <!-- Album 2 -->
            <div class="album-slideshow" data-album="1">
                <img src="/albums/Recognition Day/586393325_1371334605003390_6520786643361168505_n.jpg" class="album-slide-img active" loading="lazy">
                <img src="/albums/Recognition Day/586405972_1371336098336574_1398916957616274054_n.jpg" class="album-slide-img" loading="lazy">
                <img src="/albums/Recognition Day/586434021_1371335625003288_3818678958531396199_n.jpg" class="album-slide-img" loading="lazy">
                <div class="slide-overlay">
                    <h3 class="album-title">Recognition Day</h3>
                </div>
            </div>
            <!-- Album 3 -->
            <div class="album-slideshow" data-album="2">
                <img src="/albums/AMIS Health Assessment/556674742_1321397483330436_1853498844359200128_n.jpg" class="album-slide-img active" loading="lazy">
                <img src="/albums/AMIS Health Assessment/557110048_1321396613330523_6346617683935954154_n.jpg" class="album-slide-img" loading="lazy">
                <img src="/albums/AMIS Health Assessment/557589849_1321396386663879_8754873903607782981_n.jpg" class="album-slide-img" loading="lazy">
                <div class="slide-overlay">
                    <h3 class="album-title">Health Assessment</h3>
                </div>
            </div>
            <!-- Album 4 -->
            <div class="album-slideshow" data-album="3">
                <img src="/albums/AMISians join YMUN Korea XIII/587823096_1373163228153861_4039571029225953603_n.jpg" class="album-slide-img active" loading="lazy">
                <img src="/albums/AMISians join YMUN Korea XIII/588322790_1373163481487169_3200445259471165563_n.jpg" class="album-slide-img" loading="lazy">
                <img src="/albums/AMISians join YMUN Korea XIII/588869895_1373163174820533_5208695980297783885_n.jpg" class="album-slide-img" loading="lazy">
                <div class="slide-overlay">
                    <h3 class="album-title">YMUN Korea XIII</h3>
                </div>
            </div>
            <!-- Album 5 -->
            <div class="album-slideshow" data-album="4">
                <img src="/albums/Makasaysayan sa Pagkakaisa ng Bansa/534734549_1281575337312651_4408743598392564701_n.jpg" class="album-slide-img active" loading="lazy">
                <img src="/albums/Makasaysayan sa Pagkakaisa ng Bansa/536633326_1281574800646038_1320401250326399751_n.jpg" class="album-slide-img" loading="lazy">
                <img src="/albums/Makasaysayan sa Pagkakaisa ng Bansa/536863135_1281353394001512_5883053672460982067_n.jpg" class="album-slide-img" loading="lazy">
                <div class="slide-overlay">
                    <h3 class="album-title">Pagkakaisa ng Bansa</h3>
                </div>
            </div>
            <!-- Album 6 -->
            <div class="album-slideshow" data-album="5">
                <img src="/albums/SportFest 2025/595574610_1378333234303527_5885555887180984400_n.jpg" class="album-slide-img active" loading="lazy">
                <img src="/albums/SportFest 2025/595376814_1378339567636227_7667497623519424210_n.jpg" class="album-slide-img" loading="lazy">
                <img src="/albums/SportFest 2025/594810255_1378340514302799_3937983275975124545_n.jpg" class="album-slide-img" loading="lazy">
                <div class="slide-overlay">
                    <h3 class="album-title">Athletic Excellence</h3>
                </div>
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

        // 2. Interactive Academic Calendar
        const months = [
            {
                name: 'June 2026',
                days: [
                    { number: 1, events: [{ label: 'Brigada Eskwela', class: 'brigada' }] },
                    { number: 2, events: [{ label: 'Brigada Eskwela', class: 'brigada' }] },
                    { number: 3, events: [{ label: 'Brigada Eskwela', class: 'brigada' }] },
                    { number: 4, events: [{ label: 'Brigada Eskwela', class: 'brigada' }] },
                    { number: 5, events: [{ label: 'Brigada Eskwela', class: 'brigada' }, { label: 'Enrollment Period', class: 'brigada' }] },
                    { number: 6 },
                    { number: 7 },
                    { number: 8, events: [{ label: 'Opening Block', class: 'opening' }] },
                    { number: 9, events: [{ label: 'Opening Block', class: 'opening' }] },
                    { number: 10, events: [{ label: 'Opening Block', class: 'opening' }] },
                    { number: 11, events: [{ label: 'Start of Term 1', class: 'opening' }] },
                    { number: 12, events: [{ label: 'Independence Day', class: 'holiday' }] },
                    { number: 13 }, { number: 14 }, { number: 15 }, { number: 16 }, { number: 17 }, { number: 18 }, { number: 19 },
                    { number: 20 }, { number: 21 }, { number: 22 }, { number: 23 }, { number: 24 }, { number: 25 }, { number: 26 },
                    { number: 27 }, { number: 28 }, { number: 29 }, { number: 30 }
                ]
            },
            {
                name: 'July 2026',
                days: [
                    { number: '' }, { number: '' }, { number: '' },
                    { number: 1 }, { number: 2 }, { number: 3 }, { number: 4 }, { number: 5 },
                    { number: 6, events: [{ label: 'First Summative Test', class: 'test' }] },
                    { number: 7 }, { number: 8 }, { number: 9 }, { number: 10 }, { number: 11 }, { number: 12 }, { number: 13 },
                    { number: 14 }, { number: 15 }, { number: 16 }, { number: 17 }, { number: 18 }, { number: 19 }, { number: 20 },
                    { number: 21 }, { number: 22 }, { number: 23 }, { number: 24 }, { number: 25 }, { number: 26 }, { number: 27 },
                    { number: 28, events: [{ label: 'Second Summative Test', class: 'test' }] },
                    { number: 29 }, { number: 30 }, { number: 31 }
                ]
            },
            {
                name: 'August 2026',
                days: [
                    { number: '' }, { number: '' }, { number: '' }, { number: '' }, { number: '' }, { number: '' }, { number: 1 },
                    { number: 2 }, { number: 3 }, { number: 4 }, { number: 5 }, { number: 6 }, { number: 7 }, { number: 8 },
                    { number: 9 }, { number: 10 }, { number: 11 }, { number: 12 }, { number: 13 }, { number: 14 }, { number: 15 },
                    { number: 16 }, { number: 17 }, { number: 18 }, { number: 19 }, { number: 20 },
                    { number: 21, events: [{ label: 'Exam Period', class: 'exam' }] },
                    { number: 22 }, { number: 23 }, { number: 24 }, { number: 25 }, { number: 26 }, { number: 27 }, { number: 28 },
                    { number: 29 }, { number: 30 },
                    { number: 31, events: [{ label: 'Ninoy Aquino Day', class: 'holiday' }] }
                ]
            },
            {
                name: 'September 2026',
                days: [
                    { number: '' }, { number: '' },
                    { number: 1, events: [{ label: 'Term 1 Exam', class: 'exam' }] },
                    { number: 2, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 3, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 4, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 5, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 6, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 7, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 8, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 9, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 10, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 11, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 12, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 13, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 14, events: [{ label: 'End of Term Block', class: 'endterm' }] },
                    { number: 15, events: [{ label: 'Term 1 Complete', class: 'endterm' }] },
                    { number: 16 }, { number: 17 }, { number: 18 }, { number: 19 }, { number: 20 },
                    { number: 21 }, { number: 22 }, { number: 23 }, { number: 24 }, { number: 25 }, { number: 26 }, { number: 27 },
                    { number: 28 }, { number: 29 }, { number: 30 }
                ]
            },
            {
                name: 'October 2026',
                isComingSoon: true
            },
            {
                name: 'November 2026',
                isComingSoon: true
            },
            {
                name: 'December 2026',
                isComingSoon: true
            },
            {
                name: 'January 2027',
                isComingSoon: true
            },
            {
                name: 'February 2027',
                isComingSoon: true
            },
            {
                name: 'March 2027',
                isComingSoon: true
            }
        ];

        let currentMonthIdx = 0;
        const monthVertical = document.getElementById('monthVertical');
        const monthYear = document.getElementById('monthYear');
        const prevMonthBtn = document.getElementById('prevMonthBtn');
        const nextMonthBtn = document.getElementById('nextMonthBtn');
        const calendarGrid = document.getElementById('calendarGrid');

        const eventModal = document.getElementById('eventModal');
        const eventModalTitle = document.getElementById('eventModalTitle');
        const eventModalList = document.getElementById('eventModalList');
        const closeEventModal = document.getElementById('closeEventModal');

        function renderCalendar() {
            const m = months[currentMonthIdx];
            const nameParts = m.name.split(' ');
            const monthName = nameParts[0];
            const year = nameParts[1];

            // Render side month name letters
            monthVertical.innerHTML = monthName.split('').map(letter => `<span class="month-letter">${letter}</span>`).join('');
            monthYear.textContent = year;

            if (m.isComingSoon) {
                calendarGrid.style.display = 'flex';
                calendarGrid.style.justifyContent = 'center';
                calendarGrid.style.alignItems = 'center';
                calendarGrid.style.height = '100%';
                calendarGrid.style.width = '100%';
                calendarGrid.innerHTML = `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; color: var(--text-light); text-align: center; padding: 40px 20px;">
                        <span style="font-size: 3.5rem; margin-bottom: 15px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">📅</span>
                        <h3 style="font-size: 1.75rem; font-weight: 700; color: var(--primary); margin-bottom: 10px;">Coming Soon</h3>
                        <p style="font-size: 1rem; max-width: 340px; line-height: 1.6; margin: 0; color: var(--text-light);">Academic calendar schedule for this month is currently being finalized. Please check back later.</p>
                    </div>
                `;
            } else {
                calendarGrid.style.display = 'grid';
                // Render day headers
                let gridHtml = `
                    <div class="day-header">Sun</div>
                    <div class="day-header">Mon</div>
                    <div class="day-header">Tue</div>
                    <div class="day-header">Wed</div>
                    <div class="day-header">Thu</div>
                    <div class="day-header">Fri</div>
                    <div class="day-header">Sat</div>
                `;

                // Render days
                m.days.forEach(day => {
                    if (day.number === '') {
                        gridHtml += `<div class="day-cell empty"></div>`;
                    } else {
                        const hasEv = day.events && day.events.length > 0;
                        gridHtml += `
                            <div class="day-cell ${hasEv ? 'has-events' : ''}">
                                <span class="day-number">${day.number}</span>
                                ${hasEv ? `
                                    <button class="event-counter" data-day="${day.number}">
                                        ${day.events.length}
                                    </button>
                                ` : ''}
                            </div>
                        `;
                    }
                });

                calendarGrid.innerHTML = gridHtml;

                // Attach event details trigger
                const counters = calendarGrid.querySelectorAll('.event-counter');
                counters.forEach(c => {
                    c.addEventListener('click', function() {
                        const dayNum = parseInt(this.getAttribute('data-day'));
                        const dayObj = m.days.find(d => d.number === dayNum);
                        if (dayObj && dayObj.events) {
                            eventModalTitle.textContent = `${monthName} ${dayNum}, ${year}`;
                            eventModalList.innerHTML = dayObj.events.map(ev => `
                                <div class="event-item-modal ${ev.class}">
                                    ${ev.label}
                                </div>
                            `).join('');
                            eventModal.style.display = 'flex';
                        }
                    });
                });
            }

        if (prevMonthBtn) prevMonthBtn.addEventListener('click', () => { if (currentMonthIdx > 0) { currentMonthIdx--; renderCalendar(); } });
        if (nextMonthBtn) nextMonthBtn.addEventListener('click', () => { if (currentMonthIdx < months.length - 1) { currentMonthIdx++; renderCalendar(); } });
        if (closeEventModal) closeEventModal.addEventListener('click', () => eventModal.style.display = 'none');
        if (eventModal) eventModal.addEventListener('click', (e) => { if (e.target === eventModal) eventModal.style.display = 'none'; });

        renderCalendar();

        // 3. Life at AMIS Photo Album Slideshows with Loading indicator & skeleton
        const slideshowContainers = document.querySelectorAll('.album-slideshow');
        slideshowContainers.forEach((container, idx) => {
            // Append center spinner HTML dynamically
            const spinner = document.createElement('div');
            spinner.className = 'album-spinner';
            container.appendChild(spinner);

            const imgs = container.querySelectorAll('.album-slide-img');
            
            // Function to check if image is loaded, then apply class
            function markAsLoaded(img) {
                img.classList.add('loaded');
                if (img.classList.contains('active')) {
                    container.classList.add('img-loaded');
                }
            }
            
            imgs.forEach(img => {
                if (img.complete) {
                    markAsLoaded(img);
                } else {
                    img.addEventListener('load', () => markAsLoaded(img));
                }
            });

            if (imgs.length > 1) {
                let activeIdx = 0;
                setInterval(() => {
                    imgs[activeIdx].classList.remove('active');
                    activeIdx = (activeIdx + 1) % imgs.length;
                    
                    const nextImg = imgs[activeIdx];
                    nextImg.classList.add('active');
                    
                    // Check if next image is loaded to update the wrapper loaded state
                    if (nextImg.classList.contains('loaded')) {
                        container.classList.add('img-loaded');
                    } else {
                        container.classList.remove('img-loaded');
                    }
                }, 4000 + (idx * 500)); // stagger slideshow transitions
            }
        });
    });
</script>
@endsection
