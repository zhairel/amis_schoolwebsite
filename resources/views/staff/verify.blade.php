<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $staff->display_name }} | Official Verified AMIS Calling Card</title>
    <meta name="description" content="Official AMIS digital calling card and credential verification for {{ $staff->full_name }}, {{ $staff->position }} at Al Munawwara Islamic School (AMIS), Davao City.">
    
    <!-- Open Graph / Social Meta -->
    <meta property="og:title" content="{{ $staff->display_name }} - {{ $staff->position }}">
    <meta property="og:description" content="Official Verified AMIS Calling Card and credentials at Al Munawwara Islamic School, Davao City.">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:url" content="{{ $verificationUrl }}">
    <meta property="og:type" content="profile">
    <link rel="canonical" href="{{ $verificationUrl }}">

    <!-- Google Fonts: Cinzel for Classical Roman Caps, Outfit & Inter for UI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --amis-dark: #022417;
            --amis-deep: #043622;
            --amis-forest: #064e3b;
            --amis-emerald: #059669;
            --amis-light-emerald: #10b981;
            --amis-gold: #d97706;
            --amis-gold-light: #fbbf24;
            --card-width: 820px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: radial-gradient(circle at 50% 10%, #083321 0%, #031c12 55%, #02120b 100%);
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px 48px;
        }

        .container {
            width: 100%;
            max-width: 860px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Top Navigation Header */
        .header-nav {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding: 8px 4px;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.08);
            padding: 7px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.2s ease;
        }

        .brand-link:hover {
            background: rgba(255, 255, 255, 0.16);
            transform: translateY(-1px);
        }

        .brand-logo {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #ffffff;
            padding: 1px;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.18) 0%, rgba(5, 150, 105, 0.28) 100%);
            border: 1px solid rgba(52, 211, 153, 0.5);
            color: #6ee7b7;
            padding: 6px 14px;
            border-radius: 999px;
            font-family: 'Outfit', sans-serif;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.25);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Title Area */
        .header-title-block {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title-block h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }

        .header-title-block p {
            font-size: 12.5px;
            color: #94a3b8;
            letter-spacing: 0.02em;
        }

        /* Card View Selector Tabs */
        .card-tabs {
            display: inline-flex;
            background: rgba(0, 0, 0, 0.35);
            padding: 4px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 18px;
            gap: 4px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .tab-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
        }

        .tab-btn.active {
            background: var(--amis-forest);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        /* The SVG Card Stage */
        .card-stage {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 22px;
            perspective: 1000px;
        }

        .svg-card-wrapper {
            width: 100%;
            max-width: var(--card-width);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 10px 25px -5px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: #ffffff;
            line-height: 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .svg-card-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 70px -15px rgba(0, 0, 0, 0.8), 0 12px 30px -5px rgba(0, 0, 0, 0.5);
        }

        .svg-card-wrapper svg {
            width: 100%;
            height: auto;
            display: block;
        }

        .card-view {
            display: none;
            width: 100%;
        }

        .card-view.active {
            display: block;
        }

        /* Action Toolbar */
        .toolbar {
            width: 100%;
            max-width: var(--card-width);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin-bottom: 24px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            text-align: center;
            font-family: 'Outfit', sans-serif;
        }

        .btn-svg {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .btn-svg:hover {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transform: translateY(-1px);
        }

        .btn-png {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .btn-png:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-1px);
        }

        .btn-print {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        }

        .btn-print:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
            color: #022417;
            transform: translateY(-1px);
        }

        .btn-copy {
            background: rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .btn-copy:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* Quick Contact Bar */
        .contact-strip {
            width: 100%;
            max-width: var(--card-width);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 16px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .contact-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .contact-item:hover {
            color: #34d399;
        }

        .contact-item svg {
            color: #10b981;
            flex-shrink: 0;
        }

        /* Registry Verification Details Box */
        .details-box {
            width: 100%;
            max-width: var(--card-width);
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 18px 24px;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .details-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .details-title {
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #a7f3d0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px 24px;
        }

        .detail-item-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
        }

        .detail-item-val {
            font-weight: 600;
            color: #f1f5f9;
        }

        /* Toast notification */
        #toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #0f172a;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.15);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
            pointer-events: none;
        }

        #toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        /* Hidden canvas for client-side high-res 300DPI PNG rendering */
        #renderCanvas {
            display: none;
        }

        /* PRINT STYLESHEET: Print ONLY the calling card at exact standard size */
        @media print {
            body {
                background: none !important;
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .header-nav,
            .header-title-block,
            .card-tabs,
            .toolbar,
            .contact-strip,
            .details-box,
            #toast {
                display: none !important;
            }

            .container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .card-stage {
                margin: 0 !important;
                padding: 0 !important;
            }

            .svg-card-wrapper {
                box-shadow: none !important;
                border: 0.5pt solid #cccccc !important;
                border-radius: 0 !important;
                width: 3.5in !important;
                height: 2.0in !important;
                max-width: 3.5in !important;
                page-break-inside: avoid;
            }

            .svg-card-wrapper svg {
                width: 3.5in !important;
                height: 2.0in !important;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 16px 12px 36px;
            }

            .header-nav {
                margin-bottom: 16px;
            }

            .header-title-block h1 {
                font-size: 18px;
            }

            .toolbar {
                grid-template-columns: 1fr 1fr;
            }

            .card-tabs {
                width: 100%;
                justify-content: center;
            }

            .tab-btn {
                padding: 6px 10px;
                font-size: 11px;
            }

            .contact-strip {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Navigation Header -->
    <div class="header-nav">
        <a href="https://amis.edu.ph" class="brand-link" target="_blank" rel="noopener">
            <img src="/logo.png" alt="AMIS" class="brand-logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
            <span>amis.edu.ph</span>
        </a>

        <div class="verified-badge">
            <span class="pulse-dot"></span>
            <span>VERIFIED AMIS OFFICIAL</span>
        </div>
    </div>

    <!-- Title Area -->
    <div class="header-title-block">
        <h1>Official AMIS Calling Card Verification</h1>
        <p>Al Munawwara Islamic School &bull; DepEd School ID: 466150 &bull; Davao City, Philippines</p>
    </div>

    <!-- Card View Selector Tabs -->
    <div class="card-tabs">
        <button type="button" class="tab-btn active" onclick="switchCard('front')">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
            Official Calling Card
        </button>
        <button type="button" class="tab-btn" onclick="switchCard('qr')">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
            Card with QR Code
        </button>
        <button type="button" class="tab-btn" onclick="switchCard('back')">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
            Back of Card
        </button>
    </div>

    <!-- THE CENTERPIECE: Vector SVG Calling Card Stage -->
    <div class="card-stage">
        <div class="svg-card-wrapper" id="cardWrapper">
            <!-- 1. Standard Front Calling Card (Matching original uploaded card 1:1) -->
            <div id="view-front" class="card-view active">
                {!! $cardSvg !!}
            </div>

            <!-- 2. Front Card with Integrated QR Code Stamp -->
            <div id="view-qr" class="card-view">
                {!! $cardQrSvg !!}
            </div>

            <!-- 3. Reverse Side / Back of Card with Centered QR Code & DepEd Credentials -->
            <div id="view-back" class="card-view">
                {!! $cardBackSvg !!}
            </div>
        </div>
    </div>

    <!-- Action Toolbar -->
    <div class="toolbar">
        <a href="{{ route('staff.verify.card.svg', ['slug' => $staff->slug, 'download' => 1]) }}" id="downloadSvgBtn" class="btn-action btn-svg" title="Download Vector SVG Calling Card">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
            Download SVG
        </a>

        <button type="button" onclick="downloadHighResPng()" class="btn-action btn-png" title="Download High-Resolution 300 DPI PNG Card">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            Download PNG (300 DPI)
        </button>

        <button type="button" onclick="window.print()" class="btn-action btn-print" title="Print Standard 3.5in x 2in Calling Card">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Card
        </button>

        <button type="button" onclick="copyVerificationLink()" class="btn-action btn-copy" title="Copy Official Verification URL">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
            Copy URL
        </button>
    </div>

    <!-- Quick Contact Strip -->
    <div class="contact-strip">
        @if($staff->phone_number)
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $staff->phone_number) }}" class="contact-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span>{{ $staff->phone_number }}</span>
            </a>
        @endif

        <a href="mailto:{{ $staff->official_email }}" class="contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            <span>{{ $staff->official_email }}</span>
        </a>

        <a href="{{ $staff->official_website ?? 'https://amis.edu.ph' }}" target="_blank" rel="noopener" class="contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            <span>amis.edu.ph</span>
        </a>
    </div>

    <!-- Official Registry Details Box -->
    <div class="details-box">
        <div class="details-header">
            <div class="details-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                DepEd Official Registry Record
            </div>
            <div style="color: #10b981; font-weight: 700; font-size: 11px;">&#10004; Active &amp; Authenticated</div>
        </div>

        <div class="details-grid">
            <div>
                <div class="detail-item-label">Staff Member</div>
                <div class="detail-item-val">{{ $staff->full_name }} {{ $staff->academic_title ? '('.$staff->academic_title.')' : '' }}</div>
            </div>
            <div>
                <div class="detail-item-label">Position &amp; Role</div>
                <div class="detail-item-val">{{ $staff->position }}</div>
            </div>
            <div>
                <div class="detail-item-label">Institution</div>
                <div class="detail-item-val">Al Munawwara Islamic School (AMIS)</div>
            </div>
            <div>
                <div class="detail-item-label">DepEd School ID</div>
                <div class="detail-item-val">466150</div>
            </div>
            <div>
                <div class="detail-item-label">Verification Reference</div>
                <div class="detail-item-val" style="font-family: ui-monospace, monospace;">AMIS-STAFF-{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div>
                <div class="detail-item-label">Official Address</div>
                <div class="detail-item-val">{{ $staff->office_address ?? 'Don Julian Rodriguez Sr. Avenue, Ma-A, Davao City, 8,000, Philippines' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Toast notification popup -->
<div id="toast">Copied to clipboard!</div>

<!-- Hidden Canvas for Client-Side High-Res 300DPI Rendering -->
<canvas id="renderCanvas"></canvas>

<script>
    let currentSide = 'front';
    const slug = "{{ $staff->slug }}";

    function switchCard(side) {
        currentSide = side;
        
        // Update tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        if (event && event.currentTarget) {
            event.currentTarget.classList.add('active');
        }

        // Update card views
        document.querySelectorAll('.card-view').forEach(view => view.classList.remove('active'));
        const activeView = document.getElementById('view-' + side);
        if (activeView) {
            activeView.classList.add('active');
        }

        // Update download SVG link
        const dlBtn = document.getElementById('downloadSvgBtn');
        if (dlBtn) {
            let url = "{{ route('staff.verify.card.svg', ['slug' => $staff->slug]) }}?download=1";
            if (side === 'qr') url += '&qr=1';
            if (side === 'back') url += '&side=back';
            dlBtn.href = url;
        }
    }

    function showToast(msg) {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function copyVerificationLink() {
        const url = "{{ $verificationUrl }}";
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url).then(() => {
                showToast("Verification URL copied to clipboard!");
            }).catch(() => fallbackCopy(url));
        } else {
            fallbackCopy(url);
        }
    }

    function fallbackCopy(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand('copy');
            showToast("Verification URL copied!");
        } catch (e) {
            prompt("Copy verification URL:", text);
        }
        document.body.removeChild(textarea);
    }

    // High-resolution 300 DPI PNG download
    function downloadHighResPng() {
        showToast("Generating 300 DPI high-resolution PNG...");
        
        const activeView = document.getElementById('view-' + currentSide);
        const svgEl = activeView.querySelector('svg');
        if (!svgEl) return;

        const svgData = new XMLSerializer().serializeToString(svgEl);
        const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(svgBlob);

        const img = new Image();
        img.onload = function() {
            // 3.5" x 2.0" at 300 DPI = 1050 x 600 (we use 3x 1024x585 = 3072 x 1755 for ultra-crisp print quality)
            const canvas = document.getElementById('renderCanvas');
            const targetWidth = 3072;
            const targetHeight = 1755;
            canvas.width = targetWidth;
            canvas.height = targetHeight;
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, targetWidth, targetHeight);
            ctx.drawImage(img, 0, 0, targetWidth, targetHeight);

            URL.revokeObjectURL(url);

            const pngUrl = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            a.download = `AMIS-CallingCard-${slug}-${currentSide}-300DPI.png`;
            a.href = pngUrl;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            showToast("Calling card PNG downloaded!");
        };
        img.src = url;
    }
</script>

</body>
</html>
