<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            height: 400px;
            margin: 50px auto; /* Center the container vertically */
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        p {
            margin: 20px 0;
            font-size: 16px;
            line-height: 1.6;
            text-align: center;
            
        }

        img {
            /* max-width: 100%; */
            height: 50px;
            margin-bottom: 20px;
        }

        /* Basic button styles */
        .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        border: 2px solid #3498db;
        color: #fff;
        background-color: #3498db;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        /* Hover effect */
        .button:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        }


        footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/media/logos/MyISOOnline-Logo.png') }}" alt="Logo">
        <p>Hello</p>
        <?php
        $totalDays = request('totalDays');
        ?>
        @if($totalDays == 90)
        <p>You Haven`t SignIn to MYISO for the last 3 months</p>
        @endif

        @if($totalDays == 180)
        <p>You Haven`t SignIn to MYISO for the last 6 months</p>
        @endif
        <a class="button" href="https://myisoonline.com/" target="_blank">Sign In</a>
    </div>
    <footer>
        <p style="text-align: center;">All Rights Reserved. MyISOOnline</p>
    </footer>
</body>
</html>
