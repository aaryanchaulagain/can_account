@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<h1 class="text-2xl font-semibold text-navy-900 mb-8">My Profile</h1>

<div class="grid lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-navy-900 mb-4">Account Details</h2>
        <dl class="space-y-3 text-sm">
            <div><dt class="text-slate-500">Name</dt><dd class="font-medium text-navy-900">{{ $user->name }}</dd></div>
            <div><dt class="text-slate-500">Email</dt><dd class="font-medium text-navy-900">{{ $user->email }}</dd></div>
            <div><dt class="text-slate-500">Role</dt><dd class="font-medium text-gold-600">{{ $user->role?->name ?? '—' }}</dd></div>
            <div><dt class="text-slate-500">Status</dt><dd class="font-medium">{{ $user->is_active ? 'Active' : 'Inactive' }}</dd></div>
        </dl>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-navy-900 mb-4">Change Password</h2>
        <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1">Current password</label>
                <input type="password" name="current_password" required class="w-full rounded-lg border-slate-300">
                @error('current_password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">New password</label>
                <input type="password" name="password" required class="w-full rounded-lg border-slate-300">
                @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Confirm new password</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-lg border-slate-300">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800">Update Password</button>
        </form>
    </div>
</div>
@endsection
