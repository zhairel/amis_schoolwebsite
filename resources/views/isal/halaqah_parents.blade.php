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
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        max-width: 750px;
        margin: 40px auto 60px;
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
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <h3>Qur'an & Tajweed</h3>
                            <p>Refine your recitation, learn proper Tajweed rules, and memorize key daily Surahs together with your kids.</p>
                        </div>
                        <div class="pillar-card">
                            <div class="pillar-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <h3>Arabic Reading & Writing</h3>
                            <p>Master Arabic alphabet pronunciation, reading fluency, and foundational writing skills for understanding Islamic texts.</p>
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
                    <p>Join our online learning sessions. Fill out the application form below.</p>

                    <div style="background: #ecfdf5; border-left: 4px solid #059669; padding: 14px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 0.95rem; color: #065f46; text-align: left; line-height: 1.5; font-weight: 600;">
                        ✨ <strong>Program Fee:</strong> The Halaqah Parents sessions are <strong>completely free of charge</strong>. For those who wish to earn blessings and support our school, voluntary <strong>Sadaqah (donations)</strong> are welcome and highly appreciated.
                    </div>
                    
                    @if(session('success'))
                        <div style="background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px; border-radius: 12px; font-weight: 700; text-align: center; margin-bottom: 24px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 16px; border-radius: 12px; font-weight: 600; margin-bottom: 24px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="Halaqah Parents Registration" />
                        
                        <div class="form-grid">
                            <!-- 1. First Name -->
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="e.g. FATIMA" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <!-- 2. Middle Name -->
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="e.g. ZAHRA" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <!-- 3. Last Name -->
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="e.g. DIAZ" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <!-- 4. Age -->
                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input type="number" id="age" name="age" min="15" max="100" value="{{ old('age') }}" required placeholder="e.g. 35" />
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

        <div style="display: flex; flex-direction: column; gap: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px; margin-bottom: 20px; font-size: 0.88rem; color: #334155; line-height: 1.5;">
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
