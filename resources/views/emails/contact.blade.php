<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Consultation Request</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #0a3161 0%, #b31942 100%);
            padding: 35px 40px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .header p {
            color: rgba(255, 255, 255, 0.85);
            margin: 8px 0 0 0;
            font-size: 14px;
            font-weight: 500;
        }
        .content {
            padding: 40px;
        }
        .section-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #b31942;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            padding-bottom: 8px;
        }
        .field-group {
            margin-bottom: 24px;
        }
        .field-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
        }
        .field-value {
            font-size: 15px;
            color: #0f172a;
            line-height: 1.5;
        }
        .message-box {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 20px;
            font-size: 14px;
            color: #334155;
            line-height: 1.6;
            border-left: 4px solid #b31942;
        }
        .footer {
            background-color: #f8fafc;
            padding: 25px 40px;
            text-align: center;
            border-top: 1px solid rgba(15, 23, 42, 0.05);
            font-size: 12px;
            color: #94a3b8;
        }
        .footer a {
            color: #0a3161;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Consultation Inquiry</h1>
            <p>A new visitor has submitted a request on your website.</p>
        </div>
        <div class="content">
            <div class="section-title">Lead Information</div>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; padding-right: 15px; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Full Name</div>
                            <div class="field-value" style="font-weight: 600;">{{ $contactRequest->name }}</div>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Email Address</div>
                            <div class="field-value">
                                <a href="mailto:{{ $contactRequest->email }}" style="color: #b31942; text-decoration: none;">
                                    {{ $contactRequest->email }}
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 15px; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Phone Number</div>
                            <div class="field-value">{{ $contactRequest->phone ?? 'Not provided' }}</div>
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Company</div>
                            <div class="field-value">{{ $contactRequest->company ?? 'Not provided' }}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 15px; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Service Requested</div>
                            <div class="field-value" style="font-weight: 500; color: #0a3161;">
                                {{ $contactRequest->service_requested ?? 'General Consulting' }}
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Requested Time</div>
                            <div class="field-value">
                                @if($contactRequest->appointment_time)
                                    {{ $contactRequest->appointment_time->format('F d, Y \a\t h:i A') }}
                                @else
                                    Not requested
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            @if($contactRequest->message)
                <div class="section-title" style="margin-top: 15px;">Message Details</div>
                <div class="field-group">
                    <div class="message-box">
                        {!! nl2br(e($contactRequest->message)) !!}
                    </div>
                </div>
            @endif

            @if($contactRequest->notes)
                <div class="section-title" style="margin-top: 15px;">Additional Notes</div>
                <div class="field-group">
                    <div class="field-value" style="font-style: italic; color: #64748b;">
                        {{ $contactRequest->notes }}
                    </div>
                </div>
            @endif
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} <a href="https://www.peshalb.com.np">Peshal Bhattarai</a>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
