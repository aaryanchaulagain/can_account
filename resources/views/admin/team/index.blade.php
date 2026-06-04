@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
<x-admin.panel title="Team Members" :create-route="route('admin.team.create')" create-label="Add Member">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left w-16">Photo</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Designation</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
            <tr class="border-t">
                <td class="px-4 py-3">
                    @if($member->photo_url)
                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-xs text-slate-500 font-medium">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </div>
                    @endif
                </td>
                <td class="px-4 py-3 font-medium">{{ $member->name }}</td>
                <td class="px-4 py-3">{{ $member->designation }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-0.5 rounded text-xs {{ $member->is_published ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-600' }}">
                        {{ $member->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.team.edit', $member) }}" class="admin-btn-view text-xs">Edit</a>
                        <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline-flex m-0 p-0" onsubmit="return confirm('Delete {{ $member->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-slate-500">No team members yet. <a href="{{ route('admin.team.create') }}" class="text-gold-600 hover:underline">Add one</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-admin.panel>
<div class="mt-6 relative z-10">{{ $members->links() }}</div>
@endsection
