@extends('layouts.public')

@push('styles')
<style>
.tax-return-page {
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

.tax-return-page .tax-hero { position: relative; padding: 90px 20px 50px; overflow: hidden; }
.tax-return-page .tax-hero::before { content: ''; position: absolute; top: -150px; left: -100px; width: 400px; height: 400px; background: rgba(15,118,110,.2); filter: blur(100px); border-radius: 50%; }
.tax-return-page .tax-hero::after { content: ''; position: absolute; bottom: -150px; right: -100px; width: 450px; height: 450px; background: rgba(132,204,22,.12); filter: blur(100px); border-radius: 50%; }
.tax-return-page .tax-container { max-width: 900px; margin: auto; position: relative; z-index: 2; text-align: center; }
.tax-return-page .hero-badge { display: inline-flex; align-items: center; gap: 10px; padding: 10px 16px; background: rgba(255,255,255,.06); border: 1px solid rgba(132,204,22,.35); border-radius: 999px; margin-bottom: 20px; color: var(--ca-green-light); font-size: 13px; font-weight: 500; }
.tax-return-page .hero-badge span { width: 8px; height: 8px; background: var(--ca-green); border-radius: 50%; }
.tax-return-page .tax-heading { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: clamp(2rem, 4vw, 3rem); line-height: 1.1; font-weight: 700; margin-bottom: 16px; color: white; }
.tax-return-page .tax-heading .gradient { background: linear-gradient(to right, #5eead4, var(--ca-green)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.tax-return-page .hero-text { font-size: 1rem; line-height: 1.7; color: var(--ca-muted); max-width: 560px; margin: 0 auto; }

.tax-return-page .form-section { padding: 0 20px 100px; }
.tax-return-page .form-outer { max-width: 900px; margin: auto; }

.tax-return-page .form-wrapper { background: var(--ca-form); border-radius: 24px; overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,.35); border: 1px solid #e2e8f0; }

.tax-return-page .form-logo-bar { text-align: center; padding: 36px 32px 24px; background: white; border-bottom: 1px solid #e2e8f0; }
.tax-return-page .form-logo-bar .brand-name { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: 1.75rem; font-weight: 700; color: var(--ca-teal); letter-spacing: .02em; }
.tax-return-page .form-logo-bar .brand-sub { font-size: .7rem; font-weight: 600; color: var(--ca-teal); letter-spacing: .15em; text-transform: uppercase; margin-top: 2px; }
.tax-return-page .form-logo-bar .brand-tagline { font-size: .8rem; color: var(--ca-muted); margin-top: 10px; }
.tax-return-page .form-logo-bar .brand-instruction { font-size: .875rem; color: #475569; margin-top: 14px; }

.tax-return-page .form-header-bar { background: linear-gradient(135deg, var(--ca-bg) 0%, #0c2552 100%); padding: 24px 36px; border-bottom: 3px solid var(--ca-green); }
.tax-return-page .form-header-bar h2 { font-family: 'Cormorant Garamond', ui-serif, Georgia, serif; font-size: 1.5rem; color: white; font-weight: 700; margin: 0; }
.tax-return-page .form-header-bar p { color: #94a3b8; font-size: .8125rem; margin: 6px 0 0; }

.tax-return-page .alert-success { margin: 24px 36px 0; padding: 14px 18px; background: #ecfdf5; border: 1px solid #6ee7b7; border-left: 4px solid var(--ca-teal); border-radius: 10px; color: #065f46; font-size: .9rem; font-weight: 500; }

.tax-return-page .tax-form { padding: 32px 36px 36px; }

.tax-return-page .form-section-block { margin-bottom: 32px; }
.tax-return-page .section-label { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; }
.tax-return-page .section-num { width: 30px; height: 30px; border-radius: 8px; background: var(--ca-teal); color: white; font-size: .75rem; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.tax-return-page .section-label h3 { font-size: 1rem; font-weight: 700; color: var(--ca-heading); margin: 0; }
.tax-return-page .section-label span { font-size: .75rem; color: var(--ca-muted); font-weight: 400; }

.tax-return-page .field-grid { display: grid; gap: 18px; }
.tax-return-page .field-grid-2 { grid-template-columns: 1fr 1fr; }
.tax-return-page .field-grid-3 { grid-template-columns: 1fr 1fr 1fr; }

.tax-return-page .field-group label { display: block; font-size: .8125rem; font-weight: 600; color: var(--ca-label); margin-bottom: 7px; }
.tax-return-page .field-group label .req { color: var(--ca-teal); }
.tax-return-page .field-group .field-hint { font-size: .75rem; color: var(--ca-placeholder); margin-top: 5px; }
.tax-return-page .field-group .field-error { font-size: .8rem; color: #dc2626; margin-top: 5px; }

.tax-return-page .tax-input,
.tax-return-page .tax-select,
.tax-return-page .tax-textarea {
    width: 100%; padding: 12px 15px; background: var(--ca-input-bg);
    border: 1.5px solid var(--ca-input-border); border-radius: 10px;
    font-size: .9375rem; color: var(--ca-heading); transition: border-color .2s, box-shadow .2s; outline: none;
}
.tax-return-page .tax-input::placeholder, .tax-return-page .tax-textarea::placeholder { color: var(--ca-placeholder); opacity: 1; }
.tax-return-page .tax-input:hover, .tax-return-page .tax-select:hover { border-color: #94a3b8; }
.tax-return-page .tax-input:focus, .tax-return-page .tax-select:focus, .tax-return-page .tax-textarea:focus {
    border-color: var(--ca-teal); box-shadow: 0 0 0 3px rgba(15,118,110,.15);
}
.tax-return-page .tax-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 14px center; background-size: 18px;
    padding-right: 44px; cursor: pointer; appearance: none;
}

.tax-return-page .section-divider { border: none; border-top: 2px dotted #cbd5e1; margin: 28px 0; }

.tax-return-page .upload-zone {
    border: 2px dashed var(--ca-input-border); border-radius: 14px; padding: 36px 24px;
    text-align: center; background: white; cursor: pointer; transition: border-color .2s, background .2s;
}
.tax-return-page .upload-zone:hover, .tax-return-page .upload-zone.dragover {
    border-color: var(--ca-teal); background: #f0fdfa;
}
.tax-return-page .upload-zone .upload-icon { width: 48px; height: 48px; margin: 0 auto 12px; color: var(--ca-muted); }
.tax-return-page .upload-zone .upload-title { font-weight: 600; color: var(--ca-heading); font-size: .9375rem; }
.tax-return-page .upload-zone .upload-sub { font-size: .8125rem; color: var(--ca-placeholder); margin-top: 4px; }
.tax-return-page .upload-zone .upload-file { font-size: .8125rem; color: var(--ca-teal); font-weight: 600; margin-top: 10px; }
.tax-return-page .upload-zone input[type="file"] { display: none; }

.tax-return-page .terms-box {
    background: white; border: 1.5px solid var(--ca-input-border); border-radius: 12px;
    padding: 18px 20px; display: flex; align-items: flex-start; gap: 14px; cursor: pointer;
    transition: border-color .2s, background .2s;
}
.tax-return-page .terms-box:hover { border-color: var(--ca-teal); background: #f0fdfa; }
.tax-return-page .terms-box input { width: 20px; height: 20px; margin-top: 2px; accent-color: var(--ca-teal); flex-shrink: 0; cursor: pointer; }
.tax-return-page .terms-box p { font-size: .875rem; color: #334155; line-height: 1.55; margin: 0; }

.tax-return-page .form-footer { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; padding-top: 24px; margin-top: 8px; border-top: 2px solid #e2e8f0; }
.tax-return-page .form-note { font-size: .8rem; color: var(--ca-placeholder); max-width: 360px; line-height: 1.55; }
.tax-return-page .submit-btn {
    display: inline-flex; align-items: center; gap: 10px; padding: 15px 32px;
    background: var(--ca-teal); color: white; font-size: .9375rem; font-weight: 700;
    border: none; border-radius: 12px; cursor: pointer;
    transition: background .2s, transform .2s, box-shadow .2s;
    box-shadow: 0 8px 24px rgba(15,118,110,.35);
}
.tax-return-page .submit-btn:hover { background: var(--ca-teal-dark); transform: translateY(-2px); }

@media (max-width: 640px) {
    .tax-return-page .field-grid-2, .tax-return-page .field-grid-3 { grid-template-columns: 1fr; }
    .tax-return-page .tax-form, .tax-return-page .form-logo-bar, .tax-return-page .form-header-bar { padding-left: 20px; padding-right: 20px; }
    .tax-return-page .alert-success { margin-left: 20px; margin-right: 20px; }
    .tax-return-page .submit-btn { width: 100%; justify-content: center; }
}
</style>
@endpush

@section('content')
<div class="tax-return-page" x-data="taxUploadForm()">
    <section class="tax-hero">
        <div class="tax-container">
            <div class="hero-badge"><span></span> Australian Tax Return Services</div>
            <h1 class="tax-heading">Fast &amp; Professional <span class="gradient">Australian Tax Returns</span></h1>
            <p class="hero-text">Complete the form below correctly and submit. Our team will review your details and prepare your return.</p>
        </div>
    </section>

    <section class="form-section" id="taxform">
        <div class="form-outer">
            <div class="form-wrapper">

                <div class="form-logo-bar">
                    <div class="brand-name">CANBERRA</div>
                    <div class="brand-sub">Accountants</div>
                    <div class="brand-tagline">Tax &nbsp;|&nbsp; CFO Advisory &nbsp;|&nbsp; SMSF</div>
                    <p class="brand-instruction">Please complete the below form correctly and submit.</p>
                </div>

                <div class="form-header-bar">
                    <h2>Tax Return Application</h2>
                    <p>All fields marked with <span style="color:#5eead4">*</span> are required</p>
                </div>

                @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('forms.tax-return.store') }}" method="POST" enctype="multipart/form-data" class="tax-form">
                    @csrf
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                    {{-- 1. Personal --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">1</div>
                            <div><h3>Personal Information</h3><span>Name, contact &amp; identity</span></div>
                        </div>
                        <div class="field-grid">
                            <div class="field-grid field-grid-2">
                                <div class="field-group">
                                    <label for="first_name">First Name <span class="req">*</span></label>
                                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required class="tax-input" placeholder="First name">
                                    @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="last_name">Last Name <span class="req">*</span></label>
                                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required class="tax-input" placeholder="Last name">
                                    @error('last_name')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="field-group">
                                <label for="email">Email <span class="req">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="tax-input" placeholder="example@example.com">
                                @error('email')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field-grid field-grid-2">
                                <div class="field-group">
                                    <label for="phone">Phone Number <span class="req">*</span></label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required class="tax-input" placeholder="(000) 000-0000">
                                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="gender">Gender <span class="req">*</span></label>
                                    <select id="gender" name="gender" required class="tax-select">
                                        <option value="" disabled @selected(!old('gender'))>Please Select</option>
                                        @foreach(['Male', 'Female', 'Other', 'Prefer not to say'] as $g)
                                        <option value="{{ $g }}" @selected(old('gender') === $g)>{{ $g }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="field-grid field-grid-2">
                                <div class="field-group">
                                    <label for="tfn">TFN Number <span class="req">*</span></label>
                                    <input type="text" id="tfn" name="tfn" value="{{ old('tfn') }}" required class="tax-input" placeholder="123456789" maxlength="9" inputmode="numeric" pattern="\d{9}">
                                    <p class="field-hint">Enter a 9 digit code</p>
                                    @error('tfn')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="date_of_birth">Date of Birth <span class="req">*</span></label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="tax-input">
                                    @error('date_of_birth')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 2. Business & Bank --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">2</div>
                            <div><h3>Business &amp; Bank Details</h3><span>ABN and refund account</span></div>
                        </div>
                        <div class="field-grid">
                            <div class="field-group">
                                <label for="abn">ABN Number</label>
                                <input type="text" id="abn" name="abn" value="{{ old('abn') }}" class="tax-input" placeholder="e.g. 12345678901" maxlength="11" inputmode="numeric">
                                <p class="field-hint">Enter 11 digit ABN number (optional)</p>
                                @error('abn')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field-group">
                                <label>Bank Account Detail <span class="req">*</span></label>
                                <div class="field-grid field-grid-2">
                                    <div class="field-group" style="margin:0">
                                        <input type="text" name="bsb" value="{{ old('bsb') }}" required class="tax-input" placeholder="BSB number" maxlength="6" inputmode="numeric" pattern="\d{6}">
                                        @error('bsb')<p class="field-error">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="field-group" style="margin:0">
                                        <input type="text" name="account_number" value="{{ old('account_number') }}" required class="tax-input" placeholder="Account number">
                                        @error('account_number')<p class="field-error">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 3. Address --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">3</div>
                            <div><h3>Full Address</h3><span>Residential address details</span></div>
                        </div>
                        <div class="field-grid">
                            <div class="field-group">
                                <label for="street_address">Street Address <span class="req">*</span></label>
                                <input type="text" id="street_address" name="street_address" value="{{ old('street_address') }}" required class="tax-input" placeholder="Street address">
                                @error('street_address')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field-grid field-grid-3">
                                <div class="field-group">
                                    <label for="suburb">Suburb <span class="req">*</span></label>
                                    <input type="text" id="suburb" name="suburb" value="{{ old('suburb') }}" required class="tax-input" placeholder="Suburb">
                                    @error('suburb')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="state">State <span class="req">*</span></label>
                                    <select id="state" name="state" required class="tax-select">
                                        <option value="" disabled @selected(!old('state'))>Select state</option>
                                        @foreach(['ACT','NSW','NT','QLD','SA','TAS','VIC','WA'] as $st)
                                        <option value="{{ $st }}" @selected(old('state') === $st)>{{ $st }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="field-group">
                                    <label for="post_code">Post Code <span class="req">*</span></label>
                                    <input type="text" id="post_code" name="post_code" value="{{ old('post_code') }}" required class="tax-input" placeholder="2600" maxlength="4" inputmode="numeric">
                                    @error('post_code')<p class="field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 4. Family --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">4</div>
                            <div><h3>Family Details</h3><span>Spouse and dependants</span></div>
                        </div>
                        <div class="field-grid field-grid-2">
                            <div class="field-group">
                                <label for="has_spouse">Do you have Spouse with you? <span class="req">*</span></label>
                                <select id="has_spouse" name="has_spouse" required class="tax-select">
                                    <option value="" disabled @selected(!old('has_spouse'))>Please Select</option>
                                    <option value="Yes" @selected(old('has_spouse') === 'Yes')>Yes</option>
                                    <option value="No" @selected(old('has_spouse') === 'No')>No</option>
                                </select>
                                @error('has_spouse')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field-group">
                                <label for="number_of_children">Do you have any Kid? How many? <span class="req">*</span></label>
                                <select id="number_of_children" name="number_of_children" required class="tax-select">
                                    @for($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}" @selected(old('number_of_children', '0') == $i)>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('number_of_children')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 5. ID Upload --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">5</div>
                            <div><h3>Identity Document</h3><span>Required for verification</span></div>
                        </div>
                        <div class="field-group">
                            <label>Upload your ID document <span class="req">*</span></label>
                            <div class="upload-zone" :class="{ 'dragover': dragging }"
                                @click="$refs.fileInput.click()"
                                @dragover.prevent="dragging = true"
                                @dragleave.prevent="dragging = false"
                                @drop.prevent="handleDrop($event)">
                                <input type="file" x-ref="fileInput" name="id_document" accept=".pdf,.jpg,.jpeg,.png,.webp" required @change="fileName = $event.target.files[0]?.name || ''">
                                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <p class="upload-title">Browse Files</p>
                                <p class="upload-sub">Drag and drop files here</p>
                                <p class="upload-sub" style="margin-top:8px">Passport, Photo ID or Australian Driver Licence</p>
                                <p class="upload-file" x-show="fileName" x-text="fileName"></p>
                            </div>
                            @error('id_document')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- 6. Terms --}}
                    <div class="form-section-block">
                        <div class="section-label">
                            <div class="section-num">6</div>
                            <div><h3>Terms &amp; Conditions</h3><span>Please read and accept</span></div>
                        </div>
                        <label class="terms-box">
                            <input type="checkbox" name="terms_accepted" value="1" @checked(old('terms_accepted')) required>
                            <p>I agree to the <strong>terms and conditions</strong> of Canberra Accountants. I confirm that the information provided is accurate and authorise Canberra Accountants to prepare and lodge my tax return on my behalf.</p>
                        </label>
                        @error('terms_accepted')<p class="field-error" style="margin-top:8px">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-footer">
                        <p class="form-note">Your information is encrypted and handled in strict confidence by registered tax agents.</p>
                        <button type="submit" class="submit-btn">
                            Submit Tax Return
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
function taxUploadForm() {
    return {
        dragging: false,
        fileName: '',
        handleDrop(e) {
            this.dragging = false;
            const files = e.dataTransfer.files;
            if (files.length) {
                this.$refs.fileInput.files = files;
                this.fileName = files[0].name;
            }
        }
    };
}
</script>
@endpush
