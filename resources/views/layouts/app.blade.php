<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Al Munawwara Islamic School')</title>
    <meta name="description" content="@yield('meta_description', 'Enabling Our Students to Learn in Fid Dunya Wal Akhira. Al Munawwara Islamic School offers high-quality Islamic education in Davao City.')">
    
    <!-- Google Search Console Verification -->
    <meta name="google-site-verification" content="C-3N2wjyM9KESjDCT4MXpCoqyWmxh54zVhlt6KUZ2bA">
    
    <!-- Search Engine Crawler Directives (Google, Bing, Yahoo, DuckDuckGo, Safari) -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="author" content="Al Munawwara Islamic School">
    
    <!-- Apple / Safari Web App Meta -->
    <meta name="apple-mobile-web-app-title" content="Al Munawwara Islamic School">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    
    <!-- Twitter / X Cards Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Al Munawwara Islamic School')">
    <meta name="twitter:description" content="@yield('meta_description', 'Enabling Our Students to Learn in Fid Dunya Wal Akhira. Al Munawwara Islamic School offers high-quality Islamic education in Davao City.')">
    <meta name="twitter:image" content="{{ asset('logo.png') }}">

    <!-- Local & Geo SEO Meta Tags -->
    <meta name="geo.region" content="PH-DVO">
    <meta name="geo.placename" content="Davao City, Philippines">
    <meta name="geo.position" content="7.0736;125.6110">
    <meta name="ICBM" content="7.0736, 125.6110">

    <!-- Canonical & Open Graph Meta Tags -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="Al Munawwara Islamic School">
    <meta property="og:title" content="@yield('title', 'Al Munawwara Islamic School')">
    <meta property="og:description" content="@yield('meta_description', 'Enabling Our Students to Learn in Fid Dunya Wal Akhira. Al Munawwara Islamic School offers high-quality Islamic education in Davao City.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('logo.png') }}">

    <!-- Google & Search Engines Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "WebSite",
      "name": "Al Munawwara Islamic School",
      "alternateName": ["AMIS", "amis.edu.ph"],
      "url": "https://amis.edu.ph/"
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "EducationalOrganization",
      "name": "Al Munawwara Islamic School",
      "alternateName": "AMIS",
      "url": "https://amis.edu.ph",
      "logo": "https://amis.edu.ph/logo.png",
      "email": "inquiries@amis.edu.ph",
      "address": {
        "@@type": "PostalAddress",
        "addressLocality": "Davao City",
        "addressRegion": "Davao del Sur",
        "addressCountry": "PH"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [{
        "@@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "https://amis.edu.ph/"
      }]
    }
    </script>
    
    <!-- Google Fonts: Outfit, Inter, and Amiri (Arabic Calligraphy) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    
    <!-- CookieConsent CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanilla-cookieconsent@3.1.0/dist/cookieconsent.css">
    <style>
        /* Custom Cookie Consent Theme Overrides (AMIS Green) */
        :root {
            --cc-bg: #ffffff;
            --cc-text: #1e293b;
            --cc-btn-primary-bg: #059669;
            --cc-btn-primary-text: #ffffff;
            --cc-btn-primary-hover-bg: #047857;
            --cc-btn-secondary-bg: #f1f5f9;
            --cc-btn-secondary-text: #334155;
            --cc-btn-secondary-hover-bg: #e2e8f0;
            --cc-toggle-on-bg: #059669;
            --cc-toggle-off-bg: #cbd5e1;
            --cc-toggle-on-knob-bg: #ffffff;
            --cc-toggle-off-knob-bg: #ffffff;
            --cc-toggle-readonly-bg: #e2e8f0;
            --cc-toggle-readonly-knob-bg: #94a3b8;
        }
        /* Custom font pairing matching Outfit */
        .cc--darkmode,
        #cc-main {
            font-family: 'Outfit', 'Inter', sans-serif !important;
        }
    </style>

    @yield('styles')
</head>
<body class="bg-gray-50">
    <div class="app">
        <!-- MODERN REDESIGNED HEADER -->
        <header class="site-header" id="siteHeader">
            <!-- 1. Sleek Utility Topbar -->
            <div class="top-utility-bar">
                <div class="container top-utility-content">
                    <div class="utility-left">
                        <a href="tel:+639272991833" class="utility-item">
                            <svg class="utility-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+63 927 299 1833</span>
                        </a>
                        <span class="utility-divider"></span>
                        <a href="mailto:inquiries@amis.edu.ph" class="utility-item">
                            <svg class="utility-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>inquiries@amis.edu.ph</span>
                        </a>
                        <span class="utility-divider"></span>
                        <div class="utility-social">
                            <a href="https://www.facebook.com/almunawwaraislamicschool" target="_blank" rel="noopener noreferrer" class="utility-social-link" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://www.youtube.com/@amistv3214" target="_blank" rel="noopener noreferrer" class="utility-social-link" aria-label="YouTube">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="utility-right">
                        <span class="utility-accreditation">
                            <span class="accreditation-dot"></span>
                            DepEd Recognized & ESC Participating School
                        </span>
                        <a href="https://student.amis.edu.ph" target="_blank" rel="noopener noreferrer" class="utility-portal-link">
                            <svg class="portal-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            Student Portal
                        </a>
                        <a href="https://faculty.amis.edu.ph" target="_blank" rel="noopener noreferrer" class="utility-portal-link">
                            <svg class="portal-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Faculty
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. Main Navigation Bar (Unified & Sticky) -->
            <div class="main-navbar" id="mainNavbar">
                <div class="container navbar-container">
                    <!-- Brand / Logo Area -->
                    <a href="{{ route('home') }}" class="brand-link" title="Al Munawwara Islamic School Home">
                        <img src="/logo.png" alt="AMIS Official Seal" class="brand-logo" onerror="this.src='https://amis.edu.ph/logo.png'">
                        <div class="brand-text-stack">
                            <span class="brand-arabic">المدرسة المنورة الإسلامية</span>
                            <span class="brand-title">AL MUNAWWARA ISLAMIC SCHOOL</span>
                            <span class="brand-tagline">Enabling Our Students to Learn in Fid Dunya Wal Akhira</span>
                        </div>
                    </a>

                    <!-- Desktop Nav Links -->
                    <nav class="desktop-nav" aria-label="Main Navigation">
                        <ul class="nav-links-list">
                            <li>
                                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                                    Home
                                </a>
                            </li>

                            <!-- About Us Dropdown -->
                            <li class="nav-dropdown">
                                <button type="button" class="nav-link nav-dropdown-trigger {{ request()->routeIs('about.*') ? 'nav-link-active' : '' }}" aria-haspopup="true" aria-expanded="false">
                                    About Us
                                    <svg class="chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="nav-dropdown-card">
                                    <div class="dropdown-arrow"></div>
                                    <div class="dropdown-inner">
                                        <a href="{{ route('about.history') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">School History</span>
                                                <span class="item-desc">Founding roots & development</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('about.philosophy') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Philosophy, Vision & Mission</span>
                                                <span class="item-desc">Core Islamic education values</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('about.logo') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">AMIS Emblem & Seal</span>
                                                <span class="item-desc">Symbolism & official crest</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('about.why') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Why Islamic School?</span>
                                                <span class="item-desc">Integrated Dunya & Akhira learning</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('about.certifications') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Certifications & Accreditations</span>
                                                <span class="item-desc">DepEd recognition & government permits</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('about.location') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Campus Location</span>
                                                <span class="item-desc">Ma-a, Davao City campus map</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('about.global-community') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Global AMIS Community</span>
                                                <span class="item-desc">Worldwide students & alumni</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Academics Dropdown -->
                            <li class="nav-dropdown">
                                <button type="button" class="nav-link nav-dropdown-trigger {{ request()->routeIs('academics.*') ? 'nav-link-active' : '' }}" aria-haspopup="true" aria-expanded="false">
                                    Academics
                                    <svg class="chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="nav-dropdown-card">
                                    <div class="dropdown-arrow"></div>
                                    <div class="dropdown-inner">
                                        <a href="{{ route('academics.basic-education') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Basic Education</span>
                                                <span class="item-desc">Kindergarten to Junior & Senior High</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('academics.calendar') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Calendar S.Y. 2026-2027</span>
                                                <span class="item-desc">Academic terms & event schedules</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- ISAL Department Dropdown -->
                            <li class="nav-dropdown">
                                <button type="button" class="nav-link nav-dropdown-trigger {{ request()->routeIs('isal.*') ? 'nav-link-active' : '' }}" aria-haspopup="true" aria-expanded="false">
                                    ISAL Department
                                    <svg class="chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="nav-dropdown-card">
                                    <div class="dropdown-arrow"></div>
                                    <div class="dropdown-inner">
                                        <a href="{{ route('isal.halaqah') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Halaqah Online</span>
                                                <span class="item-desc">Quranic recitation & Tajweed program</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('isal.halaqah-parents') }}" class="dropdown-item">
                                            <span class="item-bullet"></span>
                                            <div class="item-text">
                                                <span class="item-title">Halaqah Parents</span>
                                                <span class="item-desc">Islamic studies session for guardians</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a href="{{ route('news.index') }}" class="nav-link {{ request()->routeIs('news.index') ? 'nav-link-active' : '' }}">
                                    News
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.index') ? 'nav-link-active' : '' }}">
                                    Events
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'nav-link-active' : '' }}">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Nav Actions & Mobile Toggle -->
                    <div class="nav-actions">
                        <a href="https://aes.amis.edu.ph" target="_blank" rel="noopener noreferrer" class="btn-enroll-cta">
                            <span>Pre-Enrollment</span>
                            <svg class="cta-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>

                        <!-- Mobile Hamburger Button -->
                        <button class="mobile-toggle-btn" id="mobileMenuBtn" aria-label="Open Navigation Menu" aria-expanded="false">
                            <span class="hamburger-bar"></span>
                            <span class="hamburger-bar"></span>
                            <span class="hamburger-bar"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 3. Mobile Slide-Over Drawer Navigation -->
            <div class="mobile-drawer-backdrop" id="mobileDrawerBackdrop"></div>
            <aside class="mobile-drawer" id="mobileDrawer" aria-label="Mobile Navigation Drawer">
                <div class="drawer-header">
                    <div class="drawer-brand">
                        <img src="/logo.png" alt="AMIS Logo" class="drawer-logo" onerror="this.src='https://amis.edu.ph/logo.png'">
                        <div>
                            <span class="drawer-title">AL MUNAWWARA</span>
                            <span class="drawer-subtitle">ISLAMIC SCHOOL</span>
                        </div>
                    </div>
                    <button class="drawer-close-btn" id="mobileDrawerClose" aria-label="Close Menu">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="drawer-quick-actions">
                    <a href="https://aes.amis.edu.ph" target="_blank" rel="noopener noreferrer" class="drawer-cta-btn">
                        <span>Pre-Enrollment Portal</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <div class="drawer-portal-grid">
                        <a href="https://student.amis.edu.ph" target="_blank" rel="noopener noreferrer" class="drawer-portal-pill">
                            🎓 Student Portal
                        </a>
                        <a href="https://faculty.amis.edu.ph" target="_blank" rel="noopener noreferrer" class="drawer-portal-pill">
                            👨‍🏫 Faculty
                        </a>
                    </div>
                </div>

                <div class="drawer-body">
                    <nav class="drawer-nav">
                        <a href="{{ route('home') }}" class="drawer-link {{ request()->routeIs('home') ? 'drawer-link-active' : '' }}">
                            <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Home
                        </a>

                        <!-- Drawer Accordion: About Us -->
                        <div class="drawer-accordion">
                            <button type="button" class="drawer-accordion-btn {{ request()->routeIs('about.*') ? 'active-parent' : '' }}" aria-expanded="false">
                                <span class="accordion-title-wrap">
                                    <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    About Us
                                </span>
                                <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="drawer-accordion-content">
                                <a href="{{ route('about.history') }}">School History</a>
                                <a href="{{ route('about.philosophy') }}">Philosophy, Vision, Mission & Goals</a>
                                <a href="{{ route('about.logo') }}">AMIS Official Emblem</a>
                                <a href="{{ route('about.why') }}">Why Islamic School?</a>
                                <a href="{{ route('about.certifications') }}">Certifications & DepEd Recognition</a>
                                <a href="{{ route('about.location') }}">Campus Location</a>
                                <a href="{{ route('about.global-community') }}">Global AMIS Community</a>
                            </div>
                        </div>

                        <!-- Drawer Accordion: Academics -->
                        <div class="drawer-accordion">
                            <button type="button" class="drawer-accordion-btn {{ request()->routeIs('academics.*') ? 'active-parent' : '' }}" aria-expanded="false">
                                <span class="accordion-title-wrap">
                                    <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                    Academics
                                </span>
                                <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="drawer-accordion-content">
                                <a href="{{ route('academics.basic-education') }}">Basic Education (K to 12)</a>
                                <a href="{{ route('academics.calendar') }}">Calendar S.Y. 2026-2027</a>
                            </div>
                        </div>

                        <!-- Drawer Accordion: ISAL Dept -->
                        <div class="drawer-accordion">
                            <button type="button" class="drawer-accordion-btn {{ request()->routeIs('isal.*') ? 'active-parent' : '' }}" aria-expanded="false">
                                <span class="accordion-title-wrap">
                                    <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    ISAL Department
                                </span>
                                <svg class="drawer-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="drawer-accordion-content">
                                <a href="{{ route('isal.halaqah') }}">Halaqah Online</a>
                                <a href="{{ route('isal.halaqah-parents') }}">Halaqah Parents</a>
                            </div>
                        </div>

                        <a href="{{ route('news.index') }}" class="drawer-link {{ request()->routeIs('news.index') ? 'drawer-link-active' : '' }}">
                            <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            News
                        </a>
                        <a href="{{ route('events.index') }}" class="drawer-link {{ request()->routeIs('events.index') ? 'drawer-link-active' : '' }}">
                            <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Events
                        </a>
                        <a href="{{ route('contact') }}" class="drawer-link {{ request()->routeIs('contact') ? 'drawer-link-active' : '' }}">
                            <svg class="drawer-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Contact
                        </a>
                    </nav>
                </div>

                <div class="drawer-footer">
                    <div class="drawer-contact-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:+639272991833">+63 927 299 1833</a>
                    </div>
                    <div class="drawer-contact-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:inquiries@amis.edu.ph">inquiries@amis.edu.ph</a>
                    </div>
                    <div class="drawer-social-row">
                        <a href="https://www.facebook.com/almunawwaraislamicschool" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/@amistv3214" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>
            </aside>
        </header>

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section">
                        <img src="/logo.png" alt="AMIS Logo" class="footer-logo" onerror="this.src='https://amis.edu.ph/logo.png'">
                    </div>
                    
                    <div class="footer-section">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="{{ route('about.history') }}">About Us</a></li>
                            <li><a href="{{ route('about.global-community') }}">Global AMIS Community</a></li>
                            <li><a href="{{ route('academics.calendar') }}">Calendar S.Y. 2026-2027</a></li>
                            <li><a href="{{ route('news.index') }}">News & Announcements</a></li>
                            <li><a href="{{ route('events.index') }}">Events</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Contact Info</h4>
                        <ul>
                            <li>Email: inquiries@amis.edu.ph</li>
                            <li>Address: Don Julian Rodriguez Avenue, Ma-a, Davao City, Philippines, 8000</li>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="https://www.facebook.com/almunawwaraislamicschool" target="_blank" aria-label="Facebook">FB</a>
                            <a href="https://www.youtube.com/@amistv3214" target="_blank" aria-label="YouTube">YT</a>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} Al Munawwara Islamic School. All rights reserved.</p>
                </div>
            </div>
        </footer>
        
        <!-- Feedback Button Sticker -->
        <button class="feedback-sticker" id="feedbackSticker" aria-label="Send Feedback">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <span>FEEDBACK</span>
        </button>

        <!-- Feedback Modal -->
        <div class="modal-overlay" id="feedbackModal" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" id="closeFeedback" aria-label="Close">×</button>
                
                <h2>Send Us Your Feedback</h2>
                <p class="subtitle">We'd love to hear from you!</p>

                <form id="feedbackForm">
                    @csrf
                    <div class="form-group">
                        <label for="feedback_name">Name (Optional)</label>
                        <input type="text" id="feedback_name" name="name" placeholder="Your name" />
                    </div>

                    <div class="form-group">
                        <label for="feedback_email">Email (Optional)</label>
                        <input type="email" id="feedback_email" name="email" placeholder="your.email@example.com" />
                    </div>

                    <div class="form-group">
                        <label for="feedback_type">Feedback Type</label>
                        <select id="feedback_type" name="feedback_type" required>
                            <option value="">Select type</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="complaint">Complaint</option>
                            <option value="compliment">Compliment</option>
                            <option value="question">Question</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>How would you rate our website?</label>
                        <div class="rating-stars" id="starRating">
                            <button type="button" class="star-btn" data-star="1">★</button>
                            <button type="button" class="star-btn" data-star="2">★</button>
                            <button type="button" class="star-btn" data-star="3">★</button>
                            <button type="button" class="star-btn" data-star="4">★</button>
                            <button type="button" class="star-btn" data-star="5">★</button>
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" value="0">
                    </div>

                    <div class="form-group">
                        <label for="feedback_message">Your Feedback *</label>
                        <textarea id="feedback_message" name="message" placeholder="Tell us what you think..." rows="5" required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" id="cancelFeedback">Cancel</button>
                        <button type="submit" class="btn-submit" id="submitFeedbackBtn">Send Feedback</button>
                    </div>

                    <p id="feedbackError" class="error-message" style="display: none;"></p>
                </form>

                <div class="success-message" id="feedbackSuccess" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3>Thank You!</h3>
                    <p>Your feedback has been submitted successfully.</p>
                    <button type="button" class="btn-close" id="okFeedback">Close</button>
                </div>
            </div>
        </div>
        
        <!-- Scroll to Top Button -->
        <button class="scroll-to-top" id="scrollTopBtn" style="display: none;" aria-label="Scroll to top">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>

    <!-- UI Interaction Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Modern Mobile Drawer Navigation
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const mobileDrawerBackdrop = document.getElementById('mobileDrawerBackdrop');
            const mobileDrawerClose = document.getElementById('mobileDrawerClose');
            const mainNavbar = document.getElementById('mainNavbar');

            function toggleDrawer(open) {
                if (open) {
                    mobileDrawer.classList.add('open');
                    mobileDrawerBackdrop.classList.add('active');
                    mobileMenuBtn.setAttribute('aria-expanded', 'true');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileDrawer.classList.remove('open');
                    mobileDrawerBackdrop.classList.remove('active');
                    mobileMenuBtn.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                }
            }

            if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', () => toggleDrawer(true));
            if (mobileDrawerClose) mobileDrawerClose.addEventListener('click', () => toggleDrawer(false));
            if (mobileDrawerBackdrop) mobileDrawerBackdrop.addEventListener('click', () => toggleDrawer(false));

            // Accordion dropdown toggles inside drawer
            const accordionButtons = document.querySelectorAll('.drawer-accordion-btn');
            accordionButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const accordion = this.closest('.drawer-accordion');
                    const isOpen = accordion.classList.contains('open');
                    
                    // Close other accordions
                    document.querySelectorAll('.drawer-accordion').forEach(a => {
                        if (a !== accordion) a.classList.remove('open');
                    });

                    if (isOpen) {
                        accordion.classList.remove('open');
                        this.setAttribute('aria-expanded', 'false');
                    } else {
                        accordion.classList.add('open');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            // Close drawer on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && mobileDrawer && mobileDrawer.classList.contains('open')) {
                    toggleDrawer(false);
                }
            });

            // Smart Sticky Navbar Scrolled Style
            function updateNavbarScroll() {
                if (window.scrollY > 15) {
                    mainNavbar.classList.add('navbar-scrolled');
                } else {
                    mainNavbar.classList.remove('navbar-scrolled');
                }
            }
            window.addEventListener('scroll', updateNavbarScroll, { passive: true });
            updateNavbarScroll();

            // 2. Scroll to Top Behavior
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    scrollTopBtn.style.display = 'flex';
                } else {
                    scrollTopBtn.style.display = 'none';
                }
            });

            if (scrollTopBtn) {
                scrollTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // 3. Feedback Sticker modal logic
            const feedbackSticker = document.getElementById('feedbackSticker');
            const feedbackModal = document.getElementById('feedbackModal');
            const closeFeedback = document.getElementById('closeFeedback');
            const cancelFeedback = document.getElementById('cancelFeedback');
            const okFeedback = document.getElementById('okFeedback');
            const feedbackForm = document.getElementById('feedbackForm');
            const feedbackSuccess = document.getElementById('feedbackSuccess');
            const ratingInput = document.getElementById('ratingInput');
            const starButtons = document.querySelectorAll('#starRating .star-btn');
            const submitBtn = document.getElementById('submitFeedbackBtn');
            const feedbackError = document.getElementById('feedbackError');

            function openFeedback() {
                feedbackModal.style.display = 'flex';
                feedbackForm.style.display = 'block';
                feedbackSuccess.style.display = 'none';
                feedbackForm.reset();
                ratingInput.value = 0;
                updateStars(0);
                feedbackError.style.display = 'none';
                document.body.style.overflow = 'hidden';
            }

            function closeFeedbackModal() {
                feedbackModal.style.display = 'none';
                document.body.style.overflow = '';
            }

            if (feedbackSticker) feedbackSticker.addEventListener('click', openFeedback);
            if (closeFeedback) closeFeedback.addEventListener('click', closeFeedbackModal);
            if (cancelFeedback) cancelFeedback.addEventListener('click', closeFeedbackModal);
            if (okFeedback) okFeedback.addEventListener('click', closeFeedbackModal);

            // Handle rating stars
            starButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const stars = parseInt(this.getAttribute('data-star'));
                    ratingInput.value = stars;
                    updateStars(stars);
                });
            });

            function updateStars(rating) {
                starButtons.forEach(btn => {
                    const starVal = parseInt(btn.getAttribute('data-star'));
                    if (starVal <= rating) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

            // Handle feedback submit
            if (feedbackForm) {
                feedbackForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Sending...';
                    feedbackError.style.display = 'none';

                    const formData = {
                        name: document.getElementById('feedback_name').value,
                        email: document.getElementById('feedback_email').value,
                        feedback_type: document.getElementById('feedback_type').value,
                        rating: ratingInput.value,
                        message: document.getElementById('feedback_message').value,
                        _token: document.querySelector('input[name="_token"]').value
                    };

                    fetch('{{ route('feedback.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': formData._token
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Send Feedback';
                        if (data.success) {
                            feedbackForm.style.display = 'none';
                            feedbackSuccess.style.display = 'block';
                            setTimeout(closeFeedbackModal, 2000);
                        } else {
                            feedbackError.textContent = 'Error submitting feedback. Please try again.';
                            feedbackError.style.display = 'block';
                        }
                    })
                    .catch(err => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Send Feedback';
                        feedbackError.textContent = 'Connection error. Please check your network.';
                        feedbackError.style.display = 'block';
                    });
                });
            }
        });
    </script>
    <!-- CookieConsent JS -->
    <script src="https://cdn.jsdelivr.net/npm/vanilla-cookieconsent@3.1.0/dist/cookieconsent.umd.js"></script>
    <script>
        CookieConsent.run({
            guiOptions: {
                consentModal: {
                    layout: 'box',
                    position: 'bottom left',
                    equalWeightButtons: false,
                    flipButtons: false
                },
                preferencesModal: {
                    layout: 'box',
                    position: 'right',
                    equalWeightButtons: true,
                    flipButtons: false
                }
            },
            categories: {
                necessary: {
                    readOnly: true,
                    enabled: true
                },
                analytics: {
                    enabled: false
                }
            },
            language: {
                default: 'en',
                translations: {
                    en: {
                        consentModal: {
                            title: '🍪 We value your privacy',
                            description: 'Al Munawwara Islamic School uses cookies to enhance your browsing experience and analyze site traffic. You can choose which cookies to allow.',
                            acceptAllBtn: 'Accept All',
                            acceptNecessaryBtn: 'Reject All',
                            showPreferencesBtn: 'Manage Preferences',
                            footer: '<a href="/privacy-policy">Privacy Policy</a>'
                        },
                        preferencesModal: {
                            title: 'Cookie Preferences',
                            acceptAllBtn: 'Accept All',
                            acceptNecessaryBtn: 'Reject All',
                            savePreferencesBtn: 'Save Preferences',
                            closeIconLabel: 'Close',
                            sections: [
                                {
                                    title: 'Cookie Usage',
                                    description: 'We use cookies to ensure the basic functionalities of our website and to enhance your online experience. You can opt-in or opt-out for each category.'
                                },
                                {
                                    title: 'Strictly Necessary <span class="pm__badge">Always Active</span>',
                                    description: 'These cookies are essential for the proper functioning of our website. Without these cookies, the website cannot function properly.',
                                    linkedCategory: 'necessary'
                                },
                                {
                                    title: 'Analytics & Statistics',
                                    description: 'These cookies help us understand how visitors interact with our website to improve content and user experience.',
                                    linkedCategory: 'analytics'
                                }
                            ]
                        }
                    }
                }
            }
        });
    </script>

    <!-- Global Skeleton Loading Engine -->
    <script>
    (function() {
        // Selectors to SKIP (logos, icons, tiny UI images, slideshow slides, etc.)
        const SKIP_SELECTORS = [
            '.logo-img',
            '.social-link img',
            'nav img',
            '.footer-logo img',
            '.indicator',
            '.news-slide-img',
            '.hero-image',
            '.news-slideshow-container img',
            '.album-slide-img',
        ];

        function shouldSkip(img) {
            for (const sel of SKIP_SELECTORS) {
                if (img.closest(sel.split(' ')[0]) || img.matches(sel)) return true;
            }
            // Skip tiny images (icons)
            if (img.width && img.width < 48 && img.height && img.height < 48) return true;
            return false;
        }

        function wrapImage(img) {
            if (img.dataset.skeletonWrapped) return;
            if (shouldSkip(img)) return;

            img.dataset.skeletonWrapped = '1';

            // If already loaded (cached), no skeleton needed
            if (img.complete && img.naturalWidth > 0) {
                return;
            }

            const parent = img.parentNode;
            if (!parent) return;

            // Create wrapper
            const wrapper = document.createElement('div');
            wrapper.className = 'img-skeleton-wrapper';

            // Copy sizing from parent or img's computed styles
            const computedParent = window.getComputedStyle(parent);
            if (computedParent.position === 'static') {
                parent.style.position = 'relative';
            }

            // Insert wrapper before img, move img inside
            parent.insertBefore(wrapper, img);
            wrapper.appendChild(img);

            // Add shimmer placeholder
            const placeholder = document.createElement('div');
            placeholder.className = 'skeleton-placeholder';
            wrapper.appendChild(placeholder);

            // On load: fade out skeleton
            img.addEventListener('load', function onLoad() {
                wrapper.classList.add('loaded');
                img.removeEventListener('load', onLoad);
            });

            // On error: still remove skeleton so broken state is visible
            img.addEventListener('error', function onErr() {
                wrapper.classList.add('loaded');
                img.removeEventListener('error', onErr);
            });
        }

        // Hero skeleton: dark shimmer until first hero image loads
        function setupHeroSkeleton() {
            const hero = document.querySelector('.hero');
            if (!hero) return;

            // Don't add if it's a video hero
            const heroVideo = hero.querySelector('.hero-video');
            if (heroVideo) return;

            const sk = document.createElement('div');
            sk.className = 'hero-skeleton';
            hero.appendChild(sk);

            // Listen for first active hero image
            const firstHeroImg = hero.querySelector('.hero-image.active, .hero-image:first-child');
            if (firstHeroImg) {
                if (firstHeroImg.complete && firstHeroImg.naturalWidth > 0) {
                    sk.classList.add('hidden');
                } else {
                    firstHeroImg.addEventListener('load', function() {
                        sk.classList.add('hidden');
                    }, { once: true });
                    firstHeroImg.addEventListener('error', function() {
                        sk.classList.add('hidden');
                    }, { once: true });
                }
            }
        }

        // Process all images on page load
        function processAll() {
            document.querySelectorAll('img').forEach(wrapImage);
            setupHeroSkeleton();
        }

        // Run immediately and also after DOM settles
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', processAll);
        } else {
            processAll();
        }

        // Also observe for dynamically inserted images
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType !== 1) return;
                    if (node.tagName === 'IMG') {
                        wrapImage(node);
                    } else {
                        node.querySelectorAll && node.querySelectorAll('img').forEach(wrapImage);
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            observer.observe(document.body, { childList: true, subtree: true });
        });
    })();
    </script>

    @yield('scripts')
</body>
</html>
