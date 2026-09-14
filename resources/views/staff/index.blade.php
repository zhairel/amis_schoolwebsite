<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff &amp; Faculty Verification Registry | AMIS</title>
    <meta name="description" content="Official credentials and staff verification portal for Al Munawwara Islamic School (AMIS), Davao City.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --amis-dark: #022c22;
            --amis-primary: #064e3b;
            --amis-emerald: #059669;
            --amis-gold: #d97706;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-600: #475569;
            --slate-100: #f1f5f9;
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
            padding: 24px 16px 40px;
        }

        .page-wrap {
            width: 100%;
            max-width: 640px;
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
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .main-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 45px -10px rgba(2, 44, 34, 0.25), 0 8px 20px -6px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(2, 44, 34, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            padding: 30px 24px 26px;
            text-align: center;
            color: #ffffff;
            border-bottom: 2px solid #d97706;
        }

        .school-logo {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: #ffffff;
            padding: 3px;
            margin-bottom: 10px;
        }

        .school-name {
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .header-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            margin-top: 6px;
        }

        .header-sub {
            font-size: 12px;
            color: #a7f3d0;
            margin-top: 4px;
        }

        .card-body {
            padding: 24px;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            gap: 8px;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .search-input:focus {
            border-color: var(--amis-emerald);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15);
        }

        .search-btn {
            background: var(--amis-primary);
            color: #ffffff;
            border: none;
            padding: 0 18px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .search-btn:hover {
            background: var(--amis-dark);
        }

        .staff-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .staff-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
        }

        .staff-item:hover {
            background: #ecfdf5;
            border-color: #a7f3d0;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(2, 44, 34, 0.08);
        }

        .staff-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .staff-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            color: #fbbf24;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .staff-name {
            font-family: 'Outfit', sans-serif;
            font-size: 14.5px;
            font-weight: 800;
            color: #0f172a;
        }

        .staff-pos {
            font-size: 12px;
            color: var(--amis-primary);
            font-weight: 600;
            margin-top: 2px;
        }

        .verify-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #d1fae5;
            color: #065f46;
            font-size: 11px;
            font-weight: 800;
            padding: 5px 10px;
            border-radius: 999px;
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .card-footer {
            border-top: 1px solid #e2e8f0;
            padding: 16px 24px;
            background: #f8fafc;
            text-align: center;
            font-size: 11px;
            color: #64748b;
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

    <div class="main-card">
        <div class="card-header">
            <img class="school-logo" src="/logo.png" alt="AMIS Logo" onerror="this.onerror=null; this.src='/images/AMIS_Logo.png';">
            <div class="school-name">AL MUNAWWARA ISLAMIC SCHOOL</div>
            <h1 class="header-title">Staff Verification Registry</h1>
            <div class="header-sub">Official Online Credential Authentication Registry</div>
        </div>

        <div class="card-body">
            <div class="search-box">
                <form action="{{ route('staff.verify.index') }}" method="GET" class="search-form">
                    <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search official by name or position..." class="search-input">
                    <button type="submit" class="search-btn">Search</button>
                </form>
            </div>

            <div class="staff-list">
                @forelse($staffList as $staff)
                    <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}" class="staff-item">
                        <div class="staff-info">
                            <div class="staff-avatar">
                                {{ substr($staff->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="staff-name">
                                    {{ $staff->full_name }}
                                    @if($staff->academic_title)
                                        <span style="font-size: 11px; color: #d97706; font-weight: 700;">({{ $staff->academic_title }})</span>
                                    @endif
                                </div>
                                <div class="staff-pos">{{ $staff->position }}</div>
                            </div>
                        </div>
                        <span class="verify-tag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            Verified
                        </span>
                    </a>
                @empty
                    <div style="text-align: center; padding: 30px; color: #64748b;">
                        No staff records found matching your search.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="card-footer">
            Official Registry of Al Munawwara Islamic School &bull; Don Julian Rodriguez Sr. Avenue, Ma-A, Davao City
        </div>
    </div>
</div>

</body>
</html>
