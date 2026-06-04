<section class="form-section" id="taxform" {{ $attributes }}>
    <div class="form-wrapper">
        <div class="form-top">
            <h2>{{ $heading ?? 'Start Your Tax Return' }}</h2>
            <p>{{ $description ?? 'Complete the secure online tax return form below. Once submitted, our team will review your information and contact you if any additional details are required before lodgement.' }}</p>
        </div>
        <x-tax-return-form-embed />
    </div>
</section>
