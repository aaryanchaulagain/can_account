@php
    $benefitsHeading = 'Benefits';
    $benefitsIntro = null;
    $benefitItems = [];
    $whyChoose = null;
    $highlights = null;
    $industries = null;
    $contentCta = null;

    if (! empty($service->benefits)) {
        if (isset($service->benefits['items'])) {
            $benefitsHeading = $service->benefits['heading'] ?? 'Benefits';
            $benefitsIntro = $service->benefits['intro'] ?? null;
            $benefitItems = $service->benefits['items'];
            $whyChoose = $service->benefits['why_choose'] ?? null;
            $highlights = $service->benefits['highlights'] ?? null;
            $industries = $service->benefits['industries'] ?? null;
            $contentCta = $service->benefits['cta'] ?? null;
        } else {
            $benefitItems = $service->benefits;
        }
    }
@endphp

@if(!empty($benefitItems))
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="font-serif text-3xl text-navy-900 mb-3">{{ $benefitsHeading }}</h2>
        @if($benefitsIntro)
            <p class="text-slate-600 mb-8 max-w-3xl">{{ $benefitsIntro }}</p>
        @else
            <div class="mb-8"></div>
        @endif
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($benefitItems as $benefit)
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <h3 class="font-semibold text-navy-900 text-lg">{{ $benefit['title'] ?? '' }}</h3>
                @if(!empty($benefit['description']))
                    <p class="mt-2 text-slate-600 text-sm leading-relaxed">{{ $benefit['description'] }}</p>
                @endif
                @if(!empty($benefit['items']))
                    <ul class="mt-3 space-y-1.5 text-sm text-slate-600">
                        @foreach($benefit['items'] as $item)
                            <li class="flex gap-2">
                                <span class="text-gold-500 shrink-0">•</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if(!empty($benefit['footer']))
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed">{{ $benefit['footer'] }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(!empty($whyChoose['items']))
<section class="py-16 max-w-7xl mx-auto px-4">
    <h2 class="font-serif text-3xl text-navy-900 mb-8">{{ $whyChoose['heading'] ?? 'Why Choose Us?' }}</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($whyChoose['items'] as $item)
        <div class="p-6 rounded-xl border border-slate-200 bg-white">
            <h3 class="font-semibold text-navy-900">{{ $item['title'] ?? '' }}</h3>
            <p class="mt-2 text-sm text-slate-600 leading-relaxed">{{ $item['description'] ?? '' }}</p>
        </div>
        @endforeach
    </div>
</section>
@endif

@if(!empty($highlights['items']))
<section class="py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="font-serif text-3xl text-navy-900 mb-8 text-center">{{ $highlights['heading'] ?? 'Key Benefits' }}</h2>
        <ul class="grid sm:grid-cols-2 gap-4">
            @foreach($highlights['items'] as $highlight)
            <li class="flex gap-3 items-start bg-white p-4 rounded-lg border border-slate-100 shadow-sm">
                <span class="text-gold-500 shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </span>
                <span class="text-sm text-navy-900 font-medium">{{ $highlight }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

@if(!empty($industries['items']))
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="font-serif text-3xl text-navy-900 mb-8 text-center">{{ $industries['heading'] ?? 'Industries We Serve' }}</h2>
        <div class="flex flex-wrap justify-center gap-3 max-w-4xl mx-auto">
            @foreach($industries['items'] as $industry)
            <span class="px-4 py-2 bg-white rounded-full text-sm font-medium text-navy-800 border border-slate-200 shadow-sm">{{ $industry }}</span>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(!empty($contentCta))
<section class="py-16 max-w-3xl mx-auto px-4 text-center">
    <h2 class="font-serif text-3xl text-navy-900">{{ $contentCta['heading'] ?? '' }}</h2>
    @if(!empty($contentCta['description']))
        <p class="mt-4 text-slate-600 leading-relaxed">{{ $contentCta['description'] }}</p>
    @endif
    <a href="{{ route('contact') }}#consultation-form" class="inline-flex items-center mt-8 px-8 py-3.5 bg-gold-500 text-navy-950 font-semibold rounded-lg hover:bg-gold-400 transition">
        Contact Us Today
    </a>
</section>
@endif
