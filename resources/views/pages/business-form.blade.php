@extends('layouts.public')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
.business-legacy-page {
    --primary: #020617;
    --secondary: #0f172a;
    --accent: #2563eb;
    --accent2: #06b6d4;
    --text: #e2e8f0;
    --muted: #94a3b8;
    font-family: Inter, sans-serif;
    background: linear-gradient(135deg, #020617 0%, #0f172a 50%, #111827 100%);
    color: #fff;
    overflow-x: hidden;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    width: 100vw;
    max-width: 100vw;
}

.business-legacy-page * {
    box-sizing: border-box;
}

/* HERO FORM SECTION (form at top) */
.business-legacy-page .business-hero {
    position: relative;
    padding: 120px 20px 40px;
    overflow: hidden;
}

.business-legacy-page .business-hero::before {
    content: '';
    position: absolute;
    top: -120px;
    left: -100px;
    width: 420px;
    height: 420px;
    border-radius: 50%;
    background: #2563eb25;
    filter: blur(100px);
}

.business-legacy-page .business-hero::after {
    content: '';
    position: absolute;
    bottom: -150px;
    right: -100px;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: #06b6d425;
    filter: blur(120px);
}

.business-legacy-page .business-hero .form-section {
    padding: 0;
    position: relative;
    z-index: 2;
}

/* INFO SECTION (previous hero content, below form) */
.business-legacy-page .business-info {
    position: relative;
    padding: 40px 20px 0;
    overflow: hidden;
}

.business-legacy-page .business-container {
    max-width: 1280px;
    margin: auto;
    position: relative;
    z-index: 2;
}

.business-legacy-page .hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.business-legacy-page .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 999px;
    backdrop-filter: blur(14px);
    margin-bottom: 30px;
    color: #dbeafe;
    font-size: 14px;
}

.business-legacy-page .hero-badge span {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #22c55e;
}

.business-legacy-page .hero-title {
    font-size: 72px;
    line-height: 1.05;
    font-weight: 900;
    letter-spacing: -2px;
    margin-bottom: 30px;
}

.business-legacy-page .hero-title .gradient {
    background: linear-gradient(to right, #60a5fa, #22d3ee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.business-legacy-page .hero-text {
    color: var(--muted);
    font-size: 20px;
    line-height: 1.8;
    margin-bottom: 40px;
    max-width: 650px;
}

.business-legacy-page .hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
}

.business-legacy-page .hero-btn {
    padding: 18px 30px;
    border-radius: 18px;
    text-decoration: none;
    font-weight: 700;
    transition: 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.business-legacy-page .btn-primary {
    background: linear-gradient(to right, #2563eb, #06b6d4);
    color: white;
    box-shadow: 0 20px 45px rgba(37, 99, 235, 0.35);
}

.business-legacy-page .btn-primary:hover {
    transform: translateY(-3px);
}

.business-legacy-page .btn-secondary {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: white;
    backdrop-filter: blur(10px);
}

.business-legacy-page .btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
}

/* RIGHT CARD */
.business-legacy-page .hero-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 32px;
    padding: 40px;
    backdrop-filter: blur(20px);
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
}

.business-legacy-page .card-title {
    font-size: 34px;
    font-weight: 800;
    margin-bottom: 30px;
}

.business-legacy-page .service-list {
    display: grid;
    gap: 20px;
}

.business-legacy-page .service-item {
    display: flex;
    gap: 16px;
    align-items: flex-start;
}

.business-legacy-page .service-icon {
    width: 55px;
    height: 55px;
    border-radius: 16px;
    background: linear-gradient(to right, #2563eb, #06b6d4);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 22px;
    font-weight: 700;
}

.business-legacy-page .service-content h4 {
    font-size: 18px;
    margin-bottom: 8px;
}

.business-legacy-page .service-content p {
    color: var(--muted);
    line-height: 1.7;
}

/* BUTTON MENU */
.business-legacy-page .quick-services {
    padding: 20px 20px 70px;
}

.business-legacy-page .service-buttons {
    max-width: 1280px;
    margin: auto;
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    justify-content: center;
}

.business-legacy-page .service-link {
    padding: 16px 24px;
    border-radius: 18px;
    text-decoration: none;
    color: white;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(12px);
    transition: 0.3s;
    font-weight: 600;
}

.business-legacy-page .service-link:hover {
    background: linear-gradient(to right, #2563eb, #06b6d4);
    transform: translateY(-2px);
}

/* FORM */
.business-legacy-page .form-section {
    padding: 0 20px 120px;
}

.business-legacy-page .form-wrapper {
    max-width: 1280px;
    margin: auto;
    border-radius: 35px;
    padding: 25px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
}

.business-legacy-page .form-header {
    padding: 20px 10px 35px;
}

.business-legacy-page .form-header h2 {
    font-size: 42px;
    margin-bottom: 15px;
}

.business-legacy-page .form-header p {
    color: var(--muted);
    line-height: 1.8;
    max-width: 850px;
}

.business-legacy-page .jotform-box {
    width: 100%;
    overflow: hidden;
    border-radius: 28px;
    background: #fff;
}

.business-legacy-page #JotFormIFrame-261412299504052 {
    width: 100%;
    min-width: 100%;
    height: 1600px;
    border: none;
}

/* STATS */
.business-legacy-page .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-top: 50px;
}

.business-legacy-page .stat-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 35px;
    text-align: center;
}

.business-legacy-page .stat-card h3 {
    font-size: 44px;
    margin-bottom: 10px;
    background: linear-gradient(to right, #60a5fa, #22d3ee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.business-legacy-page .stat-card p {
    color: var(--muted);
}

/* MOBILE */
@media (max-width: 991px) {
    .business-legacy-page .hero-grid {
        grid-template-columns: 1fr;
    }

    .business-legacy-page .hero-title {
        font-size: 54px;
    }

    .business-legacy-page .stats-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .business-legacy-page .business-hero {
        padding-top: 90px;
        padding-bottom: 20px;
    }

    .business-legacy-page .business-info {
        padding-top: 20px;
    }

    .business-legacy-page .hero-title {
        font-size: 40px;
        line-height: 1.15;
    }

    .business-legacy-page .hero-text {
        font-size: 17px;
    }

    .business-legacy-page .hero-buttons {
        flex-direction: column;
    }

    .business-legacy-page .hero-btn {
        width: 100%;
    }

    .business-legacy-page .hero-card {
        padding: 28px;
    }

    .business-legacy-page .form-wrapper {
        padding: 15px;
        border-radius: 24px;
    }

    .business-legacy-page .form-header h2 {
        font-size: 30px;
    }

    .business-legacy-page #JotFormIFrame-261412299504052 {
        height: 2200px;
    }
}
</style>
@endpush

@section('content')
<div class="business-legacy-page">
    {{-- Form at top (hero position) --}}
    <section class="business-hero">
        <x-business-form-section />
    </section>

    {{-- Previous hero content (below form) --}}
    <section class="business-info">
        <div class="business-container">
            <div class="hero-grid">
                <div>
                    <div class="hero-badge">
                        <span></span>
                        Australian Business Services
                    </div>

                    <h1 class="hero-title">
                        Business Tax &amp;
                        <span class="gradient">Business Setup Solutions</span>
                    </h1>

                    <p class="hero-text">
                        Canberra Accountants provides complete business taxation, business registration, BAS lodgement, bookkeeping and business setup solutions for startups, sole traders, companies and growing Australian businesses.
                    </p>

                    <div class="hero-buttons">
                        <a href="#businessform" class="hero-btn btn-primary">
                            Start Business Service Form
                        </a>
                        <a href="{{ route('home') }}" class="hero-btn btn-secondary">
                            Main Website
                        </a>
                    </div>
                </div>

                <div class="hero-card">
                    <h3 class="card-title">Business Services</h3>
                    <div class="service-list">
                        <div class="service-item">
                            <div class="service-icon">✓</div>
                            <div class="service-content">
                                <h4>Business Registration</h4>
                                <p>Company, ABN, GST, TFN, PAYG and business structure setup services across Australia.</p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">$</div>
                            <div class="service-content">
                                <h4>Business Tax Returns</h4>
                                <p>Company, trust, partnership and sole trader tax return preparation and lodgement.</p>
                            </div>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">⚡</div>
                            <div class="service-content">
                                <h4>BAS &amp; GST Lodgements</h4>
                                <p>Fast and accurate BAS, IAS and GST reporting services for businesses of all sizes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>100%</h3>
                    <p>Online Business Services</p>
                </div>
                <div class="stat-card">
                    <h3>Fast</h3>
                    <p>Setup &amp; Lodgement Process</p>
                </div>
                <div class="stat-card">
                    <h3>Australia</h3>
                    <p>Nationwide Business Support</p>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-services">
        <div class="service-buttons">
            <a href="#businessform" class="service-link">Business Registration</a>
            <a href="#businessform" class="service-link">Start a Business</a>
            <a href="#businessform" class="service-link">Business Tax Return</a>
            <a href="#businessform" class="service-link">Business Activity Statement</a>
            <a href="#businessform" class="service-link">GST Registration</a>
            <a href="#businessform" class="service-link">PAYG Registration</a>
            <a href="#businessform" class="service-link">Company Setup</a>
            <a href="#businessform" class="service-link">Trust Setup</a>
            <a href="#businessform" class="service-link">Business Engagement Form</a>
        </div>
    </section>
</div>
@endsection
