@extends('layouts.public')

@push('styles')
<style>
.business-form-page {
    --ca-bg: #071A3A;
    --ca-form: #F8FAFC;
    --ca-teal: #0F766E;
    --ca-teal-dark: #0d655e;
    --ca-teal-light: #14b8a6;
    --ca-green: #84CC16;
    --ca-green-light: #a3e635;
    --ca-muted: #94a3b8;
    --ca-heading: #071A3A;
    --ca-label: #1e293b;
    --ca-placeholder: #94a3b8;
    --ca-input-border: #cbd5e1;
    --ca-input-bg: #ffffff;
    background: var(--ca-bg);
    color: white;
}

.business-form-page .business-hero { position: relative; padding: 100px 20px 60px; overflow: hidden; }
.business-form-page .business-hero::before { content: ''; position: absolute; top: -120px; left: -100px; width: 420px; height: 420px; border-radius: 50%; background: rgba(15,118,110,.2); filter: blur(100px); }
.business-form-page .business-hero::after { content: ''; position: absolute; bottom: -150px; right: -100px; width: 500px; height: 500px; border-radius: 50%; background: rgba(132,204,22,.12); filter: blur(120px); }
.business-form-page .business-container { max-width: 1100px; margin: auto; position: relative; z-index: 2; }
.business-form-page .hero-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
.business-form-page .hero-badge { display: inline-flex; align-items: center; gap: 10px; padding: 10px 16px; background: rgba(255,255,255,.06); border: 1px solid rgba(132,204,22,.35); border-radius: 999px; margin-bottom: 24px; color: var(--ca-green-light); font-size: 13px; font-weight: 500; }
.business-form-page .hero-badge span { width: 8px; height: 8px; background: var(--ca-green); border-radius: 50%; box-shadow: 0 0 8px rgba(132,204,22,.6); }
.business-form-page .hero-title { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: clamp(2.2rem, 4.5vw, 3.5rem); line-height: 1.08; font-weight: 700; margin-bottom: 20px; color: white; }
.business-form-page .hero-title .gradient { background: linear-gradient(to right, #5eead4, var(--ca-green)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.business-form-page .hero-text { color: var(--ca-muted); font-size: 1.05rem; line-height: 1.75; margin-bottom: 32px; max-width: 520px; }
.business-form-page .hero-buttons { display: flex; flex-wrap: wrap; gap: 14px; }
.business-form-page .hero-btn { padding: 14px 26px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: .9rem; transition: .25s; display: inline-flex; align-items: center; justify-content: center; }
.business-form-page .btn-primary { background: var(--ca-teal); color: white; box-shadow: 0 12px 28px rgba(15,118,110,.35); }
.business-form-page .btn-primary:hover { background: var(--ca-teal-dark); transform: translateY(-2px); }
.business-form-page .btn-secondary { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.18); color: white; }
.business-form-page .btn-secondary:hover { border-color: rgba(132,204,22,.45); background: rgba(255,255,255,.09); }
.business-form-page .hero-card { background: rgba(255,255,255,.05); border: 1px solid rgba(15,118,110,.3); border-radius: 20px; padding: 32px; }
.business-form-page .card-title { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: 1.75rem; font-weight: 700; margin-bottom: 20px; color: white; }
.business-form-page .service-list { display: grid; gap: 16px; }
.business-form-page .service-item { display: flex; gap: 14px; align-items: flex-start; }
.business-form-page .service-icon { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, var(--ca-teal), var(--ca-teal-light)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px; font-weight: 700; color: white; }
.business-form-page .service-content h4 { font-size: 1rem; margin-bottom: 4px; color: white; font-weight: 600; }
.business-form-page .service-content p { color: var(--ca-muted); line-height: 1.65; font-size: .875rem; }
.business-form-page .stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-top: 36px; }
.business-form-page .stat-card { background: rgba(255,255,255,.05); border: 1px solid rgba(15,118,110,.25); border-radius: 16px; padding: 24px; text-align: center; }
.business-form-page .stat-card h3 { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: 2rem; margin-bottom: 6px; background: linear-gradient(to right, #5eead4, var(--ca-green)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 700; }
.business-form-page .stat-card p { color: var(--ca-muted); font-size: .875rem; }

.business-form-page .quick-services { padding: 10px 20px 50px; }
.business-form-page .service-buttons { max-width: 900px; margin: auto; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
.business-form-page .service-link { padding: 10px 16px; border-radius: 10px; text-decoration: none; color: white; background: rgba(255,255,255,.06); border: 1px solid rgba(15,118,110,.3); font-weight: 600; font-size: .8125rem; transition: .25s; }
.business-form-page .service-link:hover { background: var(--ca-teal); border-color: var(--ca-teal); transform: translateY(-1px); }

.business-form-page .form-section { padding: 0 20px 100px; }
.business-form-page .form-outer { max-width: 900px; margin: auto; }
.business-form-page .form-wrapper { background: var(--ca-form); border-radius: 24px; overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,.35); border: 1px solid #e2e8f0; }

.business-form-page .form-logo-bar { text-align: center; padding: 36px 32px 24px; background: white; border-bottom: 1px solid #e2e8f0; }
.business-form-page .form-logo-bar .brand-name { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: 1.75rem; font-weight: 700; color: var(--ca-teal); }
.business-form-page .form-logo-bar .brand-sub { font-size: .7rem; font-weight: 600; color: var(--ca-teal); letter-spacing: .15em; text-transform: uppercase; margin-top: 2px; }
.business-form-page .form-logo-bar .brand-tagline { font-size: .8rem; color: var(--ca-muted); margin-top: 10px; }
.business-form-page .form-logo-bar .brand-instruction { font-size: .875rem; color: #475569; margin-top: 14px; }

.business-form-page .form-header-bar { background: linear-gradient(135deg, var(--ca-bg) 0%, #0c2552 100%); padding: 24px 36px; border-bottom: 3px solid var(--ca-green); }
.business-form-page .form-header-bar h2 { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: 1.5rem; color: white; font-weight: 700; margin: 0; }
.business-form-page .form-header-bar p { color: #94a3b8; font-size: .8125rem; margin: 6px 0 0; }

.business-form-page .alert-success { margin: 24px 36px 0; padding: 14px 18px; background: #ecfdf5; border: 1px solid #6ee7b7; border-left: 4px solid var(--ca-teal); border-radius: 10px; color: #065f46; font-size: .9rem; font-weight: 500; }

.business-form-page .biz-form { padding: 32px 36px 36px; }
.business-form-page .form-section-block { margin-bottom: 32px; }
.business-form-page .section-label { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; }
.business-form-page .section-num { width: 30px; height: 30px; border-radius: 8px; background: var(--ca-teal); color: white; font-size: .75rem; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.business-form-page .section-label h3 { font-size: 1rem; font-weight: 700; color: var(--ca-heading); margin: 0; }
.business-form-page .section-label span { font-size: .75rem; color: var(--ca-muted); font-weight: 400; }

.business-form-page .field-grid { display: grid; gap: 18px; }
.business-form-page .field-grid-2 { grid-template-columns: 1fr 1fr; }
.business-form-page .field-group label { display: block; font-size: .8125rem; font-weight: 600; color: var(--ca-label); margin-bottom: 7px; }
.business-form-page .field-group label .req { color: var(--ca-teal); }
.business-form-page .field-hint { font-size: .75rem; color: var(--ca-placeholder); margin-top: 5px; }
.business-form-page .field-error { font-size: .8rem; color: #dc2626; margin-top: 5px; }

.business-form-page .biz-input,
.business-form-page .biz-select,
.business-form-page .biz-textarea {
    width: 100%; padding: 12px 15px; background: var(--ca-input-bg);
    border: 1.5px solid var(--ca-input-border); border-radius: 10px;
    font-size: .9375rem; color: var(--ca-heading); transition: border-color .2s, box-shadow .2s; outline: none;
}
.business-form-page .biz-input::placeholder, .business-form-page .biz-textarea::placeholder { color: var(--ca-placeholder); opacity: 1; }
.business-form-page .biz-input:hover, .business-form-page .biz-select:hover { border-color: #94a3b8; }
.business-form-page .biz-input:focus, .business-form-page .biz-select:focus, .business-form-page .biz-textarea:focus {
    border-color: var(--ca-teal); box-shadow: 0 0 0 3px rgba(15,118,110,.15);
}
.business-form-page .biz-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 14px center; background-size: 18px;
    padding-right: 44px; cursor: pointer; appearance: none;
}
.business-form-page .biz-textarea { resize: vertical; min-height: 140px; line-height: 1.6; }
.business-form-page .section-divider { border: none; border-top: 2px dotted #cbd5e1; margin: 28px 0; }

.business-form-page .service-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
.business-form-page .service-pill {
    padding: 8px 14px; border-radius: 999px; font-size: .75rem; font-weight: 600;
    border: 1.5px solid var(--ca-input-border); background: white; color: #475569;
    cursor: pointer; transition: .2s;
}
.business-form-page .service-pill:hover { border-color: var(--ca-teal); color: var(--ca-teal); }
.business-form-page .service-pill.active { background: var(--ca-teal); border-color: var(--ca-teal); color: white; }

.business-form-page .terms-box {
    background: white; border: 1.5px solid var(--ca-input-border); border-radius: 12px;
    padding: 18px 20px; display: flex; align-items: flex-start; gap: 14px; cursor: pointer;
    transition: border-color .2s, background .2s;
}
.business-form-page .terms-box:hover { border-color: var(--ca-teal); background: #f0fdfa; }
.business-form-page .terms-box input { width: 20px; height: 20px; margin-top: 2px; accent-color: var(--ca-teal); flex-shrink: 0; cursor: pointer; }
.business-form-page .terms-box p { font-size: .875rem; color: #334155; line-height: 1.55; margin: 0; }

.business-form-page .form-footer { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; padding-top: 24px; border-top: 2px solid #e2e8f0; }
.business-form-page .form-note { font-size: .8rem; color: var(--ca-placeholder); max-width: 360px; line-height: 1.55; }
.business-form-page .submit-btn {
    display: inline-flex; align-items: center; gap: 10px; padding: 15px 32px;
    background: var(--ca-teal); color: white; font-size: .9375rem; font-weight: 700;
    border: none; border-radius: 12px; cursor: pointer;
    box-shadow: 0 8px 24px rgba(15,118,110,.35); transition: background .2s, transform .2s;
}
.business-form-page .submit-btn:hover { background: var(--ca-teal-dark); transform: translateY(-2px); }

@media (max-width: 991px) {
    .business-form-page .hero-grid { grid-template-columns: 1fr; }
    .business-form-page .stats-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    .business-form-page .field-grid-2 { grid-template-columns: 1fr; }
    .business-form-page .biz-form, .business-form-page .form-logo-bar, .business-form-page .form-header-bar { padding-left: 20px; padding-right: 20px; }
    .business-form-page .alert-success { margin-left: 20px; margin-right: 20px; }
    .business-form-page .hero-buttons { flex-direction: column; }
    .business-form-page .hero-btn { width: 100%; }
    .business-form-page .submit-btn { width: 100%; justify-content: center; }
}
</style>
@endpush

@section('content')
<div class="business-form-page" x-data="{ serviceType: '{{ old('service_type', '') }}' }">
    <section class="business-hero">
        <div class="business-container">
            <div class="hero-grid">
                <div>
                    <div class="hero-badge"><span></span> Australian Business Services</div>
                    <h1 class="hero-title">Business Tax &amp; <span class="gradient">Business Setup Solutions</span></h1>
                    <p class="hero-text">Complete business taxation, registration, BAS lodgement and setup solutions for startups, sole traders, companies and growing Australian businesses.</p>
                    <div class="hero-buttons">
                        <a href="#businessform" class="hero-btn btn-primary">Start Business Service Form</a>
                        <a href="{{ route('home') }}" class="hero-btn btn-secondary">Main Website</a>
                    </div>
                </div>
                <div class="hero-card">
                    <h3 class="card-title">Business Services</h3>
                    <div class="service-list">
                        <div class="service-item">
                            <div class="service-icon">✓</div>
                            <div class="service-content"><h4>Business Registration</h4><p>Company, ABN, GST, TFN, PAYG and business structure setup across Australia.</p></div>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">$</div>
                            <div class="service-content"><h4>Business Tax Returns</h4><p>Company, trust, partnership and sole trader tax return preparation and lodgement.</p></div>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">⚡</div>
                            <div class="service-content"><h4>BAS &amp; GST Lodgements</h4><p>Fast and accurate BAS, IAS and GST reporting for businesses of all sizes.</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stats-grid">
                <div class="stat-card"><h3>100%</h3><p>Online Business Services</p></div>
                <div class="stat-card"><h3>Fast</h3><p>Setup &amp; Lodgement Process</p></div>
                <div class="stat-card"><h3>Australia</h3><p>Nationwide Business Support</p></div>
            </div>
        </div>
    </section>

    <section class="quick-services">
        <div class="service-buttons">
            @foreach(\App\Http\Requests\BusinessFormRequest::SERVICE_TYPES as $service)
            <a href="#businessform" class="service-link" @click="serviceType = '{{ $service }}'">{{ $service }}</a>
            @endforeach
        </div>
    </section>

    <section class="form-section" id="businessform">
        <div class="form-outer">
            <div class="form-wrapper">

                <div class="form-logo-bar">
                    <div class="brand-name">CANBERRA</div>
                    <div class="brand-sub">Accountants</div>
                    <div class="brand-tagline">Tax &nbsp;|&nbsp; CFO Advisory &nbsp;|&nbsp; SMSF</div>
                    <p class="brand-instruction">Please complete the business engagement form below and submit.</p>
                </div>

                <div class="form-header-bar">
                    <h2>Business Engagement &amp; Tax Form</h2>
                    <p>All fields marked with <span style="color:#5eead4">*</span> are required</p>
                </div>

                @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('forms.business.store') }}" method="POST" class="biz-form">
                    @csrf
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                    {{-- 1. Contact --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">1</div>
                            <div><h3>Contact Information</h3><span>Your details</span></div>
                        </div>
                        <div class="field-grid">
                            <div class="field-group">
                                <label for="name">Contact Name <span class="req">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="biz-input" placeholder="Full name">
                                @error('name')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field-grid field-grid-2">
                                <div class="field-group">
                                    <label for="email">Email <span class="req">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="biz-input" placeholder="example@example.com">
                                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="phone">Phone Number <span class="req">*</span></label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required class="biz-input" placeholder="(000) 000-0000">
                                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 2. Business --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">2</div>
                            <div><h3>Business Details</h3><span>About your business</span></div>
                        </div>
                        <div class="field-grid">
                            <div class="field-group">
                                <label for="business_name">Business Name <span class="req">*</span></label>
                                <input type="text" id="business_name" name="business_name" value="{{ old('business_name') }}" required class="biz-input" placeholder="Registered or trading name">
                                @error('business_name')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field-grid field-grid-2">
                                <div class="field-group">
                                    <label for="abn">ABN Number</label>
                                    <input type="text" id="abn" name="abn" value="{{ old('abn') }}" class="biz-input" placeholder="12345678901" maxlength="11" inputmode="numeric">
                                    <p class="field-hint">Enter 11 digit ABN (optional if not yet registered)</p>
                                    @error('abn')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="business_structure">Business Structure <span class="req">*</span></label>
                                    <select id="business_structure" name="business_structure" required class="biz-select">
                                        <option value="" disabled @selected(!old('business_structure'))>Select structure</option>
                                        @foreach(['Sole Trader', 'Partnership', 'Company', 'Trust', 'SMSF', 'Other'] as $structure)
                                        <option value="{{ $structure }}" @selected(old('business_structure') === $structure)>{{ $structure }}</option>
                                        @endforeach
                                    </select>
                                    @error('business_structure')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 3. Service --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">3</div>
                            <div><h3>Service Required</h3><span>What do you need help with?</span></div>
                        </div>
                        <div class="field-group">
                            <label>Quick select a service</label>
                            <div class="service-pills">
                                @foreach(\App\Http\Requests\BusinessFormRequest::SERVICE_TYPES as $service)
                                <button type="button" class="service-pill" :class="{ 'active': serviceType === '{{ $service }}' }" @click="serviceType = '{{ $service }}'">{{ $service }}</button>
                                @endforeach
                            </div>
                            <label for="service_type">Service Type <span class="req">*</span></label>
                            <select id="service_type" name="service_type" required class="biz-select" x-model="serviceType">
                                <option value="" disabled>Select a service</option>
                                @foreach(\App\Http\Requests\BusinessFormRequest::SERVICE_TYPES as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                            </select>
                            @error('service_type')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 4. Requirements --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">4</div>
                            <div><h3>Your Requirements</h3><span>Tell us about your needs</span></div>
                        </div>
                        <div class="field-group">
                            <label for="message">How can we help? <span class="req">*</span></label>
                            <textarea id="message" name="message" required class="biz-textarea" placeholder="Describe your business registration, tax return, BAS, bookkeeping or advisory requirements…">{{ old('message') }}</textarea>
                            @error('message')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 5. Terms --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">5</div>
                            <div><h3>Terms &amp; Conditions</h3><span>Please read and accept</span></div>
                        </div>
                        <label class="terms-box">
                            <input type="checkbox" name="terms_accepted" value="1" @checked(old('terms_accepted')) required>
                            <p>I agree to the <strong>terms and conditions</strong> of Canberra Accountants and authorise them to contact me regarding my business enquiry.</p>
                        </label>
                        @error('terms_accepted')<p class="field-error" style="margin-top:8px">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-footer">
                        <p class="form-note">Your information is handled securely and confidentially by registered professionals.</p>
                        <button type="submit" class="submit-btn">
                            Submit Business Form
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
