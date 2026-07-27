@extends('layouts.app')

@section('title', ($announcement->title ?? 'Announcement') . ' | AMIS')

@section('styles')
<style>
    .announcement-detail {
        min-height: 100vh;
    }
    .breadcrumb-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 20px 0;
        margin-top: 0;
        position: relative;
        top: 0;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 0.9rem;
    }
    .breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb a:hover {
        color: white;
    }
    .breadcrumb .separator {
        color: rgba(255, 255, 255, 0.6);
    }
    .announcement-detail .section {
        padding-top: 15px !important;
    }
    .detail-category {
        text-align: center;
        margin-bottom: 16px;
        margin-top: 15px;
    }
    .category-badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .category-news {
        background: #dbeafe;
        color: #1e40af;
    }
    .category-event {
        background: #fce7f3;
        color: #be185d;
    }
    .category-announcement {
        background: #fef3c7;
        color: #92400e;
    }
    .category-other {
        background: #e5e7eb;
        color: #374151;
    }
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 16px;
        color: var(--text);
        line-height: 1.2;
    }
    .page-subtitle {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: var(--text-light);
        font-size: 1rem;
        margin-bottom: 25px;
    }
    .page-subtitle svg {
        width: 20px;
        height: 20px;
    }
    .content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px 80px 20px;
    }
    .gallery-container {
        width: 100%;
        max-width: 860px;
        margin: 0 auto 30px auto;
        position: relative;
        padding-right: 110px;
        box-sizing: border-box;
    }
    .main-gallery-viewport {
        width: 100%;
        aspect-ratio: 4/3;
        overflow: hidden;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        position: relative;
    }
    .gallery-thumbnails-sidebar {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 95px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        overflow-y: auto;
        z-index: 10;
        padding-right: 4px;
        box-sizing: border-box;
    }
    .gallery-thumbnails-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    .gallery-thumbnails-sidebar::-webkit-scrollbar-track {
        background: transparent;
    }
    .gallery-thumbnails-sidebar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .gallery-thumbnails-sidebar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    .gallery-thumbnail-btn {
        border: 2px solid #e2e8f0;
        transition: all 0.2s ease;
        opacity: 0.75;
    }
    .gallery-thumbnail-btn:hover {
        opacity: 1;
        border-color: #cbd5e1;
    }
    .gallery-thumbnail-btn.active {
        opacity: 1;
        border-color: #0d9488;
    }
    .detail-text {
        font-size: 1.15rem;
        line-height: 1.95;
        color: #111111;
        text-align: justify;
        white-space: pre-wrap;
        margin-top: 30px;
    }
    @media (max-width: 640px) {
        .page-title {
            font-size: 2rem;
        }
        .page-subtitle {
            font-size: 0.9rem;
        }
        .gallery-container {
            padding-right: 0;
        }
        .main-gallery-viewport {
            aspect-ratio: 1/1;
        }
        .gallery-thumbnails-sidebar {
            position: relative;
            right: auto;
            top: auto;
            bottom: auto;
            width: 100%;
            height: 70px;
            flex-direction: row;
            overflow-x: auto;
            overflow-y: hidden;
            margin-top: 12px;
            padding: 4px 0;
        }
        .gallery-thumbnails-sidebar::-webkit-scrollbar {
            height: 4px;
            width: auto;
        }
        .gallery-thumbnail-btn {
            width: 80px;
            height: 60px;
        }
        .main-gallery-viewport button {
            opacity: 0.85 !important;
        }
        .detail-text {
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<div class="announcement-detail">
    <!-- Breadcrumb Header -->
    <div class="breadcrumb-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">/</span>
                <span>Announcement</span>
            </div>
        </div>
    </div>

    <!-- Announcement Content -->
    <section class="section">
        <div class="container">
            <!-- Title Section at the top -->
            <div class="detail-header-top" style="text-align: center; margin-bottom: 25px;">
                <h1 class="page-title">{{ $announcement->title }}</h1>
                @if($announcement->publish_date || $announcement->created_at)
                    <div class="page-subtitle" style="margin-bottom: 0;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ optional($announcement->publish_date ?? $announcement->created_at)->format('F d, Y') }}
                    </div>
                @endif
            </div>

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                @php
                    $imgs = json_decode($announcement->image, true);
                    if (!is_array($imgs)) {
                        $imgs = $announcement->image ? [$announcement->image] : [];
                    }
                @endphp

                @if(!empty($imgs))
                    <!-- Gallery View Container -->
                    <div class="gallery-container">
                        <!-- Main Viewport (Left) -->
                        <div class="main-gallery-viewport group">
                            <!-- Slides -->
                            <div class="flex transition-transform duration-500 ease-out h-full" id="carouselSlides" style="width: {{ count($imgs) * 100 }}%;">
                                @foreach($imgs as $img)
                                    <div class="h-full flex items-center justify-center flex-shrink-0" style="width: calc(100% / {{ count($imgs) }});">
                                        <img src="{{ $img }}" alt="{{ $announcement->title }}" class="w-full h-full object-contain" loading="lazy">
                                    </div>
                                @endforeach
                            </div>

                            @if(count($imgs) > 1)
                                <!-- Navigation Arrows -->
                                <button onclick="moveCarousel(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 hover:bg-white text-slate-800 flex items-center justify-center border border-slate-200 transition-all duration-200 opacity-0 group-hover:opacity-100 cursor-pointer z-10">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button onclick="moveCarousel(1)" class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 hover:bg-white text-slate-800 flex items-center justify-center border border-slate-200 transition-all duration-200 opacity-0 group-hover:opacity-100 cursor-pointer z-10">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            @endif
                        </div>

                        <!-- Vertical Scrollable Thumbnails (Right) -->
                        @if(count($imgs) > 1)
                            <div class="gallery-thumbnails-sidebar">
                                @foreach($imgs as $index => $img)
                                    <button onclick="setCarouselSlide({{ $index }})" class="gallery-thumbnail-btn w-full aspect-[4/3] rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'active' : '' }} transition bg-slate-100 p-0 flex-shrink-0 cursor-pointer" data-index="{{ $index }}">
                                        <img src="{{ $img }}" class="w-full h-full object-cover" loading="lazy">
                                    </button>
                                @endforeach
                            </div>

                            <script>
                                let currentSlideIndex = 0;
                                const totalSlides = {{ count($imgs) }};
                                let autoSlideInterval;
                                
                                function updateCarousel() {
                                    const slidesContainer = document.getElementById('carouselSlides');
                                    if (!slidesContainer) return;
                                    const offset = -currentSlideIndex * (100 / totalSlides);
                                    slidesContainer.style.transform = `translateX(${offset}%)`;
                                    
                                    // Update active class on thumbnail buttons
                                    const buttons = document.querySelectorAll('.gallery-thumbnail-btn');
                                    const sidebar = document.querySelector('.gallery-thumbnails-sidebar');
                                    buttons.forEach((btn, idx) => {
                                        if (idx === currentSlideIndex) {
                                            btn.classList.add('active');
                                            if (sidebar) {
                                                const btnTop = btn.offsetTop;
                                                const btnHeight = btn.offsetHeight;
                                                const sidebarHeight = sidebar.clientHeight;
                                                const sidebarScrollTop = sidebar.scrollTop;
                                                
                                                if (btnTop + btnHeight > sidebarScrollTop + sidebarHeight) {
                                                    sidebar.scrollTo({
                                                        top: btnTop + btnHeight - sidebarHeight + 4,
                                                        behavior: 'smooth'
                                                    });
                                                } else if (btnTop < sidebarScrollTop) {
                                                    sidebar.scrollTo({
                                                        top: btnTop - 4,
                                                        behavior: 'smooth'
                                                    });
                                                }
                                            }
                                        } else {
                                            btn.classList.remove('active');
                                        }
                                    });
                                }

                                function setCarouselSlide(index) {
                                    currentSlideIndex = index;
                                    updateCarousel();
                                    resetAutoSlide();
                                }

                                function moveCarousel(direction) {
                                    currentSlideIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
                                    updateCarousel();
                                    resetAutoSlide();
                                }

                                function startAutoSlide() {
                                    autoSlideInterval = setInterval(() => {
                                        currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
                                        updateCarousel();
                                    }, 4000);
                                }

                                function resetAutoSlide() {
                                    clearInterval(autoSlideInterval);
                                    startAutoSlide();
                                }

                                // Initialize
                                document.addEventListener('DOMContentLoaded', () => {
                                    updateCarousel();
                                    startAutoSlide();
                                });
                            </script>
                        @endif
                    </div>
                @endif

                <!-- Dynamic Category Chip Section (Moved below image gallery) -->
                @if($announcement->category)
                    @php
                        $categoryLower = strtolower($announcement->category);
                        $badgeStyle = 'background: #e0f2fe; color: #0369a1;'; // Default sky blue
                        
                        if (str_contains($categoryLower, 'news') || str_contains($categoryLower, 'good')) {
                            $badgeStyle = 'background: #dbeafe; color: #1e40af;'; // blue
                        } elseif (str_contains($categoryLower, 'participant') || str_contains($categoryLower, 'call') || str_contains($categoryLower, 'apply') || str_contains($categoryLower, 'applicant')) {
                            $badgeStyle = 'background: #f3e8ff; color: #6b21a8;'; // purple/violet
                        } elseif (str_contains($categoryLower, 'event') || str_contains($categoryLower, 'sport')) {
                            $badgeStyle = 'background: #fce7f3; color: #be185d;'; // pink/rose
                        } elseif (str_contains($categoryLower, 'announcement') || str_contains($categoryLower, 'important')) {
                            $badgeStyle = 'background: #fef3c7; color: #92400e;'; // amber/orange
                        } else {
                            // Dynamic color choice using hash modulo to keep it varied
                            $colorsList = [
                                ['bg' => '#d1fae5', 'text' => '#065f46'], // green
                                ['bg' => '#ffedd5', 'text' => '#9a3412'], // orange
                                ['bg' => '#e0f2fe', 'text' => '#0369a1'], // sky
                                ['bg' => '#e0e7ff', 'text' => '#3730a3'], // indigo
                                ['bg' => '#fee2e2', 'text' => '#991b1b'], // red
                            ];
                            $colorIndex = abs(crc32($categoryLower)) % count($colorsList);
                            $selectedColor = $colorsList[$colorIndex];
                            $badgeStyle = "background: {$selectedColor['bg']}; color: {$selectedColor['text']};";
                        }
                    @endphp
                    <div class="detail-category" style="margin-top: 30px; margin-bottom: 20px; text-align: center;">
                        <span class="category-badge" style="{{ $badgeStyle }} display: inline-block; padding: 6px 18px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $announcement->category }}
                        </span>
                    </div>
                @endif

                <!-- Event Details Information Card -->
                @if($announcement->event_dates || $announcement->event_venue || $announcement->is_online)
                    <div style="margin: 20px auto 30px; max-width: 700px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: flex; flex-direction: column; gap: 12px; text-align: left;">
                        <h3 style="font-size: 0.9rem; font-weight: 800; color: #059669; text-transform: uppercase; letter-spacing: 0.5px; margin: 0; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">📅 Event Details</h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
                            @if($announcement->event_dates)
                                <div style="display: flex; align-items: start; gap: 10px;">
                                    <span style="font-size: 1.25rem; line-height: 1;">📅</span>
                                    <div>
                                        <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Event Date(s)</div>
                                        <div style="font-size: 0.95rem; font-weight: 600; color: #1e293b; margin-top: 2px;">{{ $announcement->event_dates }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($announcement->is_online)
                                <div style="display: flex; align-items: start; gap: 10px;">
                                    <span style="font-size: 1.25rem; line-height: 1;">💻</span>
                                    <div>
                                        <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Venue / Location</div>
                                        <div style="font-size: 0.95rem; font-weight: 700; color: #059669; margin-top: 2px;">Online Class / Virtual Event</div>
                                    </div>
                                </div>
                            @endif
                            @if(!$announcement->is_online && $announcement->event_venue)
                                <div style="display: flex; align-items: start; gap: 10px;">
                                    <span style="font-size: 1.25rem; line-height: 1;">📍</span>
                                    <div>
                                        <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Venue / Location</div>
                                        <div style="font-size: 0.95rem; font-weight: 600; color: #1e293b; margin-top: 2px;">{{ $announcement->event_venue }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Text Content -->
                <div class="detail-text" style="margin-top: 10px;">{!! $announcement->content !!}</div>
            </div>
        </div>
    </section>
</div>
@endsection
