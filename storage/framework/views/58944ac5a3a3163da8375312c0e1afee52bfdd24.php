<!DOCTYPE html>
<html>
<head>
    <title>Expert Gateway</title>
</head>
<body>

    <div style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;padding-top: 30px;word-break: break-word;"
     width="100%">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                <tr>
                    <td style="vertical-align: top; padding-bottom:30px;background-color:#ffffff;padding-top:25px;padding-left:40px;">
                        <a href="" target="_blank"><img alt="ExpertGateway"
                                                        src="<?php echo e(asset('assets/img/logo.png')); ?>"
                                                        style="border:none;max-width:150px;"/></a></td>
                </tr>
                </tbody>
            </table>

            <div style="padding: 40px; background: #fff;border-bottom-left-radius:6px;border-bottom-right-radius:6px;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                    <tr>
                        <td style="border-bottom:1px solid #f6f6f6;">
                            <h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Hello
                                <?php echo e($details['f_name']); ?>,</h1>

                            <p style="margin-top:0px; color:#bbbbbb;">&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0 30px 0;">
                            <p>Welcome to ExpertGateway, <?php echo e($details['title']); ?></p>
                            <br>
                            <p>
                                Email: <?php echo e($details['email']); ?>

                            </p>
                            <p>
                                <?php echo e($details['body']); ?>

                            </p>
                            <br>
                            <b>- Thanks (ExpertGateWay team)</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php /**PATH C:\wamp64\www\expertgateway\resources\views/emails/lawyer_approved_mail.blade.php ENDPATH**/ ?>