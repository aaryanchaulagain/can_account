@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ $company->exists ? route('admin.companies.update', $company) : route('admin.companies.store') }}" enctype="multipart/form-data" class="bg-white p-8 rounded-xl max-w-2xl space-y-4">
    @csrf @if($company->exists) @method('PUT') @endif
    <input name="name" value="{{ old('name', $company->name) }}" required class="w-full rounded-lg border-slate-300">
    <textarea name="description" rows="5" class="w-full rounded-lg border-slate-300">{{ old('description', $company->description) }}</textarea>
    <textarea name="services" rows="3" class="w-full rounded-lg border-slate-300">{{ old('services', $company->services) }}</textarea>
    <input name="website_url" value="{{ old('website_url', $company->website_url) }}" class="w-full rounded-lg border-slate-300">
    <input type="file" name="logo"><input type="file" name="featured_image">
    <button class="px-6 py-2 bg-navy-900 text-white rounded-lg">Save</button>
</form>
@endsection
