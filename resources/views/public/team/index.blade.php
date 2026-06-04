@extends('layouts.public')

@section('content')
<section class="bg-navy-950 py-20 text-center">
    <h1 class="font-serif text-4xl text-white">Our Team</h1>
    <p class="mt-4 text-slate-300">Experienced professionals dedicated to your financial success.</p>
</section>
<section class="py-20 max-w-7xl mx-auto px-4 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($members as $member)
        @include('components.team-card', ['member' => $member])
    @endforeach
</section>
@endsection
