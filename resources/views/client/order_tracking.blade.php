@extends('layout.home_master')
@section('css')
    <link type="text/css" rel="stylesheet" href="{!! asset('assets') !!}/css/dashboard-style.css">
    <link type="text/css" rel="stylesheet" href="{!! asset('assets') !!}/css/payment-style.css">
   <style>
       @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
       .card-body {
           -ms-flex: 1 1 auto;
           flex: 1 1 auto;
           padding: 1.25rem;
       }
        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #383536
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ec3059;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ec3059;
            border-color: #ec3059;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
        .green-btn, .green-btn-small {
            background-color: #57a477;
            color: #fff;
        }
       .itemside .title {
           display: block;
           margin-bottom: 5px;
           color: #212529;
           font-size: 14px;
       }
    </style>

   <style>
        .bg-light {
            background-color: #ec3059 !important;
            color: white;
        }
        .card-box{background-color:#fff;background-clip:border-box;border:1px solid #e7eaed;padding:1.5rem;margin-bottom:24px;border-radius:.25rem}.rounded-circle{border-radius:50%!important}.nav-pills .nav-link.active,.nav-pills .show>.nav-link{color:#fff;background-color:#1abc9c}.nav-pills .nav-link{border-radius:.25rem}.navtab-bg li>a{background-color:#f7f7f7;margin:0 5px}.nav-pills>li>a,.nav-tabs>li>a{color:#6c757d;font-weight:600}.mb-4,.my-4{margin-bottom:2.25rem!important}.tab-content{padding:20px 0 0 0}.progress-sm{height:5px}.m-0{margin:0!important}.table .thead-light th{color:#6c757d;background-color:#f1f5f7;border-color:#dee2e6}.social-list-item{height:2rem;width:2rem;line-height:calc(2rem - 4px);display:block;border:2px solid #adb5bd;border-radius:50%;color:#adb5bd}.text-purple{color:#6559cc!important}.border-purple{border-color:#6559cc!important}.timeline{margin-bottom:50px;position:relative}.timeline:before{background-color:#dee2e6;bottom:0;content:"";left:50%;position:absolute;top:30px;width:2px;z-index:0}.timeline .time-show{margin-bottom:30px;margin-top:30px;position:relative}.timeline .timeline-box{background:#fff;display:block;margin:15px 0;position:relative;padding:20px}.timeline .timeline-album{margin-top:12px}.timeline .timeline-album a{display:inline-block;margin-right:5px}.timeline .timeline-album img{height:36px;width:auto;border-radius:3px}@media (min-width:768px){.timeline .time-show{margin-right:-69px;text-align:right}.timeline .timeline-box{margin-left:45px}.timeline .timeline-icon{background:#dee2e6;border-radius:50%;display:block;height:20px;left:-54px;margin-top:-10px;position:absolute;text-align:center;top:50%;width:20px}.timeline .timeline-icon i{color:#98a6ad;font-size:13px;position:absolute;left:4px}.timeline .timeline-desk{display:table-cell;vertical-align:top;width:50%}.timeline-item{display:table-row}.timeline-item:before{content:"";display:block;width:50%}.timeline-item .timeline-desk .arrow{border-bottom:12px solid transparent;border-right:12px solid #fff!important;border-top:12px solid transparent;display:block;height:0;left:-12px;margin-top:-12px;position:absolute;top:50%;width:0}.timeline-item.timeline-item-left:after{content:"";display:block;width:50%}.timeline-item.timeline-item-left .timeline-desk .arrow-alt{border-bottom:12px solid transparent;border-left:12px solid #fff!important;border-top:12px solid transparent;display:block;height:0;left:auto;margin-top:-12px;position:absolute;right:-12px;top:50%;width:0}.timeline-item.timeline-item-left .timeline-desk .album{float:right;margin-top:20px}.timeline-item.timeline-item-left .timeline-desk .album a{float:right;margin-left:5px}.timeline-item.timeline-item-left .timeline-icon{left:auto;right:-56px}.timeline-item.timeline-item-left:before{display:none}.timeline-item.timeline-item-left .timeline-box{margin-right:45px;margin-left:0;text-align:right}}@media (max-width:767.98px){.timeline .time-show{text-align:center;position:relative}.timeline .timeline-icon{display:none}}.timeline-sm{padding-left:110px}.timeline-sm .timeline-sm-item{position:relative;padding-bottom:20px;padding-left:40px;border-left:2px solid #dee2e6}.timeline-sm .timeline-sm-item:after{content:"";display:block;position:absolute;top:3px;left:-7px;width:12px;height:12px;border-radius:50%;background:#fff;border:2px solid #f37d8a}.timeline-sm .timeline-sm-item .timeline-sm-date{position:absolute;left:-104px}@media (max-width:420px){.timeline-sm{padding-left:0}.timeline-sm .timeline-sm-date{position:relative!important;display:block;left:0!important;margin-bottom:10px}}
    </style>
@stop
@section('body')

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="assets/images/bg/page-title-1.webp" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Order tracking</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}}">Home</a></li>
                            <li class="breadcrumb-item active">Order tracking</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->
    <div class="clearfix"></div>
    <section>
        <div class="container theme-container">
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                    @include('client.include.nav_client')
                </div>
                <!-- end col-->

                <div class="col-lg-9 col-xl-9">
                    <div class="card-boxs shadow">
                        <div class="tab-content">
                            <div class="tab-pane active" id="about-me">
                                @include('include.flash-msg')

                                <article  class="container theme-container">
                                    <div class="row">
                                        <!-- Posts Start -->
                                        <aside class="col-md-12 col-sm-12 space-bottom-45">

                                            <article class="card">

                                                <div class="card-body">
                                                    <h6>Order ID: {!! $data['data']['allData']['id'] !!}</h6>
                                                    <article class="card">
                                                        <div class="card-body row">
                                                            <div class="col-md-6"> <strong>Estimated Delivery time:</strong> <br>{!! ($data['data']['allData']['expectedDeliveryDate'] == "" ? "" : date('d-m-Y', strtotime($data['data']['allData']['expectedDeliveryDate']))) !!} </div>
                                                            <div class="col-md-6"> <strong>Carrier Name:</strong> <br> {!! $data['data']['allData']['carrierName'] !!}  </div>

                                                            <div class="col-md-6"> <strong>Awb No #:</strong> <br> {!! $data['data']['allData']['awbNo'] !!} </div>
                                                        </div>
                                                    </article>
                                                    <div class="track">
                                                        @if(count($data['data']['events'])!=0)
                                                            @foreach($data['data']['events'] as $row)
                                                                <div class="step active">
                                                                    <span class="icon"> <i class="fa fa-check"></i> </span>
                                                                    <span class="text">
                                                                        @switch($row['status'])
                                                                            @case ("SB")
                                                                                Shipment Booked

                                                                            @break;
                                                                            @case ("PU")
                                                                                Picked Up

                                                                            @break;
                                                                            @case ("IT")
                                                                                In Transit

                                                                            @break;
                                                                            @case ("EX"):
                                                                                Exception

                                                                            @break;
                                                                            @case ("OD"):
                                                                                Out for Delivery

                                                                            @break;
                                                                            @case ("OP"):
                                                                                Out for Pickup

                                                                            @break;
                                                                            @case ("RT"):
                                                                                Return

                                                                            @break;
                                                                            @case ("DL"):
                                                                                Delivered

                                                                            @break;
                                                                        @endswitch
                                                                        <p>{!! $row['Remarks'] !!}</p>
                                                                        <p>{!! $row['Location'] !!}</p>

                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                    <hr>

                                                    <hr>
                                                    <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
                                                </div>
                                            </article>
                                        </aside>
                                </article>

                            </div>
                            <!-- end settings content-->
                        </div>
                        <!-- end tab-content -->
                    </div>
                    <!-- end card-box-->
                </div>
                <!-- end col -->
            </div>
        </div>
    </section>
    <div class="clearfix"></div>

@stop
@section('js')
    <script type="text/javascript">
        $("input[type='image']").click(function() {
            $("input[id='my_file']").click();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("input[type='image']").attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("input[id='my_file']").change(function() {
            readURL(this);
        });
    </script>
@stop

