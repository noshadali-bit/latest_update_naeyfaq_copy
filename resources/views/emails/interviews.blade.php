<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        /* table, td {border:2px solid #000000 !important;} */

    </style>
</head>

<body>
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#f3f2f1;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="background:#ffffff;width:602px;border-collapse:collapse;border:30px solid #fff;border-spacing:0;text-align:left;">
                    <tr>
                        <td style="padding:0;">
                            <img src="https://i.postimg.cc/W4C9cgCX/logo.jpg" alt="" style="max-width: 170px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;">
                            <?php if($sent_to == 'company'){  ?>
                            <p style="font-size: 25px;color: #2d2d2f;">Your interview request has been sent to <a
                                    href="#" style="color: #0066cc;font-weight: bold;">{{ $first_name }}
                                    {{ $last_name }}</a></p>
                            <?php }else{ ?>

                            <p style="font-size: 25px;color: #2d2d2f;">{{ $first_name }}
                                {{ $last_name }} Your interview is been schedule <a href="#"
                                    style="color: #0066cc;font-weight: bold;"></a></p>

                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px;">
                            <?php if($sent_to == 'company'){  ?>
                            <span
                                style="background-color: #feedf1;color: #a63a47;font-size: 14px;padding: 5px 10px;border-radius: 5px;font-weight: bold;">Awaiting
                                candidate confirmation</span>
                            <?php }else{ ?>
                            <span
                                style="background-color: #feedf1;color: #a63a47;font-size: 14px;padding: 5px 10px;border-radius: 5px;font-weight: bold;">Awaiting
                                confirmation</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>{{ $job_title }}</p>
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:1px solid #fff;border-spacing:0;text-align:left;">
                                <tr>
                                    <td style="width: 30px;vertical-align: top;"><img
                                            src="https://i.postimg.cc/jq6SCbK4/001-calendar.png" alt=""
                                            style="width: 18px;"></td>
                                    <td>
                                        <p style="margin: 0 0 7px;">{{ $date }}</p>
                                        <p style="margin: 0;">{{ $start_time }} - {{ $end_time }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <p style="margin: 0px 0 0;">
                                            <?php if ($interview_type == 'Video'){ ?>
                                        <p>Link: <b>{{ $link }}</b></p>
                                        <?php } else if($interview_type == 'Phone') {?>
                                        <p>Phone: <b>{{ $phone }}</b></p>
                                        <?php } ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0 15px;">
                            <p style="font-weight: bold;margin: 0 0 6px;">Your message</p>
                            <p style="margin: 0;border-left: 5px solid #e4e2e0;padding: 0 0 0 10px;">
                                {{ $msg }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;">
                            <hr style="margin: 20px 0 25px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="https://i.postimg.cc/W4C9cgCX/logo.jpg" alt=""
                                style="max-width: 140px;margin: 0 0 20px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #6a5d5e;font-size: 12px;">© 2022 Lorem Ipsum</td>
                    </tr>
                    <tr>
                        <td style="color: #6a5d5e;font-size: 12px;">Lorem Ipsum is simply dummy text of the</td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 0;"><a href="#" style="color: #406cb2;font-size: 12px;">Privacy
                                Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"
                                style="color: #406cb2;font-size: 12px;">Terms</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#"
                                style="color: #406cb2;font-size: 12px;">Help</a></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
