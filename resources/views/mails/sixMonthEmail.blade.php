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

    <div class="container" style="max-width: 500px; height: auto; margin: 50px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">

        <img src="https://myisoonline.com/assets/media/logos/newmyisologo50.png" alt="Logo" style="height: 50px; margin-bottom: 20px;">

        <div class="content-area" style="text-align: left;">

            <p><strong>
                <?php if(isset($clientName)) { ?>
                    Dear {{$clientName}}
                <?php }else{ ?>
                    Dear Client
                <?php } ?>
                </strong></p>
            <p>
                Your ISO Certificate's validity depends on maintaining your documentation. As of now, insufficient activity has been made on your account. Please update and maintain your records
            </p>
            <p>
                For any assistance or clarification, please visit the support section on your account where you will find video tutorials and other useful tools. Alternatively, our team is ready to support you with any questions you may have.
            </p>
            <p>Your prompt attention is crucial to ensure the continuous validity of your ISO certifications.</p>

        </div>

        <?php if(isset($clientName) && isset($clientEmail) && isset($totalDays)) { ?>
            <table style="width: 100%; margin-top: 20px; margin-bottom: 20px; border-collapse: collapse; border: 1px solid #ddd;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><strong>Client Name:</strong></td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $clientName }}</td> 
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><strong>Client Email:</strong></td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $clientEmail }}</td> 
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><strong>Client haven't signed in to MyISO for the last:</strong></td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $totalDays }} Days</td>
                </tr>
            </table>        
            
            <a href="https://myisoonline.com/" target="_blank" style="display: inline-block; padding: 10px 20px; font-size: 16px; font-weight: bold; text-align: center; text-decoration: none; cursor: pointer; border: 2px solid #3498db; color: #fff; background-color: #3498db; border-radius: 5px; transition: background-color 0.3s, color 0.3s, border-color 0.3s;"
            class="button">Sign In</a>
            
        <?php } ?>
    </div>

    <footer style="margin-top: 20px; text-align: center; color: #888;">
        <p>All Rights Reserved. MyISOOnline</p>
    </footer>

</body>

</html>
