@php
    $requestType = $data['request_type'] ?? 'information';
    $sourcePage = $data['source_page'] ?? 'Website';
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New {{ $requestType }} request</title>
</head>
<body style="margin:0;background:#05080d;color:#f6fbff;font-family:Inter,Arial,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#05080d;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:680px;overflow:hidden;border:1px solid rgba(255,255,255,.12);border-radius:28px;background:#071016;">
                    <tr>
                        <td style="padding:34px 34px 28px;background:linear-gradient(135deg,#061018 0%,#0e2630 55%,#111827 100%);">
                            <div style="display:inline-block;border:1px solid rgba(34,211,238,.35);border-radius:999px;padding:7px 12px;color:#22d3ee;font-size:11px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;">
                                FieldPro Motor Gallery
                            </div>
                            <h1 style="margin:20px 0 0;color:#ffffff;font-size:32px;line-height:1.1;font-weight:900;">
                                New {{ $requestType }} request
                            </h1>
                            <p style="margin:12px 0 0;color:rgba(246,251,255,.65);font-size:15px;line-height:1.7;">
                                A visitor submitted a request from the {{ $sourcePage }} page.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 34px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding:14px 16px;border:1px solid rgba(255,255,255,.1);border-radius:18px;background:rgba(255,255,255,.05);">
                                        <p style="margin:0;color:#f59e0b;font-size:11px;font-weight:900;letter-spacing:.16em;text-transform:uppercase;">Customer</p>
                                        <h2 style="margin:8px 0 0;color:#ffffff;font-size:22px;">{{ $data['full_name'] }}</h2>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top:18px;">
                                <tr>
                                    <td style="padding:14px 0;color:rgba(246,251,255,.55);font-size:12px;font-weight:900;letter-spacing:.14em;text-transform:uppercase;">Phone</td>
                                    <td align="right" style="padding:14px 0;color:#ffffff;font-size:15px;">{{ $data['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top:1px solid rgba(255,255,255,.1);padding:14px 0;color:rgba(246,251,255,.55);font-size:12px;font-weight:900;letter-spacing:.14em;text-transform:uppercase;">Email</td>
                                    <td align="right" style="border-top:1px solid rgba(255,255,255,.1);padding:14px 0;color:#22d3ee;font-size:15px;">{{ $data['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top:1px solid rgba(255,255,255,.1);padding:14px 0;color:rgba(246,251,255,.55);font-size:12px;font-weight:900;letter-spacing:.14em;text-transform:uppercase;">Preferred Time</td>
                                    <td align="right" style="border-top:1px solid rgba(255,255,255,.1);padding:14px 0;color:#ffffff;font-size:15px;">{{ $data['preferred_contact_time'] ?: 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top:1px solid rgba(255,255,255,.1);padding:14px 0;color:rgba(246,251,255,.55);font-size:12px;font-weight:900;letter-spacing:.14em;text-transform:uppercase;">Source Page</td>
                                    <td align="right" style="border-top:1px solid rgba(255,255,255,.1);padding:14px 0;color:#ffffff;font-size:15px;">{{ $sourcePage }}</td>
                                </tr>
                            </table>

                            <div style="margin-top:24px;border-left:4px solid #22d3ee;border-radius:18px;background:rgba(34,211,238,.08);padding:20px;">
                                <p style="margin:0 0 10px;color:#22d3ee;font-size:12px;font-weight:900;letter-spacing:.16em;text-transform:uppercase;">Message</p>
                                <div style="color:rgba(246,251,255,.82);font-size:15px;line-height:1.75;">{!! nl2br(e($data['message'])) !!}</div>
                            </div>

                            <p style="margin:28px 0 0;color:rgba(246,251,255,.45);font-size:12px;line-height:1.6;">
                                Reply directly to this email to contact {{ $data['full_name'] }}.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
