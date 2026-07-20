<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signature Verification Portal — Al Munawwara Islamic School</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap');
        
        :root {
            color-scheme: light;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 24px 16px;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #ffffff;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
        }
        
        main {
            width: min(100%, 540px);
            padding: 36px 28px;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 
                0 20px 45px -10px rgba(15, 23, 42, 0.08),
                0 4px 12px -2px rgba(15, 23, 42, 0.04);
            text-align: center;
            position: relative;
        }
        
        .shield-container {
            width: 72px;
            height: 72px;
            margin: 0 auto 20px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            color: #059669;
        }
        .shield-container svg {
            width: 34px;
            height: 34px;
            stroke-width: 1.75;
        }
        
        .badge {
            display: inline-block;
            margin-bottom: 16px;
            padding: 5px 14px;
            border-radius: 999px;
            color: #047857;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        
        .greeting-card {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .greeting-title {
            font-family: 'Outfit', sans-serif;
            font-size: 19px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px;
        }
        .greeting-arabic {
            font-family: 'Amiri', serif;
            font-size: 15px;
            font-weight: 700;
            color: #059669;
            margin: 0;
            direction: rtl;
        }
        
        h1 {
            margin: 0 0 12px;
            font-family: 'Outfit', sans-serif;
            font-size: clamp(22px, 4.5vw, 28px);
            font-weight: 900;
            letter-spacing: -0.02em;
            line-height: 1.15;
            color: #0f172a;
        }
        
        .description {
            margin: 0 auto 24px;
            font-size: 13.5px;
            line-height: 1.6;
            color: #475569;
            max-width: 440px;
        }
        
        .features {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #f8fafc;
            padding: 18px 20px;
            margin-bottom: 28px;
            text-align: left;
        }
        .features-title {
            font-size: 11px;
            font-weight: 800;
            color: #047857;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .features-title svg {
            width: 14px;
            height: 14px;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 12px;
            line-height: 1.45;
            color: #334155;
        }
        .feature-item:last-child {
            margin-bottom: 0;
        }
        .feature-bullet {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #059669;
            margin-top: 5px;
            flex-shrink: 0;
        }
        
        /* School Information Footer Block */
        .school-footer-card {
            border-top: 2px solid #e2e8f0;
            padding-top: 24px;
            margin-top: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .school-logo {
            width: 68px;
            height: 68px;
            object-fit: contain;
        }
        .school-arabic-name {
            font-family: 'Amiri', serif;
            font-size: 18px;
            font-weight: 700;
            color: #047857;
            direction: rtl;
            line-height: 1.2;
        }
        .school-english-name {
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            line-height: 1.1;
        }
        .school-address {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }
        .school-id-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 8px;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            font-size: 11px;
            font-weight: 800;
            color: #1e293b;
            letter-spacing: 0.05em;
        }
        
        .footer-link {
            margin-top: 16px;
            font-size: 11.5px;
            color: #64748b;
        }
        .footer-link a {
            color: #059669;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
<main>
    <div class="shield-container">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
        </svg>
    </div>
    
    <span class="badge">Official Security Portal</span>

    <div class="greeting-card">
        <div class="greeting-title">Assalamu Alaikum &amp; Good Day!</div>
        <div class="greeting-arabic">السلام عليكم ورحمة الله وبركاته</div>
    </div>

    <h1>Digital Signature Verification</h1>
    <p class="description">
        Please stand by — the official <strong>School Director Digital Signature Verification System</strong> is coming soon. We are currently implementing cryptographic security standards to ensure tamper-proof authentication of official school documents, student credentials, and director signatures.
    </p>
    
    <div class="features">
        <div class="features-title">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span>Security Implementation Status</span>
        </div>
        <div class="feature-item">
            <div class="feature-bullet"></div>
            <span><strong>School Director Seal:</strong> Encrypted cryptographic signature registry coming soon.</span>
        </div>
        <div class="feature-item">
            <div class="feature-bullet"></div>
            <span><strong>Anti-Counterfeiting:</strong> Instant QR validation to trace all authentic credentials.</span>
        </div>
        <div class="feature-item">
            <div class="feature-bullet"></div>
            <span><strong>Tamper-Proof Audit Logs:</strong> Secure verification endpoints for institutions &amp; partners.</span>
        </div>
    </div>
    
    <!-- School Information Block at Bottom -->
    <div class="school-footer-card">
        <img src="{{ asset('logo/AMIS_Logo.png') }}" class="school-logo" alt="AMIS Logo" onerror="this.src='{{ asset('logo.png') }}'">
        <div class="school-arabic-name">مدرسة المنورة الإسلامية</div>
        <div class="school-english-name">Al Munawwara Islamic School</div>
        <div class="school-address">Don Julian Rodriguez Avenue, Ma-a, Davao City</div>
        <div class="school-id-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>SCHOOL ID: 466150</span>
        </div>
    </div>

    <div class="footer-link">
        Al Munawwara Islamic School &copy; 2026. <br>
        Go back to <a href="/">amis.edu.ph</a>
    </div>
</main>
</body>
</html>
