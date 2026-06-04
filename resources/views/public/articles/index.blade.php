@extends('layouts.public')

@section('content')
<section class="bg-navy-950 py-20 text-center">
    <h1 class="font-serif text-4xl text-white">Insights & Articles</h1>
    <p class="mt-4 text-slate-300 max-w-xl mx-auto">Expert advice on tax, accounting and business strategy.</p>
</section>
<section class="py-12 max-w-7xl mx-auto px-4">
    <form method="GET" class="flex flex-wrap gap-4 mb-12">
        <input type="search" name="q" value="{{ $search }}" placeholder="Search insights..." class="flex-1 min-w-[200px] rounded-lg border-slate-300">
        @if($categories->count())
        <select name="category" class="rounded-lg border-slate-300">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->slug }}" @selected($activeCategory === $cat->slug)>{{ $cat->name }}</option>
            @endforeach
        </select>
        @endif
        <button type="submit" class="px-6 py-2 bg-navy-900 text-white rounded-lg hover:bg-navy-800">Search</button>
    </form>
    <div class="grid md:grid-cols-3 gap-8">
        @forelse($articles as $article)
        <article class="group bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-md transition">
            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                @if($article->featured_image_url)
                    <x-insight-image :src="$article->featured_image_url" :alt="$article->title" variant="card" />
                @else
                    <div class="w-full h-36 bg-gradient-to-br from-navy-800 to-navy-950 flex items-center justify-center">
                        <span class="font-serif text-white/40 text-lg">Insights</span>
                    </div>
                @endif
                <div class="p-5">
                    <p class="text-xs text-gold-600 font-medium">{{ $article->published_at?->format('d M Y') }}</p>
                    <h2 class="mt-1.5 text-base font-semibold text-navy-900 group-hover:text-gold-600 transition line-clamp-2">{{ $article->title }}</h2>
                    @if($article->excerpt)
                        <p class="mt-2 text-sm text-slate-600 line-clamp-3">{{ $article->excerpt }}</p>
                    @endif
                    <span class="inline-block mt-4 text-sm font-medium text-gold-600">Read more →</span>
                </div>
            </a>
        </article>
        @empty
        <div class="col-span-3 text-center py-16 text-slate-600">
            <p>No insights published yet. Check back soon.</p>
        </div>
        @endforelse
    </div>
    <div class="mt-12">{{ $articles->withQueryString()->links() }}</div>
</section>
@endsection
