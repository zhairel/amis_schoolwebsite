@extends('layouts.app')

@section('title', 'Events & Activities | AMIS')

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
    
    .events-section {
        background: #f8fafc;
        padding: 60px 0;
    }
    
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        max-width: 1100px;
        margin: 0 auto;
    }
    
    .event-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .event-card:hover {
        border-color: #059669;
        transform: translateY(-3px);
    }
    
    .event-image-wrapper {
        position: relative;
        width: 100%;
        height: 210px;
        overflow: hidden;
        background: #e2e8f0;
    }
    
    .event-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Calendar Overlay Badge */
    .event-date-overlay {
        position: absolute;
        top: 15px;
        left: 15px;
        background: white;
        border-radius: 12px;
        width: 55px;
        height: 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        z-index: 10;
    }
    
    .event-date-overlay .month {
        background: #059669;
        color: white;
        width: 100%;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        text-align: center;
        padding: 3px 0;
        letter-spacing: 0.5px;
    }
    
    .event-date-overlay .day {
        color: #0f172a;
        font-size: 1.25rem;
        font-weight: 800;
        line-height: 1.2;
        padding-top: 2px;
    }
    
    .event-card-content {
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }
    
    .event-card-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }
    
    .event-card-category {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .event-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.4;
        margin-bottom: 10px;
    }
    
    .event-card-excerpt {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .event-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
        margin-top: auto;
    }
    
    .event-card-link {
        font-size: 0.85rem;
        font-weight: 700;
        color: #059669;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }
    
    .event-card-link:hover {
        color: #047857;
    }
    
    .event-author {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    /* Pagination Styling */
    .events-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 50px;
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
</style>
@endsection

@section('content')
<!-- HERO BANNER -->
<section class="page-hero">
    <div class="container">
        <span class="sy-badge">School Year 2026 - 2027</span>
        <h1>School Events</h1>
        <p>Keep track of academic events, programs, and activities at AMIS</p>
    </div>
</section>

<!-- GRID OF EVENTS -->
<section class="events-section">
    <div class="container">
        @if($events->count() > 0)
            <div class="events-grid">
                @foreach($events as $event)
                    @php
                        // Resolve image preview
                        $imgs = json_decode($event->image, true);
                        $firstImg = is_array($imgs) ? ($imgs[0] ?? null) : $event->image;
                        
                        // Parse date details for calendar badge overlay
                        $dateObj = $event->publish_date ?? $event->created_at;
                        $monthAbbr = $dateObj ? $dateObj->format('M') : 'AN';
                        $dayNum = $dateObj ? $dateObj->format('d') : '--';
                        
                        $plainText = strip_tags($event->content);
                        
                        // Dynamic category badges matching our soft color system (using green primary theme colors for events)
                        $categoryLower = strtolower($event->category);
                        $badgeStyle = 'background: #e6f4ea; color: #059669; border: 1px solid #a7f3d0;'; // Default soft green
                        
                        if (str_contains($categoryLower, 'news') || str_contains($categoryLower, 'good')) {
                            $badgeStyle = 'background: #dbeafe; color: #1e40af;'; // blue
                        } elseif (str_contains($categoryLower, 'participant') || str_contains($categoryLower, 'call') || str_contains($categoryLower, 'apply') || str_contains($categoryLower, 'applicant')) {
                            $badgeStyle = 'background: #f3e8ff; color: #6b21a8;'; // purple/violet
                        } elseif (str_contains($categoryLower, 'event') || str_contains($categoryLower, 'sport')) {
                            $badgeStyle = 'background: #fce7f3; color: #be185d;'; // pink/rose
                        } elseif (str_contains($categoryLower, 'announcement') || str_contains($categoryLower, 'important')) {
                            $badgeStyle = 'background: #fef3c7; color: #92400e;'; // amber/orange
                        }
                    @endphp
                    
                    <div class="event-card">
                        <!-- Date overlay & image (If no cover, remove image cover) -->
                        @if($firstImg)
                            <div class="event-image-wrapper">
                                <div class="event-date-overlay">
                                    <span class="month">{{ $monthAbbr }}</span>
                                    <span class="day">{{ $dayNum }}</span>
                                </div>
                                <img src="{{ $firstImg }}" alt="{{ $event->title }}">
                            </div>
                        @else
                            <div style="padding: 20px 24px 0; display: flex; align-items: center; gap: 12px;">
                                <div class="event-date-overlay" style="position: static;">
                                    <span class="month">{{ $monthAbbr }}</span>
                                    <span class="day">{{ $dayNum }}</span>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Details Content -->
                        <div class="event-card-content">
                            <div>
                                <div class="event-card-meta">
                                    @if($event->category)
                                        <span class="event-card-category" style="{{ $badgeStyle }}">
                                            {{ $event->category }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="event-card-title">{{ $event->title }}</h2>
                                
                                @if($event->event_dates || $event->event_venue || $event->is_online)
                                    <div style="display: flex; flex-direction: column; gap: 4px; font-size: 0.8rem; color: #64748b; margin: 8px 0 12px; padding: 10px; background: #f8fafc; border-radius: 10px; border: 1px solid #f1f5f9;">
                                        @if($event->event_dates)
                                            <span style="display: flex; align-items: center; gap: 6px;">
                                                <span>📅</span> <strong>Date:</strong> {{ $event->event_dates }}
                                            </span>
                                        @endif
                                        @if($event->is_online)
                                            <span style="display: flex; align-items: center; gap: 6px; color: #059669; font-weight: 700;">
                                                <span>💻</span> <strong>Mode:</strong> Online Class / Virtual
                                            </span>
                                        @elseif($event->event_venue)
                                            <span style="display: flex; align-items: center; gap: 6px;">
                                                <span>📍</span> <strong>Venue:</strong> {{ $event->event_venue }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                
                                <p class="event-card-excerpt">{{ Str::limit($plainText, 120, '...') }}</p>
                            </div>
                            
                            <!-- Card Footer info -->
                            <div class="event-card-footer">
                                <span class="event-author">
                                    👤 {{ $event->author ?? 'AMIS' }}
                                </span>
                                <a href="{{ route('announcement.show', $event->uuid ?? $event->id) }}" class="event-card-link">
                                    Details <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($events->hasPages())
                <div class="events-pagination">
                    {{-- Previous Page Link --}}
                    <a href="{{ $events->previousPageUrl() }}" class="pagination-btn {{ $events->onFirstPage() ? 'disabled-link' : '' }}">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    
                    {{-- Pagination Numbers --}}
                    @for ($page = 1; $page <= $events->lastPage(); $page++)
                        <a href="{{ $events->url($page) }}" class="pagination-number {{ $events->currentPage() === $page ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endfor
                    
                    {{-- Next Page Link --}}
                    <a href="{{ $events->nextPageUrl() }}" class="pagination-btn {{ !$events->hasMorePages() ? 'disabled-link' : '' }}">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 100px 40px; background: white; border-radius: 16px; border: 1px solid #e2e8f0; max-width: 900px; margin: 0 auto;">
                <div style="font-size: 4rem; margin-bottom: 20px;">📅</div>
                <h3 style="font-size: 1.5rem; color: #1e293b; margin-bottom: 10px; font-weight: 700;">No Events Scheduled Yet</h3>
                <p style="color: #64748b;">Please check back later for school activities and event schedules.</p>
            </div>
        @endif
    </div>
</section>
@endsection
