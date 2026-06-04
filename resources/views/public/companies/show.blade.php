@extends('layouts.public')

@section('content')
<section class="py-20 max-w-4xl mx-auto px-4">
    @if($company->featured_image_url)
        <img src="{{ $company->featured_image_url }}" alt="" class="w-full h-64 object-cover rounded-xl mb-8" loading="lazy">
    @endif
    <h1 class="font-serif text-4xl text-navy-900">{{ $company->name }}</h1>
    <div class="mt-6 prose prose-lg text-slate-600">{!! nl2br(e($company->description)) !!}</div>
    @if($company->services)
        <h2 class="font-serif text-2xl mt-10 text-navy-900">Services</h2>
        <p class="mt-4 text-slate-600">{!! nl2br(e($company->services)) !!}</p>
    @endif
    @if($company->website_url)
        <a href="{{ $company->website_url }}" target="_blank" rel="noopener" class="inline-block mt-8 text-gold-600 font-semibold">Visit Website →</a>
    @endif
</section>
@endsection
