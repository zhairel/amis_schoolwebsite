<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $staff->display_name }} | Official AMIS Verification</title>
    <meta name="description" content="Official credential verification for {{ $staff->full_name }}, {{ $staff->position }} at Al Munawwara Islamic School (AMIS).">
    
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $staff->display_name }} - {{ $staff->position }}">
    <meta property="og:description" content="Official AMIS Credential Verification.">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:url" content="{{ $verificationUrl }}">
    <meta property="og:type" content="profile">
    <link rel="canonical" href="{{ $verificationUrl }}">

    <!-- Google Fonts: Cinzel & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 48px 20px 64px;
            line-height: 1.5;
        }

        .verification-page {
            width: 100%;
            max-width: 880px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* AMIS Logo */
        .logo-wrap {
            margin-bottom: 18px;
        }

        .amis-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Titles & Status */
        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.01em;
            margin-bottom: 6px;
        }

        .verified-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #2e6930;
            margin-bottom: 6px;
        }

        .verified-status svg {
            width: 17px;
            height: 17px;
            fill: #2e6930;
        }

        .staff-summary {
            font-size: 14.5px;
            color: #64748b;
            margin-bottom: 36px;
        }

        .staff-summary strong {
            color: #334155;
            font-weight: 600;
        }

        /* [Original Calling Card] */
        .card-container {
            width: 100%;
            max-width: 850px;
            margin-bottom: 40px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            background: #ffffff;
            line-height: 0;
        }

        .card-container svg {
            width: 100%;
            height: auto;
            display: block;
        }

        /* [QR Code] Section */
        .qr-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 14px;
        }

        .qr-frame {
            width: 136px;
            height: 136px;
            padding: 8px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .qr-frame svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .qr-caption {
            font-size: 13px;
            color: #64748b;
        }

        /* Verification Reference ID */
        .reference-id {
            font-size: 13px;
            color: #64748b;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            margin-bottom: 24px;
        }

        .reference-id span {
            font-weight: 600;
            color: #1e293b;
        }

        /* Action Links / Buttons */
        .action-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border-radius: 6px;
            color: #2e6930;
            background: #f4f8f4;
            text-decoration: none;
            border: 1px solid #d7e6d8;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.15s ease;
        }

        .action-link:hover {
            background: #e8f2e9;
            color: #1e4d20;
            border-color: #bcd5bd;
        }

        .action-divider {
            color: #cbd5e1;
            font-size: 14px;
        }

        /* Toast popup */
        #toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #1e293b;
            color: #ffffff;
            padding: 9px 18px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transition: all 0.25s ease;
            pointer-events: none;
            z-index: 1000;
        }

        #toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        /* Print Stylesheet: prints strictly the 3.5in x 2.0in card */
        @media print {
            body {
                background: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .logo-wrap,
            .page-title,
            .verified-status,
            .staff-summary,
            .qr-section,
            .reference-id,
            .action-bar,
            #toast {
                display: none !important;
            }

            .verification-page {
                max-width: 100% !important;
                margin: 0 !important;
            }

            .card-container {
                box-shadow: none !important;
                border: 0.5pt solid #cccccc !important;
                border-radius: 0 !important;
                width: 3.5in !important;
                height: 2.0in !important;
                max-width: 3.5in !important;
                page-break-inside: avoid;
                margin: 0 auto !important;
            }

            .card-container svg {
                width: 3.5in !important;
                height: 2.0in !important;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 28px 14px 44px;
            }

            .amis-logo {
                width: 60px;
                height: 60px;
            }

            .page-title {
                font-size: 20px;
            }

            .staff-summary {
                font-size: 13.5px;
                margin-bottom: 24px;
            }

            .card-container {
                margin-bottom: 28px;
                border-radius: 8px;
            }
        }
    </style>
</head>
<body>

<div class="verification-page">
    <!-- AMIS Logo -->
    <div class="logo-wrap">
        <a href="https://amis.edu.ph" title="Al Munawwara Islamic School">
            <img src="/logo.png" alt="AMIS Logo" class="amis-logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
        </a>
    </div>

    <!-- Official AMIS Verification -->
    <h1 class="page-title">Official AMIS Verification</h1>

    <!-- Verified Status -->
    <div class="verified-status">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        <span>Verified</span>
    </div>

    <!-- Staff name and position -->
    <div class="staff-summary">
        <strong>{{ $staff->display_name }}</strong> &bull; {{ $staff->position }}
    </div>

    <!-- [Original Calling Card] -->
    <div class="card-container">
        {!! $cardSvg !!}
    </div>

    <!-- [QR Code] -->
    <div class="qr-section">
        <div class="qr-frame">
            {!! $qrSvg !!}
        </div>
        <p class="qr-caption">Scan to verify this AMIS official</p>
    </div>

    <!-- Verification ID -->
    <div class="reference-id">
        Verification ID: <span>AMIS-STAFF-{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</span>
    </div>

    <!-- Download QR | Print Card -->
    <div class="action-bar">
        <a href="{{ route('staff.verify.qr.download', ['slug' => $staff->slug, 'format' => 'png']) }}" class="action-link" title="Download Official QR Code">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
            Download QR
        </a>

        <span class="action-divider">|</span>

        <button type="button" onclick="window.print()" class="action-link" title="Print Calling Card">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Card
        </button>

        <span class="action-divider">|</span>

        <a href="{{ route('staff.verify.card.svg', ['slug' => $staff->slug, 'download' => 1]) }}" class="action-link" title="Download Vector SVG Calling Card">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
            Download SVG
        </a>
    </div>
</div>

<div id="toast"></div>

<script>
    function showToast(msg) {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }
</script>

</body>
</html>
