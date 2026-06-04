@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data" class="bg-white p-8 rounded-xl max-w-3xl space-y-4">
    @csrf @if($service->exists) @method('PUT') @endif
    <input name="title" value="{{ old('title', $service->title) }}" required placeholder="Title" class="w-full rounded-lg border-slate-300">
    <textarea name="short_description" rows="2" placeholder="Short description" class="w-full rounded-lg border-slate-300">{{ old('short_description', $service->short_description) }}</textarea>
    <textarea name="overview" rows="6" placeholder="Overview" class="w-full rounded-lg border-slate-300">{{ old('overview', $service->overview) }}</textarea>
    <textarea name="benefits" rows="4" placeholder='Benefits JSON [{"title":"","description":""}]' class="w-full rounded-lg border-slate-300 font-mono text-xs">{{ old('benefits', json_encode($service->benefits ?? [])) }}</textarea>
    <textarea name="process_steps" rows="4" placeholder='Process JSON' class="w-full rounded-lg border-slate-300 font-mono text-xs">{{ old('process_steps', json_encode($service->process_steps ?? [])) }}</textarea>
    <textarea name="faqs" rows="4" placeholder='FAQs JSON' class="w-full rounded-lg border-slate-300 font-mono text-xs">{{ old('faqs', json_encode($service->faqs ?? [])) }}</textarea>
    <input type="file" name="hero_image">
    <label><input type="checkbox" name="is_published" value="1" @checked($service->is_published ?? true)> Published</label>
    <button class="px-6 py-2 bg-navy-900 text-white rounded-lg">Save</button>
</form>
@endsection
