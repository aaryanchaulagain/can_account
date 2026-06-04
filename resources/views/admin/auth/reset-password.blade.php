@extends('layouts.auth')

@section('title', 'New Password')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8 sm:p-10">
    <h2 class="font-serif text-2xl text-navy-900 text-center mb-8">Set New Password</h2>

    <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label class="block text-sm font-medium mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" required class="w-full rounded-lg border-slate-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1.5">New password</label>
            <input type="password" name="password" required class="w-full rounded-lg border-slate-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1.5">Confirm password</label>
            <input type="password" name="password_confirmation" required class="w-full rounded-lg border-slate-300">
        </div>
        @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        <button type="submit" class="w-full py-3.5 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800">Reset Password</button>
    </form>
</div>
@endsection
