<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;font-size: 14px;}
        /* table, td {border:2px solid #000000 !important;} */
        
    </style>
</head>
<body>
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#f3f2f1;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="background:#ffffff;width:602px;border-collapse:collapse;border:30px solid #fff;border-spacing:0;text-align:left;">
                    <tr>
                        <td style="padding:0;">
                            <img src="https://i.postimg.cc/W4C9cgCX/logo.jpg" alt="" style="max-width: 170px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;">
                            <p style="font-size: 25px;color: #2d2d2f;">Did your interview with <a href="#" style="color: #2d2d2f;font-weight: bold;">{{ $name }}</a> take place?</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ $button_link_1 }}" style="border: 2px solid #4679f1;display: inline-block;padding: 6px 15px;border-radius: 15px;text-decoration: none;margin-right: 10px;font-weight: 600;color: #4679f1;">Yes</a>
                            <a href="{{ $button_link_2 }}" style="border: 2px solid #4679f1;display: inline-block;padding: 6px 15px;border-radius: 15px;text-decoration: none;margin-right: 10px;font-weight: 600;color: #4679f1;">Cancelled or reschedule</a>
                            <a href="{{ $button_link_3 }}" style="border: 2px solid #4679f1;display: inline-block;padding: 6px 15px;border-radius: 15px;text-decoration: none;margin-right: 10px;font-weight: 600;color: #4679f1;">Candidate was no-show </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#f3f2f1;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="background:#f3f2f1;width:602px;border-collapse:collapse;border:30px solid #f3f2f1;border-spacing:0;text-align:left;">
                    <tr>
                        <td>
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                                <tr>
                                    <td style="padding: 20px 20px;">
                                        <p style="margin: 10px 0;"><b>Date:</b> {{ $date }}</p>
                                        <p style="margin: 10px 0;"><b>Time:</b> {{ $start_time }} - {{ $end_time }}</p>
                                        <p style="margin: 10px 0;"><b>Position:</b> {{ $job_title }}</p>
                                        {{-- <p style="margin: 10px 0;"><b>Location:</b> 1807 S Highland Ave Largo, FL 33706</p> --}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#f3f2f1;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="background:#ffffff;width:602px;border-collapse:collapse;border:30px solid #fff;border-spacing:0;text-align:left;">
                    <tr>
                        <td style="color: #6a5d5e;font-size: 12px;">© 2022 Lorem Ipsum</td>
                    </tr>
                    <tr>
                        <td style="color: #6a5d5e;font-size: 12px;">Lorem Ipsum is simply dummy text of the</td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 0;"><a href="#" style="color: #406cb2;font-size: 12px;">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" style="color: #406cb2;font-size: 12px;">Terms</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" style="color: #406cb2;font-size: 12px;">Help</a></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>