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
                            <img src="{{asset('/web/img/logo.png')}}" alt="" style="max-width: 170px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;">
                            <p style="font-size: 25px;color: #2d2d2f;">Your login crediantial 
                            <a href="#" style="color: #0066cc;font-weight: bold;"></a></p>
                            
                            <p><a href="#" style="color: #0066cc;font-weight: bold;">{{ $details['email'] }}</a></p>
                            <p><a href="#" style="color: #0066cc;font-weight: bold;">{{ $details['password'] }}</a></p>

                         
                        </td>
                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0 15px;">
                            <p style="font-weight: bold;margin: 0 0 6px;">Your message</p>
                            <p style="margin: 0;border-left: 5px solid #e4e2e0;padding: 0 0 0 10px;">
                                {{ $details['msg'] }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
