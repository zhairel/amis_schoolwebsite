<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calling Card &bull; {{ $staff->display_name }} | AMIS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0b1712;
            color: #e2e8f0;
            min-height: 100vh;
            padding: 24px 16px 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-bar {
            width: 100%;
            max-width: 860px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .header-title {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 800;
            color: #ffffff;
        }

        .header-sub {
            font-size: 12px;
            color: #94a3b8;
        }

        .action-btns {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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
            font-family: 'Outfit', sans-serif;
            transition: all 0.2s;
        }

        .btn-print {
            background: #10b981;
            color: #ffffff;
        }

        .btn-print:hover {
            background: #059669;
        }

        .btn-svg {
            background: #064e3b;
            color: #ffffff;
            border: 1px solid #10b981;
        }

        .btn-svg:hover {
            background: #022c22;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .cards-container {
            width: 100%;
            max-width: 860px;
            display: flex;
            flex-direction: column;
            gap: 36px;
            align-items: center;
        }

        .card-block {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-label {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .card-preview {
            width: 100%;
            max-width: 820px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: #ffffff;
            line-height: 0;
        }

        .card-preview svg {
            width: 100%;
            height: auto;
            display: block;
        }

        @media print {
            body {
                background: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .header-bar,
            .card-label {
                display: none !important;
            }

            .cards-container {
                gap: 0 !important;
            }

            .card-block {
                page-break-after: always;
                margin: 0 !important;
                padding: 0 !important;
            }

            .card-preview {
                box-shadow: none !important;
                border: 0.5pt solid #dddddd !important;
                border-radius: 0 !important;
                width: 3.5in !important;
                height: 2.0in !important;
                max-width: 3.5in !important;
            }

            .card-preview svg {
                width: 3.5in !important;
                height: 2.0in !important;
            }
        }
    </style>
</head>
<body>

<div class="header-bar">
    <div>
        <div class="header-title">{{ $staff->display_name }} &bull; AMIS Official Calling Card</div>
        <div class="header-sub">Standard Business Card &bull; 3.5" &times; 2.0" (88.9 &times; 50.8 mm) &bull; Vector SVG</div>
    </div>
    <div class="action-btns">
        <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}" class="btn btn-back">
            &larr; Verification View
        </a>
        <a href="{{ route('staff.verify.card.svg', ['slug' => $staff->slug, 'download' => 1]) }}" class="btn btn-svg">
            Download SVG
        </a>
        <button onclick="window.print()" class="btn btn-print">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Card (3.5" &times; 2")
        </button>
    </div>
</div>

<div class="cards-container">
    <!-- Front: Pure Calling Card -->
    <div class="card-block">
        <div class="card-label">Official Calling Card (Front Side)</div>
        <div class="card-preview">
            {!! $cardSvg !!}
        </div>
    </div>

    <!-- Front: Calling Card with Integrated QR Code -->
    <div class="card-block">
        <div class="card-label">Calling Card with Verification QR Code</div>
        <div class="card-preview">
            {!! $cardQrSvg !!}
        </div>
    </div>

    <!-- Back: Official reverse side with QR and credentials -->
    <div class="card-block">
        <div class="card-label">Official Calling Card (Reverse / Back Side)</div>
        <div class="card-preview">
            {!! $cardBackSvg !!}
        </div>
    </div>
</div>

</body>
</html>
