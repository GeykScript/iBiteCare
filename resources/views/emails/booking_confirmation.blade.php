<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>

<body style="margin:0; padding:0; background-color:#f9fafb; font-family: 'Segoe UI', Arial, sans-serif;">
    <div style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">

        <!-- Header -->
        <div style="background:#EB1C24; padding: 25px 35px; text-align:center;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                <tr>

                    <!-- Right Column -->
                    <td align="start" style="width:100%; vertical-align:middle;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                            <tr>
                                <td>
                                    <h2 style="margin:0; color:#ffffff; font-size:35px; font-family: 'Geologica', sans-serif; font-weight:900; text-shadow: 1px 1px 4px rgba(0,0,0,0.4);">
                                        Dr. Care Animal Bite Center
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px; text-align:center;">
                                    <p style="margin:0; color:#ffffff; font-size:16px; font-weight:600; font-family:'Segoe UI', Arial, sans-serif;">
                                        Guinobatan Branch
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Body -->
        <div style="padding:30px; color:#374151; font-size:15px; line-height:1.6;">
            <p style="margin:0 0 16px;">Hello, We are Dr. Care Guinobatan.</p>
            <p style="margin:0 0 16px;">Thank you for booking with our Animal Bite Center!</p>
            <p style="margin:0 0 16px;">Your appointment details:</p>

            <!-- Appointment Details Table -->
            <table align="center" cellpadding="10" cellspacing="0" border="0" style="margin:30px auto; background:#FFECEC; border-radius:8px; text-align:left; width:auto; padding:10px;">
                <tr>
                    <td style="font-size:16px; font-weight:bold; color:#EB1C24; padding:8px 15px;">
                        Booking Reference:
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-weight:600; color:#000000; padding:4px 15px 8px 15px;">
                        {{ ($booking->booking_reference) }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:16px; font-weight:bold; color:#EB1C24; padding:8px 15px;">
                        Date:
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-weight:600; color:#000000; padding:4px 15px 8px 15px;">
                        {{ \Carbon\Carbon::parse($booking->appointment_date)->format('F d, Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:16px; font-weight:bold; color:#EB1C24; padding:8px 15px;">
                        Time:
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-weight:600; color:#000000; padding:4px 15px 8px 15px;">
                        {{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:16px; font-weight:bold; color:#EB1C24; padding:8px 15px;">
                        Treatment Type:
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-weight:600; color:#000000; padding:4px 15px 8px 15px;">
                        {{ strtoupper($booking->treatment_type) }}
                    </td>
                </tr>
            </table>

            <div id="appointment_note" style="margin-top:16px; padding:16px; border-left:4px solid #EB1C24; background:#FFECEC; color:#B91C1C; border-radius:6px; font-size:14px;">
                <strong style="color:#EB1C24">NOTE:</strong><br>
                <p style="color: #252525ff;">
                    Be at the clinic at least 30 minutes <strong style="color: #EB1C24;">BEFORE</strong> the appointment schedule.<br>
                    If you do not show up, your appointment will be <strong style="color: #EB1C24;">REMOVED</strong> from the list and you will need to book again.
                </p>
            </div>

            <p style="margin:0 0 16px;">We will contact you if needed. See you soon!</p>
            <p style="margin:0 0 16px;">If you did not request this, you can safely ignore this email.</p>
            <p style=" margin-top:40px; ">Thanks,<br><span style=" color:#EB1C24; font-weight: bold;">Dr. Care Guinobatan Support</span></p>
        </div>


        <!-- Footer -->
        <div style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#6b7280;">
            &copy; {{ date('Y') }} Dr.Care Guinobatan. All rights reserved.
        </div>

    </div>
</body>

</html>