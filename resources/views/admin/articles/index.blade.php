@extends('layouts.admin')

@section('title', 'Insights')

@section('content')
<x-admin.panel title="Insights" :create-route="route('admin.articles.create')" create-label="Add Insight">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left w-16">Image</th>
                <th class="px-4 py-3 text-left">Title</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
            <tr class="border-t">
                <td class="px-4 py-3">
                    @if($article->featured_image_url)
                        <img src="{{ $article->featured_image_url }}" alt="" class="w-12 h-12 rounded object-contain bg-slate-50">
                    @else
                        <div class="w-12 h-12 rounded bg-slate-100"></div>
                    @endif
                </td>
                <td class="px-4 py-3 font-medium">{{ $article->title }}</td>
                <td class="px-4 py-3 text-slate-500">{{ $article->published_at?->format('d M Y') ?? '—' }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-0.5 rounded text-xs {{ $article->is_published ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $article->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-gold-600 hover:underline cursor-pointer">Edit</a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Delete this insight?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline cursor-pointer">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-slate-500">No insights yet. <a href="{{ route('admin.articles.create') }}" class="text-gold-600 hover:underline">Create one</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-admin.panel>
<div class="mt-6 relative z-10">{{ $articles->links() }}</div>
@endsection
