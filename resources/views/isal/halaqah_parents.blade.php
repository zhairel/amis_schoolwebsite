@extends('layouts.app')

@section('title', 'Halaqah Parents | Al Munawwara Islamic School')

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
        max-width: 750px;
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

    /* Pillars Grid */
    .pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin: 40px 0 60px;
    }
    .pillar-card {
        background: white;
        padding: 32px 24px;
        border-radius: 20px;
        border: 1px solid rgba(5, 150, 105, 0.15);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        text-align: center;
        transition: transform 0.3s;
    }
    .pillar-card:hover {
        transform: translateY(-5px);
    }
    .pillar-icon {
        width: 60px;
        height: 60px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #059669;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .pillar-icon svg {
        width: 30px;
        height: 30px;
        stroke-width: 2;
    }
    .pillar-card h3 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #064e3b;
        margin-bottom: 12px;
    }
    .pillar-card p {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.6;
        margin: 0;
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
    .corner-top-left { top: 14px; left: 14px; border-right: none; border-bottom: none; }
    .corner-top-right { top: 14px; right: 14px; border-left: none; border-bottom: none; }
    .corner-bottom-left { bottom: 14px; left: 14px; border-right: none; border-top: none; }
    .corner-bottom-right { bottom: 14px; right: 14px; border-left: none; border-top: none; }

    .schedule-card h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.85rem;
        color: #064e3b;
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
        color: #d97706;
    }

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
        background-color: #064e3b;
        color: #fef08a;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        padding: 16px;
        text-transform: uppercase;
        font-size: 0.82rem;
        letter-spacing: 0.06em;
        border-bottom: 2px solid #d97706;
    }
    .halaqah-table td {
        padding: 18px 16px;
        border-bottom: 1px solid rgba(5, 150, 105, 0.08);
        color: #1f2937;
        font-weight: 600;
        vertical-align: middle;
    }
    .halaqah-table tr:nth-child(even) td {
        background-color: rgba(240, 253, 244, 0.35);
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
    
    .team-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 800;
    }
    .badge-ummahat {
        background-color: #fce7f3;
        color: #be185d;
        border: 1px solid #fbcfe8;
    }
    .badge-aba {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
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
    .form-group input:not(#parent_email),
    .form-group textarea {
        text-transform: uppercase;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
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

    @media (max-width: 968px) {
        .page-hero h1 { font-size: 2.75rem; }
        .pillars-grid { grid-template-columns: 1fr; }
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
            <h1>Halaqah Parents</h1>
            <p>Empowering AMIS Parents through Islamic Knowledge & Family Guidance</p>
        </div>
    </section>

    <!-- CONTENT OVERVIEW -->
    <section class="content-section">
        <div class="container">
            <div class="intro-container">
                <div class="intro-text">
                    <h2>Program Overview</h2>
                    <p>The <strong>AMIS Halaqah Parents Program</strong> is an Islamic educational initiative created specifically for mothers, fathers, and guardians of Al Munawwara Islamic School (AMIS) students. Designed to support Islamic learning at home, this program helps parents deepen their understanding of Islamic Tarbiya (Parenting), Qur'an Recitation, Tajweed, and practical Fiqh for family life.</p>
                    <p>By fostering a collaborative Islamic environment between school and home, parents are equipped with the knowledge and spiritual grounding needed to nurture righteous, knowledgeable, and compassionate children.</p>
                    <p>Classes are held in flexible online and weekend sessions, led by respected Asaatidh (instructors) of Al Munawwara Islamic School, and offered <strong>free of charge</strong> for all AMIS parents.</p>

                    <!-- PROGRAM PILLARS -->
                    <div class="pillars-grid">
                        <div class="pillar-card">
                            <div class="pillar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <h3>Islamic Tarbiya</h3>
                            <p>Learn Islamic principles of child rearing, character building, and nurturing faith in young hearts.</p>
                        </div>
                        <div class="pillar-card">
                            <div class="pillar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <h3>Qur'an & Tajweed</h3>
                            <p>Refine your recitation, learn proper Tajweed rules, and memorize key daily Surahs together with your kids.</p>
                        </div>
                        <div class="pillar-card">
                            <div class="pillar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <h3>Family Fiqh & Sunnah</h3>
                            <p>Gain practical clarity on daily acts of worship, household ethics, Halal living, and prophetic traditions.</p>
                        </div>
                    </div>

                    <!-- Timetable Card -->
                    <div class="schedule-card">
                        <div class="corner-ornament corner-top-left"></div>
                        <div class="corner-ornament corner-top-right"></div>
                        <div class="corner-ornament corner-bottom-left"></div>
                        <div class="corner-ornament corner-bottom-right"></div>

                        <div class="islamic-watermark">
                            <svg viewBox="0 0 100 100" fill="none" stroke="#d97706" stroke-width="1.2">
                                <path d="M50 5 L63 37 L95 50 L63 63 L50 95 L37 63 L5 50 L37 37 Z" />
                                <path d="M50 5 L78 22 L95 50 L78 78 L50 95 L22 78 L5 50 L22 22 Z" transform="rotate(45 50 50)" />
                                <circle cx="50" cy="50" r="22" />
                            </svg>
                        </div>

                        <h3>Halaqah Parents Timetable</h3>
                        <div class="islamic-divider"><span class="divider-line"></span></div>

                        <div class="halaqah-table-wrap">
                            <table class="halaqah-table">
                                <thead>
                                    <tr>
                                        <th style="width: 22%">Session Day</th>
                                        <th style="width: 20%">Schedule</th>
                                        <th style="width: 18%">Group</th>
                                        <th style="width: 20%">Focus Topic</th>
                                        <th style="width: 20%">Lead Asaatidh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="day-col">SATURDAY MORNING</td>
                                        <td class="time-col">8:30 AM - 10:00 AM</td>
                                        <td><span class="team-badge badge-ummahat">FASLOL UMMAHAT</span></td>
                                        <td><strong class="subject-text">Tarbiya & Qur'an Tajweed</strong></td>
                                        <td class="instructor-col">USTADZA & ISAL STAFF</td>
                                    </tr>
                                    <tr>
                                        <td class="day-col">SUNDAY EVENING</td>
                                        <td class="time-col">7:30 PM - 9:00 PM</td>
                                        <td><span class="team-badge badge-aba">FASLOL ABA'</span></td>
                                        <td><strong class="subject-text">Family Fiqh & Character</strong></td>
                                        <td class="instructor-col">USTADZ & ISAL FACULTY</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- REGISTRATION SECTION -->
    <section class="register-section" id="register">
        <div class="container">
            <div class="register-container">
                <div class="register-card">
                    <h3>Register for Halaqah Parents</h3>
                    <p>Join our online learning sessions. Fill out the form below to enroll.</p>

                    <div id="formSuccessAlert" style="display: none; background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px; border-radius: 12px; font-weight: 700; text-align: center; margin-bottom: 24px;">
                        JazakAllahu Khayran! Your registration for Halaqah Parents has been successfully submitted. Our ISAL Department coordinator will reach out to you shortly.
                    </div>

                    <form id="parentsHalaqahForm" onsubmit="handleRegistrationSubmit(event)">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="parent_name">Parent / Guardian Full Name *</label>
                                <input type="text" id="parent_name" name="parent_name" required placeholder="e.g. FATIMA ZAHRA DIAZ">
                            </div>

                            <div class="form-group">
                                <label for="parent_category">Category *</label>
                                <select id="parent_category" name="parent_category" required>
                                    <option value="">Select Category</option>
                                    <option value="Mother">Mother (Faslol Ummahat)</option>
                                    <option value="Father">Father (Faslol Aba')</option>
                                    <option value="Guardian">Legal Guardian</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mobile_number">Mobile / WhatsApp Number *</label>
                                <input type="tel" id="mobile_number" name="mobile_number" required placeholder="e.g. 09171234567">
                            </div>

                            <div class="form-group">
                                <label for="parent_email">Email Address</label>
                                <input type="email" id="parent_email" name="parent_email" placeholder="e.g. parent@example.com">
                            </div>

                            <div class="form-group">
                                <label for="child_name">Child's Name (Student in AMIS)</label>
                                <input type="text" id="child_name" name="child_name" placeholder="e.g. AHMAD DIAZ">
                            </div>

                            <div class="form-group">
                                <label for="child_grade">Child's Grade Level</label>
                                <select id="child_grade" name="child_grade">
                                    <option value="">Select Grade Level</option>
                                    <option value="Kindergarten">Kindergarten</option>
                                    <option value="Grade 1-3">Grade 1 - Grade 3</option>
                                    <option value="Grade 4-6">Grade 4 - Grade 6</option>
                                    <option value="Grade 7-10">Grade 7 - Grade 10 (JHS)</option>
                                    <option value="Grade 11-12">Grade 11 - Grade 12 (SHS)</option>
                                </select>
                            </div>

                            <div class="form-group full-width">
                                <label for="remarks">Additional Notes or Questions (Optional)</label>
                                <textarea id="remarks" name="remarks" rows="3" placeholder="Any specific Islamic topics or questions you would like to focus on..."></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-register" id="btnSubmitForm">Submit Registration</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    function handleRegistrationSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitForm');
        const alert = document.getElementById('formSuccessAlert');
        const form = document.getElementById('parentsHalaqahForm');

        btn.disabled = true;
        btn.textContent = 'Submitting...';

        setTimeout(() => {
            btn.style.display = 'none';
            alert.style.display = 'block';
            form.reset();
            alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 1000);
    }
</script>
@endsection
