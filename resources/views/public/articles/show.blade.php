@extends('layouts.public')

@section('content')
<article class="py-16 max-w-2xl mx-auto px-4">
    <header class="border-b border-slate-200 pb-8">
        @if($article->category)
            <p class="text-sm text-gold-600 font-medium">{{ $article->category->name }}</p>
        @endif
        <p class="text-sm text-slate-500 mt-1">{{ $article->published_at?->format('d F Y') }}</p>
        <h1 class="font-serif text-3xl sm:text-4xl text-navy-900 mt-3 leading-tight">{{ $article->title }}</h1>
    </header>

    @if($article->featured_image_url)
        <x-insight-image :src="$article->featured_image_url" :alt="$article->title" variant="detail" class="!mt-8" />
    @endif

    <div class="prose prose-slate prose-lg mt-8 max-w-none text-slate-700 leading-relaxed">
        @if($article->content !== strip_tags($article->content))
            {!! $article->content !!}
        @else
            {!! nl2br(e($article->content)) !!}
        @endif
    </div>
</article>

@if($related->count())
<section class="py-14 bg-slate-50 border-t border-slate-200">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="font-serif text-xl text-navy-900 mb-6">Related Insights</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($related as $rel)
            <a href="{{ route('articles.show', $rel->slug) }}" class="block p-5 bg-white rounded-xl border border-slate-100 hover:border-gold-500/30 hover:shadow-md transition">
                <p class="text-xs text-gold-600">{{ $rel->published_at?->format('d M Y') }}</p>
                <h3 class="mt-1 font-semibold text-navy-900 text-sm leading-snug">{{ $rel->title }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
