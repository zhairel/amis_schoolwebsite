@extends('layouts.app')

@php
    $pageTitle = ($announcement->title ?? 'Announcement') . ' | AMIS';
    
    // Clean, plain-text excerpt for social sharing description
    $plainText = strip_tags(str_replace(['</p>', '<br>', '<br/>', '<br />', '</tr>', '</th>', '</td>', '</li>'], ' ', $announcement->content ?? ''));
    $plainText = trim(preg_replace('/\s+/', ' ', $plainText));
    $shareDescription = Str::limit($plainText, 180, '...');
    if (empty($shareDescription)) {
        $shareDescription = 'Official school announcement and advisory from Al Munawwara Islamic School (AMIS), Davao City.';
    }

    // Determine the best sharing image (first real uploaded image or default school banner)
    $rawImgs = json_decode($announcement->image ?? '', true);
    if (!is_array($rawImgs)) {
        $rawImgs = $announcement->image ? [$announcement->image] : [];
    }
    $validImgs = array_values(array_filter($rawImgs, function($img) {
        return !empty($img) && !str_contains($img, 'coming-soon');
    }));

    // Detect local image dimensions if available for instant Facebook preview generation
    $imageWidth = 1200;
    $imageHeight = 630;
    $imageMime = 'image/png';

    if (!empty($validImgs)) {
        $firstImgPath = $validImgs[0];
        // Check if a dedicated 1200x630 OpenGraph landscape banner exists (e.g. sm-2627-031-og.png or amis-gem-2026-international-og.png)
        $ogBannerCandidate = preg_replace('/-page\d+\.(png|jpg|jpeg)$/i', '-og.$1', $firstImgPath);
        $directOgCandidate = preg_replace('/\.(png|jpg|jpeg)$/i', '-og.$1', $firstImgPath);
        if ($ogBannerCandidate !== $firstImgPath && file_exists(public_path(ltrim(parse_url($ogBannerCandidate, PHP_URL_PATH), '/')))) {
            $firstImgPath = $ogBannerCandidate;
        } elseif ($directOgCandidate !== $firstImgPath && file_exists(public_path(ltrim(parse_url($directOgCandidate, PHP_URL_PATH), '/')))) {
            $firstImgPath = $directOgCandidate;
        }

        $shareImage = str_starts_with($firstImgPath, 'http') ? $firstImgPath : url($firstImgPath);
        $localPath = public_path(ltrim(parse_url($firstImgPath, PHP_URL_PATH), '/'));
        if (file_exists($localPath)) {
            $imgDims = @getimagesize($localPath);
            if ($imgDims) {
                $imageWidth = $imgDims[0];
                $imageHeight = $imgDims[1];
                $imageMime = $imgDims['mime'] ?? 'image/png';
            }
        }
    } else {
        $shareImage = url('/hero1.png');
        $imageWidth = 1920;
        $imageHeight = 1080;
        $imageMime = 'image/png';
    }
    
    $canonicalUrl = route('announcement.show', $announcement->uuid ?? $announcement->id);

    // Reading time calculation
    $wordCount = str_word_count(strip_tags($announcement->content ?? ''));
    $readTime = max(1, ceil($wordCount / 180));

    // Dynamic category badge style & icon
    $categoryLower = strtolower($announcement->category ?? 'Official Advisory');
    $categoryLabel = $announcement->category ?: 'Official Advisory';
    $badgeBg = '#fef3c7';
    $badgeText = '#92400e';
    $badgeBorder = '#fde68a';

    if (str_contains($categoryLower, 'news') || str_contains($categoryLower, 'balita') || str_contains($categoryLower, 'good')) {
        $badgeBg = '#dbeafe';
        $badgeText = '#1e40af';
        $badgeBorder = '#bfdbfe';
    } elseif (str_contains($categoryLower, 'advisory') || str_contains($categoryLower, 'memorandum') || str_contains($categoryLower, 'memo') || str_contains($categoryLower, 'important')) {
        $badgeBg = '#fef3c7';
        $badgeText = '#92400e';
        $badgeBorder = '#fde68a';
    } elseif (str_contains($categoryLower, 'event') || str_contains($categoryLower, 'sport') || str_contains($categoryLower, 'ceremony')) {
        $badgeBg = '#fce7f3';
        $badgeText = '#be185d';
        $badgeBorder = '#fbcfe8';
    } elseif (str_contains($categoryLower, 'call') || str_contains($categoryLower, 'apply') || str_contains($categoryLower, 'participant')) {
        $badgeBg = '#f3e8ff';
        $badgeText = '#6b21a8';
        $badgeBorder = '#e9d5ff';
    } else {
        $badgeBg = '#d1fae5';
        $badgeText = '#065f46';
        $badgeBorder = '#a7f3d0';
    }

    // Process content for authentic news / balita typography
    $processedContent = $announcement->content ?? '';

    // If content has no <p> tags, convert line breaks into clean paragraphs
    if (!str_contains($processedContent, '<p>')) {
        $paragraphs = array_filter(array_map('trim', explode("\n", $processedContent)));
        $processedContent = '<p>' . implode('</p><p>', $paragraphs) . '</p>';
    }

    // Format Islamic Salutation Greeting with traditional Amiri typography
    $processedContent = preg_replace(
        '/<p>\s*(Assalaamu\s+alaikum[^<]*)\s*<\/p>/iu',
        '<div class="islamic-salutation-card"><div class="arabic-calligraphy">السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ ٱللَّهِ وَبَرَكَاتُهُ</div><div class="latin-salutation">$1</div></div>',
        $processedContent,
        1
    );

    // Format Islamic Closing with traditional Amiri typography
    $processedContent = preg_replace(
        '/<p>\s*(Shukran\.[^<]*)\s*<\/p>/iu',
        '<div class="islamic-closing-card"><span class="arabic-closing">شُكْرًا وَبَارَكَ ٱللَّهُ فِيكُمْ</span><span class="latin-closing">$1</span></div>',
        $processedContent,
        1
    );

    // Format Official Administration Sign-off Banner
    $processedContent = preg_replace(
        '/<p>\s*(&ndash;|–|-)?\s*<strong>(AMIS\s+Administration)<\/strong>\s*<\/p>/iu',
        '<div class="official-signoff-banner"><img src="/logo.png" alt="AMIS Seal" class="signoff-seal" /><div class="signoff-info"><span class="signoff-org">Al Munawwara Islamic School</span><span class="signoff-dept">Office of the School Administration &bull; Davao City</span></div><div class="signoff-badge"><svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Verified Official Release</div></div>',
        $processedContent,
        1
    );

    // Fetch related announcements fallback
    if (!isset($relatedAnnouncements)) {
        $relatedAnnouncements = \App\Models\Announcement::where('id', '!=', $announcement->id)
            ->orderByDesc('publish_date')
            ->orderByDesc('id')
            ->take(3)
            ->get();
    }
@endphp

@section('title', $pageTitle)
@section('meta_description', $shareDescription)
@section('og_title', $announcement->title ?? 'Announcement')
@section('og_type', 'article')
@section('og_image', $shareImage)
@section('canonical_url', $canonicalUrl)
@section('og_url', url()->full())

@section('extra_og_tags')
    <meta property="og:image:width" content="{{ $imageWidth }}">
    <meta property="og:image:height" content="{{ $imageHeight }}">
    <meta property="og:image:type" content="{{ $imageMime }}">
    <meta property="article:published_time" content="{{ optional($announcement->publish_date ?? $announcement->created_at)->toIso8601String() }}">
    <meta property="article:author" content="{{ $announcement->author ?: 'AMIS Administration' }}">
    <meta property="article:section" content="{{ $announcement->category ?: 'School Announcements' }}">
    <meta property="og:image:alt" content="{{ $announcement->title ?? 'Announcement' }}">
@endsection

@section('styles')
<style>
    .announcement-news-page {
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 80px;
    }
    
    /* Top Breadcrumb Navigation */
    .breadcrumb-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 16px 0;
    }
    .breadcrumb-nav-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 0.875rem;
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
    .breadcrumb .current {
        color: rgba(255, 255, 255, 0.95);
        font-weight: 500;
        max-width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .back-news-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.16);
        color: white;
        padding: 5px 14px;
        border-radius: 9999px;
        font-size: 0.825rem;
        font-weight: 600;
        text-decoration: none;
        backdrop-filter: blur(8px);
        transition: all 0.2s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .back-news-btn:hover {
        background: rgba(255, 255, 255, 0.28);
        transform: translateX(-3px);
        color: white;
    }

    /* Editorial News Article Sheet */
    .news-sheet {
        max-width: 860px;
        margin: 36px auto 0;
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05), 0 4px 12px -2px rgba(15, 23, 42, 0.025);
        overflow: hidden;
        position: relative;
    }
    .news-sheet-stripe {
        height: 5px;
        background: linear-gradient(90deg, #059669 0%, #10b981 50%, #047857 100%);
    }
    .news-sheet-body {
        padding: 44px 52px 48px;
    }

    /* Kicker & Meta Row */
    .news-kicker-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }
    .category-kicker {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        border: 1px solid transparent;
    }
    .news-dateline-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 0.825rem;
        font-weight: 600;
        color: #475569;
        background: #f1f5f9;
        padding: 5px 14px;
        border-radius: 9999px;
        border: 1px solid #e2e8f0;
    }
    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        display: inline-block;
        animation: pulseGlow 2s infinite ease-in-out;
    }
    @keyframes pulseGlow {
        0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        50% { opacity: 0.5; transform: scale(0.85); box-shadow: 0 0 0 4px rgba(16, 185, 129, 0); }
    }

    /* Headline / Ulo ng Balita */
    .news-headline {
        font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: clamp(1.9rem, 3.4vw, 2.65rem);
        font-weight: 800;
        line-height: 1.24;
        letter-spacing: -0.025em;
        color: #0f172a;
        margin: 0 0 22px 0;
        text-align: left;
    }

    /* Editorial Byline Bar */
    .news-byline-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        padding: 16px 0 20px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 32px;
    }
    .byline-author-group {
        display: flex;
        align-items: center;
        gap: 13px;
    }
    .byline-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        object-fit: contain;
        padding: 2px;
        flex-shrink: 0;
    }
    .byline-text-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .byline-author-name {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
    }
    .verified-icon {
        color: #059669;
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }
    .byline-subinfo {
        font-size: 0.825rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .byline-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .action-btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 13px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .action-btn-sm:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
        transform: translateY(-1px);
    }
    .action-btn-sm.btn-copied {
        background: #ecfdf5 !important;
        color: #047857 !important;
        border-color: #a7f3d0 !important;
    }

    /* Media Gallery */
    .gallery-container {
        width: 100%;
        margin: 0 auto 32px auto;
        position: relative;
        padding-right: 110px;
        box-sizing: border-box;
    }
    .main-gallery-viewport {
        width: 100%;
        aspect-ratio: 16/10;
        overflow: hidden;
        border-radius: 16px;
        background: #0f172a;
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
    .gallery-thumbnails-sidebar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
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
        border-color: #059669;
    }

    /* Event Details Box */
    .event-info-box {
        margin: 0 0 32px 0;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }
    .event-info-header {
        font-size: 0.85rem;
        font-weight: 800;
        color: #059669;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin: 0 0 14px 0;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .event-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    /* Authentic News Typography */
    .news-body-content {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 1.15rem;
        line-height: 1.85;
        color: #1e293b;
        text-align: left;
        word-break: break-word;
    }
    .news-body-content p {
        margin-bottom: 1.5rem;
        line-height: 1.85;
    }
    .news-body-content p:last-child {
        margin-bottom: 0;
    }
    .news-body-content strong, .news-body-content b {
        font-weight: 700;
        color: #0f172a;
    }
    .news-body-content ul, .news-body-content ol {
        margin: 1rem 0 1.5rem 1.5rem;
        padding-left: 1rem;
    }
    .news-body-content li {
        margin-bottom: 0.5rem;
        line-height: 1.75;
    }

    /* News Lead Paragraph */
    .news-body-content > p:first-of-type,
    .islamic-salutation-card + p {
        font-size: 1.22rem;
        font-weight: 500;
        line-height: 1.8;
        color: #0f172a;
        letter-spacing: -0.01em;
    }

    /* Islamic Salutation Card */
    .islamic-salutation-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
        border-left: 4px solid #059669;
        border-radius: 0 16px 16px 0;
        padding: 20px 24px;
        margin-bottom: 2rem;
        border-top: 1px solid #d1fae5;
        border-right: 1px solid #d1fae5;
        border-bottom: 1px solid #d1fae5;
    }
    .arabic-calligraphy {
        font-family: 'Amiri', 'Georgia', serif;
        font-size: 1.45rem;
        color: #047857;
        font-weight: 700;
        direction: rtl;
        text-align: right;
        line-height: 1.6;
        margin-bottom: 6px;
    }
    .latin-salutation {
        font-size: 1.05rem;
        color: #065f46;
        font-style: italic;
        font-weight: 600;
        line-height: 1.5;
    }

    /* Islamic Closing Card */
    .islamic-closing-card {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 14px 20px;
        margin: 2rem 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .arabic-closing {
        font-family: 'Amiri', 'Georgia', serif;
        font-size: 1.35rem;
        color: #047857;
        font-weight: 700;
    }
    .latin-closing {
        font-size: 1rem;
        color: #065f46;
        font-style: italic;
        font-weight: 600;
    }

    /* Official Sign-off Banner */
    .official-signoff-banner {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px 22px;
        margin-top: 2.25rem;
        flex-wrap: wrap;
    }
    .signoff-seal {
        width: 46px;
        height: 46px;
        object-fit: contain;
        flex-shrink: 0;
    }
    .signoff-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        flex-grow: 1;
    }
    .signoff-org {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
    }
    .signoff-dept {
        font-size: 0.8rem;
        color: #64748b;
    }
    .signoff-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #047857;
        background: #d1fae5;
        padding: 6px 12px;
        border-radius: 20px;
        border: 1px solid #a7f3d0;
    }

    /* Article Bottom Action Bar */
    .news-bottom-actions {
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .share-pill-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .share-pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .share-fb {
        background: #1877f2;
        color: white;
    }
    .share-fb:hover {
        background: #0d65d9;
        transform: translateY(-2px);
        color: white;
    }
    .share-copy {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        cursor: pointer;
    }
    .share-copy:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: translateY(-2px);
    }
    .share-print {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        cursor: pointer;
    }
    .share-print:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: translateY(-2px);
    }

    /* Related News / More Announcements Section */
    .related-news-section {
        max-width: 860px;
        margin: 50px auto 0;
        padding: 0 10px;
    }
    .related-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }
    .related-section-title {
        font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .related-see-all {
        font-size: 0.875rem;
        font-weight: 700;
        color: #059669;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }
    .related-see-all:hover {
        color: #047857;
        text-decoration: underline;
    }
    .related-news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    .related-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .related-card:hover {
        border-color: #059669;
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
    }
    .related-thumb-wrapper {
        width: 100%;
        aspect-ratio: 16/9;
        background: #f1f5f9;
        overflow: hidden;
    }
    .related-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .related-card:hover .related-thumb {
        transform: scale(1.05);
    }
    .related-content {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;
    }
    .related-meta-date {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }
    .related-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .related-read-link {
        font-size: 0.825rem;
        font-weight: 700;
        color: #059669;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Print Styles */
    @media print {
        body { background: white !important; color: black !important; }
        .breadcrumb-header, .back-news-btn, .byline-actions, .news-bottom-actions, .related-news-section, .header, .footer, .announcement-banner {
            display: none !important;
        }
        .news-sheet {
            box-shadow: none !important;
            border: none !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .news-sheet-body {
            padding: 0 !important;
        }
        .news-headline {
            font-size: 2rem !important;
            color: black !important;
        }
    }

    /* Responsive Breakdown */
    @media (max-width: 768px) {
        .news-sheet-body {
            padding: 28px 22px 34px;
        }
        .news-headline {
            font-size: 1.85rem;
        }
        .news-byline-bar {
            flex-direction: column;
            align-items: flex-start;
        }
        .byline-actions {
            width: 100%;
            justify-content: flex-start;
        }
        .news-body-content {
            font-size: 1.075rem;
            line-height: 1.78;
        }
        .gallery-container {
            padding-right: 0;
        }
        .main-gallery-viewport {
            aspect-ratio: 4/3;
        }
        .gallery-thumbnails-sidebar {
            position: relative;
            width: 100%;
            height: 70px;
            flex-direction: row;
            overflow-x: auto;
            overflow-y: hidden;
            margin-top: 10px;
        }
        .news-bottom-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .share-pill-group {
            width: 100%;
            justify-content: stretch;
        }
        .share-pill-btn {
            flex: 1;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="announcement-news-page">
    <!-- Breadcrumb Navigation Bar -->
    <div class="breadcrumb-header">
        <div class="container">
            <div class="breadcrumb-nav-wrapper">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <a href="{{ route('news.index') }}">News & Announcements</a>
                    <span class="separator">/</span>
                    <span class="current">{{ $announcement->title }}</span>
                </div>
                <a href="{{ route('news.index') }}" class="back-news-btn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to News
                </a>
            </div>
        </div>
    </div>

    <!-- Main Editorial News Sheet Container -->
    <div class="container" style="padding: 0 16px;">
        <article class="news-sheet">
            <!-- Top Brand Stripe -->
            <div class="news-sheet-stripe"></div>

            <div class="news-sheet-body">
                <!-- Kicker / Category Row -->
                <div class="news-kicker-row">
                    <span class="category-kicker" style="background: {{ $badgeBg }}; color: {{ $badgeText }}; border-color: {{ $badgeBorder }};">
                        @if(str_contains($categoryLower, 'advisory') || str_contains($categoryLower, 'memo'))
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        @elseif(str_contains($categoryLower, 'news') || str_contains($categoryLower, 'balita'))
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
                        @elseif(str_contains($categoryLower, 'event'))
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        @else
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                        @endif
                        {{ $categoryLabel }}
                    </span>

                    <span class="news-dateline-pill">
                        <span class="pulse-dot"></span>
                        Davao City, Philippines &bull; Official Bulletin
                    </span>
                </div>

                <!-- Headline / Ulo ng Balita -->
                <h1 class="news-headline">{{ $announcement->title }}</h1>

                <!-- Editorial Byline Bar -->
                <div class="news-byline-bar">
                    <div class="byline-author-group">
                        <img src="/logo.png" alt="AMIS Logo" class="byline-avatar">
                        <div class="byline-text-meta">
                            <span class="byline-author-name">
                                {{ $announcement->author ?: 'AMIS Administration' }}
                                <svg class="verified-icon" viewBox="0 0 20 20" fill="currentColor" title="Verified School Release">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="byline-subinfo">
                                <span>Published: {{ optional($announcement->publish_date ?? $announcement->created_at)->format('l, F j, Y') }}</span>
                                <span>&bull;</span>
                                <span>⏱️ {{ $readTime }} min read</span>
                            </span>
                        </div>
                    </div>

                    <div class="byline-actions">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->full()) }}" target="_blank" rel="noopener noreferrer" class="action-btn-sm" title="Share on Facebook">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Share
                        </a>
                        <button onclick="copyArticleUrl(this)" class="action-btn-sm" id="copyLinkBtn" title="Copy article link">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            Copy Link
                        </button>
                        <button onclick="window.print()" class="action-btn-sm" title="Print advisory">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            Print
                        </button>
                    </div>
                </div>

                <!-- Featured Media Gallery (if present) -->
                @php
                    $imgs = json_decode($announcement->image ?? '', true);
                    if (!is_array($imgs)) {
                        $imgs = $announcement->image ? [$announcement->image] : [];
                    }
                    $imgs = array_values(array_filter($imgs, function($img) {
                        return !empty($img) && !str_contains($img, 'coming-soon');
                    }));
                @endphp

                @if(!empty($imgs))
                    <div class="gallery-container" @if(count($imgs) <= 1) style="padding-right: 0;" @endif>
                        <div class="main-gallery-viewport group">
                            <div class="flex transition-transform duration-500 ease-out h-full" id="carouselSlides" style="width: {{ count($imgs) * 100 }}%;">
                                @foreach($imgs as $img)
                                    <div class="h-full flex items-center justify-center flex-shrink-0" style="width: calc(100% / {{ count($imgs) }});">
                                        <img src="{{ $img }}" alt="{{ $announcement->title }}" class="w-full h-full object-contain" loading="lazy">
                                    </div>
                                @endforeach
                            </div>

                            @if(count($imgs) > 1)
                                <button onclick="moveCarousel(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 hover:bg-white text-slate-800 flex items-center justify-center border border-slate-200 transition-all duration-200 opacity-0 group-hover:opacity-100 cursor-pointer z-10" aria-label="Previous slide">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button onclick="moveCarousel(1)" class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 hover:bg-white text-slate-800 flex items-center justify-center border border-slate-200 transition-all duration-200 opacity-0 group-hover:opacity-100 cursor-pointer z-10" aria-label="Next slide">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            @endif
                        </div>

                        @if(count($imgs) > 1)
                            <div class="gallery-thumbnails-sidebar">
                                @foreach($imgs as $index => $img)
                                    <button onclick="setCarouselSlide({{ $index }})" class="gallery-thumbnail-btn w-full aspect-[4/3] rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'active' : '' }} transition bg-slate-100 p-0 flex-shrink-0 cursor-pointer" data-index="{{ $index }}" aria-label="Thumbnail {{ $index + 1 }}">
                                        <img src="{{ $img }}" class="w-full h-full object-cover" loading="lazy">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Event Details Card (if applicable) -->
                @if($announcement->event_dates || $announcement->event_venue || $announcement->is_online)
                    <div class="event-info-box">
                        <div class="event-info-header">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            Key Event Details &amp; Schedule
                        </div>
                        <div class="event-info-grid">
                            @if($announcement->event_dates)
                                <div style="display: flex; align-items: start; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Event Date(s)</div>
                                        <div style="font-size: 0.95rem; font-weight: 600; color: #1e293b; margin-top: 2px;">{{ $announcement->event_dates }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($announcement->event_venue)
                                <div style="display: flex; align-items: start; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ $announcement->is_online ? 'Onsite Venue' : 'Venue / Location' }}</div>
                                        <div style="font-size: 0.95rem; font-weight: 600; color: #1e293b; margin-top: 2px;">{{ $announcement->event_venue }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($announcement->is_online)
                                <div style="display: flex; align-items: start; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Virtual / Online Modality</div>
                                        <div style="font-size: 0.95rem; font-weight: 700; color: #059669; margin-top: 2px;">{{ $announcement->event_venue ? 'Hybrid (Online via Microsoft Teams & Onsite)' : 'Online Class / Virtual Platform' }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Authentic News / Balita Body Content -->
                <div class="news-body-content">
                    {!! $processedContent !!}
                </div>

                <!-- Bottom Social Sharing & Navigation -->
                <div class="news-bottom-actions">
                    <div class="share-pill-group">
                        <span style="font-size: 0.825rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-right: 4px;">Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->full()) }}" target="_blank" rel="noopener noreferrer" class="share-pill-btn share-fb">
                            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                        <button onclick="copyArticleUrl(this)" class="share-pill-btn share-copy">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            Copy Link
                        </button>
                        <button onclick="window.print()" class="share-pill-btn share-print">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            Print
                        </button>
                    </div>

                    <a href="{{ route('news.index') }}" style="color: #059669; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                        View all news &rarr;
                    </a>
                </div>
            </div>
        </article>

        <!-- More News & Advisories Section -->
        @if(!empty($relatedAnnouncements) && count($relatedAnnouncements) > 0)
            <div class="related-news-section">
                <div class="related-section-header">
                    <h2 class="related-section-title">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
                        More News & Advisories
                    </h2>
                    <a href="{{ route('news.index') }}" class="related-see-all">
                        View All &rarr;
                    </a>
                </div>

                <div class="related-news-grid">
                    @foreach($relatedAnnouncements as $rel)
                        @php
                            $relImgs = json_decode($rel->image ?? '', true);
                            if (!is_array($relImgs)) {
                                $relImgs = $rel->image ? [$rel->image] : [];
                            }
                            $relValidImgs = array_values(array_filter($relImgs, function($i) {
                                return !empty($i) && !str_contains($i, 'coming-soon');
                            }));
                            $relThumb = !empty($relValidImgs) ? $relValidImgs[0] : '/hero1.png';
                            $relLink = route('announcement.show', $rel->uuid ?? $rel->id);
                        @endphp
                        <a href="{{ $relLink }}" class="related-card">
                            <div class="related-thumb-wrapper">
                                <img src="{{ $relThumb }}" alt="{{ $rel->title }}" class="related-thumb" loading="lazy">
                            </div>
                            <div class="related-content">
                                <div>
                                    <div class="related-meta-date">
                                        {{ optional($rel->publish_date ?? $rel->created_at)->format('M d, Y') }} &bull; {{ $rel->category ?: 'Advisory' }}
                                    </div>
                                    <h3 class="related-card-title">{{ $rel->title }}</h3>
                                </div>
                                <div class="related-read-link">
                                    Read Full Story &rarr;
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Copy Article URL to Clipboard with instant visual feedback
    function copyArticleUrl(buttonElement) {
        if (!navigator.clipboard) {
            const tempInput = document.createElement('input');
            tempInput.value = window.location.href;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            showCopiedFeedback(buttonElement);
            return;
        }

        navigator.clipboard.writeText(window.location.href).then(function() {
            showCopiedFeedback(buttonElement);
        }).catch(function(err) {
            console.error('Could not copy URL: ', err);
        });
    }

    function showCopiedFeedback(btn) {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Na-kopya!';
        btn.classList.add('btn-copied');
        setTimeout(function() {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-copied');
        }, 2200);
    }

    // Media Carousel Logic
    @if(!empty($imgs) && count($imgs) > 1)
        let currentSlideIndex = 0;
        const totalSlides = {{ count($imgs) }};
        let autoSlideInterval;
        
        function updateCarousel() {
            const slidesContainer = document.getElementById('carouselSlides');
            if (!slidesContainer) return;
            const offset = -currentSlideIndex * (100 / totalSlides);
            slidesContainer.style.transform = `translateX(${offset}%)`;
            
            // Update active state on thumbnail buttons
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
            }, 5000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCarousel();
            startAutoSlide();
        });
    @endif
</script>
@endsection
