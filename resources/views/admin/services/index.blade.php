@extends('layouts.admin')

@section('title', 'Services')

@section('content')
@include('admin.partials.resource-index', ['title' => 'Services', 'createRoute' => route('admin.services.create')])

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-navy-900">Title</th>
                <th class="px-4 py-3 text-right font-semibold text-navy-900">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr class="border-t border-slate-100">
                <td class="px-4 py-3 font-medium text-navy-900">{{ $service->title }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.services.edit', $service) }}" class="text-gold-600 hover:text-gold-500 font-medium">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="px-4 py-8 text-center text-slate-500">No services yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $services->links() }}</div>
@endsection
