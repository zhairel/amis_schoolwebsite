@extends('layouts.app')

@section('title', 'Certifications & Accreditations | AMIS')

@section('styles')
<style>
    .certifications {
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
    .main-accreditations {
        margin-bottom: 60px;
    }
    .accred-section {
        margin-bottom: 50px;
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    .accred-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 30px;
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 3px solid var(--primary);
    }
    .accred-images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    .accred-images-grid.single {
        grid-template-columns: 1fr;
        max-width: 800px;
        margin: 0 auto;
    }
    .accred-img-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 3px solid var(--border);
        cursor: pointer;
    }
    .accred-img-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        border-color: var(--primary);
    }
    .accred-img-card img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
        background: white;
    }
    .zoom-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .zoom-modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        animation: zoomIn 0.3s ease;
    }
    @keyframes zoomIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .zoom-modal-content img {
        width: 100%;
        height: auto;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 8px;
    }
    .zoom-close {
        position: absolute;
        top: -50px;
        right: 0;
        background: white;
        color: #1f2937;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-weight: 700;
    }
    .zoom-close:hover {
        background: var(--primary);
        color: white;
        transform: rotate(90deg);
    }
    .info-box {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 50px 40px;
        border-radius: 16px;
        color: white;
        text-align: center;
        margin-bottom: 80px;
    }
    .info-box h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: white;
    }
    .info-box p {
        color: rgba(255, 255, 255, 0.95);
        line-height: 1.8;
        font-size: 1.15rem;
        margin-bottom: 40px;
        max-width: 900px;
        margin: 0 auto 40px;
    }
    .accred-badges {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        max-width: 1050px;
        margin: 0 auto;
    }
    .badge {
        background: rgba(255, 255, 255, 0.15);
        padding: 20px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }
    .badge:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-5px);
    }
    .badge-icon {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
    }
    .badge-text {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
    }
    .accred-header-wrap {
        text-align: center;
        margin-bottom: 24px;
    }
    .accred-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .accred-pill.active-pill {
        background: #ecfdf5;
        color: #065f46;
        border: 1.5px solid #a7f3d0;
    }
    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #059669;
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
        animation: pulseGreen 2s infinite;
    }
    @keyframes pulseGreen {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 8px rgba(5, 150, 105, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
        }
    }
    .accred-lead {
        max-width: 820px;
        margin: 0 auto 24px;
        text-align: center;
        color: #475569;
        font-size: 1.05rem;
        line-height: 1.7;
    }
    .peac-meta-card {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px;
        margin: 0 auto 36px;
        max-width: 960px;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8), 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .peac-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px;
        margin-bottom: 18px;
    }
    .peac-meta-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        text-align: left;
    }
    .peac-meta-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 700;
        color: #64748b;
    }
    .peac-meta-val {
        font-size: 0.98rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .peac-meta-val.text-success {
        color: #059669;
    }
    .peac-meta-val.code-val {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        letter-spacing: 0.5px;
        color: #991b1b;
        background: #fef2f2;
        padding: 3px 8px;
        border-radius: 6px;
        border: 1px solid #fee2e2;
        font-size: 0.92rem;
    }
    .peac-school-ids {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 12px 24px;
        font-size: 0.88rem;
        color: #334155;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
        text-align: center;
    }
    .accred-card-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .accred-card-header {
        display: flex;
        flex-direction: column;
        gap: 3px;
        text-align: left;
    }
    .card-badge {
        font-weight: 800;
        font-size: 0.98rem;
        color: #0f172a;
    }
    .card-sub {
        font-size: 0.82rem;
        color: #64748b;
    }
    .zoom-hint {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 14px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        transition: all 0.2s ease;
    }
    .accred-img-card:hover .zoom-hint {
        background: #ecfdf5;
        color: #065f46;
    }
    @media (max-width: 768px) {
        .page-title { font-size: 2rem; }
        .page-subtitle { font-size: 1rem; }
        .accred-section { padding: 20px; }
        .accred-title { font-size: 1.5rem; }
        .accred-images-grid { grid-template-columns: 1fr; }
        .accred-badges { grid-template-columns: 1fr 1fr; }
        .peac-meta-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
        .peac-school-ids { flex-direction: column; gap: 6px; }
        .zoom-close { top: 10px; right: 10px; }
        .zoom-modal-content { max-width: 95vw; }
    }
</style>
@endsection

@section('content')
<div class="certifications">
    <!-- Breadcrumb Header -->
    <div class="breadcrumb-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">/</span>
                <a href="{{ route('about.history') }}">About Us</a>
                <span class="separator">/</span>
                <span>Certifications & Recognition</span>
            </div>
        </div>
    </div>

    <!-- Section Content -->
    <section class="section">
        <div class="container">
            <h1 class="page-title">Certifications & Recognition</h1>
            <p class="page-subtitle">Our commitment to excellence is recognized by leading educational authorities</p>

            <div class="main-accreditations">
                <div class="accred-section">
                    <h2 class="accred-title">QAHE - Quality Assurance in Pre-Tertiary &amp; Higher Education</h2>
                    <div class="accred-images-grid single">
                        <div class="accred-img-card large zoomable" data-image="/accre/QAHE_cert.png">
                            <img src="/accre/QAHE_cert.png" alt="QAHE Full Accreditation Certificate" loading="lazy" />
                            <div class="zoom-hint">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                <span>Click to enlarge certificate</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accred-section">
                    <div class="accred-header-wrap">
                        <span class="accred-pill active-pill">
                            <span class="pulse-dot"></span>
                            ACTIVE CERTIFICATION
                        </span>
                        <h2 class="accred-title">DepEd &amp; PEAC - Private Education Assistance Committee</h2>
                        <p class="accred-lead">
                            Al Munawwara Islamic School has satisfactorily met the official standards and requirements for the Junior High School Program under the Educational Service Contracting (ESC) of the Department of Education (DepEd) through the Private Education Assistance Committee (PEAC).
                        </p>
                    </div>

                    <!-- Official Verification Summary Card -->
                    <div class="peac-meta-card">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 20px; margin-bottom: 22px; padding-bottom: 20px; border-bottom: 1.5px solid #e2e8f0; flex-wrap: wrap;">
                            <img src="/accre/peac_certified_jhs_466150.webp" alt="PEAC Certified 466150 Junior High School" style="height: 78px; width: auto; object-fit: contain; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.12));" loading="lazy">
                            <div style="text-align: left;">
                                <div style="font-size: 1.25rem; font-weight: 800; color: #0f172a; line-height: 1.3;">PEAC Certified Junior High School Program</div>
                                <div style="font-size: 0.92rem; color: #059669; font-weight: 700;">DepEd School ID: 466150 &bull; ESC School ID: 1104046</div>
                                <div style="font-size: 0.82rem; color: #64748b; margin-top: 2px;">Educational Service Contracting (ESC) Participating School &bull; Full Compliance</div>
                            </div>
                        </div>

                        <div class="peac-meta-grid">
                            <div class="peac-meta-item">
                                <span class="peac-meta-label">Certification Status</span>
                                <span class="peac-meta-val text-success">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    Full Compliance
                                </span>
                            </div>
                            <div class="peac-meta-item">
                                <span class="peac-meta-label">Certification Type</span>
                                <span class="peac-meta-val">Cert-Revisit</span>
                            </div>
                            <div class="peac-meta-item">
                                <span class="peac-meta-label">Instrument</span>
                                <span class="peac-meta-val">2018 CAI</span>
                            </div>
                            <div class="peac-meta-item">
                                <span class="peac-meta-label">Date Certified</span>
                                <span class="peac-meta-val">January 7, 2026</span>
                            </div>
                            <div class="peac-meta-item">
                                <span class="peac-meta-label">Valid Until</span>
                                <span class="peac-meta-val" style="color: #047857;">May 31, 2030</span>
                            </div>
                            <div class="peac-meta-item">
                                <span class="peac-meta-label">Verification Code</span>
                                <span class="peac-meta-val code-val">PCC-2026-0RNELJVG</span>
                            </div>
                        </div>

                        <div class="peac-school-ids">
                            <span><strong>School:</strong> Al Munawwara Islamic School</span>
                            <span><strong>DepEd ID:</strong> 466150</span>
                            <span><strong>ESC ID:</strong> 1104046</span>
                            <span><strong>DepEd Region:</strong> Region 11 &bull; Davao City</span>
                            <span><strong>Address:</strong> Don Julian Rodriguez Avenue Sr., Ma-a, Davao City</span>
                        </div>
                    </div>

                    <!-- Images Grid: PEACMark Online Verification + Physical Certificate -->
                    <div class="accred-images-grid">
                        <div class="accred-card-container">
                            <div class="accred-card-header">
                                <span class="card-badge">Official PEACMark Online Verification</span>
                                <span class="card-sub">Digital verification certificate officially verified by PEAC</span>
                            </div>
                            <div class="accred-img-card zoomable" data-image="/accre/PEAC_verification.png">
                                <picture>
                                    <source srcset="/accre/PEAC_verification.webp" type="image/webp">
                                    <img src="/accre/PEAC_verification.png" alt="Official PEACMark Online Certification Verification - Al Munawwara Islamic School" loading="lazy" />
                                </picture>
                                <div class="zoom-hint">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                    <span>Click to enlarge verification card</span>
                                </div>
                            </div>
                        </div>

                        <div class="accred-card-container">
                            <div class="accred-card-header">
                                <span class="card-badge">DepEd &amp; PEAC Certificate of Certified Status</span>
                                <span class="card-sub">Conferred by Private Education Assistance Committee</span>
                            </div>
                            <div class="accred-img-card zoomable" data-image="/accre/PEAC_cert.png">
                                <img src="/accre/PEAC_cert.png" alt="DepEd &amp; PEAC ESC Certified Status Certificate - Al Munawwara Islamic School" loading="lazy" />
                                <div class="zoom-hint">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                    <span>Click to enlarge certificate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accred-section">
                    <h2 class="accred-title">ACTD - Accrediting Council for Teacher Development</h2>
                    <div class="accred-images-grid single">
                        <div class="accred-img-card large zoomable" data-image="/accre/ACTD_cert.jpg">
                            <img src="/accre/ACTD_cert.jpg" alt="ACTD Certificate" loading="lazy" />
                            <div class="zoom-hint">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                <span>Click to enlarge certificate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h2>Our Commitment to Quality</h2>
                <p>Al Munawwara Islamic School maintains the highest standards of educational excellence. Our national certifications from DepEd and PEAC, along with international accreditations from QAHE and ACTD, reflect our dedication to providing quality Islamic education that meets and exceeds national and international standards.</p>
                <div class="accred-badges">
                    <div class="badge">
                        <div class="badge-icon" style="display: flex; justify-content: center; align-items: center;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div class="badge-text">QAHE Accredited</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon" style="display: flex; justify-content: center; align-items: center;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div class="badge-text">PEAC / ESC Certified</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon" style="display: flex; justify-content: center; align-items: center;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div class="badge-text">ACTD Certified</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon" style="display: flex; justify-content: center; align-items: center;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div class="badge-text">DepEd Recognized</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon" style="display: flex; justify-content: center; align-items: center;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div class="badge-text">K-12 Compliant</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificate Zoom Modal -->
    <div class="zoom-modal" id="zoomModal" style="display: none;">
        <div class="zoom-modal-content">
            <button class="zoom-close" id="closeZoom" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
            <img src="" id="zoomImage" alt="Certificate Zoom" />
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const zoomModal = document.getElementById('zoomModal');
        const zoomImage = document.getElementById('zoomImage');
        const closeZoom = document.getElementById('closeZoom');
        const zoomableCards = document.querySelectorAll('.zoomable');

        zoomableCards.forEach(card => {
            card.addEventListener('click', function() {
                const imageSrc = this.getAttribute('data-image');
                zoomImage.src = imageSrc;
                zoomModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        });

        function closeZoomModal() {
            zoomModal.style.display = 'none';
            document.body.style.overflow = '';
        }

        if (closeZoom) closeZoom.addEventListener('click', closeZoomModal);
        if (zoomModal) {
            zoomModal.addEventListener('click', function(e) {
                if (e.target === zoomModal) closeZoomModal();
            });
        }
    });
</script>
@endsection
