{{-- JotForm embed — original integration unchanged --}}
<div class="jotform-box">
    <iframe
        id="JotFormIFrame-261412299504052"
        title="Business Services - Canberra Accountants"
        onload="window.parent.scrollTo(0,0)"
        allowtransparency="true"
        allow="geolocation; microphone; camera; fullscreen; payment"
        src="https://form.jotform.com/261412299504052"
        frameborder="0"
        scrolling="no"
    ></iframe>
</div>

@once
@push('scripts')
<script src="https://cdn.jotfor.ms/s/umd/latest/for-form-embed-handler.js"></script>
<script>
window.jotformEmbedHandler(
    "iframe[id='JotFormIFrame-261412299504052']",
    "https://form.jotform.com/"
);
</script>
@endpush
@endonce
