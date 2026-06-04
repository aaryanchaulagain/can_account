@props(['title', 'createRoute' => null, 'createLabel' => 'Add New'])

<div class="flex justify-between items-center mb-8 relative z-10">
    <h1 class="text-2xl font-semibold text-navy-900">{{ $title }}</h1>
    @if($createRoute)
        <a href="{{ $createRoute }}" class="relative z-10 inline-flex items-center px-4 py-2 bg-navy-900 text-white text-sm font-semibold rounded-lg hover:bg-navy-800 cursor-pointer">{{ $createLabel }}</a>
    @endif
</div>
<div class="bg-white rounded-xl shadow-sm overflow-x-auto relative z-10">
    {{ $slot }}
</div>
