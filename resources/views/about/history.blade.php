@extends('layouts.app')

@section('title', 'History | AMIS')

@section('styles')
<style>
    .history-page {
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
    .content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 80px;
    }
    .content-wrapper p {
        font-size: 1.05rem;
        line-height: 1.9;
        color: var(--text-light);
        text-align: justify;
        margin-bottom: 25px;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        .page-subtitle {
            font-size: 1rem;
        }
        .content-wrapper p {
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<div class="history-page">
    <!-- Breadcrumb Header -->
    <div class="breadcrumb-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('about.index') }}">About Us</a>
                <span class="separator">/</span>
                <span>History</span>
            </div>
        </div>
    </div>

    <!-- Section Content -->
    <section class="section">
        <div class="container">
            <h1 class="page-title">History</h1>
            <p class="page-subtitle">Our journey and milestones</p>

            <div class="content-wrapper">
                <p>Al Munawwara Islamic School (AMIS) was established in 2008 as part of the Moro National Liberation Front (MNLF) and Government of the Republic of the Philippines (GRP) Peace Agreement signed in 1996, which aimed to integrate traditional madrasahs into the Philippine educational system. Consequently, DepEd Order No. 51, Series of 2004, signed by the former DepEd Secretary Mr. Edilberto C. de Jesus, was issued to invite traditional madrasahs to become pilot private madrasahs. After four years of preparation, the program was implemented in 2008, and AMIS was among the schools selected to participate. It became the first-ever private Islamic school to be established in Davao City that is duly recognized by the Department of Education (DepEd).</p>

                <p>Initially, the school offered Kindergarten, Preparatory, and Grade 1 levels for the School Year 2008-2009 and the Summer of 2009. The school provided an 8-week curriculum on Early Childhood Learning in preparation for Grade 1 and an Accelerated Islamic Studies Learning Program for transfer students who did not have Islamic Studies in their previous schools.</p>

                <p>As of now, the Al Munawwara Islamic School (AMIS) completely offers Basic Education from Kindergarten 1 to Grade 12 with the Department of Education's K-12 Curriculum and Revised K-10 Curriculum plus a refined standard Madrasah Curriculum. AMIS has also received international accreditation from QAHE in 2025 and ACTD USA.</p>

                <p>Al Munawwara Islamic School believes that the "Islamic Development Approach" leads to academic excellence, it produces the sphere of creativity, ingenuity of one's mind, and well-rounded student development. Our commitment to quality learning and extensive educational exposure aims to equip students to meet global demands and achieve a brighter future. While emphasizing physical, social, and intellectual development, we prioritize Islamic values and beliefs based on the Qur'an and Sunnah as the core of our educational integrity.</p>
            </div>
        </div>
    </section>
</div>
@endsection
