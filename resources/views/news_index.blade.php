@extends('layouts.app')

@section('title', 'News & Announcements | AMIS')

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
</style>
@endsection

@section('content')
<!-- HERO BANNER -->
<section class="page-hero">
    <div class="container">
        <span class="sy-badge">School Year 2026 - 2027</span>
        <h1>Recent News</h1>
        <p>Stay informed about events, announcements, and key updates from AMIS</p>
    </div>
</section>

<!-- LIST OF ANNOUNCEMENTS -->
<section class="news-section">
    <div class="container">
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
                <div style="font-size: 4rem; margin-bottom: 20px;">📰</div>
                <h3 style="font-size: 1.5rem; color: #1e293b; margin-bottom: 10px; font-weight: 700;">No Recent News Yet</h3>
                <p style="color: #64748b;">Please check back later for new announcements and updates for this school year.</p>
            </div>
        @endif
    </div>
</section>
@endsection
