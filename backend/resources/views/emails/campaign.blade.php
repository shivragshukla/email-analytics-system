<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->subject }}</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .content {
            margin: 20px 0;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h1>{{ $campaign->from_name }}</h1>
            <p>{{ $campaign->subject }}</p>
        </div>

        <!-- Content Section -->
        <div class="content">
            {!! $content !!}
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>If you no longer wish to receive these emails, you can <a href="#">unsubscribe</a>.</p>
            <p>&copy; {{ date('Y') }} {{ $campaign->from_name }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
