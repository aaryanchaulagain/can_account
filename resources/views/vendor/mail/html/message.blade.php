<x-mail::layout>
{{-- Header with embedded logo (works in Gmail without a public URL) --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
@if (isset($message) && file_exists(public_path('images/logo.png')))
<img
    src="{{ $message->embed(public_path('images/logo.png')) }}"
    alt="{{ config('mail.from.name', 'Canberra Accountants') }}"
    class="logo"
    style="max-height: 64px; max-width: 200px; height: auto; width: auto; border: 0; display: block; margin: 0 auto;"
>
@else
{{ config('mail.from.name', 'Canberra Accountants') }}
@endif
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
