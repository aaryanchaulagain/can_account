@php
    $ref = '#'.str_pad((string) $submission->id, 5, '0', STR_PAD_LEFT);
    $submittedAt = $submission->created_at->timezone(config('app.timezone', 'Australia/Sydney'))->format('j M Y, g:i A T');
    $adminUrl = route('admin.contacts.show', $submission);
@endphp
@include('emails.layouts.canberra', [
    'emailTitle' => 'New consultation enquiry',
    'headline' => 'New consultation enquiry',
    'body' => view('emails.partials.contact-notification-body', compact('submission', 'ref', 'submittedAt', 'adminUrl'))->render(),
    'footerNote' => 'Internal notification from the Canberra Accountants website contact form.',
])
