@extends('layouts.public')

@section('content')
<section class="relative min-h-[85vh] flex items-center bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none bg-gradient-to-br from-navy-950 via-navy-900 to-navy-800 opacity-95"></div>
    <div class="absolute inset-0 z-0 pointer-events-none bg-[url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1920&q=80')] bg-cover bg-center opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32" data-animate>
        <p class="text-gold-400 font-medium tracking-widest uppercase text-sm mb-6">Australian Accounting Excellence</p>
        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-white leading-tight max-w-3xl">
            Strategic Accounting & Tax Advisory for Growing Businesses
        </h1>
        <p class="mt-6 text-lg text-slate-300 max-w-2xl leading-relaxed">
            Canberra Accountants delivers trusted taxation, SMSF, business advisory and wealth strategies — with offices across ACT, NSW, Tasmania and South Australia.
        </p>
        <div class="mt-10 flex flex-wrap gap-4 relative z-10">
            <a href="{{ route('contact') }}#consultation-form" class="relative z-10 inline-flex items-center px-8 py-3.5 bg-gold-500 text-navy-950 font-semibold rounded hover:bg-gold-400 transition cursor-pointer">Book Consultation</a>
            <a href="{{ route('forms.tax-return') }}" class="relative z-10 inline-flex items-center px-8 py-3.5 border border-white/30 text-white font-semibold rounded hover:bg-white/10 transition cursor-pointer">Tax Return Form</a>
            <a href="{{ route('forms.business') }}" class="relative z-10 inline-flex items-center px-8 py-3.5 border border-white/30 text-white font-semibold rounded hover:bg-white/10 transition cursor-pointer">Business Form</a>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-serif text-3xl lg:text-4xl text-navy-900">Why Choose Canberra Accountants</h2>
            <p class="mt-4 text-slate-600">We combine technical excellence with personalised service to protect and grow your wealth.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['title' => 'Expert Advisory', 'desc' => 'Qualified accountants and tax agents with deep Australian regulatory knowledge.'],
                ['title' => 'Nationwide Reach', 'desc' => 'Offices in Canberra, Sydney, Hobart and Adelaide serving clients Australia-wide.'],
                ['title' => 'Trusted Partner', 'desc' => 'Long-term relationships built on integrity, transparency and results.'],
            ] as $item)
            <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-gold-500/10 flex items-center justify-center text-gold-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-navy-900">{{ $item['title'] }}</h3>
                <p class="mt-3 text-slate-600 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-24" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <h2 class="font-serif text-3xl lg:text-4xl text-navy-900">Our Services</h2>
                <p class="mt-3 text-slate-600">Comprehensive financial solutions for individuals and businesses.</p>
            </div>
            <a href="{{ route('services.index') }}" class="mt-4 md:mt-0 text-gold-600 font-semibold hover:text-gold-500">View all services →</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <a href="{{ route('services.show', $service) }}" class="group p-6 rounded-xl border border-slate-200 hover:border-gold-500/50 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-navy-900 group-hover:text-gold-600 transition">{{ $service->title }}</h3>
                <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $service->short_description }}</p>
                <span class="inline-block mt-4 text-sm font-medium text-gold-600">Learn more →</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

@if($companies->count())
<section class="py-24 bg-slate-50" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-serif text-3xl text-navy-900 text-center mb-12">Our Companies</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($companies as $company)
            <a href="{{ route('companies.show', $company) }}" class="bg-white p-6 rounded-xl shadow-sm text-center hover:shadow-md transition">
                @if($company->logo_url)
                    <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="h-16 mx-auto object-contain" loading="lazy">
                @else
                    <div class="h-16 flex items-center justify-center font-serif text-xl text-navy-800">{{ $company->name }}</div>
                @endif
                <p class="mt-4 text-sm text-slate-600 line-clamp-2">{{ Str::limit($company->description, 100) }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($articles->count())
<section class="py-24" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-serif text-3xl text-navy-900 mb-12">Latest Insights</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="group">
                <a href="{{ route('articles.show', $article->slug) }}">
                    @if($article->featured_image_url)
                        <x-insight-image :src="$article->featured_image_url" :alt="$article->title" variant="card" class="rounded-lg overflow-hidden" />
                    @else
                        <div class="w-full h-48 bg-navy-800 rounded-lg"></div>
                    @endif
                    <h3 class="mt-4 text-lg font-semibold text-navy-900 group-hover:text-gold-600">{{ $article->title }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($team->count())
<section class="py-24 bg-navy-950 text-white" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-serif text-3xl text-center mb-12">Meet Our Team</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($team as $member)
            <a href="{{ route('team.show', $member) }}" class="text-center group">
                @if($member->photo_url)
                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-32 h-32 rounded-full mx-auto object-cover ring-2 ring-gold-500/30" loading="lazy">
                @else
                    <div class="w-32 h-32 rounded-full mx-auto bg-navy-800 flex items-center justify-center text-2xl font-serif">{{ substr($member->name, 0, 1) }}</div>
                @endif
                <h3 class="mt-4 font-semibold group-hover:text-gold-400">{{ $member->name }}</h3>
                <p class="text-sm text-slate-400">{{ $member->designation }}</p>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('team.index') }}" class="text-gold-400 font-semibold hover:text-gold-300">View full team →</a>
        </div>
    </div>
</section>
@endif

@if($testimonials->count())
<section class="py-24 bg-slate-50" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-serif text-3xl text-navy-900 text-center mb-12">Client Testimonials</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <blockquote class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
                <p class="text-slate-600 italic">"{{ $testimonial->content }}"</p>
                <footer class="mt-6">
                    <p class="font-semibold text-navy-900">{{ $testimonial->client_name }}</p>
                    <p class="text-sm text-slate-500">{{ $testimonial->client_title }}{{ $testimonial->company ? ', '.$testimonial->company : '' }}</p>
                </footer>
            </blockquote>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-20 bg-navy-900" data-animate>
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="font-serif text-3xl text-white">Ready to Elevate Your Financial Strategy?</h2>
        <p class="mt-4 text-slate-300">Schedule a confidential consultation with our advisory team today.</p>
        <a href="{{ route('contact') }}#consultation-form" class="relative z-10 inline-flex items-center mt-8 px-8 py-3.5 bg-gold-500 text-navy-950 font-semibold rounded hover:bg-gold-400 transition cursor-pointer">Get Started</a>
    </div>
</section>
@endsection
