@php
    $ref = '#'.str_pad((string) $submission->id, 5, '0', STR_PAD_LEFT);
    $submittedAt = $submission->created_at->timezone(config('app.timezone', 'Australia/Sydney'))->format('j M Y, g:i A T');
    $acknowledgedAt = ($submission->approved_at ?? now())->timezone(config('app.timezone', 'Australia/Sydney'))->format('j M Y, g:i A T');
    $sitePhone = \App\Models\SiteSetting::get('phone', '(02) 6190 6075');
    $siteEmail = \App\Models\SiteSetting::get('email', config('mail.from.address', 'info@canberraaccountants.com.au'));
@endphp
@include('emails.layouts.canberra', [
    'emailTitle' => 'Your enquiry has been received',
    'headline' => 'Your enquiry has been received',
    'body' => view('emails.partials.contact-approved-body', compact('submission', 'ref', 'submittedAt', 'acknowledgedAt', 'sitePhone', 'siteEmail'))->render(),
    'footerNote' => 'This is a transactional message about your website enquiry. You are receiving it because you submitted our contact form.',
])
