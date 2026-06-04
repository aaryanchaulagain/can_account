@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 sm:p-10" x-data="{ showPassword: false }">
    <div class="text-center mb-8">
        <h2 class="font-serif text-2xl text-navy-900">Sign in to Admin</h2>
        <p class="text-sm text-slate-500 mt-2">Enter your credentials to access the dashboard</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg">{{ session('error') }}</div>
    @endif
    @if(session('status'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-800 text-sm rounded-lg">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-navy-900 mb-1.5">Email address</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500 @error('email') border-red-500 @enderror"
            >
            @error('email')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-navy-900 mb-1.5">Password</label>
            <div class="relative">
                <input
                    id="password"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-lg border-slate-300 focus:border-gold-500 focus:ring-gold-500 pr-10 @error('password') border-red-500 @enderror"
                >
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-navy-900 text-sm"
                    tabindex="-1"
                >
                    <span x-text="showPassword ? 'Hide' : 'Show'"></span>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-navy-900 focus:ring-gold-500" {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>
            <a href="{{ route('admin.password.request') }}" class="text-gold-600 hover:text-gold-500 font-medium">Forgot password?</a>
        </div>

        <button type="submit" class="w-full py-3.5 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800 transition focus:outline-none focus:ring-2 focus:ring-gold-500 focus:ring-offset-2">
            Sign In
        </button>
    </form>
</div>
@endsection
