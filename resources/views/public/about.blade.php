@extends('layouts.public')

@section('content')
<section class="bg-navy-950 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="font-serif text-4xl lg:text-5xl text-white">About Canberra Accountants</h1>
        <p class="mt-4 text-slate-300 max-w-2xl mx-auto">A trusted Australian accounting firm committed to excellence, integrity and client success.</p>
    </div>
</section>

<section class="py-20 max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-16">
    <div data-animate>
        <h2 class="font-serif text-2xl text-navy-900">Company Introduction</h2>
        <p class="mt-4 text-slate-600 leading-relaxed">Canberra Accountants is a leading accounting and taxation firm providing comprehensive advisory services to individuals, families and businesses across Australia. With offices in the Australian Capital Territory, New South Wales, Tasmania and South Australia, we deliver local expertise with national capability.</p>
    </div>
    <div data-animate>
        <h2 class="font-serif text-2xl text-navy-900">Our Mission</h2>
        <p class="mt-4 text-slate-600 leading-relaxed">To empower our clients with strategic financial clarity, ensuring compliance while maximising wealth creation and business growth through proactive, personalised advisory.</p>
    </div>
    <div data-animate>
        <h2 class="font-serif text-2xl text-navy-900">Our Vision</h2>
        <p class="mt-4 text-slate-600 leading-relaxed">To be Australia's most trusted boutique accounting group — recognised for technical excellence, ethical practice and lasting client partnerships.</p>
    </div>
    <div data-animate>
        <h2 class="font-serif text-2xl text-navy-900">Core Values</h2>
        <ul class="mt-4 space-y-2 text-slate-600">
            <li>• Integrity & Transparency</li>
            <li>• Technical Excellence</li>
            <li>• Client-First Advisory</li>
            <li>• Proactive Partnership</li>
        </ul>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4" data-animate>
        <p class="text-slate-600 leading-relaxed">
            Effective tax planning is about more than simply meeting compliance obligations—it is about creating opportunities to grow, protect, and preserve your wealth. With the right strategies in place, individuals, families, and businesses can improve tax efficiency while working towards their long-term financial goals.
        </p>
        <p class="mt-6 text-slate-600 leading-relaxed">
            Our Tax Planning &amp; Wealth Strategies services provide proactive, tailored advice designed to minimise tax liabilities, optimise financial outcomes, and support sustainable wealth creation.
        </p>

        <h2 class="font-serif text-3xl text-navy-900 mt-12 mb-8">Our Services</h2>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-8">
            <h3 class="font-serif text-2xl text-navy-900">Tax Planning &amp; Advisory</h3>
            <p class="mt-4 text-slate-600 leading-relaxed">
                We provide strategic tax advice to help you make informed financial decisions, including:
            </p>
            <ul class="mt-6 space-y-3 text-slate-600">
                <li class="flex gap-3">
                    <span class="text-gold-500 shrink-0 font-bold">•</span>
                    <span>Tax-effective business structures</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-gold-500 shrink-0 font-bold">•</span>
                    <span>Income tax planning</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-gold-500 shrink-0 font-bold">•</span>
                    <span>Capital Gains Tax (CGT) planning</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-gold-500 shrink-0 font-bold">•</span>
                    <span>Investment tax strategies</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-gold-500 shrink-0 font-bold">•</span>
                    <span>Year-end tax planning</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-gold-500 shrink-0 font-bold">•</span>
                    <span>Tax compliance support</span>
                </li>
            </ul>
        </div>
    </div>
</section>

@if($timeline->count())
<section class="py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="font-serif text-3xl text-navy-900 text-center mb-12">Company Timeline</h2>
        <div class="space-y-8">
            @foreach($timeline as $event)
            <div class="flex gap-6" data-animate>
                <span class="font-serif text-2xl text-gold-600 w-20 shrink-0">{{ $event->year }}</span>
                <div>
                    <h3 class="font-semibold text-navy-900">{{ $event->title }}</h3>
                    <p class="mt-1 text-slate-600 text-sm">{{ $event->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($leadership->count())
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="font-serif text-3xl text-navy-900 text-center mb-12">Leadership Team</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($leadership as $member)
            @include('components.team-card', ['member' => $member])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
