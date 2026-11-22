@extends('layouts.app')

@section('title', 'Newsroom & Official Notices | Al Munawwara Islamic School')

@php
    $activeTab = $activeTab ?? request('tab', 'all');
    $searchQuery = $searchQuery ?? request('q', '');
    $counts = $counts ?? [
        'all' => $announcements->total(),
        'notices' => 0,
        'news' => 0,
        'events' => 0,
    ];

    $cleanAnnouncementTitle = function (?string $rawTitle): string {
        $title = trim((string) $rawTitle);
        if ($title === '') return 'Official AMIS Update';
        // Remove redundant prefix like "AMIS News | "
        $title = preg_replace('/^AMIS\s+News\s*\|\s*/i', '', $title);
        if ($title === mb_strtoupper($title, 'UTF-8') && mb_strlen($title) > 18) {
            $title = mb_convert_case(mb_strtolower($title, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
            $title = str_ireplace(
                ['Amis-Gem', 'Amis', 'Peac', 'Dti', 'Ayimun', 'Adni', 'Deped', 'Qahe', 'Actd', 'Asad', 'Isal', 'S.y.', 'Sy ', 'Ii', 'Iii'],
                ['AMIS-GEM', 'AMIS', 'PEAC', 'DTI', 'AYIMUN', 'ADNI', 'DepEd', 'QAHE', 'ACTD', 'ASAD', 'ISAL', 'S.Y.', 'SY ', 'II', 'III'],
                $title
            );
        }
        return $title;
    };

    $cleanAnnouncementExcerpt = function (?string $rawHtml, int $limit = 175): string {
        $text = (string) $rawHtml;
        // Remove inline style/script blocks
        $text = preg_replace('/<(style|script)\b[^>]*>.*?<\/\1>/is', ' ', $text);
        // Remove memorandum table/header blocks so the excerpt shows the actual message body
        $text = preg_replace('/<table\b[^>]*>.*?<\/table>/is', ' ', $text);
        // Add space before and after block/break tags before stripping HTML
        $text = str_ireplace(['</p>', '<br>', '<br/>', '<br />', '</div>', '</li>', '</tr>', '</td>', '</th>', '</h1>', '</h2>', '</h3>', '</h4>'], ' ', $text);
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Strip leading memorandum boilerplate if still present in plain text
        $text = preg_replace('/^(?:MEMORANDUM|Circular\s+No\.[^\n]*|TO\s*:.*?DATE\s*:[^\n]*)/is', ' ', $text);
        $text = preg_replace('/\b(?:Assalaamu\s+alaikum\s+wa\s+rahmatullahi\s+wa\s+barakatuh\.?| السَّلَامُ عَلَيْكُمْ[^\s]*)\s*/iu', '', $text);
        $text = trim(preg_replace('/\s+/', ' ', $text));
        return \Illuminate\Support\Str::limit($text, $limit, '...');
    };
@endphp

@section('styles')
<style>
    .newsroom-page {
        background: #f8fafc;
        min-height: 100vh;
        padding-bottom: 5rem;
    }

    /* Hero Header */
    .newsroom-hero {
        background: radial-gradient(circle at 15% 20%, rgba(16, 185, 129, 0.25) 0%, transparent 45%),
                    radial-gradient(circle at 85% 80%, rgba(250, 204, 21, 0.14) 0%, transparent 45%),
                    linear-gradient(135deg, #022c22 0%, #064e3b 52%, #047857 100%);
        color: #ffffff;
        padding: 3.25rem 0 3.75rem;
        border-bottom: 3px solid rgba(250, 204, 21, 0.35);
    }
    .newsroom-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.84rem;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 1.25rem;
        background: rgba(255, 255, 255, 0.08);
        padding: 0.38rem 0.9rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .newsroom-breadcrumb a {
        color: #a7f3d0;
        text-decoration: none;
        font-weight: 600;
    }
    .newsroom-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: rgba(250, 204, 21, 0.16);
        color: #fde047;
        border: 1px solid rgba(250, 204, 21, 0.4);
        padding: 0.32rem 0.85rem;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 0.85rem;
    }
    .newsroom-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2rem, 1.35rem + 2.2vw, 3rem);
        font-weight: 900;
        line-height: 1.15;
        margin: 0 0 0.75rem;
        text-wrap: balance;
    }
    .newsroom-hero p {
        font-size: clamp(0.98rem, 0.92rem + 0.3vw, 1.12rem);
        color: rgba(255, 255, 255, 0.9);
        max-width: 64ch;
        line-height: 1.65;
        margin: 0;
    }

    /* Filter Tabs & Search Toolbar */
    .newsroom-toolbar-wrap {
        margin-top: -1.65rem;
        position: relative;
        z-index: 10;
        margin-bottom: 2.5rem;
    }
    .newsroom-toolbar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 0.9rem 1.15rem;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .newsroom-tabs {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.45rem;
    }
    .newsroom-tab {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.55rem 1rem;
        border-radius: 12px;
        font-size: 0.86rem;
        font-weight: 700;
        color: #475569;
        text-decoration: none;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    .newsroom-tab:hover {
        border-color: #059669;
        color: #059669;
        background: #f0fdf4;
    }
    .newsroom-tab.active {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.22);
    }
    .newsroom-tab-count {
        font-size: 0.72rem;
        font-weight: 800;
        padding: 0.12rem 0.45rem;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.08);
        color: inherit;
    }
    .newsroom-tab.active .newsroom-tab-count {
        background: rgba(255, 255, 255, 0.22);
        color: #ffffff;
    }

    .newsroom-search-form {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
        max-width: 340px;
        min-width: 240px;
    }
    .newsroom-search-input {
        width: 100%;
        padding: 0.58rem 0.95rem;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        font-size: 0.88rem;
        color: #0f172a;
        outline: none;
        transition: border-color 0.2s, background 0.2s;
    }
    .newsroom-search-input:focus {
        border-color: #059669;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
    }
    .newsroom-search-btn {
        padding: 0.58rem 1rem;
        border-radius: 12px;
        border: none;
        background: #0f172a;
        color: #ffffff;
        font-size: 0.84rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
    }
    .newsroom-search-btn:hover {
        background: #059669;
    }

    /* Section Headings */
    .newsroom-section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .newsroom-section-pill {
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
        margin-bottom: 0.45rem;
    }
    .newsroom-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.45rem, 1.15rem + 1vw, 2rem);
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }

    /* Featured Highlights Section (Clean Cards — Zero Text Overlaid on Photos) */
    .featured-highlights-wrap {
        margin-bottom: 3.25rem;
    }
    .featured-lead-card {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
        margin-bottom: 1.35rem;
        position: relative;
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .featured-lead-card:hover {
        transform: translateY(-3px);
        border-color: #059669;
        box-shadow: 0 18px 40px rgba(5, 150, 105, 0.12);
    }
    .featured-lead-img {
        width: 100%;
        height: 100%;
        min-height: 300px;
        max-height: 410px;
        aspect-ratio: 16 / 10;
        object-fit: cover;
        display: block;
        background: #f1f5f9;
    }
    .featured-lead-body {
        padding: clamp(1.5rem, 2.5vw, 2.35rem);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 1rem;
    }

    .featured-sub-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.35rem;
    }
    .featured-sub-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .featured-sub-card:hover {
        transform: translateY(-3px);
        border-color: #059669;
        box-shadow: 0 14px 30px rgba(5, 150, 105, 0.1);
    }
    .featured-sub-img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
        background: #f1f5f9;
    }
    .featured-sub-body {
        padding: 1.35rem 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
        gap: 0.85rem;
    }

    /* Stretched link pattern from Modern Web Guidance */
    .card-stretched:has(a.card-link) {
        position: relative;
    }
    .card-stretched a.card-link {
        color: inherit;
        text-decoration: none;
    }
    .card-stretched a.card-link::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 1;
    }
    .card-stretched:hover a.card-link {
        color: #059669;
    }

    /* All Updates Feed Grid */
    .feed-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.35rem;
    }
    .feed-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.035);
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        position: relative;
    }
    .feed-card:hover {
        transform: translateY(-3px);
        border-color: #059669;
        box-shadow: 0 14px 30px rgba(5, 150, 105, 0.1);
    }
    .feed-card.is-notice-card {
        border-top: 4px solid #d97706;
    }
    .feed-card.is-urgent-card {
        border-top: 4px solid #e11d48;
    }
    .feed-card.is-news-card {
        border-top: 4px solid #059669;
    }

    .feed-card-media-wrap {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        background: #f1f5f9;
        overflow: hidden;
        border-bottom: 1px solid #f1f5f9;
    }
    .feed-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .feed-card:hover .feed-card-img {
        transform: scale(1.03);
    }
    .feed-photo-count {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(15, 23, 42, 0.78);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.22rem 0.6rem;
        border-radius: 999px;
        backdrop-filter: blur(6px);
    }

    .feed-card-body {
        padding: 1.35rem 1.45rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
        gap: 0.85rem;
    }

    .card-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .card-cat-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .card-date-text {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
    }

    .card-headline-lg {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.35rem, 1.1rem + 0.8vw, 1.75rem);
        font-weight: 800;
        color: #0f172a;
        line-height: 1.28;
        margin: 0.5rem 0 0.65rem;
        text-wrap: balance;
    }
    .card-headline-md {
        font-family: 'Outfit', sans-serif;
        font-size: 1.18rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.35;
        margin: 0.35rem 0 0.45rem;
        text-wrap: balance;
    }

    .card-excerpt {
        font-size: 0.92rem;
        color: #475569;
        line-height: 1.62;
        margin: 0;
        text-wrap: pretty;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer-bar {
        padding-top: 0.85rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        font-size: 0.82rem;
    }
    .card-author {
        color: #64748b;
        font-weight: 600;
    }
    .card-read-cta {
        color: #059669;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Pagination */
    .news-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 2.75rem;
    }
    .pagination-btn,
    .pagination-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        min-height: 42px;
        padding: 0 0.65rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .pagination-btn:hover:not(.disabled-link),
    .pagination-number:hover {
        border-color: #059669;
        color: #059669;
    }
    .pagination-number.active {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
    }
    .pagination-btn.disabled-link {
        opacity: 0.4;
        pointer-events: none;
    }

    @media (max-width: 960px) {
        .featured-lead-card,
        .featured-sub-grid,
        .feed-grid {
            grid-template-columns: 1fr;
        }
        .newsroom-search-form {
            max-width: 100%;
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="newsroom-page">
    <!-- HERO BANNER -->
    <section class="newsroom-hero">
        <div class="container">
            <nav class="newsroom-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Newsroom &amp; Official Notices</span>
            </nav>
            <div>
                <span class="newsroom-kicker">Official School Communications &bull; SY 2026–2027</span>
                <h1>AMIS Newsroom &amp; Official Notice Board</h1>
                <p>Stay informed with verified school advisories, administrative circulars, student achievements, and campus events from Al Munawwara Islamic School.</p>
            </div>
        </div>
    </section>

    <!-- FILTER TABS & SEARCH TOOLBAR -->
    <div class="container newsroom-toolbar-wrap">
        <div class="newsroom-toolbar">
            <nav class="newsroom-tabs" aria-label="Filter announcements by category">
                <a href="{{ route('news.index', ['tab' => 'all', 'q' => $searchQuery ?: null]) }}"
                   class="newsroom-tab {{ $activeTab === 'all' ? 'active' : '' }}">
                    <span>All Updates</span>
                    <span class="newsroom-tab-count">{{ $counts['all'] ?? $announcements->total() }}</span>
                </a>
                <a href="{{ route('news.index', ['tab' => 'notices', 'q' => $searchQuery ?: null]) }}"
                   class="newsroom-tab {{ $activeTab === 'notices' ? 'active' : '' }}">
                    <span>AMIS Notices &amp; Advisories</span>
                    <span class="newsroom-tab-count">{{ $counts['notices'] ?? 0 }}</span>
                </a>
                <a href="{{ route('news.index', ['tab' => 'news', 'q' => $searchQuery ?: null]) }}"
                   class="newsroom-tab {{ $activeTab === 'news' ? 'active' : '' }}">
                    <span>Good News &amp; Stories</span>
                    <span class="newsroom-tab-count">{{ $counts['news'] ?? 0 }}</span>
                </a>
                <a href="{{ route('news.index', ['tab' => 'events', 'q' => $searchQuery ?: null]) }}"
                   class="newsroom-tab {{ $activeTab === 'events' ? 'active' : '' }}">
                    <span>Events &amp; Competitions</span>
                    <span class="newsroom-tab-count">{{ $counts['events'] ?? 0 }}</span>
                </a>
            </nav>

            <form method="GET" action="{{ route('news.index') }}" class="newsroom-search-form">
                @if($activeTab !== 'all')
                    <input type="hidden" name="tab" value="{{ $activeTab }}">
                @endif
                <input type="search"
                       name="q"
                       value="{{ $searchQuery }}"
                       placeholder="Search news, notices, circulars..."
                       class="newsroom-search-input"
                       aria-label="Search news and notices">
                <button type="submit" class="newsroom-search-btn">Search</button>
            </form>
        </div>
    </div>

    <div class="container">
        <!-- FEATURED TOP STORIES (Shown on 'All Updates', Page 1, without active search) -->
        @if($activeTab === 'all' && $searchQuery === '' && isset($topStories) && $topStories->count() >= 1 && request()->get('page', 1) == 1)
            @php
                $leadStory = $topStories->first();
                $subStories = $topStories->slice(1, 2);
                $leadImgs = json_decode($leadStory->image ?? '', true);
                $leadImg = is_array($leadImgs) ? ($leadImgs[0] ?? null) : $leadStory->image;
                $leadTitle = $cleanAnnouncementTitle($leadStory->title);
                $leadExcerpt = $cleanAnnouncementExcerpt($leadStory->content, 220);
                $leadDate = optional($leadStory->publish_date ?? $leadStory->created_at)->format('F d, Y');
                $leadAuthor = (!empty($leadStory->author) && !str_contains(strtolower($leadStory->author), 'admin')) ? $leadStory->author : 'AMIS Newsroom';
            @endphp

            <section class="featured-highlights-wrap" aria-label="Featured Campus Highlights">
                <div class="newsroom-section-header">
                    <div>
                        <span class="newsroom-section-pill">&#9733; Featured Campus Highlights</span>
                        <h2 class="newsroom-section-title">Top Stories &amp; Student Achievements</h2>
                    </div>
                </div>

                <!-- Lead Story Split Card -->
                <article class="featured-lead-card card-stretched">
                    <img src="{{ $leadImg ?: '/hero1.png' }}"
                         alt="{{ $leadTitle }}"
                         class="featured-lead-img"
                         onerror="this.src='/hero1.png'">
                    <div class="featured-lead-body">
                        <div>
                            <div class="card-meta-row">
                                <span class="card-cat-badge" style="background: #dcfce7; color: #065f46; border: 1px solid #a7f3d0;">
                                    {{ $leadStory->category ?: 'Featured Story' }}
                                </span>
                                <span class="card-date-text">{{ $leadDate }}</span>
                            </div>
                            <h3 class="card-headline-lg">
                                <a href="{{ route('announcement.show', $leadStory->uuid ?? $leadStory->id) }}" class="card-link">
                                    {{ $leadTitle }}
                                </a>
                            </h3>
                            <p class="card-excerpt">{{ $leadExcerpt }}</p>
                        </div>

                        <footer class="card-footer-bar">
                            <span class="card-author">By {{ $leadAuthor }}</span>
                            <span class="card-read-cta">Read Full Story &rarr;</span>
                        </footer>
                    </div>
                </article>

                @if($subStories->count() > 0)
                    <div class="featured-sub-grid">
                        @foreach($subStories as $story)
                            @php
                                $sImgs = json_decode($story->image ?? '', true);
                                $sImg = is_array($sImgs) ? ($sImgs[0] ?? null) : $story->image;
                                $sTitle = $cleanAnnouncementTitle($story->title);
                                $sExcerpt = $cleanAnnouncementExcerpt($story->content, 145);
                                $sDate = optional($story->publish_date ?? $story->created_at)->format('F d, Y');
                                $sAuthor = (!empty($story->author) && !str_contains(strtolower($story->author), 'admin')) ? $story->author : 'AMIS Newsroom';
                            @endphp
                            <article class="featured-sub-card card-stretched">
                                <img src="{{ $sImg ?: '/hero1.png' }}"
                                     alt="{{ $sTitle }}"
                                     class="featured-sub-img"
                                     loading="lazy"
                                     onerror="this.src='/hero1.png'">
                                <div class="featured-sub-body">
                                    <div>
                                        <div class="card-meta-row">
                                            <span class="card-cat-badge" style="background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe;">
                                                {{ $story->category ?: 'AMIS News' }}
                                            </span>
                                            <span class="card-date-text">{{ $sDate }}</span>
                                        </div>
                                        <h3 class="card-headline-md">
                                            <a href="{{ route('announcement.show', $story->uuid ?? $story->id) }}" class="card-link">
                                                {{ $sTitle }}
                                            </a>
                                        </h3>
                                        <p class="card-excerpt">{{ $sExcerpt }}</p>
                                    </div>
                                    <footer class="card-footer-bar">
                                        <span class="card-author">{{ $sAuthor }}</span>
                                        <span class="card-read-cta">Read Article &rarr;</span>
                                    </footer>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        @endif

        <!-- MAIN FEED: ALL NEWS & OFFICIAL NOTICES -->
        <section aria-label="Official Updates Feed">
            <div class="newsroom-section-header">
                <div>
                    <span class="newsroom-section-pill">
                        @if($activeTab === 'notices')
                            Official School Bulletin
                        @elseif($activeTab === 'news')
                            Campus Journalism
                        @elseif($activeTab === 'events')
                            Activities &amp; Calendar
                        @else
                            Complete Directory
                        @endif
                    </span>
                    <h2 class="newsroom-section-title">
                        @if($activeTab === 'notices')
                            AMIS Official Notices &amp; Advisories
                        @elseif($activeTab === 'news')
                            School News &amp; Student Achievements
                        @elseif($activeTab === 'events')
                            School Events &amp; Academic Competitions
                        @else
                            All Official Notices, Advisories &amp; News
                        @endif
                    </h2>
                </div>
                @if($searchQuery !== '')
                    <a href="{{ route('news.index', ['tab' => $activeTab]) }}" style="font-size: 0.85rem; font-weight: 700; color: #dc2626; text-decoration: none;">
                        &times; Clear search &ldquo;{{ $searchQuery }}&rdquo;
                    </a>
                @endif
            </div>

            @if($announcements->count() > 0)
                <div class="feed-grid">
                    @foreach($announcements as $announcement)
                        @php
                            $imgs = json_decode($announcement->image ?? '', true);
                            $firstImg = is_array($imgs) ? ($imgs[0] ?? null) : $announcement->image;
                            $photoCount = is_array($imgs) ? count($imgs) : ($firstImg ? 1 : 0);

                            $title = $cleanAnnouncementTitle($announcement->title);
                            $excerpt = $cleanAnnouncementExcerpt($announcement->content, 165);
                            $pubDate = optional($announcement->publish_date ?? $announcement->created_at)->format('F d, Y') ?? 'Official Update';
                            $author = (!empty($announcement->author) && !str_contains(strtolower($announcement->author), 'admin')) ? $announcement->author : 'AMIS Administration';

                            $catLower = strtolower($announcement->category ?? '');
                            $isNotice = str_contains($catLower, 'advisory') || str_contains($catLower, 'notice') || str_contains($catLower, 'reminder') || str_contains($catLower, 'announcement') || str_contains($catLower, 'memo');
                            $isUrgent = in_array(strtolower($announcement->priority ?? ''), ['urgent', 'high'], true);

                            if ($isUrgent && $isNotice) {
                                $cardTypeClass = 'is-urgent-card';
                                $badgeStyle = 'background: #ffe4e6; color: #9f1239; border: 1px solid #fecdd3;';
                            } elseif ($isNotice) {
                                $cardTypeClass = 'is-notice-card';
                                $badgeStyle = 'background: #fef3c7; color: #92400e; border: 1px solid #fde68a;';
                            } else {
                                $cardTypeClass = 'is-news-card';
                                $badgeStyle = 'background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;';
                            }
                        @endphp

                        <article class="feed-card card-stretched {{ $cardTypeClass }}">
                            @if($firstImg)
                                <div class="feed-card-media-wrap">
                                    <img src="{{ $firstImg }}"
                                         alt="{{ $title }}"
                                         class="feed-card-img"
                                         loading="lazy"
                                         onerror="this.src='/hero1.png'">
                                    @if($photoCount > 1)
                                        <span class="feed-photo-count">{{ $photoCount }} Photos</span>
                                    @endif
                                </div>
                            @endif

                            <div class="feed-card-body">
                                <div>
                                    <div class="card-meta-row">
                                        <span class="card-cat-badge" style="{{ $badgeStyle }}">
                                            {{ $announcement->category ?: 'Official Notice' }}
                                        </span>
                                        <span class="card-date-text">{{ $pubDate }}</span>
                                    </div>

                                    <h3 class="card-headline-md">
                                        <a href="{{ route('announcement.show', $announcement->uuid ?? $announcement->id) }}" class="card-link">
                                            {{ $title }}
                                        </a>
                                    </h3>

                                    <p class="card-excerpt">{{ $excerpt }}</p>
                                </div>

                                <footer class="card-footer-bar">
                                    <span class="card-author">{{ $author }}</span>
                                    <span class="card-read-cta">
                                        {{ $isNotice ? 'Read Official Notice' : 'Read Full Article' }} &rarr;
                                    </span>
                                </footer>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($announcements->hasPages())
                    <div class="news-pagination">
                        <a href="{{ $announcements->previousPageUrl() }}" class="pagination-btn {{ $announcements->onFirstPage() ? 'disabled-link' : '' }}" aria-label="Previous page">
                            &larr;
                        </a>
                        @for ($page = 1; $page <= $announcements->lastPage(); $page++)
                            <a href="{{ $announcements->url($page) }}" class="pagination-number {{ $announcements->currentPage() === $page ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        @endfor
                        <a href="{{ $announcements->nextPageUrl() }}" class="pagination-btn {{ !$announcements->hasMorePages() ? 'disabled-link' : '' }}" aria-label="Next page">
                            &rarr;
                        </a>
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 4.5rem 2rem; background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0;">
                    <h3 style="font-size: 1.35rem; color: #0f172a; margin: 0 0 0.5rem; font-weight: 800;">No Matching Updates Found</h3>
                    <p style="color: #64748b; margin: 0 0 1.25rem;">Try clearing your search filter or switching to another category tab.</p>
                    <a href="{{ route('news.index') }}" style="display: inline-flex; padding: 0.65rem 1.35rem; border-radius: 10px; background: #059669; color: #ffffff; font-weight: 700; text-decoration: none;">
                        View All Updates
                    </a>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
