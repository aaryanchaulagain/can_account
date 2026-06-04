<p style="margin:0 0 18px;font-size:15px;color:#334155;">Dear {{ $submission->name }},</p>

<p style="margin:0 0 18px;font-size:15px;color:#334155;">
    Thank you for contacting <strong style="color:#071A3A;">Canberra Accountants</strong>.
    This email confirms that we have received and acknowledged your enquiry
    (<strong style="color:#0F766E;">reference {{ $ref }}</strong>).
</p>

<p style="margin:0 0 24px;font-size:15px;color:#334155;">
    A member of our team will review your message and respond using the contact details you provided.
    You do not need to resubmit the form.
</p>

@if($submission->service_interested)
<p style="margin:0 0 24px;font-size:15px;color:#334155;">
    <strong style="color:#071A3A;">Service of interest:</strong> {{ $submission->service_interested }}
</p>
@endif

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 28px;border:1px solid #e2e8f0;border-radius:10px;background-color:#f8fafc;">
    <tr>
        <td style="padding:18px 22px;">
            <p style="margin:0 0 10px;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Submitted:</strong> {{ $submittedAt }}
            </p>
            <p style="margin:0;font-size:14px;color:#334155;">
                <strong style="color:#071A3A;">Acknowledged:</strong> {{ $acknowledgedAt }}
            </p>
        </td>
    </tr>
</table>

@if($submission->message)
<p style="margin:0 0 8px;font-size:14px;font-weight:700;color:#071A3A;">Your message</p>
<p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;white-space:pre-wrap;">{{ $submission->message }}</p>
@endif

<p style="margin:0 0 10px;font-size:15px;font-weight:700;color:#071A3A;">Questions?</p>
<p style="margin:0 0 8px;font-size:14px;color:#334155;">
    Reply to this email or write to
    <a href="mailto:{{ $siteEmail }}" style="color:#0F766E;font-weight:600;text-decoration:none;">{{ $siteEmail }}</a>
</p>
<p style="margin:0 0 28px;font-size:14px;color:#334155;">Phone: {{ $sitePhone }}</p>

<p style="margin:0 0 6px;font-size:15px;color:#334155;">Warm regards,</p>
<p style="margin:0;font-size:15px;font-weight:700;color:#071A3A;">The Canberra Accountants Team</p>
