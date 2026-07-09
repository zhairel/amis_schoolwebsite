@extends('layouts.app')

@section('title', 'Admissions | AMIS')

@section('styles')
<style>
    .admissions-page {
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
    .steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    .step {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border-top: 3px solid var(--primary);
    }
    .step-number {
        width: 60px;
        height: 60px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 auto 20px;
    }
    .step h3 {
        font-size: 1.35rem;
        margin-bottom: 12px;
        color: var(--text);
        font-weight: 700;
    }
    .step p {
        color: var(--text-light);
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .requirements {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
        margin-bottom: 60px;
    }
    .req-card {
        background: white;
        padding: 40px;
        border-radius: 12px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    .req-card h3 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: var(--primary);
        font-weight: 700;
    }
    .req-card ul {
        list-style: none;
        padding: 0;
    }
    .req-card li {
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
        color: var(--text-light);
        font-size: 0.95rem;
    }
    .req-card li:last-child {
        border-bottom: none;
    }
    .req-card li::before {
        content: "✓ ";
        color: var(--primary);
        font-weight: 700;
        margin-right: 8px;
    }
    .cta-box {
        background: white;
        padding: 60px;
        border-radius: 12px;
        text-align: center;
        border: 2px solid var(--primary);
        box-shadow: 0 4px 20px rgba(5, 150, 105, 0.08);
        margin-bottom: 80px;
    }
    .cta-box h3 {
        font-size: 2rem;
        margin-bottom: 12px;
        font-weight: 700;
    }
    .cta-box p {
        font-size: 1.125rem;
        color: var(--text-light);
        margin-bottom: 24px;
    }
    @media (max-width: 768px) {
        .page-hero h1 { font-size: 2.5rem; }
        .cta-box { padding: 40px 20px; }
    }
</style>
@endsection

@section('content')
<div class="admissions-page">
    <section class="page-hero">
        <div class="container">
            <h1>Admissions</h1>
            <p>Join our community of learners</p>
        </div>
    </section>

    <!-- Application Process -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Application Process</h2>
            <p class="section-subtitle">Four simple steps to enroll your child at AMIS</p>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Submit Application</h3>
                    <p>Complete our online application form with the required files and student documents.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Assessment</h3>
                    <p>Schedule and participate in our entrance academic assessment and student/parent interview.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Review</h3>
                    <p>Our admissions committee reviews the assessment performance and submitted documents.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Enrollment</h3>
                    <p>Receive your admission decision letter and complete the school enrollment process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements -->
    <section class="section" style="background: var(--bg-light)">
        <div class="container">
            <h2 class="section-title">Admission Requirements</h2>
            <p class="section-subtitle">Documents and files needed for new students</p>
            
            <div class="requirements">
                <div class="req-card">
                    <h3>📄 Required Documents</h3>
                    <ul>
                        <li>PSA Birth Certificate (Original & Photocopy)</li>
                        <li>Report Card / Form 138 (from previous school)</li>
                        <li>Certificate of Good Moral Character</li>
                        <li>Recent 2x2 ID Photos (2 copies)</li>
                    </ul>
                </div>
                
                <div class="req-card">
                    <h3>📝 Student Profile Details</h3>
                    <ul>
                        <li>Student personal information</li>
                        <li>Parent / Guardian occupation & contact details</li>
                        <li>Emergency contact details</li>
                        <li>Academic history and special needs checklist</li>
                    </ul>
                </div>
            </div>
            
            <div class="cta-box">
                <h3>Ready to Apply?</h3>
                <p>Have questions about tuition fees, slot availability, or requirements? Get in touch with our team.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
    </section>
</div>
@endsection
