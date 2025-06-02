<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Password Has Been Changed</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .email-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px;
        }

        .header {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .message {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .important-note {
            background-color: #ffecec;
            padding: 15px;
            border: 1px solid #ffdddd;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #cc0000;
        }

        .important-note strong {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto 15px;
            display: block;
        }
    </style>
</head>
<body>
<div class="email-container">
    @if(isset($user->name))
        <p class="greeting">Hello {{ $user->name }},</p>
    @else
        <p class="greeting">Hello,</p>
    @endif

    <p class="message">We are notifying you that the password for your account has been successfully changed.</p>

    <div class="important-note">
        <strong>Important:</strong> If you did not change this password, please contact us immediately to take necessary actions and secure your account.
    </div>

    <p class="message">Thank you for using our services!</p>

    <div class="footer">
        <p>Sincerely,</p>
        <p>{{ config('app.name') }}</p>
    </div>
</div>
</body>
</html>
