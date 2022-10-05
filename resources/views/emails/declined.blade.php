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
                            <p style="font-size: 25px;color: #2d2d2f;"><a href="#"
                                    style="color: #0066cc;font-weight: bold;">{{ $name }}</a> declined your
                                interview request</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 10px;">
                            <span
                                style="background-color: #feedf1;color: #a63a47;font-size: 14px;padding: 5px 10px;border-radius: 5px;font-weight: bold;">Declined</span>
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
                                        <p style="margin: 0px 0px 0px;">
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
                    {{-- <tr>
                        <td style="padding: 0 0 15px;"><p>Fill this time slot with another candidate:</p><a href="#" style="background-color: #2457a6;color: #fff;text-decoration: none;padding: 13px 20px;display: inline-block;border-radius: 5px;">View Candidates</a></td>
                    </tr> --}}
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
