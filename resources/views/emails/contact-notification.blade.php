<x-mail::message>
# New Contact Form Enquiry

A new message was submitted on the Canberra Accountants website.

**Form Type:** {{ $submission->formTypeLabel() }}

**Name:** {{ $submission->name }}

**Email:** {{ $submission->email }}

**Phone:** {{ $submission->phone ?? 'N/A' }}

**Company:** {{ $submission->company ?? 'N/A' }}

**Service:** {{ $submission->service_interested ?? 'N/A' }}

@if(!empty($submission->form_data))
**Additional Details:**

@foreach($submission->form_data as $key => $value)
- {{ ucwords(str_replace('_', ' ', $key)) }}: {{ is_bool($value) ? ($value ? 'Yes' : 'No') : $value }}
@endforeach

@endif

**Message:**

{{ $submission->message }}

<x-mail::button :url="route('admin.contacts.show', $submission)">
View in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
