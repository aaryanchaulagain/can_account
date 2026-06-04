@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-semibold text-navy-900">Admin Users</h1>
    <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-navy-900 text-white text-sm font-semibold rounded-lg hover:bg-navy-800">Add User</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Role</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3">{{ $user->role?->name }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-0.5 rounded text-xs {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-gold-600 hover:underline">Edit</a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $users->links() }}</div>
@endsection
