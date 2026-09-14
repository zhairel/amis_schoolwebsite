<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calling Card Mockup &bull; {{ $staff->display_name }} | AMIS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --amis-dark: #022c22;
            --amis-primary: #064e3b;
            --amis-emerald: #059669;
            --amis-gold: #d97706;
            --amis-gold-light: #fbbf24;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #1e293b;
            min-height: 100vh;
            padding: 30px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-bar {
            width: 100%;
            max-width: 800px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            color: #ffffff;
        }

        .header-title {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 800;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-print {
            background: #10b981;
            color: #ffffff;
        }

        .btn-print:hover {
            background: #059669;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .cards-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: center;
        }

        /* Calling Card standard ratio 3.5in x 2in (approx 525px x 300px) */
        .card-preview {
            width: 525px;
            height: 300px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            background: #ffffff;
            display: flex;
        }

        /* Front of card */
        .card-front {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            color: #ffffff;
            padding: 24px 28px;
            flex-direction: column;
            justify-content: space-between;
            border: 2px solid #fbbf24;
        }

        .card-front-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .front-logo-block {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .front-logo {
            width: 52px;
            height: 52px;
            background: #ffffff;
            border-radius: 50%;
            padding: 2px;
        }

        .front-school-text {
            font-family: 'Outfit', sans-serif;
        }

        .front-arabic {
            font-size: 14px;
            color: #fbbf24;
            direction: rtl;
        }

        .front-school-name {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .front-school-sub {
            font-size: 8px;
            color: #a7f3d0;
            letter-spacing: 0.05em;
        }

        .card-front-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .front-person-info {
            flex: 1;
        }

        .front-name {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
        }

        .front-title-badge {
            display: inline-block;
            background: #fbbf24;
            color: #022c22;
            font-size: 9px;
            font-weight: 800;
            padding: 1px 6px;
            border-radius: 4px;
            margin-top: 3px;
        }

        .front-position {
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: #34d399;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-top: 4px;
        }

        .front-contact-list {
            margin-top: 8px;
            font-size: 9.5px;
            color: #e2e8f0;
            line-height: 1.5;
        }

        /* Front QR Section */
        .front-qr-box {
            text-align: center;
            background: #ffffff;
            padding: 6px;
            border-radius: 8px;
            border: 1.5px solid #fbbf24;
            width: 104px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .front-qr-box svg {
            width: 90px;
            height: 90px;
            display: block;
        }

        .front-qr-caption {
            font-family: 'Outfit', sans-serif;
            font-size: 7.5px;
            font-weight: 800;
            text-transform: uppercase;
            color: #022c22;
            margin-top: 4px;
            letter-spacing: 0.05em;
        }

        .card-label {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
            text-align: center;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }
            .header-bar {
                display: none;
            }
            .card-preview {
                box-shadow: none;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

<div class="header-bar">
    <div>
        <div class="header-title">Official Calling Card Preview &amp; Print</div>
        <div style="font-size: 12px; color: #94a3b8;">Standard Business Card (3.5" &times; 2.0" &bull; 88.9 &times; 50.8 mm)</div>
    </div>
    <div class="action-btns">
        <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}" class="btn btn-back">
            &larr; Back to Verification
        </a>
        <button onclick="window.print()" class="btn btn-print">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Card
        </button>
    </div>
</div>

<div class="cards-container">
    <div>
        <div class="card-label">Calling Card Face with Verification QR Code</div>
        <div class="card-preview card-front">
            <div class="card-front-top">
                <div class="front-logo-block">
                    <img src="/logo.png" alt="AMIS" class="front-logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
                    <div class="front-school-text">
                        <div class="front-arabic">المدرسة المنورة الإسلامية</div>
                        <div class="front-school-name">AL MUNAWWARA ISLAMIC SCHOOL</div>
                        <div class="front-school-sub">DepEd School ID: 466150 &bull; Davao City, Philippines</div>
                    </div>
                </div>
            </div>

            <div class="card-front-bottom">
                <div class="front-person-info">
                    <div class="front-name">{{ $staff->full_name }}</div>
                    @if($staff->academic_title)
                        <span class="front-title-badge">{{ $staff->academic_title }}</span>
                    @endif
                    <div class="front-position">{{ $staff->position }}</div>

                    <div class="front-contact-list">
                        <div>&bull; {{ $staff->official_email }}</div>
                        @if($staff->phone_number)
                            <div>&bull; {{ $staff->phone_number }}</div>
                        @endif
                        <div>&bull; https://amis.edu.ph</div>
                    </div>
                </div>

                <div class="front-qr-box">
                    {!! $qrSvg !!}
                    <div class="front-qr-caption">Scan to Verify</div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
