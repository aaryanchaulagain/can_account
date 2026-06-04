@props(['seo' => []])

@php
    $title = $seo['title'] ?? config('app.name');
    $description = $seo['description'] ?? '';
    $canonical = $seo['canonical'] ?? url()->current();
    $og = $seo['og'] ?? [];
    $twitter = $seo['twitter'] ?? [];
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:title" content="{{ $og['title'] ?? $title }}">
<meta property="og:description" content="{{ $og['description'] ?? $description }}">
<meta property="og:image" content="{{ $og['image'] ?? '' }}">
<meta property="og:url" content="{{ $og['url'] ?? $canonical }}">
<meta property="og:type" content="{{ $og['type'] ?? 'website' }}">
<meta property="og:site_name" content="{{ $og['site_name'] ?? config('app.name') }}">

<meta name="twitter:card" content="{{ $twitter['card'] ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $twitter['title'] ?? $title }}">
<meta name="twitter:description" content="{{ $twitter['description'] ?? $description }}">
<meta name="twitter:image" content="{{ $twitter['image'] ?? ($og['image'] ?? '') }}">

@if(!empty($schema))
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endif
