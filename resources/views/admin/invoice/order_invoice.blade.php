<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SONA Pure Essentials</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link href="{!! URL::asset('assets/images/favicon.ico') !!}" rel="icon">
    <link href="{!! URL::asset('assets/images/favicon.ico') !!}" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            color: #333;
            font-size: 13px;
            margin: 0px;
        }

        .top-header {
            background-color: rgb(233 232 232);
            padding: 10px 15px;
            /* border-bottom: 1px solid #ffffff; */
            border-left: 1px solid #878787;
            border-right: 1px solid #878787;
            border-top: 1px solid #878787;
        }

        .invoice-box {
            max-width: 8.5in;
            margin: auto;
            /*    border: 1px solid #ddd;*/
            font-size: 13px;
            line-height: 24px;
            font-family: 'Poppins', sans-serif;
            background: url("../assets/images/watermark.png") no-repeat;
            background-position: center;
        }

        .main-div {
            padding: 0px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 10px;
            line-height: 20px;
            font-weight: 500;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .information {
            border-left: 1px solid #878787;
            border-right: 1px solid #878787;
            font-size: 12px;
        }

        .table {}

        .heading th {
            background: #206031;
            line-height: normal;
            color: #fff !important;
        }

        .heading td,
        .heading th,
        .total th,
        .main-row td,
        .payment-transaction td {
            border: 1px solid #878787;
            padding: 8px;
            color: #000;
            font-weight: 500;
            font-size: 12px;
        }

        .main-row td p {
            margin: 0px;
        }

        .payment-transaction td {
            line-height: 20px;
            color: #fff;
        }

        .payment-transaction td strong {
            font-weight: 500;
        }

        .total th {
            background: #206031;
            color: #fff;
        }

        .table table {
            border: 1px solid #878787;
        }

        .social-icon {
            margin: 0px;
            margin-top: 40px;
        }

        .social-icon>li {
            list-style: none;
            margin-right: 10px;
            display: inline-block;
        }

        .social-icon>li>a {
            background: #9e9e9e;
            color: #fff;
            width: 23px;
            height: 23px;
            display: block;
            text-align: center;
            line-height: 25px;
            -webkit-transition: all .3s ease-out;
            -moz-transition: all .3s ease-out;
            transition: all .3s ease-out;
        }

        .social-icon>li>a:hover {
            background: #fe742a;
            color: #fff;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {}
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="top-header">
            <table>
                <tr>
                    <td class="title">
                        <img src="{!! URL::asset('assets/images/green-logo.png') !!}" alt="logo" style="width: 100%; max-width: 100px" />
                    </td>
                    <td align="right">
                        <h3 style="line-height: 62px; font-size: 28px;">
                            Tax Invoice/Bill of Supply/Cash Memo
                        </h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="main-div">
            <table>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td style="    padding: 10px;">
                                    <strong>SONA Pure Essentials</strong><br>
                                    17 / 1A, Madan Mohan Malviya Marg, <br>
                                    Lucknow-226001, UP, India<br>
                                    <strong> PAN No:</strong> AACF1234TGH<br>
                                    <strong>GST Registration No:</strong> 09AACEREYURY546456<br> <br>


                                    <strong>Order Number:</strong> {!! $order->order_id !!} <br>
                                    <strong>Order Date:</strong> {!! date('F,d Y', strtotime($order->date_time)) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td align="right" style="    padding: 10px;">
                                    <strong>Shipping Address :</strong>
                                    <br>{!! ucfirst($order->first_name.' '.$order->last_name) !!}
                                    <br>{!! ucfirst($order->shipping_locality.','.$order->shipping_address) !!}
                                    <br>{!! ucfirst($order->shipping_city.', '.$order->shipping_state) !!}
                                    <br>{!! ucfirst($order->shipping_post_code.', '.$order->shipping_country) !!}
                                    <br>
                                    <br>
                                    <strong>Invoice Number :</strong> {!! $order->invoice_id !!}

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div class="table">
                <table>
                    <tr class="heading">
                        <th width="5%" align="center">Sl. No.</th>
                        <th width="25%">Description</th>
                        <th width="10%" align="center"> Unit Price</th>
                        <th width="10%" align="center">Discount </th>
                        <th width="5%" align="center"> Qty</th>
                        <th width="10%" align="center">Net Amount</th>
                        <th width="5%" align="center">Tax Rate</th>
                        <th width="5%" align="center">Tax Type</th>
                        <th width="15%" align="center">Tax Amount</th>
                        <th width="15%" align="center">Total Amount</th>
                    </tr>
                    @if(count($order_item) !=0)
                    @foreach($order_item as $key=>$row)
                    <tr class="main-row">
                        <td>{!! $key+1 !!}.</td>
                        <td>
                            {!! $row->product_name !!}
                        </td>
                        <td align="right">
                            ₹ {!! number_format($row->price, 2) !!}
                        </td>
                        <td align="right">
                            ₹ 0.00
                        </td>

                        <td align="right">{!! number_format($row->qty, 2) !!}</td>

                        <td align="right">
                            ₹ {!! number_format($row->total_price, 2) !!}

                        </td>
                        <td align="right">
                            18%

                        </td>
                        <td align="center">
                            GST
                        </td>
                        <td align="right">
                            ₹ {!! number_format($row->tax_amount, 2) !!}
                        </td>
                        <td align="right">
                            ₹ {!! number_format($row->total_price-$row->tax_amount, 2) !!}
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    <tr class="total">
                        <th colspan="8" align="right">Grand Total:</th>
                        <th align="right"> ₹ {!! number_format($order->gst, 2) !!}</th>
                        <th align="right"> ₹ {!! number_format($order->total_amount, 2) !!}</th>
                    </tr>
                    <tr class="main-row">
                        <td colspan="10" align="right"><strong>Amount in Words: {!! ucfirst($word) !!}</strong></td>
                    </tr>
                    <tr class="main-row">
                        <td colspan="10" align="right"><strong>SONA PURE ESSENTIALS:</strong><br>
                            <img src="{!! URL::asset('assets/images/surabhi-gupta.png') !!}" width="200" height="60"><br>
                            <strong>Authorized Signatory</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" style="padding: 0px;">
                            <table style="background: rgb(32 96 49); width: 100%; border: 0px;">
                                <tr class="payment-transaction">
                                    <td width="25%" style="border: 0px;border-right: 1px solid #878787;">
                                        <strong>Payment Transaction ID:</strong>
                                        <br>{!! $order->razorpay_payment_id !!}
                                    </td>
                                    <td width="25%" style="border: 0px; border-right: 1px solid #878787;">
                                        <strong>Date & Time:</strong>
                                        <br>{!! date('F, d Y', strtotime($order->date_time)) !!}
                                    </td>
                                    <td width="25%" style="border: 0px; border-right: 1px solid #878787;">
                                        <strong>Invoice Value:</strong>
                                        <br> {!! number_format($order->total_amount, 2) !!}
                                    </td>
                                    <td width="25%" style="border: 0px;">
                                        <strong>Mode of Payment:</strong>
                                        <br> {!! $order->payment_status=="COD" ? "COD" : "Online Payment" !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <!-- <ul class="social-icon">
                    <li>
                        <a href="https://hi-in.facebook.com/sonapureessentials/" target="blank">
                            <img src="{!! URL::asset('assets/images/f.png') !!}" class="img-responsive" alt="facebook">
                        </a>
                    </li>
                    <li>
                        <a href="" target="blank">
                            <img src="{!! URL::asset('assets/images/i.png') !!}" class="img-responsive" alt="instagram">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{!! URL::asset('assets/images/y.png') !!}" class="img-responsive" alt="linkedin">
                        </a>
                    </li>
                </ul>
                <p style="font-size: 12px;  margin: 0px;">If you do not wish to receive updates from us, then please <a href="">subscribe here</a></p> -->
                <p style="font-size: 12px;  margin: 0px; margin-top:30px;">
                    (This is a computer generated invoice and does not require any signature)
                </p>
            </div>
        </div>
    </div>
</body>

</html>