@props([
    'src',
    'alt' => '',
    'variant' => 'card', // card | detail | thumb
])

@php
    $wrapperClass = match ($variant) {
        'detail' => 'mt-6 mx-auto w-fit max-w-[280px] p-4 bg-slate-50 rounded-2xl border border-slate-100 shadow-sm',
        'thumb' => 'inline-flex',
        default => 'w-full bg-slate-50 flex items-center justify-center p-4 min-h-[9rem] max-h-44 border-b border-slate-100',
    };
    $imgClass = match ($variant) {
        'detail' => 'max-w-[220px] max-h-40 w-auto h-auto object-contain rounded-lg mx-auto block',
        'thumb' => 'w-10 h-10 object-contain rounded bg-slate-50',
        default => 'max-w-full max-h-36 w-auto h-auto object-contain',
    };
@endphp

<div {{ $attributes->merge(['class' => $wrapperClass]) }}>
    <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imgClass }}" loading="lazy" decoding="async">
</div>
