<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaseManagementSystem - Password Change Request </title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <table align="center" width="500" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tbody>
            <!-- Header Image -->
            <tr>
                <td align="center" style="padding: 20px 0;">
                    <img src="{{ asset('assets/images/reset-password.png') }}"  width="500" height="100" alt="Password Reset" style="display: block; max-width: 93%;">
                </td>
            </tr>

            <!-- Greeting and Message -->
            <tr>
                <td style="padding: 20px; font-family: Arial, sans-serif; font-size: 16px; color: #333;">
                    <p>Hello <strong>{{ $user->name }}</strong>,</p>
                    <p>Your site administrator has reset your password. Please <a href="{{$reset_link}}" target="_blank" style="color: #64aaea; text-decoration: none;">click here</a> to enter a new password to gain access.</p>
                    <p>Once you have set a new password, please log in using the following email address:</p>
                    <p><strong><a href="mailto:{{ $user->email }}" style="color: #104fbe;">{{ $user->email }}</a></strong></p>
                </td>
            </tr>

            <!-- Divider -->
            <tr>
                <td height="25" style="background-color:#64aaea;"></td>
            </tr>

            <!-- Footer -->
           
        </tbody>
    </table>
</body>
</html>
