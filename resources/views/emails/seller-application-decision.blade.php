<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Status Update</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F5F5F4; font-family: 'Plus Jakarta Sans', Arial, sans-serif; color: #292524;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding: 40px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 520px; background-color: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #E7E5E4; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <tr>
                        <td align="center" style="background-color: #5D3140; padding: 28px; border-bottom: 3px solid #CF4173;">
                            <span style="font-size: 32px; font-family: 'DM Serif Display', Georgia, serif; color: #ffffff;">Storkia</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px 28px;">
                            <h2 style="font-size: 20px; color: #292524; margin-top: 0;">
                                Hello, {{ $application->user->first_name }}!
                            </h2>

                            @if($status === 'approved')
                                <p style="font-size: 14px; line-height: 1.6; color: #44403C;">
                                    Congratulations! Your seller application for <strong>{{ $application->business_name }}</strong> has been <strong>approved</strong>.
                                </p>
                                <p style="font-size: 14px; line-height: 1.6; color: #44403C;">
                                    Full seller privileges have been activated. You can now log into the Seller Portal to manage your catalog and start selling.
                                </p>
                                <div style="text-align: center; margin: 30px 0;">
                                    <a href="{{ route('seller.login') }}" style="background-color: #CF4173; color: #ffffff; padding: 12px 28px; text-decoration: none; font-weight: bold; border-radius: 12px; font-size: 14px; display: inline-block;">
                                        Go to Seller Portal
                                    </a>
                                </div>
                            @else
                                <p style="font-size: 14px; line-height: 1.6; color: #44403C;">
                                    Thank you for your interest in selling on Storkia. After reviewing your application for <strong>{{ $application->business_name }}</strong>, our team was unable to approve it at this time.
                                </p>
                                <div style="background-color: #FFF1F2; border-left: 4px solid #E11D48; padding: 14px 16px; margin: 20px 0; border-radius: 4px;">
                                    <strong style="color: #9F1239; font-size: 13px;">Reason provided:</strong>
                                    <p style="margin: 6px 0 0; font-size: 13px; color: #881337; line-height: 1.5;">
                                        {{ $reason }}
                                    </p>
                                </div>
                                <p style="font-size: 14px; line-height: 1.6; color: #44403C;">
                                    Your account remains active. You may log into your dashboard, update your profile or re-upload your verification documents, and re-submit your application for review.
                                </p>
                                <div style="text-align: center; margin: 30px 0;">
                                    <a href="{{ route('seller.seller-dashboard') }}" style="background-color: #5D3140; color: #ffffff; padding: 12px 28px; text-decoration: none; font-weight: bold; border-radius: 12px; font-size: 14px; display: inline-block;">
                                        Update & Re-apply
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #F5F5F4; padding: 16px 28px; text-align: center; border-top: 1px solid #E7E5E4; font-size: 12px; color: #78716C;">
                            &copy; {{ date('Y') }} Storkia. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>