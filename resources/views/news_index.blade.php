@extends('layouts.app')

@section('title', 'News & Info | AMIS')

@section('styles')
<style>
    .page-hero {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        padding: 100px 0 60px;
        text-align: center;
    }
    .page-hero h1 {
        font-size: 2.75rem;
        margin-bottom: 12px;
        font-weight: 800;
    }
    .page-hero p {
        font-size: 1.15rem;
        opacity: 0.95;
    }
    .sy-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .news-section {
        background: #f8fafc;
        padding: 60px 0;
    }
    
    .news-list {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    .news-item {
        display: flex;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .news-item:hover {
        border-color: #059669;
        transform: translateY(-2px);
    }
    
    .news-item-image {
        width: 280px;
        height: 190px;
        flex-shrink: 0;
        overflow: hidden;
        position: relative;
    }
    
    .news-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .news-item-content {
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }
    
    .news-item-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
    
    .news-item-date {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .news-item-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    
    .news-item-excerpt {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-item-link {
        font-size: 0.9rem;
        font-weight: 700;
        color: #059669;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }
    
    .news-item-link:hover {
        color: #047857;
    }
    
    /* Pagination styling */
    .news-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 40px;
    }
    
    .pagination-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: white;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-btn:hover:not(.disabled-link) {
        border-color: #059669;
        color: #059669;
    }
    
    .pagination-btn.disabled-link {
        opacity: 0.4;
        pointer-events: none;
        cursor: not-allowed;
    }
    
    .pagination-number {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 6px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: white;
        color: #475569;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-number:hover {
        border-color: #059669;
        color: #059669;
    }
    
    .pagination-number.active {
        background: #059669;
        border-color: #059669;
        color: white;
    }
    
    @media (max-width: 768px) {
        .news-item {
            flex-direction: column;
        }
        .news-item-image {
            width: 100%;
            height: 200px;
        }
        .news-item-content {
            padding: 20px;
        }
        .news-item-title {
            font-size: 1.2rem;
        }
    }

    /* TOP STORIES SECTION */
    .top-stories-section {
        background: #ffffff;
        padding: 50px 0 60px;
        border-bottom: 1px solid #e2e8f0;
    }
    .top-stories-header {
        margin-bottom: 28px;
    }
    .top-stories-badge-row {
        margin-bottom: 10px;
    }
    .top-stories-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .pulse-dot {
        display: inline-block;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);
    }
    .top-stories-title {
        font-size: 2.25rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 8px;
        letter-spacing: -0.5px;
    }
    .top-stories-subtitle {
        font-size: 1rem;
        color: #64748b;
        margin: 0;
    }

    /* TOP STORIES MOSAIC / BENTO GRID */
    .top-stories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: 255px 255px;
        gap: 12px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Specific Grid Placements matching user reference layout */
    .top-story-card-0 {
        grid-column: 1 / 3;
        grid-row: 1 / 3;
    }
    .top-story-card-1 {
        grid-column: 3 / 5;
        grid-row: 1 / 2;
    }
    .top-story-card-2 {
        grid-column: 3 / 4;
        grid-row: 2 / 3;
    }
    .top-story-card-3 {
        grid-column: 4 / 5;
        grid-row: 2 / 3;
    }

    /* Base Card Styling */
    .top-story-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background-color: #0f172a;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        isolation: isolate;
    }
    .top-story-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    /* Stretched link pattern */
    .top-story-card .top-story-card-link::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 2;
    }

    /* Media & Background Image */
    .top-story-media {
        position: absolute;
        inset: 0;
        z-index: -2;
        overflow: hidden;
    }
    .top-story-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        transition: transform 0.5s cubic-bezier(0.2, 0, 0.2, 1);
        display: block;
    }
    .top-story-card:hover .top-story-img {
        transform: scale(1.06);
    }

    /* Gradient Vignette Overlay */
    .top-story-overlay {
        position: absolute;
        inset: 0;
        z-index: -1;
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0) 15%,
            rgba(0, 0, 0, 0.45) 55%,
            rgba(0, 0, 0, 0.94) 100%
        );
        transition: background 0.3s ease;
    }
    .top-story-card:hover .top-story-overlay {
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0.05) 10%,
            rgba(0, 0, 0, 0.55) 50%,
            rgba(0, 0, 0, 0.98) 100%
        );
    }

    /* Content Area */
    .top-story-content {
        position: relative;
        z-index: 1;
        padding: 22px 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        color: #ffffff;
    }
    .top-story-card-0 .top-story-content {
        padding: 30px 28px;
        gap: 12px;
    }

    /* Badge */
    .top-story-tag-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .top-story-cat {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        background: rgba(15, 23, 42, 0.75);
        color: #f1f5f9;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .top-story-cat.cat-good-news {
        background: #059669;
        color: #ffffff;
        border-color: #34d399;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.4);
    }

    /* Headlines */
    .top-story-headline {
        margin: 0;
        line-height: 1.25;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
    }
    .top-story-card-0 .top-story-headline {
        font-size: 1.7rem;
        font-weight: 800;
    }
    .top-story-card-1 .top-story-headline {
        font-size: 1.28rem;
        font-weight: 700;
    }
    .top-story-card-2 .top-story-headline,
    .top-story-card-3 .top-story-headline {
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .top-story-card-link {
        color: #ffffff;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .top-story-card:hover .top-story-card-link {
        color: #a7f3d0;
    }

    /* Snippet */
    .top-story-snippet {
        margin: 0;
        font-size: 0.92rem;
        color: rgba(255, 255, 255, 0.88);
        line-height: 1.55;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.7);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Byline */
    .top-story-byline {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
        margin-top: 2px;
    }
    .story-author {
        font-weight: 700;
        color: #ffffff;
    }
    .story-separator {
        color: rgba(255, 255, 255, 0.5);
    }

    /* Feed Header */
    .feed-header-bar {
        max-width: 900px;
        margin: 0 auto 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 14px;
    }

    /* Responsiveness */
    @media (max-width: 991px) {
        .top-stories-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto;
            gap: 12px;
        }
        .top-story-card-0 {
            grid-column: 1 / 3;
            grid-row: auto;
            height: 380px;
        }
        .top-story-card-1 {
            grid-column: 1 / 3;
            grid-row: auto;
            height: 250px;
        }
        .top-story-card-2 {
            grid-column: 1 / 2;
            grid-row: auto;
            height: 230px;
        }
        .top-story-card-3 {
            grid-column: 2 / 3;
            grid-row: auto;
            height: 230px;
        }
    }

    @media (max-width: 640px) {
        .top-stories-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .top-story-card-0,
        .top-story-card-1,
        .top-story-card-2,
        .top-story-card-3 {
            grid-column: 1;
            grid-row: auto;
        }
        .top-story-card-0 {
            height: 340px;
        }
        .top-story-card-1 {
            height: 230px;
        }
        .top-story-card-2,
        .top-story-card-3 {
            height: 210px;
        }
        .top-story-card-0 .top-story-headline {
            font-size: 1.35rem;
        }
        .top-story-card-0 .top-story-content {
            padding: 22px 18px;
        }
    }
</style>
@endsection

@section('content')
<!-- HERO BANNER -->
<section class="page-hero">
    <div class="container">
        <span class="sy-badge">School Year 2026 - 2027</span>
        <h1>News & Info</h1>
        <p>Stay informed with the latest updates, announcements, and info from AMIS</p>
    </div>
</section>

<!-- TOP STORIES (GOOD NEWS & HIGHLIGHTS) -->
@if(isset($topStories) && $topStories->count() >= 3 && request()->get('page', 1) == 1)
<section class="top-stories-section">
    <div class="container" style="max-width: 1200px;">
        <div class="top-stories-header">
            <div class="top-stories-badge-row">
                <span class="top-stories-pill">
                    <span class="pulse-dot"></span>
                    Good News &amp; Achievements
                </span>
            </div>
            <h2 class="top-stories-title">Top Stories</h2>
            <p class="top-stories-subtitle">Celebrating academic excellence, global competitions, and inspiring achievements at AMIS</p>
        </div>

        <div class="top-stories-grid">
            @foreach($topStories as $idx => $story)
                @php
                    $storyImgs = json_decode($story->image, true);
                    $storyImg = is_array($storyImgs) ? ($storyImgs[0] ?? null) : $story->image;
                    if (!$storyImg) $storyImg = '/images/announcements/announcement_1784523441_ZOr34C.jpg';
                    $plainContent = strip_tags($story->content);
                    $authorName = (!empty($story->author) && !str_contains(strtolower($story->author), 'admin')) ? $story->author : 'AMIS IT Support';
                    $storyDate = optional($story->publish_date ?? $story->created_at)->format('F d, Y');
                    
                    // Title formatting: if uppercase, convert to Title Case and preserve AMIS / PEAC / DTI / etc.
                    $displayTitle = $story->title;
                    if ($displayTitle === strtoupper($displayTitle)) {
                        $displayTitle = ucwords(strtolower($displayTitle));
                        $displayTitle = str_ireplace(
                            ['amis', 'peac', 'dti', 'ayimun', 'adni', 'sy', 's.y.'],
                            ['AMIS', 'PEAC', 'DTI', 'AYIMUN', 'ADNI', 'S.Y.', 'S.Y.'],
                            $displayTitle
                        );
                    }
                @endphp

                <article class="top-story-card top-story-card-{{ $idx }}">
                    <div class="top-story-media">
                        <img src="{{ $storyImg }}" alt="{{ $displayTitle }}" loading="lazy" class="top-story-img">
                    </div>
                    <div class="top-story-overlay"></div>
                    <div class="top-story-content">
                        <div class="top-story-tag-wrap">
                            <span class="top-story-cat {{ str_contains(strtolower($story->category), 'good') ? 'cat-good-news' : '' }}">
                                {{ $story->category }}
                            </span>
                        </div>
                        
                        <h3 class="top-story-headline">
                            <a href="{{ route('announcement.show', $story->uuid ?? $story->id) }}" class="top-story-card-link">
                                {{ $displayTitle }}
                            </a>
                        </h3>
                        
                        @if($idx === 0)
                            <p class="top-story-snippet">{{ \Illuminate\Support\Str::limit($plainContent, 130) }}</p>
                        @endif
                        
                        <div class="top-story-byline">
                            <span class="story-author">{{ $authorName }}</span>
                            <span class="story-separator">&bull;</span>
                            <span class="story-date">{{ $storyDate }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- LIST OF ANNOUNCEMENTS -->
<section class="news-section">
    <div class="container">
        <div class="feed-header-bar">
            <div>
                <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0 0 4px; letter-spacing: -0.3px;">
                    All News &amp; Advisories
                </h2>
                <p style="margin: 0; font-size: 0.92rem; color: #64748b;">Official announcements, circulars, and updates from AMIS</p>
            </div>
            <span style="font-size: 0.85rem; font-weight: 700; color: #475569; background: white; padding: 6px 14px; border-radius: 20px; border: 1px solid #cbd5e1; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                {{ $announcements->total() }} Total Updates
            </span>
        </div>

        @if($announcements->count() > 0)
            <div class="news-list">
                @foreach($announcements as $announcement)
                    @php
                        // Resolve image preview
                        $imgs = json_decode($announcement->image, true);
                        $firstImg = is_array($imgs) ? ($imgs[0] ?? null) : $announcement->image;
                        
                        // Parse content cleanly for display (strip HTML tags since it's just a snippet)
                        $plainText = strip_tags($announcement->content);
                        
                        // Dynamic category badges matching our soft color system
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
                    
                    <div class="news-item">
                        <!-- Left: Image -->
                        <div class="news-item-image">
                            <img src="{{ $firstImg ?? '/summer-class.png' }}" alt="{{ $announcement->title }}" onerror="this.src='/summer-class.png'">
                        </div>
                        
                        <!-- Right: Details -->
                        <div class="news-item-content">
                            <div>
                                <div class="news-item-meta">
                                    @if($announcement->category)
                                        <span style="{{ $badgeStyle }} display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ $announcement->category }}
                                        </span>
                                    @endif
                                    <span class="news-item-date">
                                        {{ optional($announcement->publish_date ?? $announcement->created_at)->format('F d, Y') ?? 'ANNOUNCEMENT' }}
                                    </span>
                                </div>
                                <h2 class="news-item-title">{{ $announcement->title }}</h2>
                                <p class="news-item-excerpt">{{ Str::limit($plainText, 180, '...') }}</p>
                            </div>
                            
                            <a href="{{ route('announcement.show', $announcement->uuid ?? $announcement->id) }}" class="news-item-link">
                                Read Full Article <span>→</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Custom Styled Pagination -->
            @if($announcements->hasPages())
                <div class="news-pagination">
                    {{-- Previous Page Link --}}
                    <a href="{{ $announcements->previousPageUrl() }}" class="pagination-btn {{ $announcements->onFirstPage() ? 'disabled-link' : '' }}">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    
                    {{-- Pagination Numbers --}}
                    @for ($page = 1; $page <= $announcements->lastPage(); $page++)
                        <a href="{{ $announcements->url($page) }}" class="pagination-number {{ $announcements->currentPage() === $page ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endfor
                    
                    {{-- Next Page Link --}}
                    <a href="{{ $announcements->nextPageUrl() }}" class="pagination-btn {{ !$announcements->hasMorePages() ? 'disabled-link' : '' }}">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 100px 40px; background: white; border-radius: 16px; border: 1px solid #e2e8f0; max-width: 900px; margin: 0 auto;">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
                </div>
                <h3 style="font-size: 1.5rem; color: #1e293b; margin-bottom: 10px; font-weight: 700;">No News & Info Available</h3>
                <p style="color: #64748b;">Please check back later for new updates, advisories, and info for this school year.</p>
            </div>
        @endif
    </div>
</section>
@endsection
