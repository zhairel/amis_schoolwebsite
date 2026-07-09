@extends('layouts.app')

@section('title', 'Basic Education - K to 12 | AMIS')

@section('styles')
<style>
    .basic-education-page {
        min-height: 100vh;
    }
    .breadcrumb-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 20px 0;
        margin-top: 0;
        position: relative;
        top: 0;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 0.9rem;
    }
    .breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb a:hover {
        color: white;
    }
    .breadcrumb .separator {
        color: rgba(255, 255, 255, 0.6);
    }
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 16px;
        color: var(--text);
        margin-top: 40px;
    }
    .page-subtitle {
        text-align: center;
        color: var(--text-light);
        font-size: 1.25rem;
        margin-bottom: 60px;
    }
    .curriculum-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 80px;
    }
    .curriculum-card {
        background: white;
        border-radius: 16px;
        padding: 40px 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border-top: 4px solid var(--primary);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }
    .curriculum-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
    }
    .curriculum-card h3 {
        font-size: 1.5rem;
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 16px;
    }
    .curriculum-card p {
        color: var(--text-light);
        line-height: 1.7;
        font-size: 0.95rem;
        margin-bottom: 20px;
    }
    .subjects-list {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }
    .subjects-list h4 {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text);
        margin-bottom: 8px;
    }
    .subjects-list ul {
        list-style: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .subjects-list li {
        font-size: 0.8rem;
        background: var(--bg-light);
        border: 1px solid var(--border);
        color: var(--text-light);
        padding: 4px 10px;
        border-radius: 6px;
    }
    @media (max-width: 768px) {
        .page-title { font-size: 2rem; }
        .page-subtitle { font-size: 1rem; }
    }
</style>
@endsection

@section('content')
<div class="basic-education-page">
    <!-- Breadcrumb Header -->
    <div class="breadcrumb-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('academics.index') }}">Academics</a>
                <span class="separator">/</span>
                <span>Basic Education - K to 12</span>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <section class="section">
        <div class="container">
            <h1 class="page-title">Basic Education - K to 12</h1>
            <p class="page-subtitle">Comprehensive academic programs from Kindergarten to Grade 12</p>

            <div class="curriculum-grid">
                <!-- Kindergarten -->
                <div class="curriculum-card">
                    <h3>Kindergarten</h3>
                    <p>Focuses on early childhood development, cognitive learning, basic numbers and letters, motor skills, social interactions, and introductory Islamic manners (Adab).</p>
                    <div class="subjects-list">
                        <h4>Core Focus</h4>
                        <ul>
                            <li>Phonics</li>
                            <li>Early Math</li>
                            <li>Arabic Letters</li>
                            <li>Sunnah Manners</li>
                            <li>Art & Play</li>
                        </ul>
                    </div>
                </div>

                <!-- Elementary -->
                <div class="curriculum-card">
                    <h3>Elementary (Grades 1-6)</h3>
                    <p>Builds a strong foundation in core academic subjects according to the Department of Education standards, coupled with comprehensive Islamic Studies and Arabic Language courses.</p>
                    <div class="subjects-list">
                        <h4>Key Subjects</h4>
                        <ul>
                            <li>Mathematics</li>
                            <li>Science</li>
                            <li>English</li>
                            <li>Filipino</li>
                            <li>Arabiyyah</li>
                            <li>Quranic Memorization</li>
                        </ul>
                    </div>
                </div>

                <!-- Junior High -->
                <div class="curriculum-card">
                    <h3>Junior High (Grades 7-10)</h3>
                    <p>Develops critical thinking, problem-solving, and scientific inquiry skills. Students study advanced math and science disciplines alongside deeper exploration of Fiqh, Aqeedah, and Islamic History.</p>
                    <div class="subjects-list">
                        <h4>Key Subjects</h4>
                        <ul>
                            <li>Algebra & Geometry</li>
                            <li>Biology & Chemistry</li>
                            <li>Social Studies</li>
                            <li>Arabic Grammar</li>
                            <li>Fiqh & Aqeedah</li>
                        </ul>
                    </div>
                </div>

                <!-- Senior High -->
                <div class="curriculum-card">
                    <h3>Senior High (Grades 11-12)</h3>
                    <p>Prepares students for college academic tracks (such as General Academic and STEM strands) while enriching leadership qualities and global exposure in line with Islamic faith principles.</p>
                    <div class="subjects-list">
                        <h4>Key Strands</h4>
                        <ul>
                            <li>STEM</li>
                            <li>GAS (General Academics)</li>
                            <li>Research Projects</li>
                            <li>Islamic Leadership</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
