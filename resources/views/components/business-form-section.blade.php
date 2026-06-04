{{-- Legacy form section wrapper (used inside business-legacy-page) --}}
<section class="form-section" id="businessform" {{ $attributes }}>
    <div class="form-wrapper">
        <div class="form-header">
            <h2>{{ $heading ?? 'Business Engagement & Tax Form' }}</h2>
            <p>{{ $description ?? 'Complete the secure business engagement form below. Our team will review your details and contact you regarding your business registration, tax return, BAS or accounting requirements.' }}</p>
        </div>
        <x-business-form-embed />
    </div>
</section>
