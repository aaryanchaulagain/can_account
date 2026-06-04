@extends('layouts.public')

@section('content')
<section class="bg-navy-950 py-20 text-center">
    <h1 class="font-serif text-4xl text-white">Our Services</h1>
    <p class="mt-4 text-slate-300 max-w-2xl mx-auto">Expert accounting, taxation and advisory solutions tailored to your needs.</p>
</section>
<section class="py-20 max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-8">
    @foreach($services as $service)
    <a href="{{ route('services.show', $service) }}" class="p-8 rounded-xl border border-slate-200 hover:shadow-lg transition group" data-animate>
        <h2 class="text-xl font-semibold text-navy-900 group-hover:text-gold-600">{{ $service->title }}</h2>
        <p class="mt-3 text-slate-600">{{ $service->short_description }}</p>
        <span class="inline-block mt-4 text-gold-600 font-medium">Explore service →</span>
    </a>
    @endforeach
</section>
@endsection
