<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Two-Factor Code</title>
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
            <p style="margin:0 0 16px;">Hello,</p>
            <p style="margin:0 0 16px;">Please use the verification code below to verify your account:</p>

            <!-- Code Box -->
            <div style="text-align:center; margin:30px 0;">
                <span style="display:inline-block; font-size:32px; font-weight:bold; letter-spacing:6px; padding:12px 20px; border-radius:8px; background:#EEC7C9; color:#EB1C24;">
                    {{ $verificationCode }}
                </span>
            </div>

            <p style="margin:0 0 16px;">If you did not request this, you can safely ignore this email.</p>
            <p style="margin-top:40px; ">Thanks,<br><span style="color:#EB1C24; font-weight: bold;">Dr. Care Guinobatan Support</span></p>
        </div>

        <!-- Footer -->
        <div style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#6b7280;">
            &copy; {{ date('Y') }} Dr.Care Guinobatan. All rights reserved.
        </div>

    </div>
</body>

</html>