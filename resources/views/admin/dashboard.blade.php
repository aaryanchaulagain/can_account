@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-semibold text-navy-900 mb-8">Dashboard</h1>

@php
    $statLinks = [
        'articles' => ['label' => 'Insights', 'route' => route('admin.articles.index')],
        'team_members' => ['label' => 'Team Members', 'route' => route('admin.team.index')],
        'companies' => ['label' => 'Companies', 'route' => route('admin.companies.index')],
        'services' => ['label' => 'Services', 'route' => route('admin.services.index')],
        'contacts' => ['label' => 'New Contacts', 'route' => route('admin.contacts.index')],
        'tax_returns' => ['label' => 'Tax Return Forms', 'route' => route('admin.tax-returns.index')],
        'business_forms' => ['label' => 'Business Forms', 'route' => route('admin.business-forms.index')],
    ];
@endphp

<div class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7 gap-4 mb-12">
    @foreach($statLinks as $key => $link)
    <a
        href="{{ $link['route'] }}"
        class="relative z-10 block bg-white p-6 rounded-xl shadow-sm border border-transparent hover:border-gold-500/40 hover:shadow-md transition cursor-pointer group"
    >
        <p class="text-sm text-slate-500 group-hover:text-gold-600 transition">{{ $link['label'] }}</p>
        <p class="text-3xl font-bold text-navy-900 mt-1">{{ $stats[$key] }}</p>
        <span class="inline-block mt-3 text-xs font-medium text-gold-600 opacity-0 group-hover:opacity-100 transition">Manage →</span>
    </a>
    @endforeach
</div>

<h2 class="text-lg font-semibold text-navy-900 mb-4">Recent Contact Submissions</h2>
<div class="bg-white rounded-xl shadow-sm overflow-x-auto relative z-10">
    <table class="w-full text-sm min-w-[640px]">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-navy-900">Type</th>
                <th class="px-4 py-3 text-left font-semibold text-navy-900">Name</th>
                <th class="px-4 py-3 text-left font-semibold text-navy-900">Email</th>
                <th class="px-4 py-3 text-left font-semibold text-navy-900">Date</th>
                <th class="px-4 py-3 text-right font-semibold text-navy-900 min-w-[200px]">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentContacts as $contact)
            <tr class="border-t border-slate-100">
                <td class="px-4 py-3 text-xs font-medium text-teal-700">{{ $contact->formTypeLabel() }}</td>
                <td class="px-4 py-3 font-medium text-navy-900">{{ $contact->name }}</td>
                <td class="px-4 py-3">{{ $contact->email }}</td>
                <td class="px-4 py-3 text-slate-500">{{ $contact->created_at->diffForHumans() }}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end gap-2 relative z-20 pointer-events-auto">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="admin-btn-view">View</a>
                        @if(!$contact->isApproved())
                        <form action="{{ route('admin.contacts.approve', $contact) }}" method="POST" class="inline-flex m-0 p-0">
                            @csrf
                            <button type="submit" class="admin-btn-approve">Approve</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline-flex m-0 p-0" onsubmit="return confirm('Delete this message permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-6 text-slate-500">No submissions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<p class="mt-3 text-sm flex flex-wrap gap-4">
    <a href="{{ route('admin.contacts.index') }}" class="text-gold-600 hover:text-gold-500 font-medium">Contact messages →</a>
    <a href="{{ route('admin.tax-returns.index') }}" class="text-gold-600 hover:text-gold-500 font-medium">Tax return forms →</a>
    <a href="{{ route('admin.business-forms.index') }}" class="text-gold-600 hover:text-gold-500 font-medium">Business forms →</a>
</p>
@endsection
