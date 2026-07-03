@extends('layouts.public')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
.tax-legacy-page {
    --primary: #0f172a;
    --secondary: #1e293b;
    --accent: #3b82f6;
    --accent2: #06b6d4;
    --text: #e2e8f0;
    --muted: #94a3b8;
    --card: #ffffff10;
    --border: #ffffff14;
    font-family: Inter, sans-serif;
    background: linear-gradient(135deg, #020617 0%, #0f172a 50%, #111827 100%);
    color: white;
    overflow-x: hidden;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    width: 100vw;
    max-width: 100vw;
}

.tax-legacy-page * {
    box-sizing: border-box;
}

/* HERO FORM SECTION (form at top) */
.tax-legacy-page .tax-hero {
    position: relative;
    padding: 120px 20px 40px;
    overflow: hidden;
}

.tax-legacy-page .tax-hero::before {
    content: '';
    position: absolute;
    top: -150px;
    left: -100px;
    width: 400px;
    height: 400px;
    background: #2563eb30;
    filter: blur(100px);
    border-radius: 50%;
}

.tax-legacy-page .tax-hero::after {
    content: '';
    position: absolute;
    bottom: -150px;
    right: -100px;
    width: 450px;
    height: 450px;
    background: #06b6d430;
    filter: blur(100px);
    border-radius: 50%;
}

.tax-legacy-page .tax-hero .form-section {
    padding: 0;
    position: relative;
    z-index: 2;
}

.tax-legacy-page .tax-container {
    max-width: 1250px;
    margin: auto;
    position: relative;
    z-index: 2;
}

.tax-legacy-page .hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.tax-legacy-page .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 999px;
    margin-bottom: 30px;
    backdrop-filter: blur(12px);
    color: #dbeafe;
    font-size: 14px;
}

.tax-legacy-page .hero-badge span {
    width: 10px;
    height: 10px;
    background: #22c55e;
    border-radius: 50%;
}

.tax-legacy-page .tax-heading {
    font-size: 72px;
    line-height: 1.05;
    font-weight: 900;
    margin-bottom: 30px;
    letter-spacing: -2px;
}

.tax-legacy-page .tax-heading .gradient {
    background: linear-gradient(to right, #60a5fa, #22d3ee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tax-legacy-page .hero-text {
    font-size: 20px;
    line-height: 1.8;
    color: var(--muted);
    margin-bottom: 40px;
    max-width: 650px;
}

.tax-legacy-page .hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
}

.tax-legacy-page .hero-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 18px 30px;
    border-radius: 18px;
    text-decoration: none;
    font-weight: 700;
    transition: 0.3s;
}

.tax-legacy-page .btn-primary {
    background: linear-gradient(to right, #2563eb, #06b6d4);
    color: white;
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.35);
}

.tax-legacy-page .btn-primary:hover {
    transform: translateY(-3px);
}

.tax-legacy-page .btn-secondary {
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: rgba(255, 255, 255, 0.05);
    color: white;
    backdrop-filter: blur(12px);
}

.tax-legacy-page .btn-secondary:hover {
    background: rgba(255, 255, 255, 0.09);
}

/* CARD */
.tax-legacy-page .hero-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 32px;
    padding: 40px;
    backdrop-filter: blur(20px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
}

.tax-legacy-page .card-title {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 25px;
}

.tax-legacy-page .feature-list {
    display: grid;
    gap: 20px;
}

.tax-legacy-page .feature-item {
    display: flex;
    gap: 16px;
    align-items: flex-start;
}

.tax-legacy-page .feature-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: linear-gradient(to right, #2563eb, #06b6d4);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 22px;
    font-weight: 700;
}

.tax-legacy-page .feature-content h4 {
    font-size: 18px;
    margin-bottom: 8px;
}

.tax-legacy-page .feature-content p {
    color: var(--muted);
    line-height: 1.7;
}

/* INFO SECTION (previous hero content, below form) */
.tax-legacy-page .tax-info {
    position: relative;
    padding: 40px 20px 120px;
    overflow: hidden;
}

/* FORM SECTION */
.tax-legacy-page .form-section {
    padding: 40px 20px 120px;
}

.tax-legacy-page .form-wrapper {
    max-width: 1250px;
    margin: auto;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 35px;
    padding: 25px;
    backdrop-filter: blur(20px);
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
}

.tax-legacy-page .form-top {
    padding: 20px 15px 35px;
}

.tax-legacy-page .form-top h2 {
    font-size: 42px;
    margin-bottom: 15px;
}

.tax-legacy-page .form-top p {
    color: var(--muted);
    line-height: 1.8;
    max-width: 850px;
}

/* JOTFORM */
.tax-legacy-page .jotform-container {
    width: 100%;
    overflow: hidden;
    border-radius: 25px;
    background: white;
}

.tax-legacy-page #JotFormIFrame-261412277039051 {
    min-width: 100%;
    width: 100%;
    height: 1400px;
    border: none;
}

/* STATS */
.tax-legacy-page .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-top: 40px;
}

.tax-legacy-page .stat-box {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 30px;
    text-align: center;
}

.tax-legacy-page .stat-box h3 {
    font-size: 42px;
    margin-bottom: 10px;
    background: linear-gradient(to right, #60a5fa, #22d3ee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tax-legacy-page .stat-box p {
    color: var(--muted);
}

/* MOBILE */
@media (max-width: 991px) {
    .tax-legacy-page .hero-grid {
        grid-template-columns: 1fr;
    }

    .tax-legacy-page .tax-heading {
        font-size: 52px;
    }

    .tax-legacy-page .stats-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .tax-legacy-page .tax-hero {
        padding-top: 90px;
        padding-bottom: 20px;
    }

    .tax-legacy-page .tax-info {
        padding-bottom: 80px;
    }

    .tax-legacy-page .tax-heading {
        font-size: 40px;
        line-height: 1.15;
    }

    .tax-legacy-page .hero-text {
        font-size: 17px;
    }

    .tax-legacy-page .hero-buttons {
        flex-direction: column;
    }

    .tax-legacy-page .hero-btn {
        width: 100%;
    }

    .tax-legacy-page .hero-card {
        padding: 28px;
    }

    .tax-legacy-page .form-wrapper {
        padding: 15px;
        border-radius: 25px;
    }

    .tax-legacy-page .form-top h2 {
        font-size: 30px;
    }

    .tax-legacy-page #JotFormIFrame-261412277039051 {
        height: 1800px;
    }
}
</style>
@endpush

@section('content')
<div class="tax-legacy-page">
    {{-- Form at top (hero position) --}}
    <section class="tax-hero">
        <x-tax-return-form-section />
    </section>

    {{-- Previous hero content (below form) --}}
    <section class="tax-info">
        <div class="tax-container">
            <div class="hero-grid">
                <div>
                    <div class="hero-badge">
                        <span></span>
                        Australian Tax Return Services
                    </div>

                    <h1 class="tax-heading">
                        Fast &amp; Professional
                        <span class="gradient">Australian Tax Returns</span>
                    </h1>

                    <p class="hero-text">
                        Lodge your Australian tax return online with Canberra Accountants.
                        Simple, secure and fully digital process for individuals, students, employees, contractors and businesses across Australia.
                    </p>

                    <div class="hero-buttons">
                        <a href="#taxform" class="hero-btn btn-primary">
                            Start Your Tax Return
                        </a>
                        <a href="{{ route('home') }}" class="hero-btn btn-secondary">
                            Visit Main Website
                        </a>
                    </div>
                </div>

                <div class="hero-card">
                    <h3 class="card-title">Why Choose Canberra Accountants?</h3>
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon">✓</div>
                            <div class="feature-content">
                                <h4>100% Online Process</h4>
                                <p>Complete your tax return securely from anywhere in Australia without visiting an office.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">$</div>
                            <div class="feature-content">
                                <h4>Maximum Legitimate Refund</h4>
                                <p>We help identify eligible deductions and claims to maximise your tax refund.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">⚡</div>
                            <div class="feature-content">
                                <h4>Fast Turnaround</h4>
                                <p>Quick review and lodgement process by experienced Australian tax professionals.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <h3>100%</h3>
                    <p>Secure Digital Submission</p>
                </div>
                <div class="stat-box">
                    <h3>24/7</h3>
                    <p>Online Form Access</p>
                </div>
                <div class="stat-box">
                    <h3>Australia</h3>
                    <p>Nationwide Tax Services</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
