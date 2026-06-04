@extends('layouts.admin')

@section('title', $user->exists ? 'Edit User' : 'New User')

@section('content')
<h1 class="text-2xl font-semibold text-navy-900 mb-8">@yield('title')</h1>

<form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="bg-white rounded-xl shadow-sm p-8 max-w-lg space-y-4">
    @csrf
    @if($user->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border-slate-300">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border-slate-300">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Role</label>
        <select name="role_id" required class="w-full rounded-lg border-slate-300">
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">{{ $user->exists ? 'New password (leave blank to keep)' : 'Password' }}</label>
        <input type="password" name="password" {{ $user->exists ? '' : 'required' }} class="w-full rounded-lg border-slate-300">
        @if($user->exists)
            <input type="password" name="password_confirmation" placeholder="Confirm password" class="w-full rounded-lg border-slate-300 mt-2">
        @else
            <input type="password" name="password_confirmation" required placeholder="Confirm password" class="w-full rounded-lg border-slate-300 mt-2">
        @endif
    </div>
    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true))>
        Active account
    </label>
    <button type="submit" class="px-6 py-2.5 bg-navy-900 text-white font-semibold rounded-lg">Save User</button>
</form>
@endsection
