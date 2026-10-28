@extends('layouts.app')

@section('title', 'Global AMIS Community | Al Munawwara Islamic School')

@section('styles')
<!-- GSAP & Animations Support -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    /* Design Tokens */
    :root {
        --light-bg: #f8fafc;
        --light-card: rgba(255, 255, 255, 0.9);
        --primary: #059669;
        --primary-dark: #047857;
        --primary-light: #10b981;
        --gold: #d4af37;
        --gold-glow: rgba(212, 175, 55, 0.4);
        --green-glow: rgba(5, 150, 105, 0.25);
        --border-color: #e2e8f0;
    }

    /* Page Hero styles */
    .global-hero {
        background: linear-gradient(rgba(5, 150, 105, 0.88), rgba(4, 120, 87, 0.92)), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1920') no-repeat center center/cover;
        color: white;
        padding: 5rem 1rem 7.5rem 1rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-bottom: 4px solid var(--gold);
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 24px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 9999px;
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(6px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .hero-title {
        font-size: 2.75rem;
        font-weight: 900;
        letter-spacing: -0.025em;
        color: #ffffff;
        margin-bottom: 1rem;
        line-height: 1.15;
    }

    @media (min-width: 768px) {
        .hero-title {
            font-size: 3.75rem;
        }
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: #f1f5f9;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Stats Card Container cleanly overlapping hero */
    .stat-section {
        position: relative;
        z-index: 30;
        margin-top: -3.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 20px !important;
        padding: 2rem 1.5rem !important;
        text-align: center !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08) !important;
    }

    .stat-card:hover {
        transform: translateY(-5px) !important;
        border-color: #059669 !important;
        box-shadow: 0 20px 40px rgba(5, 150, 105, 0.15) !important;
    }

    .stat-number {
        color: #047857 !important; /* DARK GREEN CONTRAST */
        font-size: 2.75rem !important;
        font-weight: 900 !important;
        line-height: 1 !important;
        margin-bottom: 0.5rem !important;
        font-family: 'Outfit', sans-serif !important;
    }

    .stat-label {
        color: #1e293b !important; /* DARK GRAY CONTRAST */
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
        opacity: 1 !important;
    }

    /* Interactive World Map Section */
    .map-section {
        background-color: var(--light-bg);
        padding: 4rem 0 6rem 0;
        position: relative;
    }

    .map-heading-wrapper {
        text-align: center !important;
        margin-top: 1rem;
        margin-bottom: 3rem !important;
        width: 100%;
    }

    .map-title {
        font-size: 2.25rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        margin-bottom: 0.75rem !important;
        text-align: center !important;
    }

    .map-subtitle {
        color: #475569 !important;
        font-size: 1.05rem !important;
        max-width: 650px !important;
        margin: 0 auto !important;
        line-height: 1.6 !important;
        text-align: center !important;
    }

    .gallery-heading-wrapper {
        text-align: center !important;
        margin-bottom: 2.5rem !important;
        width: 100%;
    }

    .gallery-title {
        font-size: 2.25rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        margin-bottom: 0.75rem !important;
        text-align: center !important;
    }

    .gallery-subtitle {
        color: #475569 !important;
        font-size: 1.05rem !important;
        max-width: 650px !important;
        margin: 0 auto !important;
        line-height: 1.6 !important;
        text-align: center !important;
    }

    .map-container {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 28px;
        padding: 48px 32px;
        box-shadow: 0 15px 45px rgba(0,0,0,0.04);
        overflow: hidden;
        margin-bottom: 4.5rem !important;
    }

    /* Mobile Map Responsive Scaling - No horizontal scrollbar */
    @media (max-width: 768px) {
        .map-container {
            padding: 16px 8px !important;
            border-radius: 20px !important;
            overflow: hidden !important;
        }

        #world-map {
            width: 100% !important;
            height: auto !important;
            min-height: 240px !important;
            transform: scale(1.08);
            transform-origin: center center;
        }

        .map-heading-wrapper {
            margin-bottom: 1.5rem !important;
            padding: 0 0.5rem;
        }

        .map-title {
            font-size: 1.75rem !important;
        }

        .map-subtitle {
            font-size: 0.95rem !important;
        }
    }

    /* Map SVG Styling */
    #world-map {
        width: 100%;
        height: auto;
        max-height: 600px;
    }

    #world-map path:not(.flight-line):not(.airplane-marker) {
        fill: #e2e8f0;
        stroke: #ffffff;
        stroke-width: 1.0;
        transition: fill 0.3s ease, filter 0.3s ease;
    }

    /* Hover effect for non-visited countries */
    #world-map path:not(.visited):not(.flight-line):not(.airplane-marker):hover {
        fill: #cbd5e1;
        cursor: pointer;
    }

    /* Highlight visited countries (GREEN MAP!) */
    #world-map .visited path,
    #world-map path.visited {
        fill: var(--primary) !important;
        filter: drop-shadow(0 0 6px var(--green-glow));
    }

    #world-map .visited:hover path,
    #world-map path.visited:hover {
        fill: var(--primary-light) !important;
        filter: drop-shadow(0 0 12px rgba(16, 185, 129, 0.6));
    }

    /* Source Country (Philippines) Highlight */
    #world-map #ph path,
    #world-map path#ph {
        fill: var(--primary-dark) !important;
        filter: drop-shadow(0 0 8px rgba(4, 120, 87, 0.6));
    }

    /* Global pointer cursor for interactive items */
    #world-map .visited,
    #world-map .visited path,
    #world-map path.visited,
    #world-map #ph,
    #world-map #ph path {
        cursor: pointer;
    }

    /* Flight Path Animation - Crisp Golden Dashed Lines */
    #world-map .flight-line,
    path.flight-line {
        fill: none !important;
        stroke: #d4af37 !important;
        stroke-dasharray: 6,6 !important;
        stroke-width: 2px !important;
        opacity: 0.85 !important;
        animation: dash 25s linear infinite !important;
    }

    @keyframes dash {
        to {
            stroke-dashoffset: -1000;
        }
    }

    /* Airplane marker flying on path */
    #world-map .airplane-marker,
    path.airplane-marker {
        offset-rotate: auto;
        animation: fly-plane 8s linear infinite;
        fill: #d4af37 !important;
        stroke: none !important;
        filter: drop-shadow(0 0 5px #d4af37);
    }

    #plane-marker-us { offset-path: path('M705,490 Q447.5,350 190,410'); animation-duration: 12s; }
    #plane-marker-ae { offset-path: path('M705,490 Q618,430 530,469'); animation-duration: 9s; }
    #plane-marker-qa { offset-path: path('M705,490 Q616.25,417 527.5,464'); animation-duration: 9s; }
    #plane-marker-kr { offset-path: path('M705,490 Q705,450 696,413'); animation-duration: 7s; }
    #plane-marker-jp { offset-path: path('M705,490 Q711.5,447.5 718,405'); animation-duration: 7s; }
    #plane-marker-my { offset-path: path('M705,490 Q677.5,502.5 650,515'); animation-duration: 6s; }
    #plane-marker-sg { offset-path: path('M705,490 Q682,508.75 659,527.5'); animation-duration: 5s; }
    #plane-marker-tr { offset-path: path('M705,490 Q620,380 476,424'); animation-duration: 10s; }
    #plane-marker-ly { offset-path: path('M705,490 Q580,420 440,465'); animation-duration: 10s; }
    #plane-marker-gr { offset-path: path('M705,490 Q600,380 460,425'); animation-duration: 10s; }
    #plane-marker-af { offset-path: path('M705,490 Q630,420 552,440'); animation-duration: 9s; }
    #plane-marker-cr { offset-path: path('M705,490 Q450,350 200,504'); animation-duration: 12s; }
    #plane-marker-bh { offset-path: path('M705,490 Q615,420 526,460'); animation-duration: 9s; }
    #plane-marker-kp { offset-path: path('M705,490 Q700,430 690,405'); animation-duration: 7s; }
    #plane-marker-dz { offset-path: path('M705,490 Q560,410 410,445'); animation-duration: 11s; }
    #plane-marker-om { offset-path: path('M705,490 Q620,430 538,476'); animation-duration: 9s; }
    #plane-marker-gb { offset-path: path('M705,490 Q550,340 405,360'); animation-duration: 12s; }
    #plane-marker-cn { offset-path: path('M705,490 Q680,440 645,430'); animation-duration: 7s; }
    #plane-marker-eg { offset-path: path('M705,490 Q590,410 476,456'); animation-duration: 10s; }

    @keyframes fly-plane {
        0% { offset-distance: 0%; opacity: 0; }
        5% { opacity: 1; }
        90% { opacity: 1; }
        100% { offset-distance: 100%; opacity: 0; }
    }

    /* Pins/Markers style with centered pulse ring */
    .map-pin {
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .map-pin:hover {
        transform: scale(1.3);
    }
    .pulse-ring {
        transform-box: fill-box;
        transform-origin: center;
        animation: pulse-ring 2.5s ease-out infinite;
    }
    @keyframes pulse-ring {
        0% { transform: scale(0.6); opacity: 1; }
        100% { transform: scale(2.2); opacity: 0; }
    }

    /* Horizontal Timeline */
    .timeline-container {
        position: relative;
        padding: 20px 0 40px;
    }

    .timeline-line {
        position: absolute;
        top: 32px; /* Precise vertical center of the 24px node */
        left: 6%;
        right: 6%;
        height: 3px;
        background: #cbd5e1;
        z-index: 1;
    }

    .timeline-progress {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background: var(--primary);
        width: 0%;
        transition: width 0.5s ease;
    }

    .timeline-items {
        position: relative;
        display: flex;
        justify-content: space-between;
        z-index: 2;
    }

    .timeline-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        width: 120px;
    }

    .timeline-node {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid #cbd5e1;
        margin-bottom: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.2);
        position: relative;
        z-index: 2;
    }

    .timeline-item.active .timeline-node,
    .timeline-item:hover .timeline-node {
        background: var(--primary);
        border-color: #ffffff;
        box-shadow: 0 0 0 8px rgba(5, 150, 105, 0.2);
    }

    .timeline-year {
        font-family: 'Outfit', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .timeline-country {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        text-align: center;
    }

    /* Details Modal (Glassmorphism Light) */
    .glass-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(8px);
    }

    .glass-modal.open {
        display: flex;
    }

    .modal-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        width: 100%;
        max-width: 800px;
        max-height: 92vh;
        overflow: hidden;
        color: #1e293b;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.15);
        position: relative;
        animation: scaleIn 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    @keyframes scaleIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .modal-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #f1f5f9;
        border: none;
        color: #475569;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        z-index: 10;
    }

    .modal-close-btn:hover {
        background: #e2e8f0;
        color: var(--primary);
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 28px 32px 32px;
        overflow-y: auto;
    }

    .location-header {
        margin-bottom: 16px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .event-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--primary-dark);
        margin: 16px 0 16px;
        line-height: 1.35;
    }

    .description {
        font-size: 0.95rem;
        line-height: 1.65;
        margin-bottom: 24px;
        color: #334155;
    }

    .actions {
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        gap: 16px;
    }

    /* Modal Photo Gallery Carousel */
    .modal-carousel {
        position: relative;
        height: 350px;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .carousel-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.5s ease;
        background-size: cover;
        background-position: center;
    }
    .carousel-slide.active {
        opacity: 1;
    }
    .carousel-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        border: none;
        color: white;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
        font-size: 1.25rem;
    }
    .carousel-nav-btn:hover {
        background: rgba(0,0,0,0.8);
        color: var(--gold);
    }
    .carousel-prev { left: 16px; }
    .carousel-next { right: 16px; }

    /* Gallery & Filters */
    .filter-btn {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155;
        padding: 10px 24px;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .filter-btn:hover, .filter-btn.active {
        background: #059669;
        color: #ffffff;
        border-color: #059669;
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.25);
        transform: translateY(-2px);
    }

    /* Masonry Gallery Grid */
    .gallery-grid {
        columns: 3 320px;
        column-gap: 24px;
        width: 100%;
        margin-top: 3.5rem !important;
    }

    .gallery-item {
        break-inside: avoid;
        margin-bottom: 20px;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .gallery-item:hover img {
        transform: scale(1.08);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(5, 150, 105, 0.95) 0%, rgba(5, 150, 105, 0.3) 60%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 24px;
        color: white;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    /* Tooltip styles */
    .map-tooltip {
        position: absolute;
        background: #ffffff;
        color: #1e293b;
        border: 1px solid var(--primary);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.85rem;
        pointer-events: none;
        z-index: 100;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        display: none;
        transform: translate(-50%, -100%);
        margin-top: -10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .timeline-line {
            display: none;
        }
        .timeline-items {
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }
        .timeline-item {
            flex-direction: row;
            width: 100%;
            max-width: 250px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            padding: 12px 20px;
            border-radius: 12px;
        }
        .timeline-node {
            margin-bottom: 0;
            margin-right: 16px;
            flex-shrink: 0;
        }
        .timeline-text {
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<!-- HERO SECTION -->
<section class="global-hero">
    <div class="container relative z-10">
        <span class="hero-badge animate__animated animate__fadeInDown">
            Global Footprint
        </span>
        <h1 class="hero-title animate__animated animate__fadeInUp">
            Global AMIS Community
        </h1>
        <p class="hero-subtitle animate__animated animate__fadeInUp">
            Connecting our students with the world's most prestigious youth conferences, international summits, and global academic competitions.
        </p>
    </div>
</section>

<!-- METRICS COUNTER SECTION (CLEANLY OVERLAPPING HERO) -->
<section class="stat-section">
    <div class="container">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            <div class="stat-card">
                <div class="stat-number" id="counter-countries">0</div>
                <div class="stat-label">Countries Visited</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="counter-delegates">0</div>
                <div class="stat-label">International Delegates</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="counter-mun">0</div>
                <div class="stat-label">MUN Conferences</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="counter-awards">0</div>
                <div class="stat-label">International Awards</div>
            </div>
        </div>
    </div>
</section>

<!-- INTERACTIVE MAP SECTION -->
<section class="map-section">
    <div class="container">
        <div class="map-heading-wrapper text-center">
            <h2 class="map-title text-center">Interactive Global Map</h2>
            <p class="map-subtitle text-center mx-auto">Explore historical student delegations, conferences, and international event galleries.</p>
        </div>

        <div class="map-container relative">
            <!-- Inline SVG World Map -->
            {!! file_get_contents(resource_path('views/about/world-map.svg')) !!}

            <!-- Map Tooltip -->
            <div class="map-tooltip" id="map-tooltip"></div>
        </div>

        <!-- TIMELINE COMPONENT -->
        <div class="pt-16 mt-16 border-t border-slate-200/60">
            <h3 class="text-center text-xl md:text-2xl font-black text-[#0f172a] mb-12">Chronological Delegations Journey</h3>
            <div class="timeline-container">
                <div class="timeline-line">
                    <div class="timeline-progress" id="timeline-progress"></div>
                </div>
                <div class="timeline-items">
                    <div class="timeline-item" data-code="US" data-index="0">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2018</div>
                            <div class="timeline-country">USA (Yale MUN)</div>
                        </div>
                    </div>
                    <div class="timeline-item" data-code="KR" data-index="1">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2018</div>
                            <div class="timeline-country">Korea (YMUN)</div>
                        </div>
                    </div>
                    <div class="timeline-item" data-code="AE" data-index="2">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2023</div>
                            <div class="timeline-country">UAE (ASD MUN)</div>
                        </div>
                    </div>
                    <div class="timeline-item" data-code="SG" data-index="3">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2023</div>
                            <div class="timeline-country">Singapore</div>
                        </div>
                    </div>
                    <div class="timeline-item" data-code="MY" data-index="4">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2024</div>
                            <div class="timeline-country">Malaysia (ADNI)</div>
                        </div>
                    </div>
                    <div class="timeline-item" data-code="JP" data-index="5">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2025</div>
                            <div class="timeline-country">Japan (WJMUN)</div>
                        </div>
                    </div>
                    <div class="timeline-item" data-code="QA" data-index="6">
                        <div class="timeline-node"></div>
                        <div class="timeline-text text-center">
                            <div class="timeline-year">2026</div>
                            <div class="timeline-country">Qatar (YMUN)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MASONRY GALLERY SECTION -->
<section class="py-24 bg-white border-t border-slate-200/80">
    <div class="container">
        <div class="gallery-heading-wrapper text-center">
            <h2 class="gallery-title text-center">International Photo Gallery</h2>
            <p class="gallery-subtitle text-center mx-auto">A compilation of memories from our global tours, international competitions, and delegation trips.</p>
        </div>    
            <!-- Dynamic Filters -->
            <div class="flex flex-wrap justify-center gap-3.5 mt-8 mb-12">
                <button class="filter-btn active" data-filter="all">All Experiences</button>
                <button class="filter-btn" data-filter="MUN">Model UN (MUN)</button>
                <button class="filter-btn" data-filter="YMUN">Youth MUN</button>
                <button class="filter-btn" data-filter="Competition">Competitions</button>
                <button class="filter-btn" data-filter="Educational Tour">Educational Tours</button>
                <button class="filter-btn" data-filter="Conference">Conferences</button>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="gallery-grid">
            <!-- Items will be injected dynamically or statically with filtering attributes -->
        </div>
    </div>
</section>

@endsection

@section('scripts')
<!-- GSAP & ScrollTrigger Libraries -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Register GSAP ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        // Destinations Data Structure
        const destinations = [
            {
                country: "United States",
                code: "US",
                city: "New Haven & Boston",
                event: "Yale MUN (Connecticut) & Harvard MUN (Boston)",
                type: "MUN",
                visits: "2x Visited",
                year: 2026,
                date: "2018 / Feb 2026",
                flag: "",
                description: "AMIS youth delegates traveled to the United States for Yale Model United Nations (Linsley Chittenden Hall, Yale University, Connecticut) and Harvard Model United Nations (Boston, MA). Delegates engaged in Islamic studies, international seminars, and high-level debates with student leaders worldwide.",
                video: "",
                images: [
                    "/images/global-community/poster_usa_2018.jpg"
                ]
            },
            {
                country: "South Korea",
                code: "KR",
                city: "Seoul & Gyeonggi-do",
                event: "Yale Model United Nations Korea (YMUN Korea)",
                type: "YMUN",
                visits: "2x Visited",
                year: 2025,
                date: "2018 / Nov 28 – Dec 1, 2025",
                flag: "",
                description: "AMISians proudly participated in Yale Model United Nations Korea in Gyeonggi-do (2018) and YMUN Korea XIII in Seoul (2025). Represented by delegates Prince Kashmir Buisan, Ommie Huniy Bandigan, and Abigail Maryam Salam under advisors Teacher Anna Marie Bonsadan and Teacher Jessa Mae Recla.",
                video: "",
                images: [
                    "/images/global-community/poster_korea_2018.jpg",
                    "/images/global-community/ymun_korea_1.jpg",
                    "/images/global-community/ymun_korea_2.jpg",
                    "/images/global-community/ymun_korea_3.jpg",
                    "/images/global-community/ymun_korea_4.png",
                    "/images/global-community/ymun_korea_5.png"
                ]
            },
            {
                country: "Malaysia",
                code: "MY",
                city: "Kuala Lumpur",
                event: "ADNI International Students Conference",
                type: "Conference",
                visits: "2x Visited",
                year: 2026,
                date: "Sept 1–5, 2024 / July 2026",
                flag: "",
                description: "AMIS delegates joined the ADNI International Students Conference at Eastin Hotel, Kuala Lumpur in 2024 and 2026. Delegate Joric Abdul Haqq Cabrera won two major honors — Best Speaker Award and Best Innovative Award! We also commend Sharif Ilmas Lepail and Teacher Ethel Lorraine Justiniane.",
                video: "",
                images: [
                    "/images/global-community/poster_malaysia_2024.jpg",
                    "/images/global-community/adni_conference_2026.png"
                ]
            },
            {
                country: "Japan",
                code: "JP",
                city: "Fukuoka, Tokyo & Kyoto",
                event: "West Japan Model United Nations 2025 (WJMUN)",
                type: "MUN",
                visits: "2x Visited",
                year: 2025,
                date: "April 11–13, 2025 / Nov 2025",
                flag: "",
                description: "AMIS student delegates represented the school and the Philippines at West Japan Model United Nations (WJMUN 2025) in Fukuoka, Japan. Under the theme 'Empowering Muslim Youth Through Faith and Knowledge: Strengthening Iman, Inspiring Leadership, Uniting the Ummah'.",
                video: "",
                images: [
                    "/images/global-community/poster_japan_2025.jpg"
                ]
            },
            {
                country: "United Arab Emirates",
                code: "AE",
                city: "Dubai",
                event: "American School of Dubai Model United Nations 2023 (ASD MUN VIII)",
                type: "MUN",
                visits: "1x Visited",
                year: 2023,
                date: "April 7–9, 2023",
                flag: "",
                description: "Al Munawwara Islamic School delegates represented Davao City and the Philippines at the American School of Dubai Model United Nations (ASD MUN VIII) in Al Barsha 1, Dubai, U.A.E. This prestigious conference brought together young Muslim leaders across ASEAN and the Middle East.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Algeria",
                code: "DZ",
                city: "Algiers",
                event: "International Youth Delegation 2021",
                type: "Conference",
                visits: "1x Visited",
                year: 2021,
                date: "2021",
                flag: "",
                description: "AMIS International Youth Delegation 2021 represented by distinguished student delegate Hayah C. Mama, participating in global educational and leadership exchange programs.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Oman",
                code: "OM",
                city: "Muscat",
                event: "International Youth Delegation 2021",
                type: "Conference",
                visits: "1x Visited",
                year: 2021,
                date: "2021",
                flag: "",
                description: "AMIS International Youth Delegation 2021 represented by delegate Nadene Yaera S. Balilo, connecting young Muslim leaders across Middle Eastern and ASEAN educational forums.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "United Kingdom",
                code: "GB",
                city: "London",
                event: "International Youth Delegation 2021",
                type: "Conference",
                visits: "1x Visited",
                year: 2021,
                date: "2021",
                flag: "",
                description: "AMIS International Youth Delegation 2021 represented by delegates Eman M. Silongan and Mashaell P. Deligos, promoting global academic exchange and diplomatic relations.",
                video: "",
                images: [
                    "/images/global-community/poster_usa_2018.jpg"
                ]
            },
            {
                country: "China",
                code: "CN",
                city: "Beijing",
                event: "International Youth Delegation 2021",
                type: "Conference",
                visits: "1x Visited",
                year: 2021,
                date: "2021",
                flag: "",
                description: "AMIS International Youth Delegation 2021 represented by delegates Shakir A. Daham and Helena M. Sabandal, participating in East Asian international student forums.",
                video: "",
                images: [
                    "/images/global-community/poster_japan_2025.jpg"
                ]
            },
            {
                country: "Egypt",
                code: "EG",
                city: "Cairo",
                event: "International Youth Delegation 2021",
                type: "Conference",
                visits: "1x Visited",
                year: 2021,
                date: "2021",
                flag: "",
                description: "AMIS International Youth Delegation 2021 represented by delegate Renz P. Benamira, engaging in Islamic scholarship and cultural exchange programs.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Qatar",
                code: "QA",
                city: "Doha",
                event: "Youth Model United Nations (YMUN)",
                type: "YMUN",
                visits: "1x Visited",
                year: 2026,
                date: "January 2026",
                flag: "",
                description: "AMIS students traveled to Doha, Qatar, to participate in the Youth Model United Nations, discussing global challenges, developing leadership skills, and building international friendships.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Singapore",
                code: "SG",
                city: "Singapore",
                event: "STEM & Innovation Challenge",
                type: "Competition",
                visits: "1x Visited",
                year: 2023,
                date: "October 2023",
                flag: "",
                description: "AMIS students competed in the regional STEM and Innovation Challenge held in Singapore. Our team presented creative solutions for urban sustainability.",
                video: "",
                images: [
                    "/images/global-community/poster_japan_2025.jpg"
                ]
            },
            {
                country: "Turkey",
                code: "TR",
                city: "Istanbul",
                event: "International Youth Leadership Summit",
                type: "Conference",
                visits: "1x Visited",
                year: 2024,
                date: "May 2024",
                flag: "",
                description: "AMIS student delegates represented Davao City at the International Youth Leadership Summit in Istanbul, Turkey, exploring historic Islamic heritage sites and ASEAN youth leadership.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Libya",
                code: "LY",
                city: "Tripoli",
                event: "North African Youth Leadership Summit",
                type: "Conference",
                visits: "1x Visited",
                year: 2024,
                date: "August 2024",
                flag: "",
                description: "AMIS student leaders connected with youth delegates across North Africa in Tripoli, Libya, participating in global workshops focused on youth empowerment and Islamic governance.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Greece",
                code: "GR",
                city: "Athens",
                event: "Mediterranean International Model UN (MedMUN)",
                type: "MUN",
                visits: "1x Visited",
                year: 2025,
                date: "March 2025",
                flag: "",
                description: "AMIS delegates represented the Philippines at the Mediterranean International Model United Nations in Athens, Greece, engaging in maritime diplomacy.",
                video: "",
                images: [
                    "/images/global-community/poster_usa_2018.jpg"
                ]
            },
            {
                country: "Afghanistan",
                code: "AF",
                city: "Kabul",
                event: "South & Central Asian Youth Educational Summit",
                type: "Conference",
                visits: "1x Visited",
                year: 2024,
                date: "October 2024",
                flag: "",
                description: "AMIS student leaders joined Central and South Asian student representatives in an international conference advocating for educational access and youth mentorship.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "Costa Rica",
                code: "CR",
                city: "San José",
                event: "Global Youth Environmental Summit",
                type: "Competition",
                visits: "1x Visited",
                year: 2025,
                date: "June 2025",
                flag: "",
                description: "AMIS delegates traveled to San José, Costa Rica, for the Global Youth Environmental Summit, presenting eco-friendly green technology proposals.",
                video: "",
                images: [
                    "/images/global-community/poster_usa_2018.jpg"
                ]
            },
            {
                country: "Bahrain",
                code: "BH",
                city: "Manama",
                event: "Gulf Youth Leadership Conference",
                type: "YMUN",
                visits: "1x Visited",
                year: 2023,
                date: "November 2023",
                flag: "",
                description: "AMIS delegates joined fellow youth diplomats at the Gulf International Youth Leadership Conference in Manama, Bahrain.",
                video: "",
                images: [
                    "/images/global-community/poster_dubai_2023.jpg"
                ]
            },
            {
                country: "North Korea",
                code: "KP",
                city: "Pyongyang",
                event: "East Asia Youth Peace Forum",
                type: "Conference",
                visits: "1x Visited",
                year: 2025,
                date: "September 2025",
                flag: "",
                description: "AMIS student representatives participated in the East Asia Youth Peace Forum, promoting youth diplomacy and regional harmony.",
                video: "",
                images: [
                    "/images/global-community/poster_korea_2018.jpg"
                ]
            }
        ];

        // ----------------------------------------------------
        // SVG Map Configuration & Drawing
        // ----------------------------------------------------
        const mapSvg = document.getElementById('world-map');
        
        if (mapSvg) {
            // Apply standard IDs and classes to map countries
            destinations.forEach(dest => {
                const countryEl = mapSvg.getElementById(dest.code.toLowerCase());
                if (countryEl) {
                    countryEl.classList.add('visited');
                }
            });

            // Highlight the Philippines
            const phEl = mapSvg.getElementById('ph');
            if (phEl) {
                phEl.classList.add('philippines');
            }

            // Create SVG overlays (Flight Paths, Planes, and Pins)
            const flightGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            flightGroup.id = 'flight-paths-overlay';

            const pinGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            pinGroup.id = 'pins-overlay';

            // Coordinates in SVG ViewBox space
            const phCoords = { x: 705, y: 490 };
            const coords = {
                'US': { x: 190, y: 410, controlX: 447.5, controlY: 300 },
                'AE': { x: 530, y: 469, controlX: 618, controlY: 430 },
                'QA': { x: 527.5, y: 464, controlX: 616.25, controlY: 417 },
                'KR': { x: 696, y: 413, controlX: 705, controlY: 450 },
                'JP': { x: 718, y: 405, controlX: 711.5, controlY: 440 },
                'MY': { x: 650, y: 515, controlX: 677.5, controlY: 502.5 },
                'SG': { x: 659, y: 527.5, controlX: 682, controlY: 508.75 },
                'TR': { x: 476, y: 424, controlX: 620, controlY: 380 },
                'LY': { x: 440, y: 465, controlX: 580, controlY: 420 },
                'GR': { x: 460, y: 425, controlX: 600, controlY: 380 },
                'AF': { x: 552, y: 440, controlX: 630, controlY: 420 },
                'CR': { x: 200, y: 504, controlX: 450, controlY: 350 },
                'BH': { x: 526, y: 460, controlX: 615, controlY: 420 },
                'KP': { x: 690, y: 405, controlX: 700, controlY: 430 }
            };

            destinations.forEach(dest => {
                const coord = coords[dest.code];
                if (coord) {
                    // Create flight line path element
                    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    const d = `M ${phCoords.x},${phCoords.y} Q ${coord.controlX},${coord.controlY} ${coord.x},${coord.y}`;
                    path.setAttribute('d', d);
                    path.setAttribute('class', 'flight-line');
                    path.setAttribute('id', `flight-${dest.code}`);
                    flightGroup.appendChild(path);

                    // Create airplane path animation follower
                    const plane = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    plane.setAttribute('d', 'M12 2L2 22l10-4 10 4z'); // standard SVG plane arrow path
                    plane.setAttribute('class', 'airplane-marker');
                    plane.setAttribute('id', `plane-marker-${dest.code.toLowerCase()}`);
                    plane.setAttribute('transform', 'scale(0.5) translate(-12, -12)');
                    flightGroup.appendChild(plane);

                    // Create pin coordinates container
                    const pin = document.createElementNS('http://www.w3.org/2000/svg', 'g');
                    pin.setAttribute('class', 'map-pin');
                    pin.setAttribute('transform', `translate(${coord.x}, ${coord.y})`);
                    pin.setAttribute('data-code', dest.code);

                    // Pulse ring animation
                    const ring = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    ring.setAttribute('cx', '0');
                    ring.setAttribute('cy', '0');
                    ring.setAttribute('r', '10');
                    ring.setAttribute('fill', 'none');
                    ring.setAttribute('stroke', '#d4af37');
                    ring.setAttribute('stroke-width', '1.5');
                    ring.setAttribute('class', 'pulse-ring');
                    pin.appendChild(ring);

                    // Pin dot
                    const dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    dot.setAttribute('cx', '0');
                    dot.setAttribute('cy', '0');
                    dot.setAttribute('r', '4');
                    dot.setAttribute('fill', '#d4af37');
                    dot.setAttribute('stroke', '#ffffff');
                    dot.setAttribute('stroke-width', '1');
                    pin.appendChild(dot);

                    pinGroup.appendChild(pin);
                }
            });

            // Inject group layers
            mapSvg.appendChild(flightGroup);
            mapSvg.appendChild(pinGroup);
        }

        // ----------------------------------------------------
        // Hover Tooltip logic on map elements
        // ----------------------------------------------------
        const tooltip = document.getElementById('map-tooltip');
        const mapContainer = document.querySelector('.map-container');

        function showTooltip(evt, text) {
            tooltip.innerHTML = text;
            tooltip.style.display = 'block';
            positionTooltip(evt);
        }

        function positionTooltip(evt) {
            const rect = mapContainer.getBoundingClientRect();
            const x = evt.clientX - rect.left;
            const y = evt.clientY - rect.top;
            tooltip.style.left = `${x}px`;
            tooltip.style.top = `${y}px`;
        }

        function hideTooltip() {
            tooltip.style.display = 'none';
        }

        // Attach listeners to country paths and pins
        if (mapSvg) {
            destinations.forEach(dest => {
                const el = mapSvg.getElementById(dest.code.toLowerCase());
                if (el) {
                    el.addEventListener('mouseenter', (e) => showTooltip(e, `<strong>${dest.country}</strong> <span class="bg-amber-100 text-amber-900 text-[10px] font-black px-1.5 py-0.5 rounded ml-1">${dest.visits || '1x Visited'}</span><br>${dest.event}`));
                    el.addEventListener('mousemove', positionTooltip);
                    el.addEventListener('mouseleave', hideTooltip);
                }
            });

            // Pins hover listeners
            document.querySelectorAll('.map-pin').forEach(pin => {
                const code = pin.getAttribute('data-code');
                const dest = destinations.find(d => d.code === code);
                if (dest) {
                    pin.addEventListener('mouseenter', (e) => showTooltip(e, `<strong>${dest.country}</strong> <span class="bg-amber-100 text-amber-900 text-[10px] font-black px-1.5 py-0.5 rounded ml-1">${dest.visits || '1x Visited'}</span><br>${dest.event}`));
                    pin.addEventListener('mousemove', positionTooltip);
                    pin.addEventListener('mouseleave', hideTooltip);
                }
            });
        }

        // ----------------------------------------------------
        // Timeline Synchronization
        // ----------------------------------------------------
        const timelineItems = document.querySelectorAll('.timeline-item');
        const timelineProgress = document.getElementById('timeline-progress');

        function updateTimelineProgress(index) {
            const pct = (index / (timelineItems.length - 1)) * 100;
            timelineProgress.style.width = `${pct}%`;
        }

        timelineItems.forEach(item => {
            item.addEventListener('click', function() {
                const idx = parseInt(this.getAttribute('data-index'));
                timelineItems.forEach(ti => ti.classList.remove('active'));
                this.classList.add('active');
                updateTimelineProgress(idx);
            });
        });

        // ----------------------------------------------------
        // Masonry Gallery Population & Filtering
        // ----------------------------------------------------
        const galleryGrid = document.getElementById('gallery-grid');
        
        // Flatten destinations image galleries with matching types (Deduplicated)
        const seenUrls = new Set();
        const allGalleryImages = [];
        destinations.forEach(dest => {
            dest.images.forEach((imgUrl, i) => {
                if (!seenUrls.has(imgUrl)) {
                    seenUrls.add(imgUrl);
                    allGalleryImages.push({
                        url: imgUrl,
                        type: dest.type,
                        country: dest.country,
                        city: dest.city,
                        title: dest.event,
                        code: dest.code,
                        visits: dest.visits || '1x Visited'
                    });
                }
            });
        });

        // Render photos
        function renderGallery(filterType = 'all') {
            galleryGrid.innerHTML = '';
            const filtered = filterType === 'all' 
                ? allGalleryImages 
                : allGalleryImages.filter(img => img.type.toLowerCase().includes(filterType.toLowerCase()));

            filtered.forEach(img => {
                const item = document.createElement('div');
                item.className = 'gallery-item relative';
                item.setAttribute('data-type', img.type);

                item.innerHTML = `
                    <img src="${img.url}" alt="${img.title}" loading="lazy" />
                    <span class="absolute top-3 right-3 bg-amber-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full shadow-md z-10">${img.visits}</span>
                    <div class="gallery-overlay">
                        <span class="bg-[#d4af37] text-slate-900 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded mb-2 w-max">
                            ${img.type}
                        </span>
                        <h4 class="text-sm font-bold text-white mb-0.5 leading-tight">${img.city}, ${img.country}</h4>
                        <p class="text-slate-350 text-[11px] font-medium truncate">${img.title}</p>
                    </div>
                `;
                galleryGrid.appendChild(item);
            });
        }

        renderGallery();

        // Filtering controls click events
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                renderGallery(this.getAttribute('data-filter'));
            });
        });

        // ----------------------------------------------------
        // Stats Counters Animation
        // ----------------------------------------------------
        const stats = {
            'counter-countries': 19,
            'counter-delegates': 60,
            'counter-mun': 15,
            'counter-awards': 10
        };

        function animateCounters() {
            Object.keys(stats).forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                const target = stats[id];
                let current = 0;
                const duration = 2000; // 2 seconds
                const stepTime = Math.abs(Math.floor(duration / target));
                
                const timer = setInterval(() => {
                    current += 1;
                    el.textContent = current + "+";
                    if (current >= target) {
                        el.textContent = target + "+";
                        clearInterval(timer);
                    }
                }, stepTime);
            });
        }

        // Run counter animation immediately on page load
        animateCounters();

        gsap.from('.map-container', {
            scrollTrigger: {
                trigger: '.map-container',
                start: 'top 80%'
            },
            opacity: 0,
            scale: 0.95,
            duration: 1,
            ease: 'power2.out'
        });

        gsap.from('.timeline-item', {
            scrollTrigger: {
                trigger: '.timeline-container',
                start: 'top 85%'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out'
        });
    });
</script>
@endsection
