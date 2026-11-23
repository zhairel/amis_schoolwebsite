@extends('layouts.app')

@section('title', 'Al Munawwara Islamic School')

@section('styles')
<style>
    /* Hero Section CSS */
    :root {
        --header-height: 125px;
    }
    .hero {
        position: relative;
        width: 100%;
        height: calc(100vh - var(--header-height, 125px));
        height: calc(100dvh - var(--header-height, 125px));
        min-height: calc(100vh - var(--header-height, 125px));
        min-height: calc(100dvh - var(--header-height, 125px));
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: #022c22;
    }
    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        z-index: 0;
    }
    .hero-video:fullscreen,
    .hero-video:-webkit-full-screen {
        object-fit: contain;
        background: #000;
        z-index: 999999;
    }
    .hero-slideshow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }
    .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    .hero-image.active {
        opacity: 1;
    }
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        color: white;
    }
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    .hero-subtitle {
        font-size: 1.35rem;
        margin-bottom: 40px;
        opacity: 0.95;
    }
    .btn-hero {
        background: white;
        color: var(--primary);
        padding: 14px 40px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: 2px solid white;
        display: inline-block;
    }
    .btn-hero:hover {
        background: transparent;
        color: white;
        transform: translateY(-2px);
    }
    .slide-indicators {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }
    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        padding: 0;
    }
    .indicator.active {
        background: white;
        width: 32px;
        border-radius: 6px;
    }

    /* Scroll Down Indicator */
    .hero-scroll-down {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }
    .hero-scroll-down:hover {
        color: #ffffff;
        transform: translateX(-50%) translateY(3px);
    }
    .scroll-mouse {
        width: 22px;
        height: 34px;
        border: 2px solid rgba(255, 255, 255, 0.7);
        border-radius: 12px;
        position: relative;
        display: flex;
        justify-content: center;
        transition: border-color 0.3s;
    }
    .hero-scroll-down:hover .scroll-mouse {
        border-color: #34d399;
    }
    .scroll-wheel {
        width: 3px;
        height: 6px;
        background: #34d399;
        border-radius: 2px;
        position: absolute;
        top: 6px;
        animation: scroll-wheel-anim 1.8s infinite ease-in-out;
    }
    @keyframes scroll-wheel-anim {
        0% { opacity: 1; transform: translateY(0); }
        50% { opacity: 0.3; transform: translateY(10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .scroll-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        opacity: 0.85;
    }

    /* News layout & card CSS */
    .news-announcements {
        background: var(--bg-light);
    }
    .news-layout {
        display: block;
        margin-top: 40px;
    }
    .facebook-balloon-container {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 2px solid rgba(5, 150, 105, 0.1);
        display: flex;
        flex-direction: column;
        height: 680px;
    }
    .balloon-header {
        background: linear-gradient(135deg, var(--primary) 0%, #047857 100%);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
        font-weight: 700;
    }
    .balloon-content {
        padding: 15px;
        background: white;
        flex-grow: 1;
        overflow: hidden;
    }
    .balloon-content iframe {
        width: 100%;
        height: 100%;
        border-radius: 12px;
    }
    .announcements-column {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
        gap: 24px;
        align-items: stretch;
    }
    .news-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        border-top: 4px solid #059669;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        width: 100%;
    }
    .news-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary);
        box-shadow: 0 14px 30px rgba(5, 150, 105, 0.12);
    }
    .news-image {
        width: 100%;
        aspect-ratio: 16 / 10;
        background: #f1f5f9;
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #f1f5f9;
    }
    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .news-card:hover .news-image img {
        transform: scale(1.03);
    }
    .news-cat-pill {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 4;
        background: rgba(15, 23, 42, 0.8);
        color: #ffffff;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .news-photo-count {
        position: absolute;
        bottom: 10px;
        right: 10px;
        z-index: 4;
        background: rgba(15, 23, 42, 0.78);
        color: #ffffff;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }
    .news-content {
        padding: 20px 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
        flex-grow: 1;
    }
    .news-date {
        color: #64748b;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .news-card h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        margin: 6px 0 8px;
        line-height: 1.35;
        text-wrap: balance;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-excerpt {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.6;
        margin: 0;
        text-wrap: pretty;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-card-footer {
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-top: 4px;
    }
    .news-author-tag {
        font-size: 0.78rem;
        color: #64748b;
        font-weight: 600;
    }
    .news-link {
        color: var(--primary);
        font-weight: 800;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Calendar CSS */
    .calendar-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .calendar-container {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        display: grid;
        grid-template-columns: 150px 1fr;
        height: 600px;
        overflow: hidden;
    }
    .month-sidebar {
        background: var(--primary);
        color: white;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .month-vertical {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        margin-bottom: 16px;
    }
    .month-letter {
        font-size: 2rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .month-year {
        font-size: 1.125rem;
        font-weight: 500;
        margin-bottom: 30px;
    }
    .month-nav {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: auto;
    }
    .nav-btn-small {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    .nav-btn-small:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.3);
    }
    .nav-btn-small:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    .calendar-area {
        padding: 40px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .calendar-wrapper {
        width: 100%;
        max-width: 700px;
        height: 100%;
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-template-rows: auto repeat(6, 1fr);
        gap: 8px;
        width: 100%;
        height: 100%;
    }
    .day-header {
        text-align: center;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-light);
        padding: 12px 4px;
        text-transform: uppercase;
    }
    .day-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-direction: column;
        padding: 8px;
        font-size: 1rem;
        font-weight: 500;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        transition: all 0.2s ease;
    }
    .day-cell.has-events {
        border-color: var(--primary);
        background: rgba(5, 150, 105, 0.05);
    }
    .day-number {
        font-size: 1.3rem;
        font-weight: 700;
    }
    .day-cell.empty {
        background: transparent;
        border: none;
    }
    .event-counter {
        align-self: flex-end;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .event-counter:hover {
        background: #047857;
        transform: scale(1.1);
    }
    .event-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1010;
        padding: 20px;
    }
    .event-modal-content {
        background: white;
        border-radius: 16px;
        padding: 32px;
        max-width: 500px;
        width: 100%;
        border: 1px solid #cbd5e1;
        position: relative;
    }
    .event-modal-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 20px;
    }
    .event-list-modal {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .event-item-modal {
        padding: 16px;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }
    .event-item-modal.brigada { background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); }
    .event-item-modal.opening { background: linear-gradient(135deg, var(--primary) 0%, #10b981 100%); }
    .event-item-modal.test { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); }
    .event-item-modal.exam { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
    .event-item-modal.holiday { background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); }
    .event-item-modal.endterm { background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%); }

    /* Photo Album gallery CSS */
    .photo-album {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        position: relative;
        overflow: hidden;
    }
    .album-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .album-slideshow {
        position: relative;
        width: 100%;
        aspect-ratio: 1;
        overflow: hidden;
        background: #111827; /* Dark background placeholder */
    }
    
    /* Shimmering Skeleton Loader */
    .album-slideshow::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            #111827 25%,
            #1f2937 50%,
            #111827 75%
        );
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite linear;
        z-index: 2;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }
    
    /* Fade out skeleton once the active image has loaded */
    .album-slideshow.img-loaded::before {
        opacity: 0;
    }
    
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    /* Center loading spinner */
    .album-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 32px;
        height: 32px;
        border: 3px solid rgba(255, 255, 255, 0.1);
        border-top-color: #d97706; /* Gold brand accent */
        border-radius: 50%;
        animation: spin 1s infinite linear;
        z-index: 3;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .album-slideshow.img-loaded .album-spinner {
        opacity: 0;
    }
    
    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .album-slide-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        z-index: 1;
    }
    .album-slide-img.active.loaded {
        opacity: 1;
    }
    .slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30, 126, 52, 0.85) 0%, rgba(5, 150, 105, 0.75) 50%, rgba(16, 185, 129, 0.65) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
        padding: 20px;
        text-align: center;
        z-index: 5;
    }
    .album-slideshow:hover .slide-overlay {
        opacity: 1;
    }
    .album-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }
    .album-slideshow:hover .album-title {
        transform: translateY(0);
    }

    /* Responsiveness adjustments */
    @media (max-width: 968px) {
        .news-layout {
            grid-template-columns: 1fr;
        }
        .hero {
            height: calc(100dvh - var(--header-height, 100px));
            min-height: calc(100dvh - var(--header-height, 100px));
        }
        .hero-title {
            font-size: 2.25rem;
        }
        .hero-subtitle {
            font-size: 1.1rem;
        }
        .calendar-container {
            grid-template-columns: 1fr;
            height: auto;
        }
        .month-sidebar {
            flex-direction: row;
            justify-content: space-between;
            padding: 20px;
        }
        .month-vertical {
            flex-direction: row;
            margin-bottom: 0;
        }
        .month-year {
            margin-bottom: 0;
        }
        .month-nav {
            flex-direction: row;
            margin-top: 0;
        }
        .album-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .hero {
            height: calc(100dvh - var(--header-height, 90px));
            min-height: calc(100dvh - var(--header-height, 90px));
        }
        .hero-scroll-down {
            display: none;
        }
        .announcements-column {
            grid-template-columns: 1fr;
        }
        .album-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-height: 600px) {
        .hero {
            height: auto;
            min-height: 520px;
            padding: 50px 0;
        }
        .hero-scroll-down {
            display: none;
        }
    }
    

    /* School Notices Section CSS */
    .school-notices {
        background: white;
    }
    .school-notices-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        align-items: stretch;
    }
    .notice-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 15px rgba(0,0,0,0.035);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .notice-card-media {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: #f1f5f9;
        overflow: hidden;
        border-bottom: 1px solid #f1f5f9;
    }
    .notice-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .notice-card:hover .notice-card-media img {
        transform: scale(1.03);
    }
    .notice-card-body {
        padding: 22px 22px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }
    .notice-card:hover {
        transform: translateY(-4px);
        border-color: #059669 !important;
        box-shadow: 0 12px 28px rgba(5, 150, 105, 0.09) !important;
    }
    .notice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        flex-wrap: nowrap;
        gap: 8px;
    }
    .notice-badge {
        padding: 4px 11px;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }
    .notice-date {
        font-size: 0.77rem;
        color: #64748b;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .notice-title {
        font-size: 1.22rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.35;
        margin-bottom: 12px;
        letter-spacing: -0.3px;
    }
    .notice-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .notice-title a:hover {
        color: #059669;
    }
    .notice-excerpt {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.65;
        margin: 0 0 20px 0;
    }
    .notice-footer {
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }
    .notice-author {
        font-size: 0.76rem;
        color: #94a3b8;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .notice-read-more {
        color: #059669;
        font-weight: 800;
        font-size: 0.86rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s ease;
    }
    .notice-read-more:hover {
        color: #047857;
        transform: translateX(3px);
    }
    .notice-empty-state {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 18px;
        padding: 50px 24px;
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
    }
    .notice-empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        color: #059669;
    }
    @media (max-width: 768px) {
        .school-notices-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }

    /* ══════════════════════════════════════════════════════════════════ */
    /*        AMIS-GEM 2026 OFFICIAL COUNTDOWN SHOWCASE SECTION           */
    /* ══════════════════════════════════════════════════════════════════ */
    .amis-gem-showcase {
        position: relative;
        background: radial-gradient(ellipse at 50% -10%, #064e3b 0%, #022c22 65%, #011913 100%);
        color: #ffffff;
        padding: 60px 0;
        overflow: hidden;
        border-bottom: 2px solid rgba(250, 204, 21, 0.25);
        box-shadow: inset 0 20px 40px rgba(0, 0, 0, 0.4);
    }
    .gem-showcase-bg-layer {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
        z-index: 0;
    }
    .gem-bg-glow-emerald {
        position: absolute;
        top: -100px;
        left: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.22) 0%, transparent 70%);
        filter: blur(60px);
    }
    .gem-bg-glow-gold {
        position: absolute;
        bottom: -120px;
        right: -100px;
        width: 550px;
        height: 550px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(250, 204, 21, 0.16) 0%, transparent 70%);
        filter: blur(70px);
    }
    .gem-bg-grid-mesh {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.6;
    }
    .sr-only {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        white-space: nowrap !important;
        border-width: 0 !important;
    }
    .gem-showcase-container {
        position: relative;
        z-index: 1;
    }
    .gem-showcase-content {
        max-width: 820px;
        width: 100%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 18px;
    }
    .gem-kicker-text {
        color: #facc15;
        font-size: 0.82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }
    .gem-title-banner-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        width: 100%;
        max-width: 760px;
        margin: 0 auto;
    }
    .gem-title-banner-card {
        width: 100%;
        max-width: 760px;
        display: block;
        margin: 0 auto;
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid rgba(250, 204, 21, 0.45);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4), 0 0 20px rgba(250, 204, 21, 0.15);
        background: #022c22;
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .gem-title-banner-card:hover {
        transform: translateY(-2px);
        border-color: #facc15;
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.5), 0 0 30px rgba(250, 204, 21, 0.25);
    }
    .gem-title-banner-card picture {
        display: block;
        width: 100%;
        line-height: 0;
    }
    .gem-title-banner-img {
        width: 100%;
        max-width: 100%;
        height: auto;
        display: block;
        aspect-ratio: 1024 / 256;
        object-fit: cover;
    }
    .gem-motto {
        font-size: 0.95rem;
        font-style: italic;
        color: #fde047;
        margin: 0;
        opacity: 0.9;
    }
    /* Clean Meta Strip */
    .gem-meta-strip {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        gap: 14px 24px;
        padding: 12px 24px;
        background: rgba(0, 0, 0, 0.28);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        max-width: 760px;
        width: 100%;
    }
    .gem-meta-row {
        display: flex;
        align-items: baseline;
        gap: 8px;
        font-size: 0.92rem;
    }
    .gem-meta-label {
        color: #a7f3d0;
        font-weight: 700;
        min-width: 95px;
    }
    .gem-meta-val {
        color: #ffffff;
        font-weight: 600;
    }
    .gem-meta-val.deadline {
        color: #fca5a5;
        font-weight: 700;
    }
    /* Dual Live Countdown Cards */
    .gem-dual-clocks-wrapper {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        max-width: 680px;
    }
    .gem-clock-panel {
        background: rgba(0, 0, 0, 0.38);
        border: 1.5px solid rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 14px 14px 12px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        cursor: pointer;
        transition: border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }
    .gem-clock-panel:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
    }
    .gem-clock-panel.panel-reg {
        border-color: rgba(239, 68, 68, 0.45);
        background: linear-gradient(180deg, rgba(153, 27, 27, 0.2) 0%, rgba(0, 0, 0, 0.45) 100%);
    }
    .gem-clock-panel.panel-reg:hover,
    .gem-clock-panel.panel-reg.active {
        border-color: #ef4444;
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
    }
    .gem-clock-panel.panel-comp {
        border-color: rgba(250, 204, 21, 0.35);
        background: linear-gradient(180deg, rgba(6, 78, 59, 0.25) 0%, rgba(0, 0, 0, 0.45) 100%);
    }
    .gem-clock-panel.panel-comp:hover,
    .gem-clock-panel.panel-comp.active {
        border-color: #facc15;
        box-shadow: 0 0 20px rgba(250, 204, 21, 0.25);
    }
    .gem-clock-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .gem-panel-title {
        font-weight: 800;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #ffffff;
    }
    .panel-reg .gem-panel-title {
        color: #fca5a5;
    }
    .panel-comp .gem-panel-title {
        color: #fde047;
    }
    .gem-panel-target {
        font-weight: 700;
        color: #94a3b8;
        font-size: 0.75rem;
    }
    .gem-clock-panel .gem-clock-cards-row {
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: space-between;
    }
    .gem-clock-panel .gem-clock-card {
        background: linear-gradient(180deg, #0f172a 0%, #022c22 100%);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        min-width: 0;
        flex: 1;
        padding: 9px 4px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    .panel-reg .gem-clock-card {
        border-color: rgba(239, 68, 68, 0.3);
    }
    .panel-comp .gem-clock-card {
        border-color: rgba(250, 204, 21, 0.3);
    }
    .gem-clock-panel .gem-clock-digit {
        font-family: 'Outfit', sans-serif;
        font-size: 1.85rem;
        font-weight: 900;
        line-height: 1;
        letter-spacing: -0.5px;
        font-variant-numeric: tabular-nums;
    }
    .panel-reg .gem-clock-digit {
        color: #ffffff;
        text-shadow: 0 0 12px rgba(255, 255, 255, 0.35);
    }
    .panel-comp .gem-clock-digit {
        color: #facc15;
        text-shadow: 0 0 12px rgba(250, 204, 21, 0.35);
    }
    .gem-clock-panel .gem-clock-unit {
        font-size: 0.6rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        margin-top: 4px;
        text-transform: uppercase;
    }
    .panel-reg .gem-clock-unit {
        color: #fca5a5;
    }
    .panel-comp .gem-clock-unit {
        color: #a7f3d0;
    }
    .gem-clock-panel .gem-clock-divider {
        font-size: 1.4rem;
        font-weight: 900;
        opacity: 0.6;
        margin-top: -6px;
        animation: gemPulse 1s infinite;
    }
    .panel-reg .gem-clock-divider {
        color: #f87171;
    }
    .panel-comp .gem-clock-divider {
        color: #facc15;
    }
    .gem-panel-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    .gem-panel-tag {
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #94a3b8;
    }
    .gem-panel-tag.tag-urgent {
        color: #f87171;
    }
    /* Action Buttons */
    .gem-actions-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 4px;
    }
    .btn-gem-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #facc15;
        color: #0f172a;
        font-size: 0.95rem;
        font-weight: 800;
        padding: 12px 22px;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(250, 204, 21, 0.3);
    }
    .btn-gem-primary:hover {
        background: #eab308;
        color: #000;
        transform: translateY(-2px);
    }
    .btn-gem-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        font-size: 0.92rem;
        font-weight: 700;
        padding: 11px 18px;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-gem-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: #ffffff;
        transform: translateY(-2px);
    }
    .btn-gem-outline {
        color: #6ee7b7;
        font-size: 0.92rem;
        font-weight: 700;
        text-decoration: underline;
        text-underline-offset: 4px;
        padding: 10px 4px;
        transition: color 0.2s ease;
    }
    .btn-gem-outline:hover {
        color: #a7f3d0;
    }
    @media (max-width: 680px) {
        .gem-meta-strip {
            flex-direction: column;
            gap: 8px;
            align-items: center;
            padding: 12px 16px;
        }
        .gem-dual-clocks-wrapper {
            grid-template-columns: 1fr;
        }
        .gem-clock-panel .gem-clock-digit {
            font-size: 1.7rem;
        }
    }
    @media (max-width: 600px) {
        .amis-gem-showcase {
            padding: 40px 0;
        }
        .gem-main-heading {
            font-size: 2rem;
        }
        .gem-year {
            font-size: 1.7rem;
        }
        .gem-sub-heading {
            font-size: 1.05rem;
        }
        .gem-meta-row {
            flex-direction: column;
            gap: 2px;
        }
        .gem-clock-panel {
            padding: 12px 10px;
        }
        .gem-clock-panel .gem-clock-card {
            padding: 8px 3px;
        }
        .gem-actions-row {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-gem-primary,
        .btn-gem-secondary {
            justify-content: center;
            text-align: center;
        }
        .btn-gem-outline {
            text-align: center;
        }
    }

    /* Home Accreditations & Recognitions Showcase */
    .home-accred-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-top: 20px;
    }
    .home-accred-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        padding: 30px 26px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
    }
    .home-accred-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }
    .home-accred-card.featured {
        border-color: #bbf7d0;
        background: linear-gradient(180deg, #ffffff 0%, #f0fdf4 100%);
        box-shadow: 0 4px 16px rgba(5, 150, 105, 0.06);
    }
    .home-accred-card.featured:hover {
        border-color: #059669;
        box-shadow: 0 14px 32px rgba(5, 150, 105, 0.12);
    }
    .home-accred-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 999px;
        align-self: flex-start;
        margin-bottom: 16px;
    }
    .home-accred-badge.active-tag {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }
    .home-accred-badge.global-tag {
        background: #e0e7ff;
        color: #3730a3;
        border: 1px solid #c7d2fe;
    }
    .home-accred-badge.us-tag {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
    }
    .active-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #16a34a;
        box-shadow: 0 0 0 2px rgba(22, 163, 74, 0.25);
    }
    .home-accred-icon {
        margin-bottom: 14px;
        display: flex;
        align-items: center;
    }
    .home-accred-card h3 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
        line-height: 1.35;
    }
    .home-accred-card p {
        color: #64748b;
        font-size: 0.94rem;
        line-height: 1.6;
        margin-bottom: 18px;
        flex-grow: 1;
    }
    .home-accred-meta {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 0.82rem;
        color: #475569;
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 18px;
    }
    .home-accred-link {
        color: #059669;
        font-weight: 700;
        font-size: 0.92rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s, transform 0.2s;
    }
    .home-accred-link:hover {
        color: #047857;
        transform: translateX(3px);
    }
</style>
@endsection

@section('content')
<!-- HERO SECTION -->
<section class="hero" id="homeHero">
    @if($heroType === 'video')
        <video class="hero-video" id="heroVideo" autoplay muted loop playsinline preload="auto">
            <source src="/hero_video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
        <div class="hero-slideshow" id="heroSlideshow">
            <img src="/hero1.png" alt="Slide 1" class="hero-image active">
            <img src="/hero2.png" alt="Slide 2" class="hero-image">
            <img src="/hero3.jpg" alt="Slide 3" class="hero-image">
            <img src="/hero4.jpg" alt="Slide 4" class="hero-image">
        </div>
        <div class="slide-indicators" id="slideIndicators">
            <button class="indicator active" data-slide="0"></button>
            <button class="indicator" data-slide="1"></button>
            <button class="indicator" data-slide="2"></button>
            <button class="indicator" data-slide="3"></button>
        </div>
    @endif
    
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">{{ $heroTitle }}</h1>
            <p class="hero-subtitle">{{ $heroSubtitle }}</p>
            <div class="hero-buttons">
                <a href="https://aes.amis.edu.ph" class="btn btn-hero">Enroll Now</a>
            </div>
            <!-- Early Enrollment Countdown Callout -->
            <div class="hero-enroll-callout" style="margin-top: 14px; display: inline-flex; align-items: center; gap: 8px; background: rgba(0, 0, 0, 0.65); backdrop-filter: blur(8px); padding: 7px 18px; border-radius: 999px; border: 1px solid rgba(250, 204, 21, 0.45); font-size: 0.88rem; color: #ffffff;">
                <span style="color: #facc15; font-weight: 800;">SY 2027–2028 Early Enrollment:</span>
                <span>Opens in <strong style="color: #facc15; font-weight: 800; font-variant-numeric: tabular-nums;" id="heroEnrollCountdown">19d 14h 22m</strong> (Dec 1–31, 2026 &bull; 15% Off)</span>
            </div>
        </div>
    </div>

    <!-- Sleek Scroll Down Prompt -->
    <a href="#amisGemCountdownSection" class="hero-scroll-down" aria-label="Scroll to AMIS-GEM Countdown">
        <span class="scroll-mouse">
            <span class="scroll-wheel"></span>
        </span>
        <span class="scroll-label">Scroll Down</span>
    </a>
</section>

<!-- 🏆 AMIS-GEM 2026 OFFICIAL COUNTDOWN SHOWCASE SECTION -->
<section class="section amis-gem-showcase" id="amisGemCountdownSection" aria-label="AMIS-GEM 2026 Competition Countdown">
    <div class="gem-showcase-bg-layer">
        <div class="gem-bg-glow-emerald"></div>
        <div class="gem-bg-glow-gold"></div>
        <div class="gem-bg-grid-mesh"></div>
    </div>

    <div class="container gem-showcase-container">
        <div class="gem-showcase-content">
            
            <!-- Category Kicker -->
            <div class="gem-kicker-text">International Academic Competition</div>

            <!-- Official Event Branding Graphic Banner -->
            <div class="gem-title-banner-wrapper">
                <h2 class="sr-only">AMIS-GEM 2026 - Global English and Mathematics Competition (December 13–15, 2026)</h2>
                <div class="gem-title-banner-card">
                    <picture style="display: block; width: 100%;">
                        <source srcset="{{ asset('images/amis-gem-banner.webp') }}" type="image/webp">
                        <img src="{{ asset('images/amis-gem-banner.png') }}" 
                             alt="13-15 DEC 2026 | AMIS-GEM GLOBAL ENGLISH AND MATHEMATICS COMPETITION | Calculate. Communicate. Lead." 
                             class="gem-title-banner-img" 
                             width="1024" 
                             height="256" 
                             loading="eager"
                             fetchpriority="high"
                             style="width: 100%; max-width: 100%; height: auto; display: block; aspect-ratio: 1024 / 256; object-fit: cover;">
                    </picture>
                </div>
                <p class="gem-countdown-callout" style="color: #fef08a; font-weight: 700; font-size: 0.95rem; margin: 12px 0 16px; line-height: 1.5; text-align: center;">The countdown is on! Don&rsquo;t miss your chance to join the AMIS-GEM Global English and Mathematics Competition 2026! Registration ends on November 20, 2026. Register now and secure your spot!</p>
            </div>

            <!-- Clean Event Meta Details -->
            <div class="gem-meta-strip">
                <div class="gem-meta-row">
                    <span class="gem-meta-label">Registration:</span>
                    <span class="gem-meta-val deadline">Closes November 20, 2026 (Registration Cut-off)</span>
                </div>
                <div class="gem-meta-row">
                    <span class="gem-meta-label">Event Dates:</span>
                    <span class="gem-meta-val">December 13–15, 2026</span>
                </div>
                <div class="gem-meta-row">
                    <span class="gem-meta-label">Modality:</span>
                    <span class="gem-meta-val">Hybrid (AMIS Function Hall, Davao &amp; Microsoft Teams)</span>
                </div>
            </div>

            <!-- Dual Live Countdown Clocks -->
            <div class="gem-dual-clocks-wrapper" id="gemShowcaseClock" aria-live="polite">
                
                <!-- Clock 1: Registration Deadline (High Priority - Nov 20) -->
                <div class="gem-clock-panel panel-reg active">
                    <div class="gem-clock-panel-header">
                        <span class="gem-panel-title">End of Registration</span>
                        <span class="gem-panel-target">Nov 20, 2026</span>
                    </div>
                    <div class="gem-clock-cards-row" aria-label="Registration deadline countdown">
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="regDays">09</div>
                            <div class="gem-clock-unit">DAYS</div>
                        </div>
                        <div class="gem-clock-divider">:</div>
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="regHours">00</div>
                            <div class="gem-clock-unit">HOURS</div>
                        </div>
                        <div class="gem-clock-divider">:</div>
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="regMinutes">00</div>
                            <div class="gem-clock-unit">MINS</div>
                        </div>
                        <div class="gem-clock-divider">:</div>
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="regSeconds">00</div>
                            <div class="gem-clock-unit">SECS</div>
                        </div>
                    </div>
                    <div class="gem-panel-footer">
                        <span class="gem-panel-tag tag-urgent" id="regBadgeTag">9 DAYS LEFT</span>
                    </div>
                </div>

                <!-- Clock 2: Competition Opens (Dec 13) -->
                <div class="gem-clock-panel panel-comp active">
                    <div class="gem-clock-panel-header">
                        <span class="gem-panel-title">Competition Opens</span>
                        <span class="gem-panel-target">Dec 13, 2026</span>
                    </div>
                    <div class="gem-clock-cards-row" aria-label="Competition start countdown">
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="compDays">32</div>
                            <div class="gem-clock-unit">DAYS</div>
                        </div>
                        <div class="gem-clock-divider">:</div>
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="compHours">00</div>
                            <div class="gem-clock-unit">HOURS</div>
                        </div>
                        <div class="gem-clock-divider">:</div>
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="compMinutes">00</div>
                            <div class="gem-clock-unit">MINS</div>
                        </div>
                        <div class="gem-clock-divider">:</div>
                        <div class="gem-clock-card">
                            <div class="gem-clock-digit" id="compSeconds">00</div>
                            <div class="gem-clock-unit">SECS</div>
                        </div>
                    </div>
                    <div class="gem-panel-footer">
                        <span class="gem-panel-tag" id="compBadgeTag">32 DAYS TO GO</span>
                    </div>
                </div>

            </div>

            <!-- Clean Action Buttons -->
            <div class="gem-actions-row">
                <a href="https://tinyurl.com/4jeh7yr5" target="_blank" rel="noopener noreferrer" class="btn-gem-primary">
                    Pre-Register Online →
                </a>
                <a href="https://tinyurl.com/26av23dd" target="_blank" rel="noopener noreferrer" class="btn-gem-secondary">
                    Guidelines &amp; Mechanics
                </a>
                <a href="{{ route('announcement.show', 276) }}" class="btn-gem-outline">
                    View Announcement →
                </a>
            </div>

        </div>
    </div>
</section>

<!-- 1. SCHOOL NOTICES -->
<section class="section school-notices" id="schoolNotices" style="padding: 70px 0; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 720px; margin: 0 auto 40px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                <span style="display: inline-flex; align-items: center; gap: 6px; background: #ecfdf5; color: #059669; padding: 5px 14px; border-radius: 999px; font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: 1px solid #a7f3d0;">
                    <span style="display: inline-block; width: 7px; height: 7px; background: #059669; border-radius: 50%; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);"></span>
                    Official School Bulletin
                </span>
            </div>
            <h2 class="section-title" style="margin-bottom: 10px; font-size: 2.25rem; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">School Notices</h2>
            <p class="section-subtitle" style="color: #64748b; font-size: 1.02rem; margin: 0; line-height: 1.6;">Official school advisories, administrative notices, important reminders, and school-wide announcements</p>
        </div>

        @if(isset($schoolNotices) && $schoolNotices->count() > 0)
            <div class="school-notices-grid" @if($schoolNotices->count() === 1) style="max-width: 680px; margin: 0 auto;" @endif>
                @foreach($schoolNotices as $notice)
                    @php
                        $categoryLower = strtolower($notice->category ?? '');
                        $titleLower = strtolower($notice->title ?? '');

                        $noticeImgs = json_decode($notice->image ?? '', true);
                        $noticeImg = is_array($noticeImgs) ? ($noticeImgs[0] ?? null) : $notice->image;
                        // For AMIS-GEM main notice (#276), prefer the clean competition poster instead of the expired "9 Days Left" countdown graphic
                        if (str_contains($titleLower, 'amis-gem') && is_array($noticeImgs)) {
                            foreach ($noticeImgs as $candidateImg) {
                                if (str_contains($candidateImg, 'international')) {
                                    $noticeImg = $candidateImg;
                                    break;
                                }
                            }
                        }

                        // Semantic category chip & accent colors tailored to the notice topic
                        if (str_contains($titleLower, 'holiday')) {
                            $chipLabel = 'Holiday Advisory';
                            $accentColor = '#059669';
                            $badgeBg = '#ecfdf5';
                            $badgeColor = '#047857';
                            $badgeBorder = '#a7f3d0';
                            $chipIcon = 'calendar';
                        } elseif (str_contains($titleLower, 'musabaqah') || str_contains($titleLower, 'qur\'an')) {
                            $chipLabel = 'International Event';
                            $accentColor = '#059669';
                            $badgeBg = '#ecfdf5';
                            $badgeColor = '#047857';
                            $badgeBorder = '#a7f3d0';
                            $chipIcon = 'globe';
                        } elseif (str_contains($titleLower, 'enrollment')) {
                            $chipLabel = 'Admissions Advisory';
                            $accentColor = '#16a34a';
                            $badgeBg = '#f0fdf4';
                            $badgeColor = '#15803d';
                            $badgeBorder = '#bbf7d0';
                            $chipIcon = 'academic';
                        } elseif (str_contains($titleLower, 'amis-gem') || str_contains($titleLower, 'competition')) {
                            $chipLabel = 'Academic Competition';
                            $accentColor = '#2563eb';
                            $badgeBg = '#eff6ff';
                            $badgeColor = '#1d4ed8';
                            $badgeBorder = '#bfdbfe';
                            $chipIcon = 'award';
                        } elseif (str_contains($titleLower, 'summative') || str_contains($titleLower, 'schedule') || str_contains($titleLower, 'exam')) {
                            $chipLabel = 'Academic Schedule';
                            $accentColor = '#4f46e5';
                            $badgeBg = '#eef2ff';
                            $badgeColor = '#4338ca';
                            $badgeBorder = '#c7d2fe';
                            $chipIcon = 'calendar';
                        } elseif (str_contains($categoryLower, 'reminder') || str_contains($titleLower, 'reminder')) {
                            $chipLabel = 'Islamic Reminder';
                            $accentColor = '#0d9488';
                            $badgeBg = '#f0fdfa';
                            $badgeColor = '#0f766e';
                            $badgeBorder = '#99f6e4';
                            $chipIcon = 'book';
                        } elseif (str_contains($titleLower, 'heat index') || str_contains($titleLower, 'safety')) {
                            $chipLabel = 'Safety Advisory';
                            $accentColor = '#d97706';
                            $badgeBg = '#fffbeb';
                            $badgeColor = '#b45309';
                            $badgeBorder = '#fde68a';
                            $chipIcon = 'shield';
                        } else {
                            $chipLabel = $notice->category ?: 'Official Notice';
                            $accentColor = '#059669';
                            $badgeBg = '#ecfdf5';
                            $badgeColor = '#065f46';
                            $badgeBorder = '#a7f3d0';
                            $chipIcon = 'doc';
                        }

                        // Clean, complete, human-friendly notice description (never cuts off mid-word or starts with greetings/countdowns)
                        if (str_contains($titleLower, 'holiday')) {
                            $cleanNoticeExcerpt = "November 29, 2026 – Asynchronous Learning (students work independently, no class sessions). November 30, 2026 – Regular Holiday (Bonifacio Day, no classes and school office closed).";
                        } elseif (str_contains($titleLower, 'musabaqah')) {
                            $cleanNoticeExcerpt = "Al Munawwara Islamic School (AMIS) invites young learners worldwide to the 3rd AMIS Virtual International Qur'anic Musabaqah on January 29–31, 2027 via Microsoft Teams. Registration is open until January 17, 2027.";
                        } elseif (str_contains($titleLower, 'early enrollment')) {
                            $cleanNoticeExcerpt = "Early Enrollment for School Year 2027–2028 runs from December 1 to 31, 2026 for Kindergarten to Senior High School. Enroll early to avail the 15% tuition discount, sibling discounts, and an extra 5% full-payment discount.";
                        } elseif (str_contains($titleLower, 'amis-gem')) {
                            $cleanNoticeExcerpt = "Al Munawwara Islamic School (AMIS) invites schools, educators, and young scholars to join AMIS-GEM 2026, our inaugural International English and Mathematics Competition on December 13–15, 2026 (Onsite & Online via MS Teams).";
                        } elseif (str_contains($titleLower, '2nd summative test')) {
                            $cleanNoticeExcerpt = "The 2nd Summative Tests for Term 2 (S.Y. 2026–2027) will be officially conducted on November 15–19, 2026. Students are encouraged to review their lessons thoroughly, and parents are reminded to settle outstanding balances prior to exam week.";
                        } elseif (str_contains($titleLower, 'birthday celebrations')) {
                            $cleanNoticeExcerpt = "The AMIS Shariah Advisory Department (ASAD) gently reminds the school community of the Islamic guidance from the Qur'an and Sunnah regarding birthday celebrations, encouraging gratitude, sincere du'a, charity, and righteous deeds.";
                        } elseif (str_contains($titleLower, 'heat index')) {
                            $cleanNoticeExcerpt = "Official guidelines under School Memorandum No. 2627-031 and DepEd Memorandum No. 064, s. 2026 on classroom temperature monitoring, hydration protocols, and automatic shifts to online classes during high heat index levels.";
                        } else {
                            $rawNoticeText = (string) ($notice->content ?? '');
                            $rawNoticeText = preg_replace('/<(style|script|table|h[1-6])\b[^>]*>.*?<\/\1>/is', ' ', $rawNoticeText);
                            $rawNoticeText = preg_replace('/<p\s+class="salutation-islamic"[^>]*>.*?<\/p>/is', ' ', $rawNoticeText);
                            $rawNoticeText = preg_replace('/<div\s+class="[^"]*countdown[^"]*"[^>]*>.*?<\/div>/is', ' ', $rawNoticeText);
                            $rawNoticeText = str_ireplace(['</p>', '<br>', '<br/>', '<br />', '</div>', '</li>', '</tr>', '</td>', '</th>'], ' ', $rawNoticeText);
                            $rawNoticeText = strip_tags($rawNoticeText);
                            $rawNoticeText = html_entity_decode($rawNoticeText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                            $rawNoticeText = preg_replace('/\b(?:Assalaamu\s+al[ai]ykum\s+wa\s+rahmatullahi\s+wa\s+barakatuh(?:u)?\.?|Assalaamu\s+alaikum\s+wa\s+rahmatullahi\s+wa\s+barakatuh(?:u)?\.?)\s*/iu', '', $rawNoticeText);
                            $rawNoticeText = trim(preg_replace('/\s+/', ' ', $rawNoticeText));
                            $cleanNoticeExcerpt = \Illuminate\Support\Str::words($rawNoticeText, 24, '...');
                        }
                    @endphp
                    <article class="notice-card" style="border-top: 4px solid {{ $accentColor }};">
                        @if($noticeImg)
                            <a href="{{ route('announcement.show', $notice->uuid ?? $notice->id) }}" class="notice-card-media" tabindex="-1" aria-hidden="true">
                                <img src="{{ $noticeImg }}" alt="{{ $notice->title }}" loading="lazy" onerror="this.parentElement.style.display='none'">
                            </a>
                        @endif
                        <div class="notice-card-body">
                            <div>
                                <!-- Header: Semantic Category Chip & Publication Date (Single Aligned Line) -->
                                <div class="notice-header">
                                    <span class="notice-badge" style="background: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }};">
                                        @if($chipIcon === 'globe')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                        @elseif($chipIcon === 'academic')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                        @elseif($chipIcon === 'award')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                                        @elseif($chipIcon === 'calendar')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                        @elseif($chipIcon === 'book')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                        @elseif($chipIcon === 'shield')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                        @else
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        @endif
                                        {{ $chipLabel }}
                                    </span>

                                    <span class="notice-date">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #059669; flex-shrink: 0;"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                        {{ optional($notice->publish_date ?? $notice->created_at)->format('M d, Y') }}
                                    </span>
                                </div>

                                <!-- Notice Title -->
                                <h3 class="notice-title" style="text-wrap: balance;">
                                    <a href="{{ route('announcement.show', $notice->uuid ?? $notice->id) }}">
                                        {{ $notice->title }}
                                    </a>
                                </h3>

                                <!-- Clean Complete Description -->
                                <p class="notice-excerpt" style="text-wrap: pretty;">
                                    {{ $cleanNoticeExcerpt }}
                                </p>
                            </div>

                            <!-- Card Footer: Author & Read More Link -->
                            <div class="notice-footer">
                                <span class="notice-author">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #059669; flex-shrink: 0;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    {{ (!empty($notice->author) && !str_contains(strtolower($notice->author), 'admin')) ? $notice->author : 'AMIS Administration' }}
                                </span>
                                <a href="{{ route('announcement.show', $notice->uuid ?? $notice->id) }}" class="notice-read-more">
                                    <span>Read Notice</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 32px;">
                <a href="{{ route('news.index', ['tab' => 'notices']) }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; border-radius: 999px; background: #f8fafc; border: 1.5px solid #cbd5e1; color: #0f172a; font-weight: 800; font-size: 0.9rem; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.borderColor='#059669';this.style.color='#059669';" onmouseout="this.style.borderColor='#cbd5e1';this.style.color='#0f172a';">
                    <span>View All Official School Notices &amp; Advisories</span>
                    <span>&rarr;</span>
                </a>
            </div>
        @else
            <!-- Proper Empty State -->
            <div class="notice-empty-state">
                <div class="notice-empty-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h4 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 6px;">No Active School Notices</h4>
                <p style="font-size: 0.92rem; color: #64748b; margin: 0; line-height: 1.6;">There are currently no official school advisories or administrative notices published. Please check back regularly for updates.</p>
            </div>
        @endif
    </div>
</section>

<!-- ANNOUNCEMENTS & NEWS -->
<section class="section news-announcements" style="padding: 70px 0;">
    <div class="container">
        <div style="text-align: center; max-width: 720px; margin: 0 auto 36px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                <span style="display: inline-flex; align-items: center; gap: 6px; background: #ecfdf5; color: #059669; padding: 5px 14px; border-radius: 999px; font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: 1px solid #a7f3d0;">
                    <span style="display: inline-block; width: 7px; height: 7px; background: #059669; border-radius: 50%; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);"></span>
                    Campus Journalism &amp; Achievements
                </span>
            </div>
            <h2 class="section-title" style="margin-bottom: 10px; font-size: 2.25rem; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">News &amp; Campus Highlights</h2>
            <p class="section-subtitle" style="color: #64748b; font-size: 1.02rem; margin: 0 0 16px; line-height: 1.6;">Celebrating student achievements, international conferences, and institutional milestones at AMIS</p>
            <a href="{{ route('news.index') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #059669; font-weight: 800; font-size: 0.92rem; text-decoration: none; background: #ffffff; padding: 8px 18px; border-radius: 999px; border: 1px solid #a7f3d0; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.08);">
                <span>Explore Full Newsroom &amp; Archive</span>
                <span>&rarr;</span>
            </a>
        </div>
        
        <div class="news-layout">
            <!-- Live Paginated Announcement Grid -->
            @if($announcements->count() > 0)
                <div class="announcements-column">
                    @foreach($announcements as $announcement)
                        @php
                            $imgs = json_decode($announcement->image, true);
                            $firstImg = is_array($imgs) ? ($imgs[0] ?? null) : $announcement->image;
                            $photoCount = is_array($imgs) ? count($imgs) : ($firstImg ? 1 : 0);

                            $rawTitle = trim((string) $announcement->title);
                            $rawTitle = preg_replace('/^AMIS\s+News\s*\|\s*/i', '', $rawTitle);
                            if ($rawTitle === mb_strtoupper($rawTitle, 'UTF-8') && mb_strlen($rawTitle) > 18) {
                                $rawTitle = mb_convert_case(mb_strtolower($rawTitle, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
                                $rawTitle = str_ireplace(
                                    ['Amis', 'Peac', 'Dti', 'Ayimun', 'Adni', 'Deped', 'Qahe', 'Actd'],
                                    ['AMIS', 'PEAC', 'DTI', 'AYIMUN', 'ADNI', 'DepEd', 'QAHE', 'ACTD'],
                                    $rawTitle
                                );
                            }

                            $rawNewsBody = (string) ($announcement->content ?? '');
                            $rawNewsBody = preg_replace('/<(style|script|table|h[1-6])\b[^>]*>.*?<\/\1>/is', ' ', $rawNewsBody);
                            $rawNewsBody = str_ireplace(['</p>', '<br>', '<br/>', '<br />', '</div>', '</li>'], ' ', $rawNewsBody);
                            $rawNewsBody = strip_tags($rawNewsBody);
                            $rawNewsBody = html_entity_decode($rawNewsBody, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                            $rawNewsBody = preg_replace('/\b(?:Assalaamu\s+al[ai]ykum\s+wa\s+rahmatullahi\s+wa\s+barakatuh(?:u)?\.?|Assalaamu\s+alaikum\s+wa\s+rahmatullahi\s+wa\s+barakatuh(?:u)?\.?)\s*/iu', '', $rawNewsBody);
                            $cleanNewsExcerpt = \Illuminate\Support\Str::words(trim(preg_replace('/\s+/', ' ', $rawNewsBody)), 23, '...');
                        @endphp
                        <a href="{{ route('announcement.show', $announcement->uuid ?? $announcement->id) }}" class="news-card">
                            <div class="news-image">
                                <span class="news-cat-pill">{{ $announcement->category ?: 'AMIS News' }}</span>
                                @if($photoCount > 1)
                                    <span class="news-photo-count">{{ $photoCount }} Photos</span>
                                @endif
                                @if(is_array($imgs) && count($imgs) > 1)
                                    <div class="news-slideshow-container w-full h-full relative">
                                        @foreach($imgs as $idx => $img)
                                             <img src="{{ $img }}" alt="{{ $rawTitle }}" class="news-slide-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $idx === 0 ? 'opacity-100' : 'opacity-0' }}" loading="lazy">
                                        @endforeach
                                    </div>
                                @else
                                    <img src="{{ $firstImg ?? '/summer-class.png' }}" alt="{{ $rawTitle }}" class="w-full h-full object-cover" loading="lazy">
                                @endif
                            </div>
                            <div class="news-content">
                                <div>
                                    <div class="news-date">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #059669;"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                        {{ optional($announcement->publish_date ?? $announcement->created_at)->format('F d, Y') ?? 'AMIS Update' }}
                                    </div>
                                    <h3>{{ $rawTitle }}</h3>
                                    <p class="news-excerpt">{{ $cleanNewsExcerpt }}</p>
                                </div>
                                <div class="news-card-footer">
                                    <span class="news-author-tag">{{ (!empty($announcement->author) && !str_contains(strtolower($announcement->author), 'admin')) ? $announcement->author : 'AMIS Newsroom' }}</span>
                                    <span class="news-link">Read Story &rarr;</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <!-- Dynamic Pagination -->
                <div class="pagination">
                    <a href="{{ $announcements->previousPageUrl() }}" class="pagination-btn {{ $announcements->onFirstPage() ? 'disabled-link' : '' }}" {!! $announcements->onFirstPage() ? 'style="pointer-events:none;opacity:0.4;"' : '' !!}>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    
                    @for ($page = 1; $page <= $announcements->lastPage(); $page++)
                        <a href="{{ $announcements->url($page) }}" class="pagination-number {{ $announcements->currentPage() === $page ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endfor
                    
                    <a href="{{ $announcements->nextPageUrl() }}" class="pagination-btn {{ !$announcements->hasMorePages() ? 'disabled-link' : '' }}" {!! !$announcements->hasMorePages() ? 'style="pointer-events:none;opacity:0.4;"' : '' !!}>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @else
                <div style="text-align: center; padding: 80px 40px;">
                    <h3>No News & Info Available</h3>
                    <p>Check back soon for updates from AMIS</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- ACCREDITATIONS & RECOGNITIONS SHOWCASE -->
<section class="section school-accreditations" style="background: #ffffff; padding: 70px 0; border-top: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 760px; margin: 0 auto 40px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                <span style="display: inline-flex; align-items: center; gap: 6px; background: #ecfdf5; color: #059669; padding: 5px 14px; border-radius: 999px; font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: 1px solid #a7f3d0;">
                    <span style="display: inline-block; width: 7px; height: 7px; background: #059669; border-radius: 50%; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);"></span>
                    National &amp; International Recognition
                </span>
            </div>
            <h2 class="section-title" style="margin-bottom: 10px; font-size: 2.25rem; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">Accreditations &amp; Certified Status</h2>
            <p class="section-subtitle" style="color: #64748b; font-size: 1.02rem; margin: 0; line-height: 1.6;">Adhering to rigorous educational standards verified by the Department of Education, PEAC, and international accrediting bodies</p>
        </div>

        <div class="home-accred-grid">
            <!-- 1. DepEd & PEAC Card -->
            <div class="home-accred-card featured">
                <div class="home-accred-badge active-tag">
                    <span class="active-dot"></span>
                    ACTIVE &bull; FULL COMPLIANCE
                </div>
                <div style="margin-bottom: 14px; display: flex; align-items: center; justify-content: flex-start;">
                    <img src="/accre/peac_certified_jhs_466150.webp" alt="PEAC Certified 466150 Junior High School" style="height: 56px; width: auto; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));" loading="lazy">
                </div>
                <h3>DepEd &amp; PEAC Certified Status</h3>
                <p>Junior High School Program officially certified under the Educational Service Contracting (ESC) system with Full Compliance.</p>
                <div class="home-accred-meta">
                    <span><strong>DepEd ID:</strong> 466150</span>
                    <span><strong>ESC ID:</strong> 1104046</span>
                    <span><strong>PEAC Verification Code:</strong> PCC-2026-0RNELJVG</span>
                    <span><strong>Valid Until:</strong> May 31, 2030</span>
                </div>
                <a href="{{ route('about.certifications') }}" class="home-accred-link">View Verification &amp; Certificate &rarr;</a>
            </div>

            <!-- 2. QAHE Card -->
            <div class="home-accred-card">
                <div class="home-accred-badge global-tag">INTERNATIONAL ACCREDITATION</div>
                <div class="home-accred-icon" style="color: #059669;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/></svg>
                </div>
                <h3>QAHE International Accreditation</h3>
                <p>Full educational accreditation by the International Association for Quality Assurance in Pre-Tertiary &amp; Higher Education.</p>
                <div class="home-accred-meta">
                    <span><strong>Scope:</strong> Pre-Tertiary &amp; Basic Education</span>
                    <span><strong>Status:</strong> Fully Accredited Institution</span>
                </div>
                <a href="{{ route('about.certifications') }}" class="home-accred-link">View QAHE Certificate &rarr;</a>
            </div>

            <!-- 3. ACTD Card -->
            <div class="home-accred-card">
                <div class="home-accred-badge us-tag">UNITED STATES ACCREDITATION</div>
                <div class="home-accred-icon" style="color: #2563eb;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <h3>ACTD USA Certified</h3>
                <p>Accredited by the Accrediting Council for Teacher Development (USA) for instructional excellence and faculty training.</p>
                <div class="home-accred-meta">
                    <span><strong>Council:</strong> ACTD United States</span>
                    <span><strong>Focus:</strong> Teacher Development &amp; Pedagogy</span>
                </div>
                <a href="{{ route('about.certifications') }}" class="home-accred-link">View ACTD Certificate &rarr;</a>
            </div>
        </div>

        <div style="text-align: center; margin-top: 36px;">
            <a href="{{ route('about.certifications') }}" class="btn-hero" style="background: #059669; color: #ffffff; border-color: #059669; padding: 12px 32px; font-size: 0.95rem; font-weight: 700; border-radius: 8px;">
                View All Official Certifications &amp; Verification Cards &rarr;
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Hero Image Slideshow Logic
        const heroSlideshow = document.getElementById('heroSlideshow');
        if (heroSlideshow) {
            const slides = heroSlideshow.querySelectorAll('.hero-image');
            const indicators = document.querySelectorAll('#slideIndicators .indicator');
            let currentSlide = 0;
            
            function showSlide(idx) {
                slides.forEach((slide, i) => {
                    if (i === idx) {
                        slide.classList.add('active');
                        if (indicators[i]) indicators[i].classList.add('active');
                    } else {
                        slide.classList.remove('active');
                        if (indicators[i]) indicators[i].classList.remove('active');
                    }
                });
                currentSlide = idx;
            }
            
            indicators.forEach(ind => {
                ind.addEventListener('click', function() {
                    const slideIdx = parseInt(this.getAttribute('data-slide'));
                    showSlide(slideIdx);
                });
            });
            
            setInterval(() => {
                let next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }, 5000);
        }


        // Cycle news card slideshows automatically on homepage with seamless crossfade (NO white blink)
        const cardSlideshows = document.querySelectorAll('.news-slideshow-container');
        cardSlideshows.forEach(slideshow => {
            const slides = Array.from(slideshow.querySelectorAll('.news-slide-img'));
            if (slides.length > 1) {
                let activeIdx = 0;

                slideshow.style.background = '#e2e8f0';

                slides.forEach((slide, i) => {
                    slide.style.position = 'absolute';
                    slide.style.inset = '0';
                    slide.style.width = '100%';
                    slide.style.height = '100%';
                    slide.style.objectFit = 'cover';
                    slide.style.transition = 'opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                    slide.style.opacity = i === 0 ? '1' : '0';
                    slide.style.zIndex = i === 0 ? '2' : '1';
                });

                setInterval(() => {
                    const nextIdx = (activeIdx + 1) % slides.length;
                    const currentSlide = slides[activeIdx];
                    const nextSlide = slides[nextIdx];

                    // Bring next slide on top and fade in
                    nextSlide.style.zIndex = '3';
                    nextSlide.style.opacity = '1';

                    // After crossfade finishes, reset old slide position
                    setTimeout(() => {
                        currentSlide.style.opacity = '0';
                        currentSlide.style.zIndex = '1';
                        nextSlide.style.zIndex = '2';
                        activeIdx = nextIdx;
                    }, 1250);
                }, 4000 + Math.random() * 1500);
            }
        });

        // 3. Dynamic Header Height for Fullscreen Hero
        function updateHeroHeaderHeight() {
            const header = document.getElementById('siteHeader');
            if (header) {
                const height = header.offsetHeight;
                document.documentElement.style.setProperty('--header-height', height + 'px');
            }
        }
        updateHeroHeaderHeight();
        window.addEventListener('resize', updateHeroHeaderHeight, { passive: true });
        window.addEventListener('load', updateHeroHeaderHeight);

        // 4. Auto-pause hero video when scrolled out of view to eliminate lag & conserve resources
        const heroVideo = document.getElementById('heroVideo');
        if (heroVideo) {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            if (prefersReducedMotion.matches) {
                heroVideo.pause();
            }
            prefersReducedMotion.addEventListener('change', (e) => {
                if (e.matches) heroVideo.pause();
            });

            if ('IntersectionObserver' in window) {
                const heroSection = document.getElementById('homeHero') || heroVideo;
                const videoObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        const isFs = !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
                        if (isFs) return;

                        if (entry.isIntersecting) {
                            // Hero is visible in viewport - resume playback
                            heroVideo.play().catch(() => {});
                        } else {
                            // Hero is scrolled fully out of viewport - auto pause video to stop lag
                            heroVideo.pause();
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.05
                });
                videoObserver.observe(heroSection);
            }

            // Also pause video when switching tabs or minimizing browser
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    heroVideo.pause();
                } else {
                    const isFs = !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
                    if (isFs) {
                        heroVideo.play().catch(() => {});
                        return;
                    }
                    const heroSection = document.getElementById('homeHero') || heroVideo;
                    const rect = heroSection.getBoundingClientRect();
                    if (rect.bottom > 0 && rect.top < window.innerHeight) {
                        heroVideo.play().catch(() => {});
                    }
                }
            });
        }
    });
</script>
@endsection

