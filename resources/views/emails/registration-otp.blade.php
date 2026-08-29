<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Stork Verification Code</title>
    <!-- Web Font Imports for Compatible Email Clients -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        .brand-font {
            font-family: 'DM Serif Display', Georgia, 'Times New Roman', serif !important;
        }
        .body-font {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #F5F5F4; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #292524; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #F5F5F4; padding: 40px 16px;">
        <tr>
            <td align="center">
                <!-- Main Container Card -->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 500px; background-color: #ffffff; border: 1px solid #E7E5E4; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 12px rgba(41, 37, 36, 0.05);">
                    
                    <!-- Header Bar -->
                    <tr>
                        <td align="center" style="background-color: #5D3140; padding: 28px 24px; border-bottom: 3px solid #CF4173;">
                            <span class="brand-font" style="font-family: 'DM Serif Display', Georgia, serif; font-size: 38px; line-height: 1; color: #ffffff; letter-spacing: -0.5px; text-decoration: none; font-weight: normal; display: inline-block;">
                                Stork
                            </span>
                        </td>
                    </tr>

                    <!-- Card Body -->
                    <tr>
                        <td style="padding: 36px 32px 28px; text-align: center;">
                            <h1 class="body-font" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 20px; font-weight: 700; color: #292524; margin: 0 0 8px 0;">
                                Account Verification
                            </h1>
                            <p class="body-font" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; line-height: 1.6; color: #78716C; margin: 0 0 28px 0;">
                                Enter this code to verify your email and complete registration.
                            </p>

                            <!-- OTP Box -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 28px;">
                                <tr>
                                    <td align="center">
                                        <div style="display: inline-block; background-color: #F5F5F4; border: 2px dashed #F6D8BD; border-radius: 16px; padding: 18px 32px;">
                                            <span class="body-font" style="font-family: 'Plus Jakarta Sans', monospace; font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #CF4173; text-indent: 10px; display: block;">
                                                {{ $code }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Expiration & Disclaimer Notice -->
                            <div style="background-color: #FAFAF9; border: 1px solid #E7E5E4; border-radius: 12px; padding: 14px 16px; margin-bottom: 8px;">
                                <p class="body-font" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; line-height: 1.5; color: #78716C; margin: 0;">
                                    This code will expire in <strong style="color: #292524;">{{ $expiresInMinutes }} minutes</strong>. If you did not request this registration, please disregard this email.
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer Bar -->
                    <tr>
                        <td style="padding: 20px 32px 24px; background-color: #ffffff; border-top: 1px solid #E7E5E4; text-align: center;">
                            <p class="body-font" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; line-height: 1.5; color: #78716C; margin: 0;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Stork') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>