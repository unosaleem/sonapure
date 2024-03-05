<!doctype html>
<html>
<head>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            background-color: #fff;
            margin: 0px;
        }
        a {
            text-decoration: none;
        }
        .tableGrid {
            width: 600px;
            margin: auto;
            background-color: #fffff7;
            border: 1px solid #e1e1e1;
        }
        .Top-banner {
            background: url("{!! asset('assets/img/top-banner.png') !!}") no-repeat center center;
            background-size: cover;
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
            height: 110px;
        }
        .sub-btn {
            padding: 20px 10px;
            display: inline-block;
            width: 45%;
        }
        .sub-btn img {
            width: 100%;
        }
        .MainContainer {
            background: url("{!! asset('assets/img/pattern.png') !!}") no-repeat top center;
            background-size: contain;
            padding: 0px 20px;
        }
        .care-no {
            padding: 0px;
            margin: 0px 30px;
            padding-bottom: 10px;
            font-size: 10px;
            text-align: center;
            font-weight: 400;
            /* border-top: #ebe8dc 1px solid; */
            border-bottom: #ebe8dc 1px solid;
            margin-bottom: 14px;
        }
        .care-no > li {
            list-style: none;
        }
        .care-no > li:first-child {
            margin-bottom: 5px;
        }
        .table td {
            padding: 5px 10px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            font-weight: 500;
        }
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .product-img{
            font-size: 10px;
            font-weight: 500;
            line-height: normal;
            padding-bottom: 10px;
            margin: 0px 5px;
            text-align: center;
            float: left;
            width: 23%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-img img {
            width: 100%;
            display: block;
            margin-top: 5px;
        }
        .product-img b {
            background: #193e23;
            color: #fff;
            font-weight: 400;
            padding: 2px 5px;
            display: block;
        }

        @media only screen and (max-width:480px) {
        }

        @media only screen and (max-width:540px) {
        }
    </style>
</head>
<body>
<div class="tableGrid">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr class="Top-banner">
            <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td><a href="https://bitly.ws/WXr8" target="_blank" class="logo"><img src="https://sonapureessentials.com/assets/img/logo.png" alt="logo"></a></td>
                    </tr>
                    <tr>
                        <td class="title-text"><p style="padding: 0; margin: 0;">Thank you <strong style="    font-weight: 500;
    display: block;">for Shopping with us Today</strong></p></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table></td>
            <td width="50%" align="top" style="vertical-align: top;
    padding: 0px;
    padding-right: 10px;">
                <p> <a href="https://bitly.ws/WXr8" target="_blank" style=" color: #efc855;
    text-align: right;
    display: block;
    font-size: 12px;
    text-decoration: underline;">www.sonapureessentials.com</a> </p>
            </td>
        </tr>
    </table>
    <div style="padding: 20px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="    border: 1px solid #ebebeb;
    padding: 10px 20px;
    background-color: #fff;">
            <tr>
                <td style="text-align: center;">
                    @if(count($order_item) !=0)
                        @foreach($order_item as $row)
			                <span class="product-img">{!! ucfirst($row->product_name) !!}
                                <img class="img-responsive" src="{!! asset($row->product_image) !!}" alt="{!! ucfirst($row->product_name) !!}">
                                <b>Qyt : {!! $row->qty !!}</b>
			                </span>
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="table table-bordered">
                        <tr>
                            <td width="30%">Invoice Number:</td>
                            <td width="70%"><strong>{!! $order->invoice_id !!}</strong></td>
                        </tr>
                        <tr>
                            <td>Customer Name :</td>
                            <td><strong>{!! ucfirst($profile->first_name.' '.$profile->last_name) !!}</strong></td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td><strong>{!! $profile->email !!}</strong></td>
                        </tr>
                        <tr>
                            <td>Total Product :</td>
                            <td><strong> {!! count($order_item) !!}</strong></td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><a href="{!! url('my-invoice/'.base64_encode($order->order_id)) !!}" target="_blank" class="sub-btn"><img src="https://sonapureessentials.com/assets/img/InvoiceButton.png" alt=""></a> <a href="{!! url('my-profile/order-history') !!}" target="_blank" class="sub-btn"><img src="https://sonapureessentials.com/assets/img/ViewOrder.png" alt=""></a></td>
            </tr>
        </table>
    </div>
    <ul class="care-no">
        <li>Thankyou for becoming our valued customer. We are so grateful and hope to meet your
            expectations. Every buy you make brings you a step closer in empowering our root level
            farmers and entrepreneurs and are committed to providing you with safe, effective, and
            eco-conscious options that align with your values and needs.We look forward to being a part
            of your wellness journey for years to come. Should you have any questions or need
            assistance, please don't hesitate to reach out to our customer support team </li>
    </ul>
    <div class="footer-temp">
        <p> <a href="https://bitly.ws/WXr8" target="_blank" style="    color: #000;
    text-align: center;
    display: block;
    font-size: 12px;
    text-decoration: underline;">www.sonapureessentials.com</a> </p>
    </div>
</div>
</body>
</html>
