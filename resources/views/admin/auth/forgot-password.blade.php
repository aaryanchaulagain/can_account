@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 sm:p-10">
    <h2 class="font-serif text-2xl text-navy-900 text-center mb-2">Reset Password</h2>
    <p class="text-sm text-slate-500 text-center mb-8">We'll email you a reset link</p>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-800 text-sm rounded-lg">{{ session('success') }}</div>
    @endif
    @error('email')<p class="text-red-600 text-sm mb-4">{{ $message }}</p>@enderror

    <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-navy-900 mb-1.5">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-slate-300">
        </div>
        <button type="submit" class="w-full py-3.5 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800">Send Reset Link</button>
    </form>
    <a href="{{ route('admin.login') }}" class="block text-center text-sm mt-6 text-slate-500 hover:text-navy-900">← Back to login</a>
</div>
@endsection
