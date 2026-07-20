<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Signature Verification Portal — Coming Soon</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap');
        
        :root {
            color-scheme: light dark;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 24px;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: radial-gradient(circle at top, #0f2d24 0%, #051611 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #e2e8f0;
            overflow-x: hidden;
        }
        
        /* Premium card glow & glass effect */
        main {
            width: min(100%, 540px);
            padding: 40px 30px;
            border: 1px solid rgba(16, 185, 129, 0.15);
            border-radius: 28px;
            background: rgba(10, 25, 20, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            text-align: center;
            position: relative;
        }
        
        /* Security Shield Icon Animation */
        .shield-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            background: rgba(16, 185, 129, 0.08);
            border: 1.5px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
            position: relative;
        }
        .shield-container svg {
            width: 36px;
            height: 36px;
            stroke-width: 1.75;
        }
        .shield-glow {
            position: absolute;
            inset: -10px;
            border-radius: 30px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.3) 0%, transparent 70%);
            opacity: 0.6;
            filter: blur(10px);
        }
        
        .badge {
            display: inline-block;
            margin-bottom: 16px;
            padding: 5px 12px;
            border-radius: 999px;
            color: #34d399;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }
        
        h1 {
            margin: 0 0 12px;
            font-family: 'Outfit', sans-serif;
            font-size: clamp(24px, 5vw, 30px);
            font-weight: 900;
            letter-spacing: -0.02em;
            line-height: 1.15;
            color: #ffffff;
            background: linear-gradient(135deg, #ffffff 30%, #a7f3d0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .description {
            margin: 0 auto 30px;
            font-size: 14px;
            line-height: 1.6;
            color: #94a3b8;
            max-width: 420px;
        }
        
        /* Security stats/details */
        .features {
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.02);
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }
        .features-title {
            font-size: 11px;
            font-weight: 800;
            color: #10b981;
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
            font-size: 12.5px;
            line-height: 1.4;
            color: #cbd5e1;
        }
        .feature-item:last-child {
            margin-bottom: 0;
        }
        .feature-bullet {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
            margin-top: 6px;
            flex-shrink: 0;
        }
        
        .footer {
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding-top: 24px;
            font-size: 11px;
            color: #64748b;
            letter-spacing: 0.05em;
        }
        .footer a {
            color: #34d399;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
<main>
    <div class="shield-container">
        <div class="shield-glow"></div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
        </svg>
    </div>
    
    <span class="badge">Official Security Portal</span>

    <div style="margin-bottom: 18px; padding: 12px 16px; border-radius: 16px; background: rgba(16, 185, 129, 0.06); border: 1px dashed rgba(16, 185, 129, 0.25);">
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 800; color: #a7f3d0; margin: 0 0 4px; letter-spacing: -0.01em;">
            Assalamu Alaikum &amp; Good Day!
        </h2>
        <p style="font-size: 13px; font-weight: 600; color: #6ee7b7; margin: 0;">
            السلام عليكم ورحمة الله وبركاته
        </p>
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
    
    <div class="footer">
        Al Munawwara Islamic School &copy; 2026. <br>
        Go back to <a href="/">amis.edu.ph</a>
    </div>
</main>
</body>
</html>
