@extends('layouts.app')

@section('title', 'Calendar of Activities S.Y. 2026-2027 | Al Munawwara Islamic School')
@section('meta_description', 'Official Calendar of Activities for S.Y. 2026-2027 at Al Munawwara Islamic School (AMIS). Includes orientation, exam schedules, holidays, and school events.')

@section('styles')
<style>
    .calendar-page {
        background: #f8fafc;
        min-height: 100vh;
        padding-bottom: 80px;
    }
    
    .page-hero {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        padding: 80px 0 45px;
        text-align: center;
    }
    
    .page-hero h1 {
        font-size: 2.6rem;
        margin-bottom: 8px;
        font-weight: 800;
        font-family: 'Outfit', sans-serif;
    }
    
    .page-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
    }
    
    .sy-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 14px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(4px);
    }
    
    .school-ids-bar {
        display: flex;
        justify-content: center;
        gap: 16px;
        font-size: 0.82rem;
        font-weight: 600;
        opacity: 0.9;
        margin-top: 8px;
    }

    /* TOP IMPORTANT NOTICE BANNER */
    .notice-banner-top {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-left: 6px solid #2563eb;
        border-radius: 14px;
        padding: 20px 24px;
        margin: 30px auto 35px;
        max-width: 1100px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.08);
    }
    
    .notice-banner-top svg {
        flex-shrink: 0;
        color: #2563eb;
        margin-top: 2px;
    }
    
    .notice-banner-top strong {
        display: block;
        color: #1e40af;
        font-size: 0.98rem;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .notice-banner-top p {
        color: #1e3a8a;
        font-size: 0.92rem;
        line-height: 1.55;
        margin: 0;
        font-style: italic;
    }

    /* VIEW SWITCHER TABS */
    .view-switcher-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        max-width: 1100px;
        margin: 0 auto 20px;
    }
    
    .mode-btn-group {
        display: flex;
        background: #e2e8f0;
        padding: 4px;
        border-radius: 30px;
    }
    
    .mode-btn {
        padding: 8px 20px;
        border-radius: 25px;
        border: none;
        background: transparent;
        font-size: 0.88rem;
        font-weight: 700;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .mode-btn.active {
        background: #059669;
        color: white;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
    }
    .mode-btn svg {
        width: 16px;
        height: 16px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
    }

    /* VISUAL CALENDAR UI GRID */
    .visual-calendar-wrapper {
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        max-width: 1100px;
        margin: 0 auto 40px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
    }
    
    .calendar-ui-header {
        background: #059669;
        color: white;
        padding: 18px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .calendar-month-title {
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        font-family: 'Outfit', sans-serif;
    }

    .nav-arrow-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .nav-arrow-btn:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: scale(1.05);
    }
    .nav-arrow-btn svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        stroke-width: 2.5;
        fill: none;
    }

    .calendar-grid-scroll-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .grid-days-header {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
        text-align: center;
        min-width: 680px;
    }
    
    .grid-day-name {
        padding: 14px 4px;
        font-size: 0.8rem;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .grid-day-name.weekend {
        color: #059669;
    }

    .grid-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background: #cbd5e1;
        gap: 1px;
        min-width: 680px;
    }

    .grid-cell {
        background: white;
        min-height: 135px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        transition: background 0.2s;
        position: relative;
    }
    
    .grid-cell.other-month {
        background: #f8fafc;
        opacity: 0.45;
    }
    
    .grid-cell-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }
    
    .cell-day-num {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e293b;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .cell-day-num.is-today {
        background: #059669;
        color: white;
    }

    .cell-events-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
        width: 100%;
        flex-grow: 1;
    }

    .event-chip {
        font-size: 0.78rem;
        font-weight: 700;
        padding: 7px 10px;
        border-radius: 8px;
        line-height: 1.35;
        cursor: pointer;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
        word-break: normal;
        overflow-wrap: break-word;
        hyphens: auto;
    }
    
    .event-chip:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Solid Colorful Event Chips */
    .chip-exam {
        background: #fef08a;
        color: #854d0e;
        border-left: 4px solid #eab308;
    }
    .chip-holiday {
        background: #ffe4e6;
        color: #9f1239;
        border-left: 4px solid #f43f5e;
    }
    .chip-start {
        background: #dcfce7;
        color: #14532d;
        border-left: 4px solid #22c55e;
    }
    .chip-event {
        background: #dbeafe;
        color: #1e40af;
        border-left: 4px solid #3b82f6;
    }
    .chip-break {
        background: #e0e7ff;
        color: #3730a3;
        border-left: 4px solid #6366f1;
    }
    .chip-eosy {
        background: #f3e8ff;
        color: #6b21a8;
        border-left: 4px solid #a855f7;
    }

    /* EVENT DETAIL MODAL */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .modal-card {
        background: white;
        border-radius: 18px;
        max-width: 480px;
        width: 100%;
        padding: 28px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .modal-close-btn {
        position: absolute;
        top: 18px;
        right: 18px;
        background: #f1f5f9;
        border: none;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        font-size: 1.1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
    }

    /* LEGEND BAR */
    .legend-bar {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        background: #f8fafc;
        padding: 16px 24px;
        border-top: 1px solid #e2e8f0;
        font-size: 0.82rem;
        font-weight: 700;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 3px;
    }

    /* LIST VIEW TABLE STYLING */
    .month-card-table {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }
    
    .month-card-header {
        background: #059669;
        color: white;
        padding: 14px 24px;
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .events-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .events-table th {
        background: #f1f5f9;
        color: #334155;
        font-size: 0.82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 24px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .events-table td {
        padding: 14px 24px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.92rem;
        color: #1e293b;
    }
    
    .events-table tr:hover td { background: #f8fafc; }
    
    .row-exam-highlight { background: #fef9c3 !important; }
    .row-exam-highlight td { background: #fef9c3 !important; color: #713f12 !important; font-weight: 700; }
    .row-holiday-highlight { background: #fff1f2 !important; }
    .row-holiday-highlight td { background: #fff1f2 !important; color: #9f1239 !important; font-weight: 600; }

    @media (max-width: 768px) {
        .page-hero h1 { font-size: 1.9rem; }
        .notice-banner-top { flex-direction: column; gap: 10px; padding: 16px; }
        .view-switcher-bar { flex-direction: column; align-items: stroke; }
        .calendar-ui-header { padding: 14px 18px; }
        .calendar-month-title { font-size: 1.2rem; }
        .grid-cell { min-height: 95px; padding: 6px; }
        .event-chip { font-size: 0.7rem; padding: 4px 6px; }
    }
</style>
@endsection

@section('content')
<div class="calendar-page">
    <!-- HERO BANNER -->
    <section class="page-hero">
        <div class="container">
            <span class="sy-badge">School Year 2026 - 2027</span>
            <h1>CALENDAR OF ACTIVITIES</h1>
            <p>Al Munawwara Islamic School • Academic & Islamic Events</p>
            <div class="school-ids-bar">
                <span>School ID: 466150</span>
                <span>•</span>
                <span>ESC ID: 1104046</span>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- TOP IMPORTANT NOTICE BANNER -->
        <div class="notice-banner-top">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            <div class="notice-content">
                <strong>IMPORTANT NOTICE</strong>
                <p>The schedule of activities outlined herein is subject to change without prior notice, depending on circumstances beyond our control or as deemed necessary by the administration. Any modifications will be communicated to all concerned AMIS Constituents (Staff, Parents, and Students) in a timely and appropriate manner.</p>
            </div>
        </div>

        <!-- VIEW SWITCHER & CONTROLS -->
        <div class="view-switcher-bar">
            <!-- Mode Buttons with SVG Icons -->
            <div class="mode-btn-group">
                <button type="button" class="mode-btn active" id="btnModeVisual" onclick="switchView('visual')">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Visual Calendar
                </button>
                <button type="button" class="mode-btn" id="btnModeList" onclick="switchView('list')">
                    <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    List View Table
                </button>
            </div>

            <!-- Hint -->
            <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
                <span>Click any event block to view full details</span>
            </div>
        </div>

        <!-- 1. VISUAL CALENDAR UI CONTAINER -->
        <div id="visualCalendarContainer" class="visual-calendar-wrapper">
            <!-- Header Controls with Arrow Icons -->
            <div class="calendar-ui-header">
                <button class="nav-arrow-btn" onclick="navigateMonth(-1)" title="Previous Month">
                    <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <div class="calendar-month-title" id="currentMonthYearLabel">July 2026</div>
                <button class="nav-arrow-btn" onclick="navigateMonth(1)" title="Next Month">
                    <svg viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

            <!-- Horizontal Scroll Container for Mobile Responsiveness -->
            <div class="calendar-grid-scroll-wrapper">
                <!-- Days of Week Row -->
                <div class="grid-days-header">
                    <div class="grid-day-name weekend">SUN</div>
                    <div class="grid-day-name">MON</div>
                    <div class="grid-day-name">TUE</div>
                    <div class="grid-day-name">WED</div>
                    <div class="grid-day-name">THU</div>
                    <div class="grid-day-name">FRI</div>
                    <div class="grid-day-name weekend">SAT</div>
                </div>

                <!-- Calendar Days Grid Body -->
                <div class="grid-body" id="calendarGridBody">
                    <!-- Dynamically rendered by JS -->
                </div>
            </div>

            <!-- Legend Footer -->
            <div class="legend-bar">
                <div class="legend-item">
                    <div class="legend-dot" style="background:#eab308;"></div>
                    <span>Summative & Term Exams</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background:#f43f5e;"></div>
                    <span>Holidays & Breaks</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background:#22c55e;"></div>
                    <span>Class Resumption / Start</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background:#3b82f6;"></div>
                    <span>Orientations & Events</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background:#a855f7;"></div>
                    <span>EOSY Rites & Graduation</span>
                </div>
            </div>
        </div>

        <!-- 2. FULL LIST VIEW CONTAINER -->
        <div id="listViewContainer" style="display: none; max-width: 1100px; margin: 0 auto 40px;">

            <!-- OPENING BLOCK -->
            <div class="month-card-table">
                <div class="month-card-header">
                    <span>June 2026 — Opening Block</span>
                </div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr><td>June 8-11</td><td>School-based INSET for Teachers (Training-Workshop)</td></tr>
                        <tr><td>June 13</td><td>General Orientation for Teachers and Staff</td></tr>
                        <tr><td>June 14</td><td>Parents’ Orientation (Kindergarten ODL)</td></tr>
                        <tr><td>June 15</td><td>Parents’ Orientation (Grade 1 to 3 ODL)</td></tr>
                        <tr><td>June 16</td><td>Parents’ Orientation (Grade 4 to 6 ODL)</td></tr>
                        <tr><td>June 17</td><td>Parents’ Orientation (Grade 7 to 10 ODL)</td></tr>
                        <tr><td>June 18</td><td>Parents’ Orientation (Grade 11 to 12 ODL)</td></tr>
                        <tr><td>June 21</td><td>Students’ Orientation (Academic)</td></tr>
                        <tr><td>June 22</td><td>Students’ Orientation (Islamic)</td></tr>
                        <tr><td style="color:#059669;font-weight:800;">June 23</td><td><strong>Instructional Block Begins:</strong> Regular Class (Homeroom Activities/Diagnostic and etc.)</td></tr>
                        <tr><td>June 30</td><td>Homeroom Election</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- JULY 2026 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>July 2026</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr><td>July 11</td><td>PTA General Assembly and Election of Officers</td></tr>
                        <tr><td>July 18</td><td>JHS and SHS Get Together</td></tr>
                        <tr class="row-exam-highlight"><td>July 19-23</td><td>1st Summative Test (Term 1)</td></tr>
                        <tr style="background:#eff6ff;"><td>July 20</td><td><strong>22nd Asia Youth International Model United Nations (AYIMUN) 2026</strong></td></tr>
                        <tr><td>July 21</td><td>SSC Filing of Candidacy</td></tr>
                        <tr><td>July 22-23</td><td>SSC Campaign Week</td></tr>
                        <tr><td>July 28</td><td>Earthquake Drill (Davao)</td></tr>
                        <tr><td>July 29</td><td>SSC Election of Officers</td></tr>
                        <tr><td>July 30</td><td>SSC Induction of Officers</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- AUGUST 2026 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>August 2026</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr><td>August 1</td><td>Special Class</td></tr>
                        <tr><td>August 2-6</td><td>Medical Assessment for Students (F2F)</td></tr>
                        <tr class="row-exam-highlight"><td>August 16-20</td><td>2nd Summative Test (Term 1)</td></tr>
                        <tr><td>August 20-22</td><td>PEAC INSET for JHS Teachers / Asynchronous class for JHS students</td></tr>
                        <tr class="row-holiday-highlight"><td>August 21</td><td>Special Non-Working Holiday</td></tr>
                        <tr><td>August 24-26</td><td>PEAC INSET for SHS Teachers / Asynchronous class for SHS students</td></tr>
                        <tr class="row-holiday-highlight"><td>August 25</td><td>Regular Holiday</td></tr>
                        <tr><td>TBA</td><td>Instructional Leadership Enhancement Training for Effective Curriculum Implementation</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- SEPTEMBER 2026 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>September 2026 — End of Term 1</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr class="row-exam-highlight"><td>September 2-3</td><td>1st Term Examination (1st and 2nd Day)</td></tr>
                        <tr class="row-exam-highlight"><td>September 6-7</td><td>1st Term Examination (3rd and 4th Day)</td></tr>
                        <tr><td>September 8-10</td><td>Wellness Break for Students / Grade Computations for Teachers</td></tr>
                        <tr><td>September 12</td><td>Wellness Break for Teachers</td></tr>
                        <tr><td>September 13-15</td><td>AMIS School-based Musabaqah</td></tr>
                        <tr><td>September 16-17</td><td>Sports Fest 2026</td></tr>
                        <tr><td>September 19</td><td>1st Term Recognition</td></tr>
                        <tr><td>September 20</td><td>1st Term PTC & Viewing of Grades</td></tr>
                        <tr><td style="color:#059669;font-weight:800;">September 21</td><td>Start of Instructional Block (Term 2)</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- OCTOBER 2026 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>October 2026</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr><td>October 3</td><td>Special Class</td></tr>
                        <tr class="row-exam-highlight"><td>October 11-15</td><td>1st Summative test (Term 2)</td></tr>
                        <tr><td>October 25-29</td><td>English Activities (Subject Area Time Only)</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- NOVEMBER 2026 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>November 2026</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr class="row-holiday-highlight"><td>November 1-2</td><td>Academic Break (Holiday)</td></tr>
                        <tr><td>November 8-12</td><td>Math-Sci Week (Subject Area Time Only)</td></tr>
                        <tr><td>November 14</td><td>Special Class</td></tr>
                        <tr><td>November 15</td><td>PEPT Luzon</td></tr>
                        <tr class="row-exam-highlight"><td>November 16-19</td><td>2nd Summative test (Term 2)</td></tr>
                        <tr><td>November 22-26</td><td>PAASCU Visit</td></tr>
                        <tr class="row-holiday-highlight"><td>November 30</td><td>Regular Holiday</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- DECEMBER 2026 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>December 2026 — End of Term 2</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr class="row-exam-highlight"><td>December 1-3</td><td>2nd Term Examination (1st, 2nd, and 3rd Day)</td></tr>
                        <tr class="row-exam-highlight"><td>December 6</td><td>2nd Term Examination (4th Day)</td></tr>
                        <tr><td>December 7-9</td><td>Wellness Break for Students / Grade Computations for Teachers</td></tr>
                        <tr><td>December 10</td><td>Exam Rationalization</td></tr>
                        <tr><td>December 12</td><td>INSET</td></tr>
                        <tr><td>December 13-14</td><td>English International Competition</td></tr>
                        <tr><td>December 15-16</td><td>Math International Competition</td></tr>
                        <tr><td>December 17</td><td>2nd Term Recognition</td></tr>
                        <tr><td>December 19</td><td>2nd Term PTC & Viewing of Grades</td></tr>
                        <tr class="row-holiday-highlight"><td>December 20-31</td><td>Semestral & Year End Break</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- JANUARY 2027 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>January 2027</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr class="row-holiday-highlight"><td>January 1</td><td>Regular Holiday</td></tr>
                        <tr><td style="color:#059669;font-weight:800;">January 4</td><td>Resumption of Classes (Instructional Block)</td></tr>
                        <tr><td>January 16</td><td>Orientation for All Graduating Students</td></tr>
                        <tr><td>January 23</td><td>Faculty and Staff Pictorial</td></tr>
                        <tr class="row-exam-highlight"><td>January 24-28</td><td>1st Summative test (Term 3)</td></tr>
                        <tr><td>January 29-31</td><td>3rd AMIS International Qur'an Musabaqah</td></tr>
                        <tr><td>January 31</td><td>Asynchronous Class</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- FEBRUARY 2027 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>February 2027</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr><td>February 2</td><td>Pre-Ramadhan Islamic Symposium & Opening of Sadaqah Boxes</td></tr>
                        <tr><td>February 3-6</td><td>Pictorial Week for Graduating Students</td></tr>
                        <tr class="row-holiday-highlight"><td>February 8 or 9</td><td>Start of Ramadhan 1448H</td></tr>
                        <tr class="row-exam-highlight"><td>February 21-25</td><td>2nd Summative test (Term 3)</td></tr>
                        <tr class="row-holiday-highlight"><td>February 28</td><td>Start of Ramadhan Break</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- MARCH 2027 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>March 2027</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr class="row-holiday-highlight"><td>March 1-11</td><td>Ramadhan Break</td></tr>
                        <tr class="row-holiday-highlight"><td>TBA</td><td>Eid’l Fitr</td></tr>
                        <tr><td>March 13</td><td>Resumption of Work (Staff Only)</td></tr>
                        <tr><td>March 14</td><td>Resumption of Classes (PAT ME Celebration) With Students</td></tr>
                        <tr class="row-holiday-highlight"><td>March 25-26</td><td>Regular Holidays</td></tr>
                        <tr class="row-exam-highlight"><td>March 28 – 31</td><td>3rd Term Examination (Graduating Students)</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- APRIL 2027 -->
            <div class="month-card-table">
                <div class="month-card-header"><span>April 2027 — End of School Year</span></div>
                <table class="events-table">
                    <thead><tr><th style="width:170px;">Date</th><th>Activity / Event</th></tr></thead>
                    <tbody>
                        <tr><td>April 1</td><td>Remedial Examination (Graduating Students)</td></tr>
                        <tr class="row-exam-highlight"><td>April 4-7</td><td>3rd Term Examination (Non-Graduating Students)</td></tr>
                        <tr><td>April 8</td><td>Remedial Examination (Non-Graduating Students)</td></tr>
                        <tr class="row-holiday-highlight"><td>April 9</td><td>Regular Holiday</td></tr>
                        <tr><td>April 11-13</td><td>Compliance with INC Requirements and Clearance</td></tr>
                        <tr><td>April 14-15</td><td>Rehearsal for EOSY Rites (Davao)</td></tr>
                        <tr><td>April 17</td><td><strong>Year-End Recognition (Davao)</strong></td></tr>
                        <tr style="background:#f0fdf4;"><td style="color:#047857;font-weight:800;">April 18</td><td><strong style="color:#047857;">Graduation and Moving Up Ceremony (Davao)</strong></td></tr>
                        <tr><td>TBA</td><td>KSA / UAE / Qatar Year-End Recognition, Graduation & Moving Up</td></tr>
                        <tr><td>TBA</td><td>Releasing of Cards & EOSY General Assembly</td></tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<!-- EVENT POPUP MODAL -->
<div class="modal-overlay" id="eventModal" style="display: none;" onclick="closeEventModal()">
    <div class="modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-btn" onclick="closeEventModal()">✕</button>
        <div style="font-size: 0.78rem; font-weight: 800; color: #059669; text-transform: uppercase; margin-bottom: 6px;" id="modalCategory">AMIS ACTIVITY</div>
        <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 12px; line-height: 1.3;" id="modalTitle">Event Title</h3>
        
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; margin-bottom: 20px;">
            <div style="font-size: 0.9rem; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span id="modalDates">Date Range</span>
            </div>
            <div style="font-size: 0.82rem; color: #64748b; margin-top: 6px;">
                School Year 2026-2027 • Al Munawwara Islamic School
            </div>
        </div>

        <button type="button" onclick="closeEventModal()" style="width: 100%; background: #059669; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 700; cursor: pointer;">Close Details</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // CALENDAR EVENTS DATA DICTIONARY
    const calendarEvents = [
        // JUNE 2026
        { dates: "June 8-11", month: 5, year: 2026, startDay: 8, endDay: 11, title: "School-based INSET for Teachers (Training-Workshop)", type: "event" },
        { dates: "June 13", month: 5, year: 2026, startDay: 13, endDay: 13, title: "General Orientation for Teachers and Staff", type: "event" },
        { dates: "June 14", month: 5, year: 2026, startDay: 14, endDay: 14, title: "Parents’ Orientation (Kindergarten ODL)", type: "event" },
        { dates: "June 15", month: 5, year: 2026, startDay: 15, endDay: 15, title: "Parents’ Orientation (Grade 1 to 3 ODL)", type: "event" },
        { dates: "June 16", month: 5, year: 2026, startDay: 16, endDay: 16, title: "Parents’ Orientation (Grade 4 to 6 ODL)", type: "event" },
        { dates: "June 17", month: 5, year: 2026, startDay: 17, endDay: 17, title: "Parents’ Orientation (Grade 7 to 10 ODL)", type: "event" },
        { dates: "June 18", month: 5, year: 2026, startDay: 18, endDay: 18, title: "Parents’ Orientation (Grade 11 to 12 ODL)", type: "event" },
        { dates: "June 21", month: 5, year: 2026, startDay: 21, endDay: 21, title: "Students’ Orientation (Academic)", type: "event" },
        { dates: "June 22", month: 5, year: 2026, startDay: 22, endDay: 22, title: "Students’ Orientation (Islamic)", type: "event" },
        { dates: "June 23", month: 5, year: 2026, startDay: 23, endDay: 23, title: "Regular Class (Homeroom Activities/Diagnostic)", type: "start" },
        { dates: "June 30", month: 5, year: 2026, startDay: 30, endDay: 30, title: "Homeroom Election", type: "event" },

        // JULY 2026
        { dates: "July 11", month: 6, year: 2026, startDay: 11, endDay: 11, title: "PTA General Assembly and Election of Officers", type: "event" },
        { dates: "July 18", month: 6, year: 2026, startDay: 18, endDay: 18, title: "JHS and SHS Get Together", type: "event" },
        { dates: "July 19-23", month: 6, year: 2026, startDay: 19, endDay: 23, title: "1st Summative Test (Term 1)", type: "exam" },
        { dates: "July 20", month: 6, year: 2026, startDay: 20, endDay: 20, title: "22nd Asia Youth International Model United Nations (AYIMUN) 2026", type: "event" },
        { dates: "July 21", month: 6, year: 2026, startDay: 21, endDay: 21, title: "SSC Filing of Candidacy", type: "event" },
        { dates: "July 22-23", month: 6, year: 2026, startDay: 22, endDay: 23, title: "SSC Campaign Week", type: "event" },
        { dates: "July 28", month: 6, year: 2026, startDay: 28, endDay: 28, title: "Earthquake Drill (Davao)", type: "event" },
        { dates: "July 29", month: 6, year: 2026, startDay: 29, endDay: 29, title: "SSC Election of Officers", type: "event" },
        { dates: "July 30", month: 6, year: 2026, startDay: 30, endDay: 30, title: "SSC Induction of Officers", type: "event" },

        // AUGUST 2026
        { dates: "August 1", month: 7, year: 2026, startDay: 1, endDay: 1, title: "Special Class", type: "event" },
        { dates: "August 2-6", month: 7, year: 2026, startDay: 2, endDay: 6, title: "Medical Assessment for Students (F2F)", type: "event" },
        { dates: "August 16-20", month: 7, year: 2026, startDay: 16, endDay: 20, title: "2nd Summative Test (Term 1)", type: "exam" },
        { dates: "August 20-22", month: 7, year: 2026, startDay: 20, endDay: 22, title: "PEAC INSET for JHS Teachers", type: "event" },
        { dates: "August 21", month: 7, year: 2026, startDay: 21, endDay: 21, title: "Special Non-Working Holiday", type: "holiday" },
        { dates: "August 24-26", month: 7, year: 2026, startDay: 24, endDay: 26, title: "PEAC INSET for SHS Teachers", type: "event" },
        { dates: "August 25", month: 7, year: 2026, startDay: 25, endDay: 25, title: "Regular Holiday", type: "holiday" },

        // SEPTEMBER 2026
        { dates: "September 2-3", month: 8, year: 2026, startDay: 2, endDay: 3, title: "1st Term Examination (1st & 2nd Day)", type: "exam" },
        { dates: "September 6-7", month: 8, year: 2026, startDay: 6, endDay: 7, title: "1st Term Examination (3rd & 4th Day)", type: "exam" },
        { dates: "September 8-10", month: 8, year: 2026, startDay: 8, endDay: 10, title: "Wellness Break / Grade Preparation", type: "break" },
        { dates: "September 12", month: 8, year: 2026, startDay: 12, endDay: 12, title: "Wellness Break for Teachers", type: "break" },
        { dates: "September 13-15", month: 8, year: 2026, startDay: 13, endDay: 15, title: "AMIS School-based Musabaqah", type: "event" },
        { dates: "September 16-17", month: 8, year: 2026, startDay: 16, endDay: 17, title: "Sports Fest 2026", type: "event" },
        { dates: "September 19", month: 8, year: 2026, startDay: 19, endDay: 19, title: "1st Term Recognition", type: "event" },
        { dates: "September 20", month: 8, year: 2026, startDay: 20, endDay: 20, title: "1st Term PTC & Viewing of Grades", type: "event" },
        { dates: "September 21", month: 8, year: 2026, startDay: 21, endDay: 21, title: "Start of Instructional Block (Term 2)", type: "start" },

        // OCTOBER 2026
        { dates: "October 3", month: 9, year: 2026, startDay: 3, endDay: 3, title: "Special Class", type: "event" },
        { dates: "October 11-15", month: 9, year: 2026, startDay: 11, endDay: 15, title: "1st Summative test (Term 2)", type: "exam" },
        { dates: "October 25-29", month: 9, year: 2026, startDay: 25, endDay: 29, title: "English Activities (Subject Area Time)", type: "event" },

        // NOVEMBER 2026
        { dates: "November 1-2", month: 10, year: 2026, startDay: 1, endDay: 2, title: "Academic Break (Holiday)", type: "holiday" },
        { dates: "November 8-12", month: 10, year: 2026, startDay: 8, endDay: 12, title: "Math-Sci Week", type: "event" },
        { dates: "November 14", month: 10, year: 2026, startDay: 14, endDay: 14, title: "Special Class", type: "event" },
        { dates: "November 15", month: 10, year: 2026, startDay: 15, endDay: 15, title: "PEPT Luzon", type: "event" },
        { dates: "November 16-19", month: 10, year: 2026, startDay: 16, endDay: 19, title: "2nd Summative test (Term 2)", type: "exam" },
        { dates: "November 22-26", month: 10, year: 2026, startDay: 22, endDay: 26, title: "PAASCU Visit", type: "event" },
        { dates: "November 30", month: 10, year: 2026, startDay: 30, endDay: 30, title: "Regular Holiday", type: "holiday" },

        // DECEMBER 2026
        { dates: "December 1-3", month: 11, year: 2026, startDay: 1, endDay: 3, title: "2nd Term Examination (1st, 2nd & 3rd Day)", type: "exam" },
        { dates: "December 6", month: 11, year: 2026, startDay: 6, endDay: 6, title: "2nd Term Examination (4th Day)", type: "exam" },
        { dates: "December 7-9", month: 11, year: 2026, startDay: 7, endDay: 9, title: "Wellness Break / Grade Preparation", type: "break" },
        { dates: "December 10", month: 11, year: 2026, startDay: 10, endDay: 10, title: "Exam Rationalization", type: "event" },
        { dates: "December 12", month: 11, year: 2026, startDay: 12, endDay: 12, title: "INSET", type: "event" },
        { dates: "December 13-14", month: 11, year: 2026, startDay: 13, endDay: 14, title: "English International Competition", type: "event" },
        { dates: "December 15-16", month: 11, year: 2026, startDay: 15, endDay: 16, title: "Math International Competition", type: "event" },
        { dates: "December 17", month: 11, year: 2026, startDay: 17, endDay: 17, title: "2nd Term Recognition", type: "event" },
        { dates: "December 19", month: 11, year: 2026, startDay: 19, endDay: 19, title: "2nd Term PTC & Viewing of Grades", type: "event" },
        { dates: "December 20-31", month: 11, year: 2026, startDay: 20, endDay: 31, title: "Semestral & Year End Break", type: "holiday" },

        // JANUARY 2027
        { dates: "January 1", month: 0, year: 2027, startDay: 1, endDay: 1, title: "Regular Holiday", type: "holiday" },
        { dates: "January 4", month: 0, year: 2027, startDay: 4, endDay: 4, title: "Resumption of Classes (Instructional Block)", type: "start" },
        { dates: "January 16", month: 0, year: 2027, startDay: 16, endDay: 16, title: "Orientation for All Graduating Students", type: "event" },
        { dates: "January 23", month: 0, year: 2027, startDay: 23, endDay: 23, title: "Faculty and Staff Pictorial", type: "event" },
        { dates: "January 24-28", month: 0, year: 2027, startDay: 24, endDay: 28, title: "1st Summative test (Term 3)", type: "exam" },
        { dates: "January 29-31", month: 0, year: 2027, startDay: 29, endDay: 31, title: "3rd AMIS International Qur'an Musabaqah", type: "event" },
        { dates: "January 31", month: 0, year: 2027, startDay: 31, endDay: 31, title: "Asynchronous Class", type: "event" },

        // FEBRUARY 2027
        { dates: "February 2", month: 1, year: 2027, startDay: 2, endDay: 2, title: "Pre-Ramadhan Islamic Symposium & Sadaqah Boxes", type: "event" },
        { dates: "February 3-6", month: 1, year: 2027, startDay: 3, endDay: 6, title: "Pictorial Week for Graduating Students", type: "event" },
        { dates: "February 8-9", month: 1, year: 2027, startDay: 8, endDay: 9, title: "Start of Ramadhan 1448H", type: "holiday" },
        { dates: "February 21-25", month: 1, year: 2027, startDay: 21, endDay: 25, title: "2nd Summative test (Term 3)", type: "exam" },
        { dates: "February 28", month: 1, year: 2027, startDay: 28, endDay: 28, title: "Start of Ramadhan Break", type: "holiday" },

        // MARCH 2027
        { dates: "March 1-11", month: 2, year: 2027, startDay: 1, endDay: 11, title: "Ramadhan Break", type: "holiday" },
        { dates: "March 13", month: 2, year: 2027, startDay: 13, endDay: 13, title: "Resumption of Work (Staff Only)", type: "event" },
        { dates: "March 14", month: 2, year: 2027, startDay: 14, endDay: 14, title: "Resumption of Classes (PAT ME Celebration)", type: "start" },
        { dates: "March 25-26", month: 2, year: 2027, startDay: 25, endDay: 26, title: "Regular Holidays", type: "holiday" },
        { dates: "March 28-31", month: 2, year: 2027, startDay: 28, endDay: 31, title: "3rd Term Examination (Graduating Students)", type: "exam" },

        // APRIL 2027
        { dates: "April 1", month: 3, year: 2027, startDay: 1, endDay: 1, title: "Remedial Examination (Graduating Students)", type: "event" },
        { dates: "April 4-7", month: 3, year: 2027, startDay: 4, endDay: 7, title: "3rd Term Examination (Non-Graduating Students)", type: "exam" },
        { dates: "April 8", month: 3, year: 2027, startDay: 8, endDay: 8, title: "Remedial Examination (Non-Graduating Students)", type: "event" },
        { dates: "April 9", month: 3, year: 2027, startDay: 9, endDay: 9, title: "Regular Holiday", type: "holiday" },
        { dates: "April 11-13", month: 3, year: 2027, startDay: 11, endDay: 13, title: "Compliance with INC Requirements and Clearance", type: "event" },
        { dates: "April 14-15", month: 3, year: 2027, startDay: 14, endDay: 15, title: "Rehearsal for EOSY Rites (Davao)", type: "event" },
        { dates: "April 17", month: 3, year: 2027, startDay: 17, endDay: 17, title: "Year-End Recognition (Davao)", type: "eosy" },
        { dates: "April 18", month: 3, year: 2027, startDay: 18, endDay: 18, title: "Graduation and Moving Up Ceremony (Davao)", type: "eosy" },
    ];

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    // Default to Current Real Month (July 2026 = 6)
    let realDate = new Date();
    let currentMonth = (realDate.getFullYear() === 2026 || realDate.getFullYear() === 2027) ? realDate.getMonth() : 6;
    let currentYear = (realDate.getFullYear() === 2026 || realDate.getFullYear() === 2027) ? realDate.getFullYear() : 2026;

    document.addEventListener('DOMContentLoaded', function() {
        renderVisualCalendar(currentMonth, currentYear);
    });

    function renderVisualCalendar(month, year) {
        const monthLabel = document.getElementById('currentMonthYearLabel');
        if (monthLabel) monthLabel.textContent = `${monthNames[month]} ${year}`;

        const gridBody = document.getElementById('calendarGridBody');
        if (!gridBody) return;
        gridBody.innerHTML = '';

        const firstDay = new Date(year, month, 1).getDay(); // Day of week index 0-6
        const totalDays = new Date(year, month + 1, 0).getDate(); // Total days in month
        const prevMonthTotalDays = new Date(year, month, 0).getDate();

        // 1. Render Previous Month trailing days
        for (let i = firstDay - 1; i >= 0; i--) {
            const cell = document.createElement('div');
            cell.className = 'grid-cell other-month';
            cell.innerHTML = `<div class="grid-cell-top"><span class="cell-day-num">${prevMonthTotalDays - i}</span></div>`;
            gridBody.appendChild(cell);
        }

        // 2. Render Current Month days
        for (let day = 1; day <= totalDays; day++) {
            const cell = document.createElement('div');
            cell.className = 'grid-cell';

            // Check if today
            const isToday = (realDate.getDate() === day && realDate.getMonth() === month && realDate.getFullYear() === year);

            // Find matching events for this day
            const eventsForDay = calendarEvents.filter(evt => {
                return evt.month === month && evt.year === year && day >= evt.startDay && day <= evt.endDay;
            });

            let eventsHtml = '';
            if (eventsForDay.length > 0) {
                eventsHtml = '<div class="cell-events-list">';
                eventsForDay.forEach(evt => {
                    let chipClass = 'chip-event';
                    if (evt.type === 'exam') chipClass = 'chip-exam';
                    if (evt.type === 'holiday') chipClass = 'chip-holiday';
                    if (evt.type === 'start') chipClass = 'chip-start';
                    if (evt.type === 'break') chipClass = 'chip-break';
                    if (evt.type === 'eosy') chipClass = 'chip-eosy';

                    eventsHtml += `
                        <div class="event-chip ${chipClass}" onclick="openEventModal('${evt.title.replace(/'/g, "\\'")}', '${evt.dates}', '${evt.type.toUpperCase()}')">
                            ${evt.title}
                        </div>
                    `;
                });
                eventsHtml += '</div>';
            }

            cell.innerHTML = `
                <div class="grid-cell-top">
                    <span class="cell-day-num ${isToday ? 'is-today' : ''}">${day}</span>
                </div>
                ${eventsHtml}
            `;
            gridBody.appendChild(cell);
        }

        // 3. Render Next Month leading days to fill 35 or 42 grid cells
        const totalRendered = firstDay + totalDays;
        const remainingCells = (totalRendered > 35 ? 42 : 35) - totalRendered;
        for (let day = 1; day <= remainingCells; day++) {
            const cell = document.createElement('div');
            cell.className = 'grid-cell other-month';
            cell.innerHTML = `<div class="grid-cell-top"><span class="cell-day-num">${day}</span></div>`;
            gridBody.appendChild(cell);
        }
    }

    function navigateMonth(direction) {
        currentMonth += direction;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        } else if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }

        // Bound to S.Y. 2026-2027 (June 2026 to April 2027)
        if (currentYear < 2026 || (currentYear === 2026 && currentMonth < 5)) {
            currentMonth = 5;
            currentYear = 2026;
        } else if (currentYear > 2027 || (currentYear === 2027 && currentMonth > 3)) {
            currentMonth = 3;
            currentYear = 2027;
        }

        renderVisualCalendar(currentMonth, currentYear);
    }

    function switchView(mode) {
        const visual = document.getElementById('visualCalendarContainer');
        const list = document.getElementById('listViewContainer');
        const btnV = document.getElementById('btnModeVisual');
        const btnL = document.getElementById('btnModeList');

        if (mode === 'visual') {
            visual.style.display = 'block';
            list.style.display = 'none';
            btnV.classList.add('active');
            btnL.classList.remove('active');
        } else {
            visual.style.display = 'none';
            list.style.display = 'block';
            btnL.classList.add('active');
            btnV.classList.remove('active');
        }
    }

    function openEventModal(title, dates, category) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDates').textContent = dates;
        document.getElementById('modalCategory').textContent = category;
        document.getElementById('eventModal').style.display = 'flex';
    }

    function closeEventModal() {
        document.getElementById('eventModal').style.display = 'none';
    }
</script>
@endsection
