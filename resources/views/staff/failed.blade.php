<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification Failed | AMIS Official Registry</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --amis-dark: #022c22;
            --amis-primary: #064e3b;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-600: #475569;
            --crimson: #dc2626;
            --crimson-light: #fee2e2;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(180deg, #450a0a 0%, #7f1d1d 220px, #f1f5f9 220px, #f8fafc 100%);
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
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 45px -10px rgba(127, 29, 29, 0.25), 0 8px 20px -6px rgba(0, 0, 0, 0.08);
            border: 1px solid #fecaca;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #450a0a 0%, #7f1d1d 100%);
            padding: 28px 20px 24px;
            text-align: center;
            color: #ffffff;
            border-bottom: 2px solid #ef4444;
        }

        .school-logo {
            width: 68px;
            height: 68px;
            object-fit: contain;
            margin-bottom: 10px;
            border-radius: 50%;
            background: #ffffff;
            padding: 3px;
        }

        .school-name {
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .school-subtext {
            font-size: 9.5px;
            font-weight: 700;
            color: #fca5a5;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 3px;
        }

        .card-body {
            padding: 30px 22px 24px;
            text-align: center;
        }

        .fail-icon-wrap {
            width: 72px;
            height: 72px;
            background: var(--crimson-light);
            border: 2px solid #fca5a5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--crimson);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fef2f2;
            border: 1.5px solid #f87171;
            color: #991b1b;
            padding: 6px 16px;
            border-radius: 999px;
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 14px;
        }

        .fail-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #991b1b;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .fail-desc {
            font-size: 13px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .fail-slug-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 10px 14px;
            border-radius: 10px;
            font-family: ui-monospace, monospace;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 20px;
            word-break: break-all;
        }

        .notice-box {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 12px;
            padding: 14px;
            text-align: left;
            margin-bottom: 24px;
            font-size: 12px;
            color: #92400e;
            line-height: 1.5;
        }

        .notice-box strong {
            display: block;
            margin-bottom: 4px;
            font-weight: 700;
        }

        .action-btns {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #064e3b;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #022c22;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .card-footer {
            border-top: 1px solid #f1f5f9;
            padding: 14px 20px;
            background: #f8fafc;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="page-wrap">
    <div class="top-nav">
        <a href="https://amis.edu.ph">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            amis.edu.ph
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <img class="school-logo" src="/logo.png" alt="AMIS Logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
            <div class="school-name">AL MUNAWWARA ISLAMIC SCHOOL</div>
            <div class="school-subtext">Official Staff Verification System</div>
        </div>

        <div class="card-body">
            <div class="fail-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>

            <div class="status-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                Record Not Verified
            </div>

            <h1 class="fail-title">Verification Failed &ndash; This record could not be verified.</h1>

            <p class="fail-desc">
                The requested staff verification link does not correspond to any active official record in the official Al Munawwara Islamic School faculty and administration registry.
            </p>

            <div class="fail-slug-box">
                Requested Identifier: <strong>/verify/{{ $slug ?? 'unknown' }}</strong>
            </div>

            <div class="notice-box">
                <strong>Important Security Advisory:</strong>
                If you scanned this from a physical calling card or ID, verify that the QR code points strictly to <code>https://amis.edu.ph/verify/...</code>. For urgent confirmation, please contact the AMIS Administration Office at <a href="mailto:almunawwaraislamicschool@gmail.com" style="color: #065f46; font-weight: 700;">almunawwaraislamicschool@gmail.com</a>.
            </div>

            <div class="action-btns">
                <a href="https://amis.edu.ph" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Return to Official AMIS Website
                </a>
                <a href="{{ route('staff.verify.index') }}" class="btn btn-secondary">
                    View Verified Staff Directory
                </a>
            </div>
        </div>

        <div class="card-footer">
            Al Munawwara Islamic School &bull; Don Julian Rodriguez Sr. Avenue, Ma-A, Davao City
        </div>
    </div>
</div>

</body>
</html>
