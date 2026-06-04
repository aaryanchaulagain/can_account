@extends('layouts.admin')

@section('title', 'Companies')

@section('content')
@include('admin.partials.resource-index', ['title' => 'Companies', 'createRoute' => route('admin.companies.create')])

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-navy-900">Name</th>
                <th class="px-4 py-3 text-right font-semibold text-navy-900">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
            <tr class="border-t border-slate-100">
                <td class="px-4 py-3 font-medium text-navy-900">{{ $company->name }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.companies.edit', $company) }}" class="text-gold-600 hover:text-gold-500 font-medium">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="px-4 py-8 text-center text-slate-500">No companies yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $companies->links() }}</div>
@endsection
