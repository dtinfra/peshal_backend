<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Briefing Scheduled</title>
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
        .meet-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 20px;
            font-size: 14px;
            color: #166534;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .meet-link {
            display: inline-flex;
            align-items: center;
            color: #15803d;
            font-weight: 700;
            text-decoration: underline;
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
            <h1>Briefing Call Scheduled</h1>
            <p>A new visitor has booked a slot on your website calendar.</p>
        </div>
        <div class="content">
            
            @if($appointment->meeting_link)
                <div class="section-title">Meeting Details</div>
                <div class="meet-box">
                    <strong>Google Meet Link Reserved:</strong><br>
                    <a href="{{ $appointment->meeting_link }}" target="_blank" class="meet-link">
                        {{ $appointment->meeting_link }}
                    </a>
                </div>
            @endif

            <div class="section-title">Appointment Summary</div>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; padding-right: 15px; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Scheduled Date</div>
                            <div class="field-value" style="font-weight: 600;">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Time Slot</div>
                            <div class="field-value" style="font-weight: 600; color: #b31942;">
                                {{ $appointment->appointment_time }}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 15px; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Consultant Name</div>
                            <div class="field-value" style="font-weight: 600;">{{ $appointment->name }}</div>
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Email Address</div>
                            <div class="field-value">
                                <a href="mailto:{{ $appointment->email }}" style="color: #b31942; text-decoration: none;">
                                    {{ $appointment->email }}
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 15px; vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Phone Number</div>
                            <div class="field-value">{{ $appointment->phone ?? 'Not provided' }}</div>
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Company</div>
                            <div class="field-value">{{ $appointment->company ?? 'Not provided' }}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="vertical-align: top;">
                        <div class="field-group">
                            <div class="field-label">Selected Service Focus</div>
                            <div class="field-value" style="font-weight: 500; color: #0a3161;">
                                {{ $appointment->service->title ?? 'General Briefing Call' }}
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            @if($appointment->notes)
                <div class="section-title" style="margin-top: 15px;">Meeting Goals / Notes</div>
                <div class="field-group">
                    <div class="message-box">
                        {!! nl2br(e($appointment->notes)) !!}
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
