<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $staff->display_name }} | Verified AMIS Official</title>
    <meta name="description" content="Official credentials verification for {{ $staff->full_name }}, {{ $staff->position }} at Al Munawwara Islamic School (AMIS).">
    
    <!-- Open Graph / Social Meta -->
    <meta property="og:title" content="{{ $staff->display_name }} - {{ $staff->position }}">
    <meta property="og:description" content="Official Verified AMIS Official credentials at Al Munawwara Islamic School, Davao City.">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:url" content="{{ $verificationUrl }}">
    <meta property="og:type" content="profile">
    <link rel="canonical" href="{{ $verificationUrl }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --amis-dark: #022c22;
            --amis-primary: #064e3b;
            --amis-emerald: #059669;
            --amis-light-emerald: #10b981;
            --amis-gold: #d97706;
            --amis-gold-light: #fbbf24;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-600: #475569;
            --slate-400: #94a3b8;
            --slate-100: #f1f5f9;
            --slate-50: #f8fafc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(180deg, #022c22 0%, #064e3b 220px, #f1f5f9 220px, #f8fafc 100%);
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 24px 16px 40px;
        }

        .page-wrap {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }

        /* Top Bar Navigation */
        .top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 16px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
        }

        .top-nav a {
            color: #ffffff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.12);
            padding: 6px 12px;
            border-radius: 999px;
            backdrop-filter: blur(8px);
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .top-nav a:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-1px);
        }

        .top-nav .ssl-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            color: #6ee7b7;
            letter-spacing: 0.04em;
        }

        /* Main Card Container */
        .verification-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 45px -10px rgba(2, 44, 34, 0.25), 0 8px 20px -6px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(2, 44, 34, 0.08);
            overflow: hidden;
            position: relative;
        }

        /* Card Header */
        .card-header {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 60%, #065f46 100%);
            padding: 28px 20px 24px;
            text-align: center;
            position: relative;
            color: #ffffff;
            border-bottom: 2px solid #d97706;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 14px 14px;
            pointer-events: none;
            opacity: 0.7;
        }

        .school-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
            margin-bottom: 10px;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.25));
            border-radius: 50%;
            background: #ffffff;
            padding: 3px;
        }

        .school-arabic {
            font-family: 'Traditional Arabic', 'Scheherazade New', 'Amiri', serif;
            font-size: 18px;
            font-weight: 700;
            color: #fde68a;
            direction: rtl;
            unicode-bidi: embed;
            line-height: 1.4;
            letter-spacing: 0.02em;
        }

        .school-name {
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #ffffff;
            margin-top: 2px;
        }

        .school-subtext {
            font-size: 9.5px;
            font-weight: 700;
            color: #34d399;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-top: 3px;
        }

        .school-meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            padding: 4px 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            color: #e2e8f0;
            letter-spacing: 0.05em;
        }

        /* Card Body */
        .card-body {
            padding: 26px 22px 20px;
            text-align: center;
        }

        /* Verified Official Badge */
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1.5px solid #10b981;
            color: #065f46;
            padding: 7px 18px;
            border-radius: 999px;
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            margin-bottom: 20px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #059669;
            box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(5, 150, 105, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
            }
        }

        /* Profile Details */
        .profile-container {
            margin-bottom: 20px;
        }

        .profile-avatar-wrap {
            position: relative;
            width: 96px;
            height: 96px;
            margin: 0 auto 14px;
        }

        .profile-img, .profile-initials {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #065f46;
            box-shadow: 0 6px 16px rgba(2, 44, 34, 0.15);
        }

        .profile-initials {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            color: #fbbf24;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 0.05em;
        }

        .profile-verified-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 28px;
            height: 28px;
            background: #10b981;
            border: 2px solid #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .official-name {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--amis-dark);
            line-height: 1.25;
            margin-bottom: 4px;
        }

        .academic-credentials-badge {
            display: inline-block;
            background: #fef3c7;
            border: 1px solid #fde68a;
            color: #92400e;
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 800;
            padding: 3px 12px;
            border-radius: 6px;
            margin-bottom: 8px;
            letter-spacing: 0.04em;
        }

        .official-position {
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--amis-primary);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 2px;
        }

        .official-dept {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--slate-600);
            letter-spacing: 0.02em;
        }

        /* Information Grid */
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 20px;
            text-align: left;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 12px;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 2px;
        }

        .info-row:first-child {
            padding-top: 2px;
        }

        .info-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 2px;
            color: var(--amis-primary);
        }

        .info-content {
            flex: 1;
            min-width: 0;
        }

        .info-label {
            font-size: 9.5px;
            font-weight: 800;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.06em;
            margin-bottom: 2px;
        }

        .info-val {
            font-weight: 700;
            color: #0f172a;
            word-break: break-word;
            line-height: 1.35;
        }

        .info-val a {
            color: var(--amis-primary);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .info-val a:hover {
            color: var(--amis-emerald);
            text-decoration: underline;
        }

        /* Calling Card QR Section */
        .qr-section {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            border-radius: 18px;
            padding: 20px 16px;
            color: #ffffff;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 8px 24px -4px rgba(2, 44, 34, 0.3);
        }

        .qr-header-title {
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #a7f3d0;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .qr-box {
            background: #ffffff;
            width: 160px;
            height: 160px;
            margin: 0 auto;
            border-radius: 14px;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
            border: 2px solid #fbbf24;
        }

        .qr-box svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .scan-caption {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
            padding: 4px 14px;
            border-radius: 999px;
            font-family: 'Outfit', sans-serif;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #ffffff;
        }

        .url-box {
            margin-top: 12px;
            background: rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            color: #d1fae5;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .url-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding-right: 8px;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.18);
            border: none;
            color: #ffffff;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* QR Code Download Toolbox */
        .download-tools {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 20px;
            text-align: left;
        }

        .tools-title {
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--amis-dark);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tools-sub {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .download-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .dl-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 10px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            border: none;
        }

        .dl-btn-primary {
            background: var(--amis-primary);
            color: #ffffff;
        }

        .dl-btn-primary:hover {
            background: var(--amis-dark);
            box-shadow: 0 4px 10px rgba(2, 44, 34, 0.2);
        }

        .dl-btn-secondary {
            background: #f1f5f9;
            color: var(--slate-800);
            border: 1px solid #cbd5e1;
        }

        .dl-btn-secondary:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .dl-btn-gold {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            grid-column: span 2;
        }

        .dl-btn-gold:hover {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        }

        /* Card Footer */
        .card-footer {
            border-top: 1px solid #e2e8f0;
            padding: 16px 20px;
            background: #f8fafc;
            text-align: center;
        }

        .footer-disclaimer {
            font-size: 10.5px;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .footer-brand {
            font-family: 'Outfit', sans-serif;
            font-size: 11px;
            font-weight: 800;
            color: var(--amis-primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .footer-brand:hover {
            color: var(--amis-dark);
            text-decoration: underline;
        }

        /* Toast notification */
        #toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #0f172a;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
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

        @media (max-width: 480px) {
            body {
                padding: 16px 12px 30px;
            }
            .card-body {
                padding: 22px 16px 16px;
            }
            .official-name {
                font-size: 20px;
            }
            .download-grid {
                grid-template-columns: 1fr;
            }
            .dl-btn-gold {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="page-wrap">
    <!-- Top Bar Navigation -->
    <div class="top-nav">
        <a href="https://amis.edu.ph" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            amis.edu.ph
        </a>
        <div class="ssl-tag">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            OFFICIAL & ENCRYPTED
        </div>
    </div>

    <!-- Main Verification Card -->
    <div class="verification-card">
        <!-- Card Header -->
        <div class="card-header">
            <img class="school-logo" src="/logo.png" alt="AMIS Logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
            <div class="school-arabic">المدرسة المنورة الإسلامية</div>
            <div class="school-name">AL MUNAWWARA ISLAMIC SCHOOL</div>
            <div class="school-subtext">Official Staff Verification System</div>
            <div class="school-meta-pill">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                DepEd School ID: 466150
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Green Verified AMIS Official Badge -->
            <div>
                <div class="verified-badge">
                    <span class="pulse-dot"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    {{ $staff->badge_title ?? 'Verified AMIS Official' }}
                </div>
            </div>

            <!-- Profile Overview -->
            <div class="profile-container">
                <div class="profile-avatar-wrap">
                    @if($staff->photo_url)
                        <img src="{{ $staff->photo_url }}" alt="{{ $staff->full_name }}" class="profile-img">
                    @else
                        <div class="profile-initials">
                            {{ substr($staff->full_name, 0, 1) }}
                        </div>
                    @endif
                    <div class="profile-verified-icon" title="Authenticity Confirmed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                </div>

                <h1 class="official-name">{{ $staff->full_name }}</h1>

                @if($staff->academic_title)
                    <div class="academic-credentials-badge">
                        {{ $staff->academic_title }}
                    </div>
                @endif

                <div class="official-position">{{ $staff->position }}</div>

                @if($staff->department)
                    <div class="official-dept">{{ $staff->department }}</div>
                @endif
            </div>

            <!-- Credentials / Contact Details -->
            <div class="info-card">
                <div class="info-row">
                    <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <div class="info-content">
                        <div class="info-label">Verification Status</div>
                        <div class="info-val" style="color: #059669; display: flex; align-items: center; gap: 6px;">
                            Active &amp; Officially Verified
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <div class="info-content">
                        <div class="info-label">Official AMIS Email</div>
                        <div class="info-val">
                            <a href="mailto:{{ $staff->official_email }}">{{ $staff->official_email }}</a>
                        </div>
                    </div>
                </div>

                @if($staff->phone_number)
                <div class="info-row">
                    <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <div class="info-content">
                        <div class="info-label">Official Contact</div>
                        <div class="info-val">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $staff->phone_number) }}">{{ $staff->phone_number }}</a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="info-row">
                    <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <div class="info-content">
                        <div class="info-label">Institution &amp; Address</div>
                        <div class="info-val">
                            {{ $staff->office_address ?? 'Don Julian Rodriguez Sr. Avenue, Ma-A, Davao City, 8,000, Philippines' }}
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    <div class="info-content">
                        <div class="info-label">Official Portal</div>
                        <div class="info-val">
                            <a href="{{ $staff->official_website ?? 'https://amis.edu.ph' }}" target="_blank" rel="noopener">
                                {{ str_replace(['https://', 'http://'], '', $staff->official_website ?? 'amis.edu.ph') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calling Card QR Code Section -->
            <div class="qr-section">
                <div class="qr-header-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
                    Official Calling Card QR Code
                </div>

                <div class="qr-box" id="qrContainer">
                    {!! $qrSvg !!}
                </div>

                <div>
                    <span class="scan-caption">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="22" y1="12" x2="18" y2="12"/><line x1="6" y1="12" x2="2" y2="12"/><line x1="12" y1="6" x2="12" y2="2"/><line x1="12" y1="22" x2="12" y2="18"/></svg>
                        Scan to Verify
                    </span>
                </div>

                <div class="url-box">
                    <span class="url-text" id="urlText">{{ $verificationUrl }}</span>
                    <button class="copy-btn" onclick="copyVerificationLink()">
                        Copy Link
                    </button>
                </div>
            </div>

            <!-- Download Options for Calling Card Printing -->
            <div class="download-tools">
                <div class="tools-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Calling Card Print Assets
                </div>
                <div class="tools-sub">
                    Download this official QR code in high-resolution PNG (300 DPI) or infinite vector SVG with transparent or white background for printing on physical calling cards:
                </div>

                <div class="download-grid">
                    <!-- Vector SVG White -->
                    <button type="button" class="dl-btn dl-btn-primary" onclick="downloadClientSvg('white')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        SVG (White BG)
                    </button>

                    <!-- Vector SVG Transparent -->
                    <button type="button" class="dl-btn dl-btn-primary" onclick="downloadClientSvg('transparent')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        SVG (Transparent)
                    </button>

                    <!-- High-Res PNG White -->
                    <button type="button" class="dl-btn dl-btn-secondary" onclick="downloadHighResPng('white')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        PNG (White BG)
                    </button>

                    <!-- High-Res PNG Transparent -->
                    <button type="button" class="dl-btn dl-btn-secondary" onclick="downloadHighResPng('transparent')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        PNG (Transparent)
                    </button>

                    <!-- Calling Card Printable Layout -->
                    <a href="{{ route('staff.verify.card', ['slug' => $staff->slug]) }}" target="_blank" class="dl-btn dl-btn-gold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        Preview &amp; Print Calling Card Badge
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer">
            <p class="footer-disclaimer">
                This verification page is served directly from the official domain <strong>amis.edu.ph</strong> and confirms the authentic accreditation and leadership status of {{ $staff->full_name }}.
            </p>
            <a href="https://amis.edu.ph" class="footer-brand">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                Al Munawwara Islamic School &bull; amis.edu.ph
            </a>
        </div>
    </div>
</div>

<!-- Hidden Canvas for High-Resolution PNG export -->
<canvas id="renderCanvas" width="1500" height="1500"></canvas>

<!-- Toast notification element -->
<div id="toast">Link copied to clipboard!</div>

<script>
    const verificationUrl = @json($verificationUrl);
    const staffSlug = @json($staff->slug);
    const svgWhiteRaw = @json($qrSvg);
    const svgTransRaw = @json($qrSvgTransparent);

    function showToast(text) {
        const toast = document.getElementById('toast');
        toast.textContent = text;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function copyVerificationLink() {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(verificationUrl).then(() => {
                showToast('Verification URL copied to clipboard!');
            }).catch(() => fallbackCopy());
        } else {
            fallbackCopy();
        }
    }

    function fallbackCopy() {
        const temp = document.createElement('input');
        temp.value = verificationUrl;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        showToast('Verification URL copied to clipboard!');
    }

    // Direct Vector SVG download
    function downloadClientSvg(bg) {
        const content = bg === 'transparent' ? svgTransRaw : svgWhiteRaw;
        const blob = new Blob([content], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'AMIS-QR-' + staffSlug + '-' + bg + '.svg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
        showToast('SVG QR Code (' + bg + ') downloaded!');
    }

    // High-Resolution 1500x1500px 300DPI PNG download
    function downloadHighResPng(bg) {
        const canvas = document.getElementById('renderCanvas');
        const ctx = canvas.getContext('2d');
        const size = 1500;
        canvas.width = size;
        canvas.height = size;

        ctx.clearRect(0, 0, size, size);

        if (bg === 'white') {
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, size, size);
        }

        const svgData = bg === 'transparent' ? svgTransRaw : svgWhiteRaw;
        const img = new Image();
        const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(svgBlob);

        img.onload = function() {
            ctx.drawImage(img, 0, 0, size, size);
            URL.revokeObjectURL(url);

            canvas.toBlob(function(blob) {
                const pngUrl = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = pngUrl;
                link.download = 'AMIS-QR-' + staffSlug + '-' + bg + '-300dpi.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(pngUrl);
                showToast('High-Res PNG QR (' + bg + ') downloaded!');
            }, 'image/png');
        };

        img.onerror = function() {
            // Fallback to server endpoint if canvas drawing fails
            window.location.href = '/verify/' + staffSlug + '/qr/download?format=png&bg=' + bg;
        };

        img.src = url;
    }
</script>

</body>
</html>
