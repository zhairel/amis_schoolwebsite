<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calling Card &bull; {{ $staff->display_name }} | AMIS</title>

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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            min-height: 100vh;
            padding: 40px 20px 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 880px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .logo-wrap {
            margin-bottom: 16px;
        }

        .amis-logo {
            width: 68px;
            height: 68px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .page-sub {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 28px;
        }

        .card-preview {
            width: 100%;
            max-width: 850px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            background: #ffffff;
            line-height: 0;
            margin-bottom: 32px;
        }

        .card-preview svg {
            width: 100%;
            height: auto;
            display: block;
        }

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

        @media print {
            body {
                background: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .logo-wrap,
            .page-title,
            .page-sub,
            .action-bar {
                display: none !important;
            }

            .container {
                max-width: 100% !important;
                margin: 0 !important;
            }

            .card-preview {
                box-shadow: none !important;
                border: 0.5pt solid #cccccc !important;
                border-radius: 0 !important;
                width: 3.5in !important;
                height: 2.0in !important;
                max-width: 3.5in !important;
                margin: 0 auto !important;
            }

            .card-preview svg {
                width: 3.5in !important;
                height: 2.0in !important;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo-wrap">
        <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}">
            <img src="/logo.png" alt="AMIS Logo" class="amis-logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
        </a>
    </div>

    <h1 class="page-title">{{ $staff->display_name }}</h1>
    <p class="page-sub">{{ $staff->position }} &bull; Official AMIS Calling Card</p>

    <div class="card-preview">
        {!! $cardSvg !!}
    </div>

    <div class="action-bar">
        <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}" class="action-link">
            &larr; Back to Verification
        </a>

        <span class="action-divider">|</span>

        <button type="button" onclick="window.print()" class="action-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Card
        </button>

        <span class="action-divider">|</span>

        <a href="{{ route('staff.verify.card.svg', ['slug' => $staff->slug, 'download' => 1]) }}" class="action-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
            Download SVG
        </a>
    </div>
</div>

</body>
</html>
