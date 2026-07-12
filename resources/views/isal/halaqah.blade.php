@extends('layouts.app')

@section('title', 'Halaqah Online | AMIS')

@section('styles')
<style>
    .halaqah-page {
        min-height: 100vh;
        background: var(--bg-light);
    }
    .page-hero {
        background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
        color: white;
        padding: 120px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: url('/pattern-islamic.svg') repeat;
        opacity: 0.05;
        pointer-events: none;
    }
    .page-hero h1 {
        font-size: 3.5rem;
        margin-bottom: 16px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }
    .page-hero p {
        font-size: 1.35rem;
        opacity: 0.95;
        max-width: 700px;
        margin: 0 auto;
        font-weight: 500;
    }
    .content-section {
        padding: 80px 0;
    }
    .intro-container {
        max-width: 900px;
        margin: 0 auto;
    }
    .intro-text h2 {
        font-size: 2.25rem;
        color: var(--primary);
        margin-bottom: 24px;
        font-weight: 700;
        text-align: center;
    }
    .intro-text p {
        font-size: 1.125rem;
        line-height: 1.8;
        color: var(--text-light);
        margin-bottom: 24px;
        text-align: justify;
    }
    
    /* Schedule Card Styles */
    .schedule-card {
        position: relative;
        background: #ffffff;
        border-radius: 24px;
        padding: 45px 35px 35px;
        border: 1px solid rgba(5, 150, 105, 0.15);
        box-shadow: 0 15px 40px rgba(5, 150, 105, 0.06);
        background-image: url('/pattern-islamic.svg');
        background-repeat: repeat;
        background-size: 160px;
        background-blend-mode: overlay;
        background-color: rgba(255, 255, 255, 0.985);
        margin: 40px 0;
        overflow: hidden;
    }
    
    /* Double border effect using absolute inner boundary */
    .schedule-card::before {
        content: "";
        position: absolute;
        inset: 10px;
        border: 1.5px double rgba(217, 119, 6, 0.25);
        border-radius: 16px;
        pointer-events: none;
        z-index: 1;
    }

    /* Arabic/Islamic Watermark Element style */
    .islamic-watermark {
        position: absolute;
        bottom: -60px;
        right: -60px;
        width: 320px;
        height: 320px;
        opacity: 0.055;
        pointer-events: none;
        z-index: 1;
    }

    /* Corner ornaments */
    .corner-ornament {
        position: absolute;
        width: 28px;
        height: 28px;
        border: 2px solid #d97706; /* Gold color */
        pointer-events: none;
        z-index: 5;
    }
    .corner-top-left {
        top: 14px;
        left: 14px;
        border-right: none;
        border-bottom: none;
    }
    .corner-top-right {
        top: 14px;
        right: 14px;
        border-left: none;
        border-bottom: none;
    }
    .corner-bottom-left {
        bottom: 14px;
        left: 14px;
        border-right: none;
        border-top: none;
    }
    .corner-bottom-right {
        bottom: 14px;
        right: 14px;
        border-left: none;
        border-top: none;
    }

    .schedule-card h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.85rem;
        color: #064e3b; /* Deep emerald */
        margin-bottom: 5px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-shadow: 0 1px 1px rgba(0,0,0,0.05);
        position: relative;
        z-index: 2;
    }
    .schedule-card h3 svg {
        width: 28px;
        height: 28px;
        color: #d97706; /* Gold icon */
    }

    /* Islamic Elegant Divider */
    .islamic-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin: 10px 0 25px;
        position: relative;
        z-index: 2;
    }
    .divider-line {
        height: 1.5px;
        width: 220px;
        background: linear-gradient(to right, transparent, rgba(217, 119, 6, 0.45), transparent);
    }

    .schedule-time {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px dashed var(--border);
        text-align: center;
        position: relative;
        z-index: 2;
    }

    /* Premium Table styling */
    .halaqah-table-wrap {
        width: 100%;
        overflow-x: auto;
        margin-top: 20px;
        border-radius: 14px;
        border: 1px solid rgba(5, 150, 105, 0.15);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.02);
        position: relative;
        z-index: 2;
    }
    .halaqah-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.95rem;
    }
    .halaqah-table th {
        background-color: #064e3b; /* Deep Forest Emerald */
        color: #fef08a; /* Light Gold text */
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        padding: 16px;
        text-transform: uppercase;
        font-size: 0.82rem;
        letter-spacing: 0.06em;
        border-bottom: 2px solid #d97706; /* Gold bottom line */
    }
    .halaqah-table td {
        padding: 18px 16px;
        border-bottom: 1px solid rgba(5, 150, 105, 0.08);
        color: #1f2937;
        font-weight: 600;
        vertical-align: middle;
    }
    .halaqah-table tr:nth-child(even) td {
        background-color: rgba(240, 253, 244, 0.35); /* Very soft green stripe */
    }
    .halaqah-table tr:hover td {
        background-color: rgba(240, 253, 244, 0.75) !important;
    }
    
    .day-col {
        background-color: rgba(5, 150, 105, 0.04) !important;
        border-right: 1px solid rgba(5, 150, 105, 0.1) !important;
        text-align: center;
        font-size: 0.85rem;
        color: #065f46 !important;
        font-weight: 800;
    }
    .time-col {
        font-family: monospace;
        font-weight: 800;
        color: #111827;
        font-size: 0.92rem;
        white-space: nowrap;
    }
    
    /* Badges */
    .team-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.02em;
    }
    .badge-alif {
        background-color: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .badge-baa {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .badge-taa {
        background-color: #f0f9ff;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }
    
    .level-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 800;
    }
    .badge-advanced {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .badge-beginner {
        background-color: #faf5ff;
        color: #6b21a8;
        border: 1px solid #e9d5ff;
    }
    
    .subject-text {
        color: var(--text-dark);
        font-weight: 800;
        letter-spacing: 0.02em;
    }
    .instructor-col {
        font-weight: 700;
        color: var(--text-dark);
        white-space: nowrap;
    }
    
    /* Responsive card layout for mobile */
    .mobile-schedule {
        display: none;
        flex-direction: column;
        gap: 15px;
        margin-top: 20px;
    }
    .mobile-card {
        position: relative;
        background: white;
        border-radius: 16px;
        padding: 22px 20px;
        border: 1px solid rgba(5, 150, 105, 0.15);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        background-image: url('/pattern-islamic.svg');
        background-repeat: repeat;
        background-size: 110px;
        background-blend-mode: overlay;
        background-color: rgba(255, 255, 255, 0.985);
        border-left: 4px solid #d97706; /* Gold accent on the left */
        overflow: hidden;
    }
    .mobile-card::before {
        content: "";
        position: absolute;
        inset: 4px;
        border: 1px dashed rgba(217, 119, 6, 0.18);
        border-radius: 12px;
        pointer-events: none;
        z-index: 1;
    }
    .mobile-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(5, 150, 105, 0.12);
        padding-bottom: 10px;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }
    .mobile-card-body {
        display: flex;
        flex-direction: column;
        gap: 8px;
        position: relative;
        z-index: 2;
    }
    .mobile-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
    }
    .mobile-label {
        color: var(--text-light);
        font-weight: 600;
    }
    .mobile-value {
        color: var(--text-dark);
        font-weight: 700;
    }

    /* Levels Grid Styles */
    .levels-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin: 40px 0;
    }
    .level-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        position: relative;
    }
    .level-card::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        border-radius: 16px 16px 0 0;
    }
    .level-card.beginner::after { background: var(--primary); }
    .level-card.advanced::after { background: #0ea5e9; }
    
    .level-card h4 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 12px;
    }
    .level-card p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--text-light);
        margin: 0;
    }
    
    /* Registration styles */
    .register-section {
        background: white;
        padding: 80px 0;
        border-top: 1px solid var(--border);
    }
    .register-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .register-card {
        background: var(--bg-light);
        border-radius: 16px;
        padding: 40px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }
    .register-card h3 {
        font-size: 2rem;
        color: var(--primary);
        font-weight: 700;
        text-align: center;
        margin-bottom: 12px;
    }
    .register-card p {
        text-align: center;
        color: var(--text-light);
        margin-bottom: 30px;
        font-size: 1.05rem;
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group.full-width {
        grid-column: span 2;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        background: white;
        transition: border-color 0.3s;
    }
    .form-group input:not(#email),
    .form-group textarea {
        text-transform: uppercase;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
    }
    .form-group textarea {
        resize: vertical;
    }
    .btn-register {
        display: block;
        width: 100%;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        padding: 14px 24px;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
    }
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.3);
    }
    .alert {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-weight: 600;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    @media (max-width: 968px) {
        .page-hero h1 { font-size: 2.75rem; }
        .halaqah-table-wrap { display: none; }
        .mobile-schedule { display: flex; }
        .levels-grid { grid-template-columns: 1fr; }
        .register-card { padding: 30px 20px; }
        .form-grid { grid-template-columns: 1fr; }
        .form-group.full-width { grid-column: span 1; }
    }
</style>
@endsection

@section('content')
<div class="halaqah-page">
    <!-- HERO -->
    <section class="page-hero">
        <div class="container">
            <h1>Halaqah Online</h1>
            <p>Learn Islam from Anywhere</p>
        </div>
    </section>

    <!-- CONTENT OVERVIEW -->
    <section class="content-section">
        <div class="container">
            <div class="intro-container">
                <div class="intro-text">
                    <h2>Program Overview</h2>
                    <p>The <strong>AMIS Online Halaqah</strong> is an educational initiative of Al Munawwara Islamic School (AMIS) that provides structured online Islamic learning for students at both Beginner and Advanced levels. The program is designed to strengthen learners' understanding of Qur'an and Arabic through scheduled weekly classes conducted by qualified instructors.</p>
                    <p>Whether you are a beginner or wish to deepen your Islamic knowledge, our Halaqah aims to help strengthen your faith, character, and understanding of Islam.</p>
                    <p>This program is <strong>completely free of charge</strong> to ensure accessibility for everyone. However, for those who wish to contribute, voluntary <strong>Sadaqah (donations)</strong> are welcome to help support our instructors and expand our Islamic educational initiatives.</p>
                    
                    <!-- Weekly Schedule Card -->
                    <div class="schedule-card">
                        <!-- Decorative corners -->
                        <div class="corner-ornament corner-top-left"></div>
                        <div class="corner-ornament corner-top-right"></div>
                        <div class="corner-ornament corner-bottom-left"></div>
                        <div class="corner-ornament corner-bottom-right"></div>

                        <!-- Arabic/Islamic Watermark Element -->
                        <div class="islamic-watermark">
                            <svg viewBox="0 0 100 100" fill="none" stroke="#d97706" stroke-width="1.2">
                                <path d="M50 5 L63 37 L95 50 L63 63 L50 95 L37 63 L5 50 L37 37 Z" />
                                <path d="M50 5 L78 22 L95 50 L78 78 L50 95 L22 78 L5 50 L22 22 Z" transform="rotate(45 50 50)" />
                                <circle cx="50" cy="50" r="22" />
                                <circle cx="50" cy="50" r="14" />
                            </svg>
                        </div>

                        <h3>
                            AMIS Online Halaqah Timetable
                        </h3>

                        <!-- Islamic Divider -->
                        <div class="islamic-divider">
                            <span class="divider-line"></span>
                        </div>
                        
                        <!-- Desktop Table -->
                        <div class="halaqah-table-wrap">
                            <table class="halaqah-table">
                                <thead>
                                    <tr>
                                        <th style="width: 18%">Day</th>
                                        <th style="width: 20%">Time</th>
                                        <th style="width: 15%">Team</th>
                                        <th style="width: 12%">Level</th>
                                        <th style="width: 10%">Subject</th>
                                        <th style="width: 25%">Instructor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2" class="day-col">
                                            <strong>THURSDAY - SUNDAY</strong>
                                        </td>
                                        <td class="time-col">7:25 PM - 8:25 PM</td>
                                        <td>
                                            <span class="team-badge badge-alif">FASLOL ALIF</span>
                                        </td>
                                        <td>
                                            <span class="level-badge badge-advanced">ADVANCE</span>
                                        </td>
                                        <td>
                                            <strong class="subject-text">QUR'AN</strong>
                                        </td>
                                        <td class="instructor-col">USTADZ JAISAM MAMENTONG</td>
                                    </tr>
                                    <tr>
                                        <td class="time-col">8:30 PM - 9:30 PM</td>
                                        <td>
                                            <span class="team-badge badge-alif">FASLOL ALIF</span>
                                        </td>
                                        <td>
                                            <span class="level-badge badge-advanced">ADVANCE</span>
                                        </td>
                                        <td>
                                            <strong class="subject-text">ARABIC</strong>
                                        </td>
                                        <td class="instructor-col">USTADZ ALI SULTAN</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" class="day-col" style="border-top: 2px solid var(--border);">
                                            <strong>THURSDAY - SUNDAY</strong>
                                        </td>
                                        <td class="time-col" style="border-top: 2px solid var(--border);">7:25 PM - 8:25 PM</td>
                                        <td style="border-top: 2px solid var(--border);">
                                            <span class="team-badge badge-baa">FASLOL BAA</span>
                                        </td>
                                        <td style="border-top: 2px solid var(--border);">
                                            <span class="level-badge badge-beginner">BEGINNER</span>
                                        </td>
                                        <td style="border-top: 2px solid var(--border);">
                                            <strong class="subject-text">QUR'AN</strong>
                                        </td>
                                        <td class="instructor-col" style="border-top: 2px solid var(--border);">USTADZ ERSAHAD ESMAEL</td>
                                    </tr>
                                    <tr>
                                        <td class="time-col">8:30 PM - 9:30 PM</td>
                                        <td>
                                            <span class="team-badge badge-baa">FASLOL BAA</span>
                                        </td>
                                        <td>
                                            <span class="level-badge badge-beginner">BEGINNER</span>
                                        </td>
                                        <td>
                                            <strong class="subject-text">ARABIC</strong>
                                        </td>
                                        <td class="instructor-col">USTADZ ABDIRAHEEM GONZALES</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" class="day-col" style="border-top: 2px solid var(--border);">
                                            <strong>THURSDAY - SUNDAY</strong>
                                        </td>
                                        <td class="time-col" style="border-top: 2px solid var(--border);">7:25 PM - 8:25 PM</td>
                                        <td style="border-top: 2px solid var(--border);">
                                            <span class="team-badge badge-taa">FASLOL TAA</span>
                                        </td>
                                        <td style="border-top: 2px solid var(--border);">
                                            <span class="level-badge badge-beginner">BEGINNER</span>
                                        </td>
                                        <td style="border-top: 2px solid var(--border);">
                                            <strong class="subject-text">QUR'AN</strong>
                                        </td>
                                        <td class="instructor-col" style="border-top: 2px solid var(--border);">USTADZ OBAYDAH TINI</td>
                                    </tr>
                                    <tr>
                                        <td class="time-col">8:30 PM - 9:30 PM</td>
                                        <td>
                                            <span class="team-badge badge-taa">FASLOL TAA</span>
                                        </td>
                                        <td>
                                            <span class="level-badge badge-beginner">BEGINNER</span>
                                        </td>
                                        <td>
                                            <strong class="subject-text">ARABIC</strong>
                                        </td>
                                        <td class="instructor-col">USTADZ FAIDURRAHMAN SABTAL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="mobile-schedule">
                            <!-- Advanced Alif Card 1 -->
                            <div class="mobile-card">
                                <div class="mobile-card-header">
                                    <span class="team-badge badge-alif">FASLOL ALIF</span>
                                    <span class="level-badge badge-advanced">ADVANCE</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-row">
                                        <span class="mobile-label">Day:</span>
                                        <span class="mobile-value">Thursday - Sunday</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Time:</span>
                                        <span class="mobile-value">7:25 PM - 8:25 PM</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Subject:</span>
                                        <span class="mobile-value text-emerald-600" style="color: var(--primary);">QUR'AN</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Instructor:</span>
                                        <span class="mobile-value">USTADZ JAISAM MAMENTONG</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Advanced Alif Card 2 -->
                            <div class="mobile-card">
                                <div class="mobile-card-header">
                                    <span class="team-badge badge-alif">FASLOL ALIF</span>
                                    <span class="level-badge badge-advanced">ADVANCE</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-row">
                                        <span class="mobile-label">Day:</span>
                                        <span class="mobile-value">Thursday - Sunday</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Time:</span>
                                        <span class="mobile-value">8:30 PM - 9:30 PM</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Subject:</span>
                                        <span class="mobile-value text-emerald-600" style="color: var(--primary);">ARABIC</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Instructor:</span>
                                        <span class="mobile-value">USTADZ ALI SULTAN</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Beginner Baa Card 1 -->
                            <div class="mobile-card">
                                <div class="mobile-card-header">
                                    <span class="team-badge badge-baa">FASLOL BAA</span>
                                    <span class="level-badge badge-beginner">BEGINNER</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-row">
                                        <span class="mobile-label">Day:</span>
                                        <span class="mobile-value">Thursday - Sunday</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Time:</span>
                                        <span class="mobile-value">7:25 PM - 8:25 PM</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Subject:</span>
                                        <span class="mobile-value text-emerald-600" style="color: var(--primary);">QUR'AN</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Instructor:</span>
                                        <span class="mobile-value">USTADZ ERSAHAD ESMAEL</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Beginner Baa Card 2 -->
                            <div class="mobile-card">
                                <div class="mobile-card-header">
                                    <span class="team-badge badge-baa">FASLOL BAA</span>
                                    <span class="level-badge badge-beginner">BEGINNER</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-row">
                                        <span class="mobile-label">Day:</span>
                                        <span class="mobile-value">Thursday - Sunday</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Time:</span>
                                        <span class="mobile-value">8:30 PM - 9:30 PM</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Subject:</span>
                                        <span class="mobile-value text-emerald-600" style="color: var(--primary);">ARABIC</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Instructor:</span>
                                        <span class="mobile-value">USTADZ ABDIRAHEEM GONZALES</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Beginner Taa Card 1 -->
                            <div class="mobile-card">
                                <div class="mobile-card-header">
                                    <span class="team-badge badge-taa">FASLOL TAA</span>
                                    <span class="level-badge badge-beginner">BEGINNER</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-row">
                                        <span class="mobile-label">Day:</span>
                                        <span class="mobile-value">Thursday - Sunday</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Time:</span>
                                        <span class="mobile-value">7:25 PM - 8:25 PM</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Subject:</span>
                                        <span class="mobile-value text-emerald-600" style="color: var(--primary);">QUR'AN</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Instructor:</span>
                                        <span class="mobile-value">USTADZ OBAYDAH TINI</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Beginner Taa Card 2 -->
                            <div class="mobile-card">
                                <div class="mobile-card-header">
                                    <span class="team-badge badge-taa">FASLOL TAA</span>
                                    <span class="level-badge badge-beginner">BEGINNER</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-row">
                                        <span class="mobile-label">Day:</span>
                                        <span class="mobile-value">Thursday - Sunday</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Time:</span>
                                        <span class="mobile-value">8:30 PM - 9:30 PM</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Subject:</span>
                                        <span class="mobile-value text-emerald-600" style="color: var(--primary);">ARABIC</span>
                                    </div>
                                    <div class="mobile-row">
                                        <span class="mobile-label">Instructor:</span>
                                        <span class="mobile-value">USTADZ FAIDURRAHMAN SABTAL</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Learning Levels Card -->
                    <div class="levels-grid">
                        <div class="level-card beginner">
                            <h4>Beginner Level</h4>
                            <p>Tailored for students starting their Islamic studies journey. Focuses on foundational letters, basic Quranic reading (Noorani Qaida), and primary Islamic virtues.</p>
                        </div>
                        <div class="level-card advanced">
                            <h4>Advanced Level</h4>
                            <p>Designed for learners looking to enhance their fluency, study rules of Tajweed, expand their Arabic vocabulary, and analyze deeper Islamic values.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- REGISTRATION FORM -->
    <section class="register-section" id="register">
        <div class="container">
            <div class="register-container">
                <div class="register-card">
                    <h3>Register Now</h3>
                    <p>Secure a slot for our upcoming Halaqah Online sessions. Fill out the application form below.</p>

                    <div style="background: #ecfdf5; border-left: 4px solid #059669; padding: 14px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 0.95rem; color: #065f46; text-align: left; line-height: 1.5; font-weight: 600;">
                        ✨ <strong>Program Fee:</strong> The Halaqah Online sessions are <strong>completely free of charge</strong>. For those who wish to earn blessings and support our school, voluntary <strong>Sadaqah (donations)</strong> are welcome and highly appreciated.
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="Halaqah Online Registration" />
                        
                        <div class="form-grid">
                             <div class="form-group">
                                 <label for="first_name">First Name *</label>
                                 <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter first name" oninput="this.value = this.value.toUpperCase()" />
                             </div>

                             <div class="form-group">
                                 <label for="middle_name">Middle Name</label>
                                 <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter middle name" oninput="this.value = this.value.toUpperCase()" />
                             </div>

                             <div class="form-group">
                                 <label for="last_name">Last Name *</label>
                                 <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter last name" oninput="this.value = this.value.toUpperCase()" />
                             </div>
                            
                            <div class="form-group">
                                 <label for="email">Email Address</label>
                                 <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" />
                             </div>
                             
                             <div class="form-group">
                                 <label for="phone">Contact Number</label>
                                 <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g. +63 912 345 6789" oninput="this.value = this.value.toUpperCase()" />
                             </div>
                             
                             <div class="form-group">
                                 <label for="address">Home Address</label>
                                 <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Enter home address" oninput="this.value = this.value.toUpperCase()" />
                             </div>
                             
                             <div class="form-group">
                                 <label for="ms_teams">MS Teams Account</label>
                                 <input type="text" id="ms_teams" name="ms_teams" value="{{ old('ms_teams') }}" placeholder="Email or Username" oninput="this.value = this.value.toUpperCase()" />
                             </div>

                             <div class="form-group">
                                 <label for="grade_level">Grade Level *</label>
                                 <select id="grade_level" name="grade_level" required>
                                     <option value="" disabled selected>Select grade level</option>
                                     <option value="KINDERGARTEN 1">KINDERGARTEN 1</option>
                                     <option value="KINDERGARTEN 2">KINDERGARTEN 2</option>
                                     <option value="GRADE 1">GRADE 1</option>
                                     <option value="GRADE 2">GRADE 2</option>
                                     <option value="GRADE 3">GRADE 3</option>
                                     <option value="GRADE 4">GRADE 4</option>
                                     <option value="GRADE 5">GRADE 5</option>
                                     <option value="GRADE 6">GRADE 6</option>
                                     <option value="GRADE 7">GRADE 7</option>
                                     <option value="GRADE 8">GRADE 8</option>
                                     <option value="GRADE 9">GRADE 9</option>
                                     <option value="GRADE 10">GRADE 10</option>
                                     <option value="GRADE 11">GRADE 11</option>
                                     <option value="GRADE 12">GRADE 12</option>
                                     <option value="ADULT / COLLEGE / NON-STUDENT">ADULT / COLLEGE / NON-STUDENT</option>
                                 </select>
                             </div>
                             
                             <div class="form-group">
                                 <label for="level">Learning Level</label>
                                 <select id="level" name="level">
                                     <option value="" selected>Select learning level (Optional)</option>
                                     <option value="Beginner (Cannot read or write)">Beginner (Cannot read or write)</option>
                                     <option value="Advanced (Can read and write)">Advanced (Can read and write)</option>
                                 </select>
                             </div>
                             
                             <div class="form-group full-width">
                                 <label for="message">Message / Learning Goals / Background</label>
                                 <textarea id="message" name="message" rows="4" placeholder="Tell us briefly about your learning goals or Islamic learning background..." oninput="this.value = this.value.toUpperCase()">{{ old('message') }}</textarea>
                             </div>
                        </div>
                        
                        <button type="submit" class="btn-register">
                            Submit Registration
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
