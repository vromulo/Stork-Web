<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login Verification</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0,1&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
</style>
</head>
<body style="margin:0;padding:0;background-color:#F5F5F4;font-family:'Plus Jakarta Sans', Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:16px;border:1px solid #E7E5E4;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    <tr>
                        <td style="background-color:#5D3140;padding:32px;text-align:center;">
                            <span style="font-family:'DM Serif Display', Georgia, serif;font-size:36px;color:#ffffff;font-weight:normal;letter-spacing:1px;">Storkia</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:40px 32px;text-align:center;">
                            <p style="font-size:16px;color:#292524;margin:0 0 12px;font-weight:500;">Admin portal login code:</p>
                            
                            <p style="font-size:42px;letter-spacing:12px;font-weight:800;color:#CF4173;margin:0 0 24px;">{{ $code }}</p>
                            
                            <p style="font-size:14px;color:#78716C;margin:0;line-height:1.6;">
                                This code expires in <strong>10 minutes</strong>.<br>If you did not attempt to sign in, please secure your account immediately.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#F5F5F4;padding:20px;text-align:center;border-top:1px solid #E7E5E4;">
                            <p style="font-size:12px;color:#78716C;margin:0;">&copy; {{ date('Y') }} Storkia. Admin Access Logging Enabled.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>