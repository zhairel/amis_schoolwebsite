@extends('layouts.app')

@section('title', 'Academics | AMIS')

@section('styles')
<style>
    .academics-page {
        min-height: 100vh;
    }
    .page-hero {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }
    .page-hero h1 {
        font-size: 3rem;
        margin-bottom: 16px;
        font-weight: 800;
    }
    .page-hero p {
        font-size: 1.25rem;
        opacity: 0.95;
    }
    .programs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    .program-card {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        text-align: center;
        border: 2px solid var(--border);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }
    .program-card:hover {
        border-color: var(--primary);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .program-icon {
        font-size: 3.5rem;
        margin-bottom: 20px;
    }
    .program-card h3 {
        font-size: 1.75rem;
        margin-bottom: 16px;
        color: var(--primary);
        font-weight: 700;
    }
    .program-card p {
        color: var(--text-light);
        line-height: 1.6;
    }
    .special-programs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-top: 40px;
        padding-bottom: 40px;
    }
    .special-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        border-left: 4px solid var(--primary);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .special-card h3 {
        font-size: 1.25rem;
        margin-bottom: 12px;
        color: var(--text);
        font-weight: 700;
    }
    .special-card p {
        color: var(--text-light);
        line-height: 1.6;
    }
    @media (max-width: 768px) {
        .page-hero h1 { font-size: 2.5rem; }
    }
</style>
@endsection

@section('content')
<div class="academics-page">
    <section class="page-hero">
        <div class="container">
            <h1>Academics</h1>
            <p>Comprehensive programs designed for student success</p>
        </div>
    </section>

    <!-- Programs Overview -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Our Programs</h2>
            <p class="section-subtitle">We offer standard DepEd basic education integrated with a rich Madrasah curriculum</p>
            
            <div class="programs-grid">
                <a href="{{ route('academics.basic-education') }}" class="program-card">
                    <div class="program-icon" style="display: flex; justify-content: center; align-items: center; color: var(--primary);">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 2v20"/><path d="M10 7h6"/><path d="M10 11h6"/></svg>
                    </div>
                    <h3>Elementary</h3>
                    <p>Building strong foundations in core subjects with engaging, hands-on learning experiences and early childhood learning programs.</p>
                </a>
                
                <a href="{{ route('academics.basic-education') }}" class="program-card">
                    <div class="program-icon" style="display: flex; justify-content: center; align-items: center; color: var(--primary);">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18h8"/><path d="M3 22h18"/><path d="M14 22a7 7 0 1 0 0-14h-1"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"/></svg>
                    </div>
                    <h3>Junior High</h3>
                    <p>Developing critical thinking, analysis, and problem-solving skills across diverse subjects and core Islamic disciplines.</p>
                </a>
                
                <a href="{{ route('academics.basic-education') }}" class="program-card">
                    <div class="program-icon" style="display: flex; justify-content: center; align-items: center; color: var(--primary);">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    </div>
                    <h3>Senior High</h3>
                    <p>Preparing students for higher education and career excellence with advanced curriculum options and global academic exposures.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Special Areas -->
    <section class="section" style="background: var(--bg-light)">
        <div class="container">
            <h2 class="section-title">Special Programs</h2>
            <p class="section-subtitle">Areas of holistic student development</p>
            
            <div class="special-programs">
                <div class="special-card">
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); flex-shrink: 0;"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/></svg>
                        Islamic Arts &amp; Arabic
                    </h3>
                    <p>Fostering reading, writing, and speaking skills in the Arabic language alongside Islamic cultural arts.</p>
                </div>
                <div class="special-card">
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); flex-shrink: 0;"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/></svg>
                        Sports &amp; Wellness
                    </h3>
                    <p>Building teamwork, leadership, and physical fitness through physical education and annual school sports festivals.</p>
                </div>
                <div class="special-card">
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); flex-shrink: 0;"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
                        STEM &amp; Technology
                    </h3>
                    <p>Preparing students for digital innovation with computational thinking, science laboratories, and technological literacy.</p>
                </div>
                <div class="special-card">
                    <h3 style="display: flex; align-items: center; gap: 8px;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); flex-shrink: 0;"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 2v20"/></svg>
                        Quranic Studies
                    </h3>
                    <p>Nurturing spiritual excellence through recitation, memorization, and comprehension of the Holy Quran.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
