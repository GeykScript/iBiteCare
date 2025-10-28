<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clinic User Account</title>
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


        <div style="padding:30px; color:#374151; font-size:15px; line-height:1.6;">
            <p style="margin:0 0 16px;">Hello, We are Dr. Care Guinobatan.</p>
            <p style="margin:0 0 16px;">Please use this account ID and default password to access your account:</p>


            <!-- Credentials Table -->
            <table align="center" cellpadding="10" cellspacing="0" border="0" style="margin:30px auto; background:#FFECEC; border-radius:8px; text-align:left; width:auto; padding:10px;">
                <tr>
                    <td style="font-size:16px; font-weight:bold; color:#EB1C24; padding:8px 15px;">
                        Account ID:
                    </td>
                    <td style="font-size:14px; font-weight:600; color:#000000; padding:8px 15px; text-align:right;">
                        {{ $user_account->account_id }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:16px; font-weight:bold; color:#EB1C24; padding:8px 15px;">
                        Default Password:
                    </td>
                    <td style="font-size:14px; font-weight:600; color:#000000; padding:8px 15px; text-align:right;">
                        {{ $user_default_password }}
                    </td>
                </tr>
            </table>


            <p>Please, change your password after logging in for the first time to ensure your account's security.</p>

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