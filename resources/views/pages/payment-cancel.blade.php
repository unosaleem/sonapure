<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>SONA Pure Essentials</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="{!! asset('assets/images/favicon.ico') !!}" rel="icon" />
        <link href="{!! asset('assets/images/favicon.ico') !!}" rel="apple-touch-icon" />
        <style type="text/css">
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");
            body {
                font-family: "Poppins", sans-serif;
                font-size: 14px;
                background-color: #fff;
                margin: 0px;
            }
            a {
                text-decoration: none;
            }
            .tableGrid {
                width: 600px;
                margin: 50px auto;
                background-color: #fffff7;
                border: 1px solid #e1e1e1;
                padding: 30px 0px;
            }
            .Top-banner {
                text-align: center;
            }
            .Top-banner > td {
                padding: 10px 0px 0px 20px;
            }
            .title-text {
                color: #fff;
                font-size: 35px;
                padding: 0px 0px;
                line-height: 42px;
                padding-top: 1rem;
                font-weight: 500;
            }
            .name-text {
                color: #fff;
                font-size: 12px;
                font-weight: 300;
                padding-bottom: 6px;
                line-height: normal;
            }
            .logo {
            }
            .logo > img {
                height: 120px;
            }
            .sub-btn {
                padding: 0px 10px;
                display: block;
                width: 280px;
                margin: auto;
            }
            .sub-btn img {
                width: 100%;
            }
            .MainContainer {
                background: url("{!! asset('assets/img/pattern.png') !!}") no-repeat top center;
                background-size: contain;
            }
            .care-no {
                padding: 0px;
                margin: 0px 70px;
                padding-bottom: 30px;
                font-size: 14px;
                text-align: center;
                font-weight: 400;
            }
            .care-no > li {
                list-style: none;
            }
        </style>
    </head>
    <body>
        <div class="tableGrid MainContainer">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr class="Top-banner">
                    <td width="100%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td>
                                    <a href="{!! url('/') !!}" target="_blank" class="logo"><img src="{!! asset('assets/img/logo.png') !!}" alt="logo" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="title-text">
                                    <br />
                                    <img src="{!! asset('assets/img/cancelled.png') !!}" alt="" style="width: 70px;" />
                                    <p style="padding: 40px 0px; margin: 0; color: #f00; padding-top: 0px; font-weight: 600;">PAYMENT CANCELLED</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <ul class="care-no">
                <li>Your order got CANCELLED due to the unsuccessful transaction process. Do try again after some time and meanwhile discover our world of health and wellness.</li>
            </ul>

            <a href="{!! url('/') !!}" class="sub-btn"><img src="{!! asset('assets/img/website-url.png') !!}" alt="" /></a>
        </div>
    </body>
</html>

