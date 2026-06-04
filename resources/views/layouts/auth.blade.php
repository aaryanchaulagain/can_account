<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}?v=7">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon.png') }}?v=7">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}?v=7">
    <title>@yield('title', 'Admin Login') | Canberra Accountants</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-navy-950 font-sans antialiased">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <div class="hidden lg:flex lg:w-1/2 flex-col justify-center px-16 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-navy-900 to-navy-950"></div>
            <div class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200&q=80')] bg-cover bg-center"></div>
            <div class="relative z-10">
                <p class="text-gold-400 text-sm font-medium tracking-widest uppercase mb-4">Administration</p>
                <h1 class="font-serif text-4xl leading-tight">Canberra Accountants</h1>
                <p class="mt-4 text-slate-300 max-w-md">Secure content management for your corporate website.</p>
            </div>
        </div>
        <div class="flex-1 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                @yield('content')
                <p class="mt-8 text-center text-xs text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-gold-400 transition">← Back to website</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
