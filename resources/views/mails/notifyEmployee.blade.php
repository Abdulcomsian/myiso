<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject</title>
    <style>
        /* Inline styles for body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="font-family: 'Arial', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0;">

    <div class="container" style="max-width: 500px; height: auto; margin: 50px auto; padding: 32px 24px 28px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">

        <img src="https://myisoonline.com/assets/media/logos/MyISOOnline-Logo.png" alt="MyISOonline" width="180" height="40" style="width: 180px; height: 40px; max-width: 100%; display: block; margin: 0 auto 24px; border: 0;">

        <div class="content-area" style="text-align: left;">

            <p><strong>
                <?php if(isset($empName)) { ?>
                    Dear {{$empName}}
                <?php }else{ ?>
                    Dear Employee
                <?php } ?>
                </strong></p>
            <p>
                We are pleased to inform you that your Employee user account has been successfully added to MyISOonline. You now have access to MyISOonline courses.
            </p>
            {{-- ?action=register, not login: the email goes out when an
                 employee is first added, so there is no account to log into
                 yet. This is the address the client asked for:
                 https://myisoonline.com/lms/account/?action=register

                 asset() rather than url() to match the Arabic site, where the
                 LMS sits under /ar/public and url() missed it. Here the two
                 give the same answer, so nothing about this address changes
                 beyond the action - but the next time a prefix moves, this
                 one will follow it.

                 Only the address changed; the wording and the styling below
                 are untouched. --}}
            <a href="{{ asset('/lms/account') }}/?action=register" target="_blank" style="display: inline-block; padding: 10px 20px; font-size: 16px; font-weight: bold; text-align: center; text-decoration: none; cursor: pointer; border: 2px solid #3498db; color: #fff; background-color: #3498db; border-radius: 5px; transition: background-color 0.3s, color 0.3s, border-color 0.3s;"
            class="button">LOG IN NOW</a>

        </div>
    </div>

    <footer style="margin-top: 20px; text-align: center; color: #888;">
        <p>All Rights Reserved. MyISOonline</p>
    </footer>

</body>

</html>
