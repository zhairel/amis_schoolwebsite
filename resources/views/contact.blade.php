@extends('layouts.app')

@section('title', 'Contact Us | AMIS')

@section('styles')
<style>
    .contact-page {
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
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-top: 40px;
        padding-bottom: 80px;
    }
    .contact-info h2 {
        font-size: 2rem;
        margin-bottom: 16px;
        color: var(--primary);
        font-weight: 700;
    }
    .contact-info > p {
        color: var(--text-light);
        margin-bottom: 40px;
        line-height: 1.6;
    }
    .info-items {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .info-item {
        display: flex;
        gap: 16px;
    }
    .info-icon {
        font-size: 1.5rem;
        width: 50px;
        height: 50px;
        background: var(--bg-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid var(--border);
    }
    .info-item h4 {
        font-size: 1.125rem;
        margin-bottom: 4px;
        color: var(--text);
        font-weight: 700;
    }
    .info-item p {
        color: var(--text-light);
        line-height: 1.6;
    }
    .contact-form {
        background: var(--bg-light);
        padding: 40px;
        border-radius: 12px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text);
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        transition: border-color 0.3s;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
    }
    .form-group textarea {
        resize: vertical;
    }
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        .contact-form {
            padding: 30px 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-page">
    <section class="page-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Get in touch with our team</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Get In Touch</h2>
                    <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                    
                    <div class="info-items">
                        <div class="info-item">
                            <div class="info-icon">📧</div>
                            <div>
                                <h4>Email</h4>
                                <p><a href="mailto:inquiries@amis.edu.ph" style="color: var(--primary); text-decoration: none; font-weight:600;">inquiries@amis.edu.ph</a></p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">📞</div>
                            <div>
                                <h4>Phone</h4>
                                <p>+63 927 299 1833</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">📍</div>
                            <div>
                                <h4>Address</h4>
                                <p>Don Julian Rodriguez Avenue, Ma-a<br>Davao City, Philippines 8000</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">🕐</div>
                            <div>
                                <h4>Office Hours</h4>
                                <p>Monday - Friday: 8:00 AM - 4:00 PM<br>Saturday: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required />
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required />
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" />
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required />
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
