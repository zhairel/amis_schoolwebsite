<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance | Al Munawwara Islamic School (AMIS)</title>
    <link rel="icon" type="image/png" href="/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --primary-light: #10b981;
            --accent: #f59e0b;
            --dark: #0f172a;
            --slate: #334155;
            --muted: #64748b;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 40%, #f8fafc 100%);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle background Islamic geometric or soft glow decoration */
        .bg-glow-1 {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(5, 150, 105, 0.12) 0%, rgba(5, 150, 105, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .bg-glow-2 {
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .maintenance-card {
            position: relative;
            z-index: 1;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 28px;
            box-shadow: 0 20px 45px -10px rgba(5, 150, 105, 0.1), 0 10px 20px -5px rgba(0, 0, 0, 0.04);
            max-width: 680px;
            width: 100%;
            padding: 48px 40px;
            text-align: center;
        }

        @media (max-width: 640px) {
            .maintenance-card {
                padding: 36px 24px;
                border-radius: 20px;
            }
        }

        .school-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .school-logo {
            width: 68px;
            height: 68px;
            object-fit: contain;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 4px;
        }

        .school-names {
            text-align: left;
        }

        .school-arabic {
            font-family: 'Amiri', serif;
            font-size: 1.15rem;
            color: var(--primary);
            line-height: 1.2;
            font-weight: 700;
        }

        .school-english {
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .school-tagline {
            font-size: 0.72rem;
            color: var(--muted);
            font-weight: 600;
        }

        /* Pulse Status Pill */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
            padding: 6px 16px;
            border-radius: 24px;
            font-size: 0.78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 24px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #d97706;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(217, 119, 6, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 8px rgba(217, 119, 6, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(217, 119, 6, 0);
            }
        }

        .main-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: var(--dark);
            line-height: 1.25;
            margin-bottom: 14px;
        }

        @media (max-width: 640px) {
            .main-title {
                font-size: 1.65rem;
            }
        }

        .desc-text {
            font-size: 1rem;
            color: var(--slate);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .tagalog-note {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 0.88rem;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Quick Portals Links */
        .portal-links-title {
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .portals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
            margin-bottom: 32px;
        }

        .portal-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 14px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: var(--dark);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .portal-link:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(5, 150, 105, 0.08);
        }

        /* Contact Details */
        .contact-box {
            border-top: 1px solid #f1f5f9;
            padding-top: 24px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 20px;
            font-size: 0.84rem;
            color: var(--muted);
        }

        .contact-box a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .contact-box a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .page-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.76rem;
            color: #94a3b8;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="maintenance-card">
        <!-- School Identity -->
        <div class="school-header">
            <img src="/logo.png" alt="AMIS Logo" class="school-logo" onerror="this.src='https://asfi.amis.edu.ph/asfi-logo.png'">
            <div class="school-names">
                <div class="school-arabic">المدرسة المنورة الإسلامية</div>
                <div class="school-english">Al Munawwara Islamic School</div>
                <div class="school-tagline">Enabling Our Students to Learn in Fid Dunya Wal Akhira</div>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="status-pill">
            <span class="pulse-dot"></span>
            System Under Scheduled Maintenance
        </div>

        <h1 class="main-title">We’ll Be Right Back!</h1>

        <p class="desc-text">
            Our official school website is temporarily undergoing scheduled maintenance, database optimization, and system upgrades.
            All core academic services and operations will resume shortly, insha’Allah.
        </p>

        <div class="tagalog-note">
            Kasalukuyang sumasailalim sa routine maintenance at system updates ang aming opisyal na website. Babalik po kami sa operasyon sa lalong madaling panahon. Maraming salamat sa inyong pag-unawa!
        </div>

        <!-- Working Sub-Portals -->
        <div class="portal-links-title">Other Active AMIS Portals &amp; Services</div>
        <div class="portals-grid">
            <a href="https://asfi.amis.edu.ph" class="portal-link" target="_blank">
                <span>💚</span>
                <span>ASFI Takaful Portal</span>
            </a>
            <a href="https://student.amis.edu.ph" class="portal-link" target="_blank">
                <span>🎓</span>
                <span>Student Portal</span>
            </a>
            <a href="https://teacher.amis.edu.ph" class="portal-link" target="_blank">
                <span>📋</span>
                <span>Teacher Portal</span>
            </a>
        </div>

        <!-- Contact Support -->
        <div class="contact-box">
            <div>📞 <strong>Call Support:</strong> <a href="tel:+639272991833">+63 927 299 1833</a></div>
            <div>✉️ <strong>Email:</strong> <a href="mailto:inquiries@amis.edu.ph">inquiries@amis.edu.ph</a></div>
            <div>🌐 <strong>Facebook:</strong> <a href="https://www.facebook.com/almunawwaraislamicschool" target="_blank">AMIS Official Page</a></div>
        </div>
    </div>

    <footer class="page-footer">
        <p>© {{ date('Y') }} Al Munawwara Islamic School (AMIS) · Davao City, Philippines</p>
        <p>DepEd Recognized · ESC &amp; TSS Certified · All Rights Reserved</p>
    </footer>
</body>
</html>
