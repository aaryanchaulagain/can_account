@extends('layouts.public')

@section('content')
<section class="py-20 max-w-4xl mx-auto px-4">
    <div class="flex flex-col md:flex-row gap-10 items-start">
        @if($member->photo_url)
            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-48 h-48 rounded-xl object-cover" loading="lazy">
        @endif
        <div>
            <h1 class="font-serif text-4xl text-navy-900">{{ $member->name }}</h1>
            <p class="text-gold-600 font-medium mt-2">{{ $member->designation }}</p>
            @if($member->qualifications)
                <p class="mt-4 text-sm text-slate-600">{{ $member->qualifications }}</p>
            @endif
            <div class="mt-6 flex gap-4 text-sm">
                @if($member->email)<a href="mailto:{{ $member->email }}" class="text-navy-700 hover:text-gold-600">{{ $member->email }}</a>@endif
                @if($member->linkedin_url)<a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" class="text-navy-700 hover:text-gold-600">LinkedIn</a>@endif
            </div>
        </div>
    </div>
    @if($member->biography)
    <div class="mt-12 prose prose-lg max-w-none text-slate-600">{!! nl2br(e($member->biography)) !!}</div>
    @endif
</section>
@endsection
