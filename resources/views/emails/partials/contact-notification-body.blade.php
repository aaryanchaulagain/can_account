<p style="margin:0 0 18px;font-size:15px;color:#334155;">Hello,</p>

<p style="margin:0 0 18px;font-size:15px;color:#334155;">
    A new <strong style="color:#071A3A;">consultation request</strong> was submitted on the website
    (<strong style="color:#0F766E;">reference {{ $ref }}</strong>).
    Please review the details below.
</p>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px;border:1px solid #e2e8f0;border-radius:10px;background-color:#f8fafc;">
    <tr>
        <td style="padding:18px 22px;">
            <p style="margin:0 0 12px;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Name:</strong> {{ $submission->name }}
            </p>
            <p style="margin:0 0 12px;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Email:</strong>
                <a href="mailto:{{ $submission->email }}" style="color:#0F766E;text-decoration:none;">{{ $submission->email }}</a>
            </p>
            <p style="margin:0 0 12px;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Phone:</strong> {{ $submission->phone ?? 'Not provided' }}
            </p>
            <p style="margin:0 0 12px;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Company:</strong> {{ $submission->company ?? 'Not provided' }}
            </p>
            <p style="margin:0 0 12px;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Service:</strong> {{ $submission->service_interested ?? 'Not specified' }}
            </p>
            <p style="margin:0;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Submitted:</strong> {{ $submittedAt }}
            </p>
        </td>
    </tr>
</table>

@if($submission->message)
<p style="margin:0 0 8px;font-size:14px;font-weight:700;color:#071A3A;">Message</p>
<p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;white-space:pre-wrap;">{{ $submission->message }}</p>
@endif

<table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 0 24px;">
    <tr>
        <td style="border-radius:8px;background:linear-gradient(135deg,#071A3A,#0F766E);">
            <a href="{{ $adminUrl }}" style="display:inline-block;padding:14px 28px;font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;">
                Review in Admin Panel
            </a>
        </td>
    </tr>
</table>

<p style="margin:0 0 8px;font-size:14px;color:#334155;">
    Reply to this email to contact the client directly at
    <a href="mailto:{{ $submission->email }}" style="color:#0F766E;font-weight:600;text-decoration:none;">{{ $submission->email }}</a>.
</p>

<p style="margin:0;font-size:15px;font-weight:700;color:#071A3A;">Canberra Accountants — Admin</p>
