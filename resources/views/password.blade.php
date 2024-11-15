<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('path/to/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css"
        integrity="sha512-B46MVOJpI6RBsdcU307elYeStF2JKT87SsHZfRSkjVi4/iZ3912zXi45X5/CBr/GbCyLx6M1GQtTKYRd52Jxgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            padding: 10px 0;
        }

        .header img {
            max-width: 150px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .header img:hover {
            transform: scale(1.05);
        }

        .content {
            padding: 20px;
            font-size: 16px;
            color: #333333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://writeless.octopus-software.dev/Dwati.png" alt="Logo">
        </div>

        <div class="content">

            <p>Dear {{ $user->name }},</p>

            <p>
                Hi,<br>
                Thank you for choosing Dawati. Use the following Reset password to complete your Sign-in procedures.
                your Code is <br>
                <p style="font-weight: 600">{{ $password }} </p>
                <br>
                This code is valid until {{ $validity }}.
                If you did not request this code, please ignore this email.
                <br>
                Regards,
                <br>
                Dawati Team
            </p>
        </div>

        <div
            style="background-color: #f9f9f9; padding: 20px; border-top: 1px solid #e0e0e0; text-align: center; font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
            <div style="margin-bottom: 15px;">
                <a href="https://www.linkedin.com/company/octopus-software-solutions" style="text-decoration: none;">
                    <img src="https://delivery.octopus-software.dev/linkedin.png" alt="LinkedIn"
                        style="width: 25px; margin: 0 15px;">
                </a>
                <a href="https://www.facebook.com/octopus.software.solutions" style="text-decoration: none;">
                    <img src="https://delivery.octopus-software.dev/facebook.png" alt="Facebook"
                        style="width: 25px; margin: 0 15px;">
                </a>
                <a href="https://www.instagram.com/octopus.software.solutions/" style="text-decoration: none;">
                    <img src="https://delivery.octopus-software.dev/instagram.png" alt="Instagram"
                        style="width: 25px; margin: 0 15px;">
                </a>
            </div>
            <div style="font-size: 13px; color: #777;">
                &copy; 2024 <span style="color: #000; font-weight: bold;">Octopus Software Solutions</span>. All rights
                reserved.
            </div>
        </div>


    </div>
</body>

</html>
