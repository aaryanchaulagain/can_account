@extends('layouts.public')

@section('content')
<section class="bg-navy-950 py-20 text-center">
    <h1 class="font-serif text-4xl text-white">Our Companies</h1>
</section>
<section class="py-20 max-w-7xl mx-auto px-4 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($companies as $company)
    <a href="{{ route('companies.show', $company) }}" class="bg-white p-8 rounded-xl shadow-sm border hover:shadow-md transition text-center">
        @if($company->logo_url)
            <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="h-20 mx-auto object-contain" loading="lazy">
        @endif
        <h2 class="mt-4 font-semibold text-navy-900">{{ $company->name }}</h2>
        <p class="mt-2 text-sm text-slate-600 line-clamp-3">{{ $company->description }}</p>
    </a>
    @endforeach
</section>
@endsection
