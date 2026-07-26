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
        padding: 90px 0 50px;
        text-align: center;
    }
    
    .page-hero h1 {
        font-size: 2.75rem;
        margin-bottom: 10px;
        font-weight: 800;
        font-family: 'Outfit', sans-serif;
    }
    
    .page-hero p {
        font-size: 1.15rem;
        opacity: 0.95;
    }
    
    .sy-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 5px 16px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
        margin-bottom: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(4px);
    }
    
    .school-ids-bar {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        opacity: 0.9;
        margin-top: 10px;
    }

    .notice-banner {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-left: 5px solid #2563eb;
        border-radius: 12px;
        padding: 18px 24px;
        margin: 30px auto 40px;
        max-width: 1000px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.06);
    }
    
    .notice-banner svg {
        flex-shrink: 0;
        color: #2563eb;
        margin-top: 2px;
    }
    
    .notice-content strong {
        display: block;
        color: #1e40af;
        font-size: 0.95rem;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .notice-content p {
        color: #1e3a8a;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
        font-style: italic;
    }

    /* Term Filter Tabs */
    .filter-tabs {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 35px;
    }
    
    .filter-tab {
        background: white;
        border: 1px solid #cbd5e1;
        color: #475569;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .filter-tab:hover {
        border-color: #059669;
        color: #059669;
    }
    
    .filter-tab.active {
        background: #059669;
        border-color: #059669;
        color: white;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    /* Block Header */
    .block-header {
        background: #047857;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin: 35px 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 10px rgba(4, 120, 87, 0.15);
    }

    /* Month Card Table */
    .month-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }
    
    .month-header {
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
    
    .month-header span.count {
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 0.78rem;
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
        font-size: 0.95rem;
        color: #1e293b;
        vertical-align: middle;
    }
    
    .events-table tr:last-child td {
        border-bottom: none;
    }
    
    .events-table tr:hover td {
        background: #f8fafc;
    }

    .date-cell {
        font-weight: 800;
        color: #047857;
        width: 180px;
        white-space: nowrap;
    }

    .activity-cell {
        font-weight: 600;
    }

    /* Highlight Badges */
    .row-exam {
        background: #fef9c3 !important;
    }
    .row-exam td {
        background: #fef9c3 !important;
        color: #713f12 !important;
        font-weight: 700 !important;
    }
    
    .row-holiday {
        background: #fff1f2 !important;
    }
    .row-holiday td {
        background: #fff1f2 !important;
        color: #9f1239 !important;
        font-weight: 600 !important;
    }

    .tag-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-left: 8px;
    }
    
    .tag-exam {
        background: #fde047;
        color: #854d0e;
        border: 1px solid #facc15;
    }
    
    .tag-holiday {
        background: #fecdd3;
        color: #9f1239;
        border: 1px solid #fda4af;
    }

    @media (max-width: 768px) {
        .page-hero h1 { font-size: 2rem; }
        .notice-banner { flex-direction: column; gap: 10px; }
        .events-table th, .events-table td { padding: 12px 14px; }
        .date-cell { width: 130px; font-size: 0.88rem; }
        .activity-cell { font-size: 0.88rem; }
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
        <!-- IMPORTANT NOTICE BOX -->
        <div class="notice-banner">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            <div class="notice-content">
                <strong>Important Notice</strong>
                <p>The schedule of activities outlined herein is subject to change without prior notice, depending on circumstances beyond our control or as deemed necessary by the administration. Any modifications will be communicated to all concerned AMIS Constituents (Staff, Parents, and Students) in a timely and appropriate manner.</p>
            </div>
        </div>

        <!-- FILTER TABS -->
        <div class="filter-tabs">
            <button type="button" class="filter-tab active" onclick="filterTerm('all', this)">All Activities</button>
            <button type="button" class="filter-tab" onclick="filterTerm('opening', this)">Opening Block</button>
            <button type="button" class="filter-tab" onclick="filterTerm('term1', this)">Term 1</button>
            <button type="button" class="filter-tab" onclick="filterTerm('term2', this)">Term 2</button>
            <button type="button" class="filter-tab" onclick="filterTerm('term3', this)">Term 3</button>
            <button type="button" class="filter-tab" onclick="filterTerm('eosy', this)">EOSY Rites</button>
        </div>

        <div id="calendarContent">

            <!-- OPENING BLOCK -->
            <div class="term-group term-opening">
                <div class="block-header">
                    <span>Opening Block</span>
                    <span style="font-size:0.8rem;opacity:0.85;">June 2026</span>
                </div>

                <div class="month-card">
                    <div class="month-header">
                        <span>June 2026</span>
                        <span class="count">11 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">June 8-11</td>
                                <td class="activity-cell">School-based INSET for Teachers (Training-Workshop)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 13</td>
                                <td class="activity-cell">General Orientation for Teachers and Staff</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 14</td>
                                <td class="activity-cell">Parents’ Orientation (Kindergarten ODL)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 15</td>
                                <td class="activity-cell">Parents’ Orientation (Grade 1 to 3 ODL)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 16</td>
                                <td class="activity-cell">Parents’ Orientation (Grade 4 to 6 ODL)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 17</td>
                                <td class="activity-cell">Parents’ Orientation (Grade 7 to 10 ODL)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 18</td>
                                <td class="activity-cell">Parents’ Orientation (Grade 11 to 12 ODL)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 21</td>
                                <td class="activity-cell">Students’ Orientation (Academic)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 22</td>
                                <td class="activity-cell">Students’ Orientation (Islamic)</td>
                            </tr>
                            <tr>
                                <td class="date-cell" style="color:#059669;">June 23</td>
                                <td class="activity-cell"><strong>Instructional Block Begins:</strong> Regular Class (Homeroom Activities/Diagnostic and etc.)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">June 30</td>
                                <td class="activity-cell">Homeroom Election</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TERM 1 -->
            <div class="term-group term-term1">
                <div class="block-header">
                    <span>Term 1</span>
                    <span style="font-size:0.8rem;opacity:0.85;">July – September 2026</span>
                </div>

                <!-- JULY 2026 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>July 2026</span>
                        <span class="count">8 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">July 11</td>
                                <td class="activity-cell">PTA General Assembly and Election of Officers</td>
                            </tr>
                            <tr>
                                <td class="date-cell">July 18</td>
                                <td class="activity-cell">JHS and SHS Get Together</td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">July 19-23</td>
                                <td class="activity-cell">
                                    1st Summative Test (Term 1)
                                    <span class="tag-badge tag-exam">Summative Test</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">July 21</td>
                                <td class="activity-cell">SSC Filing of Candidacy</td>
                            </tr>
                            <tr>
                                <td class="date-cell">July 22-23</td>
                                <td class="activity-cell">SSC Campaign Week</td>
                            </tr>
                            <tr>
                                <td class="date-cell">July 28</td>
                                <td class="activity-cell">Earthquake Drill (Davao)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">July 29</td>
                                <td class="activity-cell">SSC Election of Officers</td>
                            </tr>
                            <tr>
                                <td class="date-cell">July 30</td>
                                <td class="activity-cell">SSC Induction of Officers</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- AUGUST 2026 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>August 2026</span>
                        <span class="count">8 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">August 1</td>
                                <td class="activity-cell">Special Class</td>
                            </tr>
                            <tr>
                                <td class="date-cell">August 2-6</td>
                                <td class="activity-cell">Medical Assessment for Students (F2F)</td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">August 16-20</td>
                                <td class="activity-cell">
                                    2nd Summative Test (Term 1)
                                    <span class="tag-badge tag-exam">Summative Test</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">August 20-22</td>
                                <td class="activity-cell">PEAC INSET for JHS Teachers / Asynchronous class for JHS students</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">August 21</td>
                                <td class="activity-cell">
                                    Special Non-Working Holiday
                                    <span class="tag-badge tag-holiday">Holiday</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">August 24-26</td>
                                <td class="activity-cell">PEAC INSET for SHS Teachers / Asynchronous class for SHS students</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">August 25</td>
                                <td class="activity-cell">
                                    Regular Holiday
                                    <span class="tag-badge tag-holiday">Holiday</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">Instructional Leadership Enhancement Training for Effective Curriculum Implementation</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- SEPTEMBER 2026 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>September 2026</span>
                        <span class="count">9 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row-exam">
                                <td class="date-cell">September 2-3</td>
                                <td class="activity-cell">
                                    1st Term Examination (1st and 2nd Day)
                                    <span class="tag-badge tag-exam">Major Exam</span>
                                </td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">September 6-7</td>
                                <td class="activity-cell">
                                    1st Term Examination (3rd and 4th Day)
                                    <span class="tag-badge tag-exam">Major Exam</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">September 8-10</td>
                                <td class="activity-cell"><strong>End of Term Block:</strong> Wellness Break for Students / Checking of Examinations, Computation of Grades, Preparation of Certificates, Presentation and etc. for Teachers</td>
                            </tr>
                            <tr>
                                <td class="date-cell">September 12</td>
                                <td class="activity-cell">Wellness Break for Teachers</td>
                            </tr>
                            <tr>
                                <td class="date-cell">September 13-15</td>
                                <td class="activity-cell">AMIS School-based Musabaqah</td>
                            </tr>
                            <tr>
                                <td class="date-cell">September 16-17</td>
                                <td class="activity-cell">Sports Fest 2026</td>
                            </tr>
                            <tr>
                                <td class="date-cell">September 19</td>
                                <td class="activity-cell">1st Term Recognition</td>
                            </tr>
                            <tr>
                                <td class="date-cell">September 20</td>
                                <td class="activity-cell">1st Term PTC & Viewing of Grades</td>
                            </tr>
                            <tr>
                                <td class="date-cell" style="color:#059669;">September 21</td>
                                <td class="activity-cell"><strong>Start of Instructional Block (Term 2)</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TERM 2 -->
            <div class="term-group term-term2">
                <div class="block-header">
                    <span>Term 2</span>
                    <span style="font-size:0.8rem;opacity:0.85;">October – December 2026</span>
                </div>

                <!-- OCTOBER 2026 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>October 2026</span>
                        <span class="count">3 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">October 3</td>
                                <td class="activity-cell">Special Class</td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">October 11-15</td>
                                <td class="activity-cell">
                                    1st Summative test (Term 2)
                                    <span class="tag-badge tag-exam">Summative Test</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">October 25-29</td>
                                <td class="activity-cell">English Activities (Subject Area Time Only)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- NOVEMBER 2026 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>November 2026</span>
                        <span class="count">6 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row-holiday">
                                <td class="date-cell">November 1-2</td>
                                <td class="activity-cell">
                                    Academic Break (Holiday)
                                    <span class="tag-badge tag-holiday">Academic Break</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">November 8-12</td>
                                <td class="activity-cell">Math-Sci Week (Subject Area Time Only)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">November 14</td>
                                <td class="activity-cell">Special Class</td>
                            </tr>
                            <tr>
                                <td class="date-cell">November 15</td>
                                <td class="activity-cell">PEPT Luzon</td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">November 16-19</td>
                                <td class="activity-cell">
                                    2nd Summative test (Term 2)
                                    <span class="tag-badge tag-exam">Summative Test</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">November 22-26</td>
                                <td class="activity-cell">PAASCU Visit</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">November 30</td>
                                <td class="activity-cell">
                                    Regular Holiday
                                    <span class="tag-badge tag-holiday">Holiday</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- DECEMBER 2026 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>December 2026</span>
                        <span class="count">10 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row-exam">
                                <td class="date-cell">December 1-3</td>
                                <td class="activity-cell">
                                    2nd Term Examination (1st, 2nd, and 3rd Day)
                                    <span class="tag-badge tag-exam">Major Exam</span>
                                </td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">December 6</td>
                                <td class="activity-cell">
                                    2nd Term Examination (4th Day)
                                    <span class="tag-badge tag-exam">Major Exam</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 7-9</td>
                                <td class="activity-cell"><strong>End of Term Block:</strong> Wellness Break for Students / Checking of Examinations, Computation of Grades, Preparation of Certificates, Presentation and etc. for Teachers</td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 10</td>
                                <td class="activity-cell">Exam Rationalization</td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 12</td>
                                <td class="activity-cell">INSET</td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 13-14</td>
                                <td class="activity-cell">English International Competition</td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 15-16</td>
                                <td class="activity-cell">Math International Competition</td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 17</td>
                                <td class="activity-cell">2nd Term Recognition</td>
                            </tr>
                            <tr>
                                <td class="date-cell">December 19</td>
                                <td class="activity-cell">2nd Term PTC & Viewing of Grades</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">December 20-31</td>
                                <td class="activity-cell">
                                    Semestral & Year End Break
                                    <span class="tag-badge tag-holiday">Year-End Break</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TERM 3 -->
            <div class="term-group term-term3">
                <div class="block-header">
                    <span>Term 3</span>
                    <span style="font-size:0.8rem;opacity:0.85;">January – April 2027</span>
                </div>

                <!-- JANUARY 2027 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>January 2027</span>
                        <span class="count">8 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row-holiday">
                                <td class="date-cell">January 1</td>
                                <td class="activity-cell">
                                    Regular Holiday
                                    <span class="tag-badge tag-holiday">Holiday</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell" style="color:#059669;">January 4</td>
                                <td class="activity-cell"><strong>Instructional Block: Resumption of Classes</strong></td>
                            </tr>
                            <tr>
                                <td class="date-cell">January 16</td>
                                <td class="activity-cell">Orientation for All Graduating Students</td>
                            </tr>
                            <tr>
                                <td class="date-cell">January 23</td>
                                <td class="activity-cell">Faculty and Staff Pictorial</td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">January 24-28</td>
                                <td class="activity-cell">
                                    1st Summative test (Term 3)
                                    <span class="tag-badge tag-exam">Summative Test</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">January 29-31</td>
                                <td class="activity-cell">3rd AMIS International Qur'an Musabaqah</td>
                            </tr>
                            <tr>
                                <td class="date-cell">January 31</td>
                                <td class="activity-cell">Asynchronous Class</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- FEBRUARY 2027 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>February 2027</span>
                        <span class="count">6 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">February 2</td>
                                <td class="activity-cell">Pre-Ramadhan Islamic Symposium & Opening of Sadaqah Boxes</td>
                            </tr>
                            <tr>
                                <td class="date-cell">February 3-6</td>
                                <td class="activity-cell">Pictorial Week for Graduating Students</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">February 8 or 9</td>
                                <td class="activity-cell">
                                    Start of Ramadhan 1448H
                                    <span class="tag-badge tag-holiday">Islamic Event</span>
                                </td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">February 21-25</td>
                                <td class="activity-cell">
                                    2nd Summative test (Term 3)
                                    <span class="tag-badge tag-exam">Summative Test</span>
                                </td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">February 28</td>
                                <td class="activity-cell">
                                    Start of Ramadhan Break
                                    <span class="tag-badge tag-holiday">Ramadhan Break</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- MARCH 2027 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>March 2027</span>
                        <span class="count">6 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row-holiday">
                                <td class="date-cell">March 1-11</td>
                                <td class="activity-cell">
                                    Ramadhan Break
                                    <span class="tag-badge tag-holiday">Ramadhan Break</span>
                                </td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">
                                    Eid’l Fitr
                                    <span class="tag-badge tag-holiday">Islamic Holiday</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">March 13</td>
                                <td class="activity-cell">Resumption of Work (Staff Only)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">March 14</td>
                                <td class="activity-cell">Resumption of Classes (PAT ME Celebration) With Students</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">March 25-26</td>
                                <td class="activity-cell">
                                    Regular Holidays
                                    <span class="tag-badge tag-holiday">Holiday</span>
                                </td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">March 28 – 31</td>
                                <td class="activity-cell">
                                    3rd Term Examination (Graduating Students)
                                    <span class="tag-badge tag-exam">Major Exam</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- APRIL 2027 -->
                <div class="month-card">
                    <div class="month-header">
                        <span>April 2027</span>
                        <span class="count">2 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">April 1</td>
                                <td class="activity-cell">Remedial Examination (Graduating Students)</td>
                            </tr>
                            <tr class="row-exam">
                                <td class="date-cell">April 4-7</td>
                                <td class="activity-cell">
                                    3rd Term Examination (Non-Graduating Students)
                                    <span class="tag-badge tag-exam">Major Exam</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- EOSY RITES & END OF SCHOOL YEAR -->
            <div class="term-group term-eosy">
                <div class="block-header" style="background:#0f172a;">
                    <span>End-of-School Year (EOSY) Block 2026-2027</span>
                    <span style="font-size:0.8rem;opacity:0.85;">April 2027</span>
                </div>

                <div class="month-card">
                    <div class="month-header" style="background:#1e293b;">
                        <span>EOSY Rites & Year-End Ceremonies</span>
                        <span class="count">11 Activities</span>
                    </div>
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th class="date-cell">Date</th>
                                <th>Activity / Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell">April 8</td>
                                <td class="activity-cell">Remedial Examination (Non-Graduating Students)</td>
                            </tr>
                            <tr class="row-holiday">
                                <td class="date-cell">April 9</td>
                                <td class="activity-cell">
                                    Regular Holiday
                                    <span class="tag-badge tag-holiday">Holiday</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="date-cell">April 11-13</td>
                                <td class="activity-cell">Compliance with INC Requirements and Clearance</td>
                            </tr>
                            <tr>
                                <td class="date-cell">April 14-15</td>
                                <td class="activity-cell">Rehearsal for EOSY Rites (Davao)</td>
                            </tr>
                            <tr>
                                <td class="date-cell">April 17</td>
                                <td class="activity-cell"><strong>Year-End Recognition (Davao)</strong></td>
                            </tr>
                            <tr style="background:#f0fdf4;">
                                <td class="date-cell" style="color:#047857;">April 18</td>
                                <td class="activity-cell"><strong style="color:#047857;">Graduation and Moving Up Ceremony (Davao)</strong></td>
                            </tr>
                            <tr>
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">KSA Year-End Recognition, Graduation, and Moving Up Ceremony</td>
                            </tr>
                            <tr>
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">UAE Year-End Recognition, Graduation, and Moving Up Ceremony</td>
                            </tr>
                            <tr>
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">Qatar Year-End Recognition, Graduation, and Moving Up Ceremony</td>
                            </tr>
                            <tr>
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">Releasing of Cards</td>
                            </tr>
                            <tr>
                                <td class="date-cell">TBA</td>
                                <td class="activity-cell">EOSY General Assembly with PTA Officers and School Admin</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- REPEATED NOTICE AT FOOTER OF CALENDAR -->
        <div class="notice-banner" style="margin-top: 50px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            <div class="notice-content">
                <strong>IMPORTANT NOTICE</strong>
                <p>The schedule of activities outlined herein is subject to change without prior notice, depending on circumstances beyond our control or as deemed necessary by the administration. Any modifications will be communicated to all concerned AMIS Constituents (Staff, Parents, and Students) in a timely and appropriate manner.</p>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function filterTerm(term, btn) {
        document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const groups = document.querySelectorAll('.term-group');
        groups.forEach(group => {
            if (term === 'all') {
                group.style.display = 'block';
            } else {
                if (group.classList.contains('term-' + term)) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            }
        });
    }
</script>
@endsection
