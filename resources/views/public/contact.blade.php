@extends('layouts.public')

@section('content')
<section class="bg-navy-950 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="font-serif text-4xl text-white">Contact Us</h1>
        <p class="mt-4 text-slate-300">We'd love to hear from you. Reach out to any of our offices nationwide.</p>
    </div>
</section>

<section class="py-20 max-w-7xl mx-auto px-4">
    @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="grid lg:grid-cols-2 gap-16">
        <form id="consultation-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6 scroll-mt-28">
            @csrf
            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">
            <div>
                <label class="block text-sm font-medium text-navy-900 mb-1">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-navy-900 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-slate-300">
                    @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-navy-900 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-slate-300">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-navy-900 mb-1">Company</label>
                <input type="text" name="company" value="{{ old('company') }}" class="w-full rounded-lg border-slate-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-navy-900 mb-1">Service Interested In</label>
                <select name="service_interested" class="w-full rounded-lg border-slate-300">
                    <option value="">Select a service</option>
                    @foreach($services as $title => $label)
                        <option value="{{ $title }}" @selected(old('service_interested') === $title)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-navy-900 mb-1">Message *</label>
                <textarea name="message" rows="5" required class="w-full rounded-lg border-slate-300">{{ old('message') }}</textarea>
                @error('message')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="px-8 py-3 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800 transition">Send Message</button>
        </form>

        <div>
            <h2 class="font-serif text-2xl text-navy-900 mb-6">Office Locations</h2>
            <div class="space-y-6">
                @foreach($locations as $location)
                <div class="p-6 bg-slate-50 rounded-xl">
                    <h3 class="font-semibold text-navy-900">{{ $location->state }}</h3>
                    <p class="mt-2 text-sm text-slate-600 whitespace-pre-line">{{ $location->address }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
