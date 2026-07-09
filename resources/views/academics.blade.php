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
                    <div class="program-icon">👶</div>
                    <h3>Elementary</h3>
                    <p>Building strong foundations in core subjects with engaging, hands-on learning experiences and early childhood learning programs.</p>
                </a>
                
                <a href="{{ route('academics.basic-education') }}" class="program-card">
                    <div class="program-icon">🔬</div>
                    <h3>Junior High</h3>
                    <p>Developing critical thinking, analysis, and problem-solving skills across diverse subjects and core Islamic disciplines.</p>
                </a>
                
                <a href="{{ route('academics.basic-education') }}" class="program-card">
                    <div class="program-icon">🎓</div>
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
                    <h3>🎨 Islamic Arts & Arabic</h3>
                    <p>Fostering reading, writing, and speaking skills in the Arabic language alongside Islamic cultural arts.</p>
                </div>
                <div class="special-card">
                    <h3>⚽ Sports & Wellness</h3>
                    <p>Building teamwork, leadership, and physical fitness through physical education and annual school sports festivals.</p>
                </div>
                <div class="special-card">
                    <h3>💻 STEM & Technology</h3>
                    <p>Preparing students for digital innovation with computational thinking, science laboratories, and technological literacy.</p>
                </div>
                <div class="special-card">
                    <h3>📖 Quranic Studies</h3>
                    <p>Nurturing spiritual excellence through recitation, memorization, and comprehension of the Holy Quran.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
