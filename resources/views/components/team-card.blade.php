<a href="{{ route('team.show', $member) }}" class="block bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition group">
    @if($member->photo_url)
        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-64 object-cover object-top" loading="lazy">
    @else
        <div class="w-full h-64 bg-navy-100 flex items-center justify-center font-serif text-4xl text-navy-700">{{ substr($member->name, 0, 1) }}</div>
    @endif
    <div class="p-6">
        <h3 class="font-semibold text-navy-900 group-hover:text-gold-600">{{ $member->name }}</h3>
        <p class="text-sm text-gold-600">{{ $member->designation }}</p>
    </div>
</a>
