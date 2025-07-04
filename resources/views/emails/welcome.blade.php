<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Welcome to {{ config('app.name') }}</title>
    <meta name="description" content="Welcome Email Template.">
    <style type="text/css">
        a:hover { text-decoration: underline !important; }
        .logo-container {
            padding: 15px 0;
            line-height: 0;
            font-size: 0;
        }
        .logo-img {
            width: 100%;
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
            border: 0;
        }
        .outer-table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        @media only screen and (max-width: 480px) {
            .responsive-table {
                width: 100% !important;
            }
            .responsive-padding {
                padding: 0 15px !important;
            }
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8; font-family: 'Open Sans', sans-serif;" leftmargin="0">
<!--[if mso]>
<style type="text/css">
    body, table, td {font-family: Arial, sans-serif !important;}
</style>
<![endif]-->
<table class="outer-table" cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
    <tr>
        <td>
            <table class="responsive-table" style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
                   align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:60px; line-height:60px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="logo-container" style="text-align:center;">
                        <a href="{{ config('app.url') }}" title="logo" target="_blank" style="display: inline-block;">
                            <img src="{{ $message->embed(public_path('build/assets/img/logo.png'), 'logo.png', 'image/png') }}"
                                 class="logo-img"
                                 alt="{{ config('app.name') }} Logo"
                                 width="200"
                                 style="display: block; width: 100%; max-width: 200px; height: auto;">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px; line-height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                               style="max-width:670px; background:#fff; border-radius:3px; text-align:center; box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tr>
                                <td style="height:40px; line-height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="responsive-padding" style="padding:0 35px;">
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0; font-size:32px; font-family:'Rubik',sans-serif;">
                                        Welcome to {{ config('app.name') }}, {{ $user->first_name }} {{ $user->last_name }}!
                                    </h1>
                                    <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                    <p style="color:#455056; font-size:15px; line-height:24px; margin:0 0 20px 0;">
                                        Thank you for joining the {{ config('app.name') }} platform! We're excited to have you as part of our community.
                                    </p>
<!--                                    <a href="{{ config('app.url') }}"-->
<!--                                       style="background:#20e277; text-decoration:none !important; font-weight:500; color:#fff; text-transform:uppercase; font-size:14px; padding:12px 30px; display:inline-block; border-radius:50px; margin-bottom:15px;">-->
<!--                                        Get Started-->
<!--                                    </a>-->
                                </td>
                            </tr>
                            <tr>
                                <td style="height:40px; line-height:40px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px; line-height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center; padding:0 15px;">
                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.74); line-height:18px; margin:0 0 15px 0;">
                            Need help? <a href="mailto:support@{{ parse_url(config('app.url'), PHP_URL_HOST) }}" style="color:#2E86C1; text-decoration:none;">Contact our support team</a>
                        </p>
                        <p style="font-size:12px; color:rgba(69, 80, 86, 0.54); line-height:18px; margin:0;">
                            &copy; {{ date('Y') }} <strong>{{ config('app.name') }}</strong>. All rights reserved.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="height:60px; line-height:60px;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
