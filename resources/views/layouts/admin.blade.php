<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}?v=7">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon.png') }}?v=7">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}?v=7">
    <title>@yield('title', 'Admin') | Canberra Accountants</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen font-sans antialiased">
    <div class="flex min-h-screen">
        <aside class="relative z-50 w-64 min-h-screen bg-navy-950 text-slate-300 shrink-0 flex flex-col pointer-events-auto">
            <div class="p-5 border-b border-navy-800">
                <a href="{{ route('admin.dashboard') }}" class="block hover:opacity-90 transition" aria-label="Dashboard">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Canberra Accountants"
                        class="h-14 w-auto max-w-full object-contain mx-auto"
                        width="180"
                        height="56"
                    >
                </a>
            </div>
            <nav class="p-4 space-y-1 text-sm flex-1 relative z-10">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'pattern' => 'admin.dashboard', 'badge' => null],
                        ['route' => 'admin.articles.index', 'label' => 'Insights', 'pattern' => 'admin.articles.*', 'badge' => null],
                        ['route' => 'admin.team.index', 'label' => 'Team Members', 'pattern' => 'admin.team.*', 'badge' => null],
                        ['route' => 'admin.companies.index', 'label' => 'Companies', 'pattern' => 'admin.companies.*', 'badge' => null],
                        ['route' => 'admin.services.index', 'label' => 'Services', 'pattern' => 'admin.services.*', 'badge' => null],
                        ['route' => 'admin.contacts.index', 'label' => 'Contact Messages', 'pattern' => 'admin.contacts.*', 'badge' => 'contact'],
                        ['route' => 'admin.tax-returns.index', 'label' => 'Tax Return Forms', 'pattern' => 'admin.tax-returns.*', 'badge' => 'tax_return'],
                        ['route' => 'admin.business-forms.index', 'label' => 'Business Forms', 'pattern' => 'admin.business-forms.*', 'badge' => 'business'],
                        ['route' => 'admin.settings.index', 'label' => 'Site Settings', 'pattern' => 'admin.settings.*', 'badge' => null],
                    ];
                @endphp
                @foreach($navItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="relative z-10 flex items-center justify-between px-3 py-2.5 rounded cursor-pointer pointer-events-auto hover:bg-navy-800 hover:text-white transition {{ (isset($adminNavOverride) ? $item['pattern'] === $adminNavOverride : request()->routeIs($item['pattern'])) ? 'bg-navy-800 text-white' : '' }}"
                >
                    <span>{{ $item['label'] }}</span>
                    @if($item['badge'])
                        @php $badgeCount = \App\Models\ContactSubmission::where('form_type', $item['badge'])->where('status', 'new')->count(); @endphp
                        @if($badgeCount > 0)
                            <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-gold-500 text-navy-950">{{ $badgeCount }}</span>
                        @endif
                    @endif
                </a>
                @endforeach
                @if(auth()->user()->hasRole(\App\Enums\UserRole::SuperAdmin))
                <a
                    href="{{ route('admin.users.index') }}"
                    class="relative z-10 block px-3 py-2.5 rounded cursor-pointer pointer-events-auto hover:bg-navy-800 hover:text-white transition {{ request()->routeIs('admin.users.*') ? 'bg-navy-800 text-white' : '' }}"
                >Admin Users</a>
                @endif
            </nav>
            <div class="relative z-10 p-4 border-t border-navy-800 pointer-events-auto">
                <div class="px-3 py-2 text-xs text-slate-500">
                    <p class="text-white font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="truncate">{{ auth()->user()->role?->name }}</p>
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="block px-3 py-2 text-sm rounded hover:bg-navy-800 mt-1 cursor-pointer">My Profile</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-1">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-slate-400 hover:text-white rounded hover:bg-navy-800 cursor-pointer">Logout</button>
                </form>
            </div>
        </aside>
        <div class="relative z-0 flex-1 flex flex-col min-w-0">
            <header class="relative z-10 bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between shrink-0">
                <h2 class="text-sm font-medium text-slate-500">@yield('title', 'Dashboard')</h2>
                <a href="{{ route('home') }}" target="_blank" class="text-sm text-gold-600 hover:text-gold-500 cursor-pointer">View website →</a>
            </header>
            <main class="relative z-0 flex-1 p-8 overflow-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg relative z-10">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg relative z-10">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
