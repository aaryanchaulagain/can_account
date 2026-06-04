@extends('layouts.admin')
@section('content')
<h1 class="text-2xl font-semibold mb-8">Site Settings</h1>
<form method="POST" action="{{ route('admin.settings.update') }}" class="bg-white p-8 rounded-xl max-w-2xl space-y-4">
    @csrf @method('PUT')
    @php $defaults = ['site_name','phone','email','website_url','abn','crn','tax_agent','seo_default_title','seo_default_description','facebook','linkedin','instagram']; @endphp
    @foreach($defaults as $key)
    <div>
        <label class="block text-sm font-medium mb-1">{{ str_replace('_', ' ', ucfirst($key)) }}</label>
        <input name="settings[{{ $key }}]" value="{{ $siteSettings[$key] ?? '' }}" class="w-full rounded-lg border-slate-300">
    </div>
    @endforeach
    <button class="px-6 py-2 bg-navy-900 text-white rounded-lg">Save Settings</button>
</form>
@endsection
