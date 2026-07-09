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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        max-width: 900px;
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
    @media (max-width: 768px) {
        .page-title { font-size: 2rem; }
        .page-subtitle { font-size: 1rem; }
        .accred-section { padding: 20px; }
        .accred-title { font-size: 1.5rem; }
        .accred-images-grid { grid-template-columns: 1fr; }
        .accred-badges { grid-template-columns: 1fr 1fr; }
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
                <a href="{{ route('about.index') }}">About Us</a>
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
                    <h2 class="accred-title">QAHE - Quality Assurance in Higher Education</h2>
                    <div class="accred-images-grid">
                        <div class="accred-img-card zoomable" data-image="/accre/QAHE_cert1.jpg">
                            <img src="/accre/QAHE_cert1.jpg" alt="QAHE Certificate 1" loading="lazy" />
                        </div>
                        <div class="accred-img-card zoomable" data-image="/accre/QAHE_cert2.jpg">
                            <img src="/accre/QAHE_cert2.jpg" alt="QAHE Certificate 2" loading="lazy" />
                        </div>
                        <div class="accred-img-card zoomable" data-image="/accre/QAHE_cert3.jpg">
                            <img src="/accre/QAHE_cert3.jpg" alt="QAHE Certificate 3" loading="lazy" />
                        </div>
                    </div>
                </div>

                <div class="accred-section">
                    <h2 class="accred-title">ACTD - Accrediting Council for Teacher Development</h2>
                    <div class="accred-images-grid single">
                        <div class="accred-img-card large zoomable" data-image="/accre/ACTD_cert.jpg">
                            <img src="/accre/ACTD_cert.jpg" alt="ACTD Certificate" loading="lazy" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h2>Our Commitment to Quality</h2>
                <p>Al Munawwara Islamic School maintains the highest standards of educational excellence. Our international accreditations from QAHE and ACTD, along with DepEd recognition, reflect our dedication to providing quality Islamic education that meets and exceeds national and international standards.</p>
                <div class="accred-badges">
                    <div class="badge">
                        <div class="badge-icon">✓</div>
                        <div class="badge-text">QAHE Accredited</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon">✓</div>
                        <div class="badge-text">ACTD Certified</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon">✓</div>
                        <div class="badge-text">DepEd Recognized</div>
                    </div>
                    <div class="badge">
                        <div class="badge-icon">✓</div>
                        <div class="badge-text">K-12 Compliant</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificate Zoom Modal -->
    <div class="zoom-modal" id="zoomModal" style="display: none;">
        <div class="zoom-modal-content">
            <button class="zoom-close" id="closeZoom">✕</button>
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
