@extends('layouts.admin')

@section('title', $title ?? 'Contact Messages')

@section('content')
@php
    $pageTitle = $title ?? 'Contact Messages';
    $pageSubtitle = $subtitle ?? 'Manage enquiries from the website contact form';
    $listRoute = $routeName ?? 'admin.contacts.index';
    $type = $formType ?? 'contact';
@endphp

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-semibold text-navy-900">{{ $pageTitle }}</h1>
        <p class="text-sm text-slate-500 mt-1">{{ $pageSubtitle }}</p>
    </div>
    @if($type === 'contact')
    <div class="flex flex-wrap gap-2 text-sm">
        <a href="{{ route('admin.tax-returns.index') }}" class="px-3 py-1.5 rounded-lg bg-teal-50 text-teal-800 border border-teal-200 hover:bg-teal-100">Tax Returns →</a>
        <a href="{{ route('admin.business-forms.index') }}" class="px-3 py-1.5 rounded-lg bg-teal-50 text-teal-800 border border-teal-200 hover:bg-teal-100">Business Forms →</a>
    </div>
    @endif
</div>

<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl p-5 border border-slate-100 shadow-sm">
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total</p>
        <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-blue-100 shadow-sm">
        <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">New</p>
        <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['new'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-green-100 shadow-sm">
        <p class="text-xs font-medium text-green-600 uppercase tracking-wide">Approved</p>
        <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['approved'] }}</p>
    </div>
</div>

<div class="flex flex-wrap gap-2 mb-6">
    @foreach(['all' => 'See All', 'new' => 'New', 'read' => 'Read', 'approved' => 'Approved'] as $value => $label)
    <a
        href="{{ route($listRoute, ['status' => $value]) }}"
        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $filter === $value ? 'bg-navy-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}"
    >{{ $label }}</a>
    @endforeach
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 relative z-10">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Name</th>
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Email</th>
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Phone</th>
                    @if($type === 'tax_return')
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">TFN</th>
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">DOB</th>
                    @elseif($type === 'business')
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Business</th>
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Service</th>
                    @else
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Service</th>
                    @endif
                    <th class="px-4 py-3 text-left font-semibold text-navy-900">Date</th>
                    <th class="px-4 py-3 text-center font-semibold text-navy-900">Status</th>
                    <th class="px-4 py-3 text-right font-semibold text-navy-900 sticky right-0 bg-slate-50 shadow-[-4px_0_8px_-4px_rgba(0,0,0,0.1)] min-w-[260px]">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $submission)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50 {{ $submission->status === 'new' ? 'bg-blue-50/30' : '' }}">
                    <td class="px-4 py-4 font-medium text-navy-900">{{ $submission->name }}</td>
                    <td class="px-4 py-4">
                        <a href="mailto:{{ $submission->email }}" class="text-gold-600 hover:underline">{{ $submission->email }}</a>
                    </td>
                    <td class="px-4 py-4 text-slate-600">{{ $submission->phone ?? '—' }}</td>
                    @if($type === 'tax_return')
                    <td class="px-4 py-4 text-slate-600 font-mono text-xs">{{ $submission->form_data['tfn'] ?? '—' }}</td>
                    <td class="px-4 py-4 text-slate-600 whitespace-nowrap">{{ $submission->form_data['date_of_birth'] ?? '—' }}</td>
                    @elseif($type === 'business')
                    <td class="px-4 py-4 text-slate-600">{{ $submission->company ?? $submission->form_data['business_name'] ?? '—' }}</td>
                    <td class="px-4 py-4 text-slate-600 max-w-[140px] truncate" title="{{ $submission->service_interested }}">{{ $submission->service_interested ?? '—' }}</td>
                    @else
                    <td class="px-4 py-4 text-slate-600 max-w-[140px] truncate" title="{{ $submission->service_interested }}">{{ $submission->service_interested ?? '—' }}</td>
                    @endif
                    <td class="px-4 py-4 text-slate-500 whitespace-nowrap">{{ $submission->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-4 text-center">
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $submission->statusColor() }}">
                            {{ $submission->statusLabel() }}
                        </span>
                    </td>
                    <td class="px-4 py-4 sticky right-0 bg-white shadow-[-4px_0_8px_-4px_rgba(0,0,0,0.1)] {{ $submission->status === 'new' ? 'bg-blue-50/30' : '' }}">
                        <div class="flex items-center justify-end gap-2 flex-nowrap relative z-20 pointer-events-auto">
                            <a href="{{ route('admin.contacts.show', $submission) }}" class="admin-btn-view">View</a>
                            @if(!$submission->isApproved())
                            <form action="{{ route('admin.contacts.approve', $submission) }}" method="POST" class="inline-flex m-0 p-0">
                                @csrf
                                <button type="submit" class="admin-btn-approve">Approve</button>
                            </form>
                            @else
                            <span class="admin-btn-approve opacity-60 cursor-default">Approved</span>
                            @endif
                            <form action="{{ route('admin.contacts.destroy', $submission) }}" method="POST" class="inline-flex m-0 p-0" onsubmit="return confirm('Delete this submission permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $type === 'contact' ? 7 : 8 }}" class="px-4 py-12 text-center text-slate-500">No submissions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 relative z-10">{{ $submissions->links() }}</div>
@endsection
