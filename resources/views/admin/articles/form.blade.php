@extends('layouts.admin')

@section('title', $article->exists ? 'Edit Insight' : 'New Insight')

@section('content')
<div class="max-w-2xl relative z-10" x-data="insightForm()">
    <h1 class="text-2xl font-semibold text-navy-900 mb-6">@yield('title')</h1>

    <form
        method="POST"
        action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
        enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm p-6 sm:p-8 space-y-5"
    >
        @csrf
        @if($article->exists) @method('PUT') @endif

        <div>
            <label for="title" class="block text-sm font-medium text-navy-900 mb-1">Title <span class="text-red-500">*</span></label>
            <input
                id="title"
                type="text"
                name="title"
                x-model="title"
                @input="autoSlug"
                value="{{ old('title', $article->title) }}"
                required
                class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500"
            >
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-navy-900 mb-1">Slug</label>
            <input
                id="slug"
                type="text"
                name="slug"
                x-model="slug"
                @input="slugManual = true"
                value="{{ old('slug', $article->slug) }}"
                placeholder="auto-generated-from-title"
                class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500"
            >
            @error('slug')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-navy-900 mb-1">Content <span class="text-red-500">*</span></label>
            <textarea
                id="content"
                name="content"
                rows="10"
                required
                class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500"
                placeholder="Write your article content here. Basic HTML is supported."
            >{{ old('content', $article->content) }}</textarea>
            @error('content')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-navy-900 mb-2">Featured image</label>
            @if($article->featured_image_url)
                <div class="mb-3 bg-slate-100 rounded-lg p-3 flex items-center justify-center max-h-48">
                    <img src="{{ $article->featured_image_url }}" alt="" class="max-w-full max-h-44 w-auto h-auto object-contain rounded">
                </div>
            @endif
            <input
                type="file"
                name="featured_image"
                accept="image/jpeg,image/png,image/webp"
                @change="previewImage($event)"
                class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-navy-900 file:text-white file:cursor-pointer"
            >
            <img x-show="imagePreview" :src="imagePreview" alt="Preview" class="mt-3 w-full max-h-48 object-cover rounded-lg border border-slate-200">
            @error('featured_image')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="published_at" class="block text-sm font-medium text-navy-900 mb-1">Publish date</label>
            <input
                id="published_at"
                type="date"
                name="published_at"
                value="{{ old('published_at', $article->published_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500"
            >
            @error('published_at')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        @php
            $currentStatus = old('status', $article->exists ? ($article->is_published ? 'published' : 'draft') : 'published');
        @endphp
        <div>
            <label class="block text-sm font-medium text-navy-900 mb-2">Status</label>
            <p class="text-xs text-slate-500 mb-2">Only <strong>Published</strong> insights appear on the website.</p>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="status" value="draft" @checked($currentStatus === 'draft') class="text-navy-900 focus:ring-gold-500">
                    <span class="text-sm">Draft</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="status" value="published" @checked($currentStatus === 'published') class="text-navy-900 focus:ring-gold-500">
                    <span class="text-sm">Published</span>
                </label>
            </div>
            @error('status')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="pt-2 flex gap-3">
            <button type="submit" class="px-8 py-3 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800 cursor-pointer">
                {{ $article->exists ? 'Update' : 'Publish' }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a>
        </div>
    </form>
</div>

<script>
function insightForm() {
    return {
        title: @json(old('title', $article->title)),
        slug: @json(old('slug', $article->slug)),
        slugManual: false,
        imagePreview: null,
        autoSlug() {
            if (!this.slugManual && this.title) {
                this.slug = this.title.toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
            }
        },
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.imagePreview = URL.createObjectURL(file);
            }
        }
    };
}
</script>
@endsection
