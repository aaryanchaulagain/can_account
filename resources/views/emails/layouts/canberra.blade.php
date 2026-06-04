@php
    $brandName = config('mail.from.name', 'Canberra Accountants');
    $sitePhone = \App\Models\SiteSetting::get('phone', '(02) 6190 6075');
    $siteEmail = \App\Models\SiteSetting::get('email', config('mail.from.address', 'info@canberraaccountants.com.au'));
    $logoPath = public_path('images/logo.png');
    $hasLogo = isset($message) && file_exists($logoPath);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailTitle ?? $brandName }}</title>
</head>
<body style="margin:0;padding:0;background-color:#e8eef4;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#e8eef4;padding:32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 8px 30px rgba(7,26,58,0.12);">
                {{-- Header --}}
                <tr>
                    <td style="background:linear-gradient(135deg,#071A3A 0%,#0c2552 45%,#0F766E 100%);padding:28px 36px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-bottom:20px;">
                                    @if($hasLogo)
                                    <img
                                        src="{{ $message->embed($logoPath) }}"
                                        alt="{{ $brandName }}"
                                        width="160"
                                        style="display:block;max-height:56px;max-width:160px;width:auto;height:auto;border:0;"
                                    >
                                    @else
                                    <span style="font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#a3e635;">{{ $brandName }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h1 style="margin:0;font-size:26px;line-height:1.25;font-weight:700;color:#ffffff;letter-spacing:-0.02em;">
                                        {{ $headline }}
                                    </h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Body --}}
                <tr>
                    <td style="padding:36px 36px 28px;color:#334155;font-size:15px;line-height:1.65;">
                        {!! $body !!}
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding:22px 36px 28px;background-color:#f8fafc;border-top:1px solid #e2e8f0;">
                        <p style="margin:0 0 8px;font-size:12px;line-height:1.55;color:#94a3b8;text-align:center;">
                            {{ $footerNote ?? 'This is a transactional message about your website enquiry. You are receiving it because you submitted our contact form.' }}
                        </p>
                        <p style="margin:0;font-size:12px;line-height:1.55;color:#94a3b8;text-align:center;">
                            &copy; {{ date('Y') }} {{ $brandName }}. All rights reserved.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
