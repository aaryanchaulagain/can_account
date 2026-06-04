@extends('layouts.admin')

@section('title', $submission->adminListLabel())

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-4">
    <a href="{{ $submission->adminListUrl() }}" class="text-sm text-gold-600 hover:text-gold-500 font-medium">← Back to {{ $submission->adminListLabel() }}</a>

    <div class="flex flex-wrap items-center gap-3 relative z-20 pointer-events-auto">
        @if(!$submission->isApproved())
        <form action="{{ route('admin.contacts.approve', $submission) }}" method="POST" class="inline-flex m-0 p-0">
            @csrf
            <button type="submit" class="admin-btn-approve px-6 py-2.5 text-sm">Approve &amp; Email Client</button>
        </form>
        @else
        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-100 text-green-800 text-sm font-semibold rounded-lg">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Approved {{ $submission->approved_at?->format('d M Y') }}
        </span>
        @endif
        <form action="{{ route('admin.contacts.destroy', $submission) }}" method="POST" class="inline-flex m-0 p-0" onsubmit="return confirm('Delete this submission permanently?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn-delete px-6 py-2.5 text-sm">Delete</button>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl relative z-10">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4 bg-slate-50">
        <div>
            <p class="text-xs font-semibold text-teal-700 uppercase tracking-wide mb-1">{{ $submission->formTypeLabel() }}</p>
            <h1 class="text-xl font-semibold text-navy-900">{{ $submission->name }}</h1>
            <p class="text-sm text-slate-500 mt-1">Submitted {{ $submission->created_at->format('d F Y \a\t g:i A') }}</p>
        </div>
        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $submission->statusColor() }}">
            {{ $submission->statusLabel() }}
        </span>
    </div>

    <div class="p-6 space-y-8">
        {{-- Contact details --}}
        <div>
            <h2 class="text-sm font-bold text-navy-900 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100">Contact Details</h2>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Name</p>
                    <p class="text-navy-900 font-medium">{{ $submission->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Email</p>
                    <a href="mailto:{{ $submission->email }}" class="text-gold-600 hover:underline">{{ $submission->email }}</a>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Phone</p>
                    <p class="text-navy-900">{{ $submission->phone ?? '—' }}</p>
                </div>
                @if($submission->form_type === 'contact')
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Company</p>
                    <p class="text-navy-900">{{ $submission->company ?? '—' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Service Interested In</p>
                    <p class="text-navy-900">{{ $submission->service_interested ?? '—' }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($submission->form_type === 'tax_return' && !empty($submission->form_data))
        <div>
            <h2 class="text-sm font-bold text-navy-900 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100">Tax Return Information</h2>
            <div class="grid sm:grid-cols-2 gap-5">
                @foreach([
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'gender' => 'Gender',
                    'tfn' => 'TFN',
                    'date_of_birth' => 'Date of Birth',
                    'abn' => 'ABN',
                    'bsb' => 'BSB',
                    'account_number' => 'Account Number',
                    'street_address' => 'Street Address',
                    'suburb' => 'Suburb',
                    'state' => 'State',
                    'post_code' => 'Post Code',
                    'has_spouse' => 'Has Spouse',
                    'number_of_children' => 'Number of Children',
                ] as $key => $label)
                    @if(isset($submission->form_data[$key]) && $submission->form_data[$key] !== '' && $submission->form_data[$key] !== null)
                    <div class="{{ in_array($key, ['street_address']) ? 'sm:col-span-2' : '' }}">
                        <p class="text-xs font-semibold text-slate-500 uppercase mb-1">{{ $label }}</p>
                        <p class="text-navy-900">{{ $submission->form_data[$key] }}</p>
                    </div>
                    @endif
                @endforeach
                @if(!empty($submission->form_data['id_document']))
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">ID Document</p>
                    <a href="{{ asset('storage/'.$submission->form_data['id_document']) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 text-teal-800 rounded-lg border border-teal-200 hover:bg-teal-100 text-sm font-medium">
                        View uploaded document →
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        @if($submission->form_type === 'business')
        <div>
            <h2 class="text-sm font-bold text-navy-900 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100">Business Information</h2>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Business Name</p>
                    <p class="text-navy-900">{{ $submission->company ?? $submission->form_data['business_name'] ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">ABN</p>
                    <p class="text-navy-900">{{ $submission->form_data['abn'] ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Business Structure</p>
                    <p class="text-navy-900">{{ $submission->form_data['business_structure'] ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Service Required</p>
                    <p class="text-navy-900">{{ $submission->service_interested ?? $submission->form_data['service_type'] ?? '—' }}</p>
                </div>
            </div>
        </div>
        @endif

        @if($submission->form_type === 'contact' && !empty($submission->form_data))
        <div>
            <h2 class="text-sm font-bold text-navy-900 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100">Additional Details</h2>
            <div class="p-4 bg-slate-50 rounded-lg space-y-2 text-sm text-slate-700">
                @foreach($submission->form_data as $key => $value)
                <p><span class="font-medium text-navy-900">{{ ucwords(str_replace('_', ' ', $key)) }}:</span> {{ is_bool($value) ? ($value ? 'Yes' : 'No') : ($value ?: '—') }}</p>
                @endforeach
            </div>
        </div>
        @endif

        @if($submission->message && $submission->message !== 'Tax return form submission')
        <div>
            <h2 class="text-sm font-bold text-navy-900 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100">Message</h2>
            <div class="p-4 bg-slate-50 rounded-lg text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $submission->message }}</div>
        </div>
        @endif
    </div>

    @if(!$submission->isApproved())
    <div class="px-6 py-4 border-t border-slate-100 bg-green-50 flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-green-800">Click <strong>Approve</strong> to confirm and send a confirmation email to the client.</p>
        <form action="{{ route('admin.contacts.approve', $submission) }}" method="POST" class="inline-flex m-0 p-0 relative z-20 pointer-events-auto">
            @csrf
            <button type="submit" class="admin-btn-approve px-6 py-2.5 text-sm">Approve &amp; Email Client</button>
        </form>
    </div>
    @endif
</div>
@endsection
