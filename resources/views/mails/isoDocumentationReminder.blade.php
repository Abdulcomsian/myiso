<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder ISO Documentation</title>
</head>

<body style="font-family: 'Arial', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0;">

    <div class="container" style="max-width: 500px; height: auto; margin: 50px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">

        <img src="{{ asset('assets/media/logos/MyISOOnline-Logo.png') }}" alt="Logo" style="height: 50px; margin-bottom: 20px;">

        <div class="content-area" style="text-align: left;">

            <p><strong>
            <?php if(isset($clientName)) { ?>
                Dear {{$clientName}}
            <?php }else{ ?>
                Dear MyISOOnline Member,
            <?php } ?>
            </strong></p>

            <p>
                To ensure compliance in accordance with your agreement, please log in frequently and maintain your
                documentation.
            </p>

            <p>
                Auditors require clear evidence of compliance, failure to maintain your documentation records puts your
                certification at risk and may result in withdrawal from the IRQAO website.
            </p>

            <p>
                If you require additional support, please visit the support section of your portal.
            </p>

            <p>Thank you.</p>

        </div>

    </div>

    <footer style="margin-top: 20px; text-align: center; color: #888;">
        <p>All Rights Reserved. MyISOOnline</p>
    </footer>

</body>

</html>
