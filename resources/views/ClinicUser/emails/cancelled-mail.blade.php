<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Appointment Cancelled</title>
</head>

<body style="margin:0; padding:0; background-color:#f9fafb; font-family: 'Segoe UI', Arial, sans-serif;">
    <div style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">

        <!-- Header -->
        <div style="background:#EB1C24; padding:25px 35px; text-align:center;">
            <h2 style="margin:0; color:#ffffff; font-size:35px; font-family:'Geologica', sans-serif; font-weight:900; text-shadow:1px 1px 4px rgba(0,0,0,0.4);">
                Dr. Care Animal Bite Center
            </h2>
            <p style="margin:0; color:#ffffff; font-size:16px; font-weight:600;">Guinobatan Branch</p>
        </div>

        <!-- Body -->
        <div style="padding:35px 30px; color:#374151; font-size:15px; line-height:1.7;">
            <p style="margin:0 0 16px;">Hello {{ $appointment->name ?? 'Patient' }},</p>

            <p style="margin:0 0 16px;">
                We are sorry for the inconvenience caused due to unforeseen circumstances.
                Your appointment has been <strong style="color:#EB1C24;">Cancelled</strong>.<br>
                Cancelled appointment details:
            </p>
            <div style="margin:25px 0; border:1px solid #f1f1f1; border-radius:10px; background:#fef2f2; padding:20px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;">
                    <tr>
                        <td style="padding-bottom:8px;"><strong>Date:</strong></td>
                        <td style="padding-bottom:8px;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Time:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td><span style="color:#EB1C24; font-weight:600;">{{ $appointment->status }}</span></td>
                    </tr>
                </table>
            </div>

            <p style="margin:0 0 16px;">
                If you would like to schedule a new appointment, you can use our website, call or text us at <strong>0954 195 2374</strong>. We apologize for any inconvenience this may have caused.
            </p>

            <p style="margin:0 0 16px;">
                To make a new appointment in our Website, please click the button below: 
            </p>
            <!-- View Details Button -->
            <div style="text-align:center; margin:30px 0;">
                <a href="{{ url('/dashboard') }}"
                    style="display:inline-block; background:#EB1C24; color:#ffffff; padding:12px 28px; border-radius:8px; 
    text-decoration:none; font-weight:600; font-size:15px; letter-spacing:0.3px;">
                    Make a New Appointment
                </a>

            </div>

            <p style="margin:0 0 16px;">
                If you did not request this change, please contact our clinic immediately.
            </p>

            <p style="margin-top:40px;">
                Thank you for your understanding,<br>
                <span style="color:#EB1C24; font-weight:bold;">Dr. Care Guinobatan Support Team</span>
            </p>
        </div>

        <!-- Footer -->
        <div style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#6b7280;">
            &copy; {{ date('Y') }} Dr. Care Guinobatan. All rights reserved.
        </div>
    </div>
</body>

</html>