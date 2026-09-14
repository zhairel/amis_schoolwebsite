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
        width: 50px;
        height: 50px;
        background: var(--bg-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid var(--border);
        color: var(--primary);
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
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p><a href="mailto:inquiries@amis.edu.ph" style="color: var(--primary); text-decoration: none; font-weight:600;">inquiries@amis.edu.ph</a></p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <h4>Phone</h4>
                                <p>+63 927 299 1833</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <h4>Address</h4>
                                <p>Don Julian Rodriguez Avenue, Ma-a<br>Davao City, Philippines 8000</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <h4>Office Hours</h4>
                                <p>Monday - Friday: 8:00 AM - 4:00 PM<br>Saturday: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                            </div>
                            <div style="flex: 1;">
                                <h4>Official Calling Cards</h4>
                                <p style="margin-bottom: 12px; color: var(--text-light); font-size: 0.95rem;">
                                    View digital calling cards and verify official school credentials:
                                </p>
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    @foreach($staffMembers ?? \App\Models\StaffVerification::active()->orderBy('id', 'asc')->get() as $staff)
                                        <div style="background: var(--bg-light); border: 1px solid var(--border); border-radius: 8px; padding: 12px 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                                            <div>
                                                <div style="font-weight: 700; color: var(--text); font-size: 0.95rem;">{{ $staff->display_name }}</div>
                                                <div style="font-size: 0.8rem; color: var(--primary); font-weight: 600;">{{ $staff->position }}</div>
                                                <div style="font-size: 0.75rem; color: #64748b; font-family: ui-monospace, monospace; margin-top: 3px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                                                    <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}" style="color: #059669; font-weight: 600; text-decoration: none;">/verify/{{ $staff->slug }}</a>
                                                    <span style="color: #cbd5e1;">&bull;</span>
                                                    <a href="{{ route('staff.verify.card', ['slug' => $staff->slug]) }}" style="color: #64748b; text-decoration: underline;" title="Direct Print / Card View">card</a>
                                                </div>
                                            </div>
                                            <a href="{{ route('staff.verify.show', ['slug' => $staff->slug]) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem; font-weight: 700; color: #2e6930; background: #e8f2e9; padding: 6px 12px; border-radius: 6px; text-decoration: none; flex-shrink: 0; transition: background 0.2s;">
                                                <span>View Card</span> &rarr;
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
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

                    @if(isset($errors) && $errors->any())
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
