@extends('layouts.public')

@section('content')
<section class="relative py-24 bg-navy-950 text-white">
    @if($service->hero_image_url)
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image:url('{{ $service->hero_image_url }}')"></div>
    @endif
    <div class="relative max-w-7xl mx-auto px-4">
        <h1 class="font-serif text-4xl lg:text-5xl">{{ $service->title }}</h1>
        <p class="mt-4 text-slate-300 max-w-2xl">{{ $service->short_description }}</p>
    </div>
</section>

<section class="py-16 max-w-4xl mx-auto px-4 prose prose-lg prose-slate">
    @if($service->overview)
        <div>{!! nl2br(e($service->overview)) !!}</div>
    @endif
</section>

@include('public.services.partials.benefits', ['service' => $service])

@if(!empty($service->process_steps))
<section class="py-16 max-w-4xl mx-auto px-4">
    <h2 class="font-serif text-3xl text-navy-900 mb-8">Our Process</h2>
    <ol class="space-y-6">
        @foreach($service->process_steps as $i => $step)
        <li class="flex gap-4">
            <span class="w-10 h-10 rounded-full bg-gold-500 text-navy-950 flex items-center justify-center font-bold shrink-0">{{ $i + 1 }}</span>
            <div>
                <h3 class="font-semibold text-navy-900">{{ $step['title'] ?? '' }}</h3>
                <p class="text-slate-600 text-sm mt-1">{{ $step['description'] ?? '' }}</p>
            </div>
        </li>
        @endforeach
    </ol>
</section>
@endif

@if(!empty($service->faqs))
<section class="py-16 bg-slate-50" x-data="{ open: null }">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="font-serif text-3xl text-navy-900 mb-8 text-center">Frequently Asked Questions</h2>
        @foreach($service->faqs as $i => $faq)
        <div class="mb-4 bg-white rounded-lg border border-slate-200">
            <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="w-full px-6 py-4 text-left font-semibold text-navy-900 flex justify-between">
                {{ $faq['question'] ?? '' }}
                <span x-text="open === {{ $i }} ? '−' : '+'"></span>
            </button>
            <div x-show="open === {{ $i }}" x-cloak class="px-6 pb-4 text-slate-600 text-sm">{{ $faq['answer'] ?? '' }}</div>
        </div>
        @endforeach
    </div>
</section>
@endif

@php
    $hasServiceCta = ! empty($service->benefits['cta']);
@endphp

@if(! $hasServiceCta)
<section class="py-16 text-center">
    <a href="{{ route('contact') }}#consultation-form" class="relative z-10 inline-flex items-center px-8 py-3.5 bg-gold-500 text-navy-950 font-semibold rounded-lg hover:bg-gold-400 cursor-pointer">Book a Consultation</a>
</section>
@endif
@endsection
