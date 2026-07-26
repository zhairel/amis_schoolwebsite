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
    /* Hide number input spinners */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    .form-group input#email {
        text-transform: none !important;
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
                            <!-- 1. First Name -->
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="e.g. JUAN" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <!-- 2. Middle Name -->
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="e.g. SANTOS" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <!-- 3. Last Name -->
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="e.g. DELA CRUZ" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <!-- 4. Age -->
                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input type="number" id="age" name="age" min="5" max="100" value="{{ old('age') }}" required placeholder="e.g. 25" />
                            </div>

                            <!-- 5. Gender -->
                            <div class="form-group">
                                <label for="sex">Gender *</label>
                                <select id="sex" name="sex" required>
                                    <option value="" disabled {{ old('sex') ? '' : 'selected' }}>Select Gender</option>
                                    <option value="MALE" {{ old('sex') == 'MALE' ? 'selected' : '' }}>MALE</option>
                                    <option value="FEMALE" {{ old('sex') == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                </select>
                            </div>

                            <!-- 6. Status -->
                            <div class="form-group">
                                <label for="status">Status *</label>
                                <select id="status" name="status" required>
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select Civil Status</option>
                                    <option value="SINGLE" {{ old('status') == 'SINGLE' ? 'selected' : '' }}>SINGLE</option>
                                    <option value="MARRIED" {{ old('status') == 'MARRIED' ? 'selected' : '' }}>MARRIED</option>
                                    <option value="WIDOW / WIDOWER" {{ old('status') == 'WIDOW / WIDOWER' ? 'selected' : '' }}>WIDOW / WIDOWER</option>
                                    <option value="SEPARATED" {{ old('status') == 'SEPARATED' ? 'selected' : '' }}>SEPARATED</option>
                                </select>
                            </div>

                            <!-- 7. Level -->
                            <div class="form-group">
                                <label for="level">Level *</label>
                                <select id="level" name="level" required>
                                    <option value="" disabled {{ old('level') ? '' : 'selected' }}>Select Learning Level</option>
                                    <option value="BEGINNER" {{ old('level') == 'BEGINNER' ? 'selected' : '' }}>BEGINNER</option>
                                    <option value="ADVANCE" {{ old('level') == 'ADVANCE' ? 'selected' : '' }}>ADVANCE</option>
                                </select>
                            </div>

                            <!-- 8. Mobile -->
                            <div class="form-group">
                                <label for="mobile">Mobile Number *</label>
                                <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" required placeholder="e.g. 09171234567" />
                            </div>

                            <!-- 9. FB Account -->
                            <div class="form-group full-width">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; flex-wrap: wrap; gap: 6px;">
                                    <label for="fb_account" style="margin-bottom: 0;">FB Account (Facebook Profile Link) *</label>
                                    <button type="button" onclick="openFbGuideModal()" style="background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; font-family: inherit;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                        How to copy FB Link?
                                    </button>
                                </div>
                                <input type="text" id="fb_account" name="fb_account" value="{{ old('fb_account') }}" required placeholder="e.g. https://www.facebook.com/username or facebook.com/username" />
                            </div>

                            <!-- 10. Email -->
                            <div class="form-group full-width">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com" style="text-transform: none !important;" />
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

<!-- HOW TO COPY FB LINK MODAL GUIDE -->
<div id="fbGuideModal" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.65); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;" onclick="closeFbGuideModal()">
    <div style="background: white; border-radius: 20px; max-width: 480px; width: 100%; padding: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); position: relative;" onclick="event.stopPropagation()">
        <button type="button" onclick="closeFbGuideModal()" style="position: absolute; top: 16px; right: 16px; background: #f1f5f9; border: none; width: 32px; height: 32px; border-radius: 50%; font-weight: bold; color: #64748b; cursor: pointer; font-size: 1.1rem;">✕</button>

        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="width: 42px; height: 42px; background: #1877f2; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.3rem;">f</div>
            <div>
                <h4 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0f172a;">How to Copy your FB Profile Link</h4>
                <p style="margin: 0; font-size: 0.8rem; color: #64748b;">Step-by-step guide for Facebook Mobile & Browser</p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px; margin-bottom: 16px; font-size: 0.88rem; color: #334155; line-height: 1.5;">
            <div style="display: flex; align-items: flex-start; gap: 10px;">
                <span style="background: #1877f2; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.75rem; flex-shrink: 0; margin-top: 1px;">1</span>
                <div>Open your <strong>Facebook App</strong> and tap your <strong>Profile picture</strong>.</div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 10px;">
                <span style="background: #1877f2; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.75rem; flex-shrink: 0; margin-top: 1px;">2</span>
                <div>Tap the <strong>3 Dots (...)</strong> button beside <em>Edit Profile</em>.</div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 10px;">
                <span style="background: #1877f2; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.75rem; flex-shrink: 0; margin-top: 1px;">3</span>
                <div>Tap <strong>Share Profile</strong> or scroll to <em>Your Profile Link</em>.</div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 10px;">
                <span style="background: #1877f2; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.75rem; flex-shrink: 0; margin-top: 1px;">4</span>
                <div>Tap <strong>Copy Link</strong> (e.g. <em>https://www.facebook.com/username</em>) and paste it into the form field!</div>
            </div>
        </div>

        <!-- VISUAL TUTORIAL PREVIEW CARDS -->
        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
            <!-- Step 1 & 2 Visual UI Card -->
            <div style="background: linear-gradient(135deg, #1877f2 0%, #0d5bb5 100%); border-radius: 14px; padding: 14px; color: white; box-shadow: 0 4px 14px rgba(24,119,242,0.25);">
                <div style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; opacity: 0.9; margin-bottom: 8px; letter-spacing: 0.05em; display: flex; align-items: center; justify-content: space-between;">
                    <span>Step 1 & 2: FB Profile Header</span>
                    <span style="background: #fef08a; color: #854d0e; padding: 2px 8px; border-radius: 6px; font-weight: 800; font-size: 0.7rem;">Click 3 Dots</span>
                </div>
                <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(4px); border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: white; color: #1877f2; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1rem;">👤</div>
                        <div>
                            <div style="font-size: 0.85rem; font-weight: 800;">Your Name</div>
                            <div style="font-size: 0.7rem; opacity: 0.85;">Edit profile</div>
                        </div>
                    </div>
                    <!-- Highlighted 3 Dots Icon -->
                    <div style="background: #fef08a; color: #854d0e; font-weight: 900; padding: 6px 14px; border-radius: 8px; font-size: 0.9rem; border: 2px solid #eab308; box-shadow: 0 0 12px rgba(250,204,21,0.8);">
                        •••
                    </div>
                </div>
            </div>

            <!-- Step 3 & 4 Visual UI Card -->
            <div style="background: #ffffff; border: 2px solid #3b82f6; border-radius: 14px; padding: 14px; box-shadow: 0 4px 14px rgba(0,0,0,0.04);">
                <div style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; color: #1e40af; margin-bottom: 8px; letter-spacing: 0.05em; display: flex; align-items: center; justify-content: space-between;">
                    <span>Step 3 & 4: Profile Link Menu</span>
                    <span style="background: #2563eb; color: white; padding: 2px 8px; border-radius: 6px; font-weight: 800; font-size: 0.7rem;">Copy Link</span>
                </div>
                
                <div style="background: #f8fafc; border: 1.5px dashed #93c5fd; border-radius: 10px; padding: 10px 12px;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; margin-bottom: 4px;">Your Profile Link</div>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; background: white; padding: 8px 10px; border-radius: 8px; border: 1px solid #cbd5e1;">
                        <span style="font-size: 0.8rem; font-weight: 700; color: #1d4ed8; word-break: break-all;">https://facebook.com/username</span>
                        <span style="background: #2563eb; color: white; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 0.75rem; flex-shrink: 0; box-shadow: 0 2px 6px rgba(37,99,235,0.3);">Copy link</span>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" onclick="closeFbGuideModal()" style="width: 100%; background: #1877f2; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(24,119,242,0.25);">Got it, thanks!</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openFbGuideModal() {
        document.getElementById('fbGuideModal').style.display = 'flex';
    }
    function closeFbGuideModal() {
        document.getElementById('fbGuideModal').style.display = 'none';
    }
</script>
@endsection
