@extends('admin.layout.admin_layout')
@section('style')
    <!-- jsvectormap css -->
    <link href="{!! URL::asset('assets-admin/libs/jsvectormap/css/jsvectormap.min.css') !!}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{!! URL::asset('assets-admin/libs/swiper/swiper-bundle.min.css') !!}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop
@section('body')

    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-8">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Good Morning, {!! Session::get('admin')['user_name'] !!}!</h4>
                                <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <div class="col-md-4">
                        <form method="get">
                            <div class="row">
                                <div class="col-md-8">
                                     <input type="text" name="date" class="form-control date-range" required/>

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 5px;">Filter Data</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                                    </div>

                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">&#8377;<span class="counter-value" data-target="{!! $order['total_earning'] !!}">0</span> </h4>
                                        <a href="#" class="text-decoration-underline">View net earnings</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-success rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                                    </div>

                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{!! $order['total_order'] !!}">0</span></h4>
                                        <a href="{!! url('admin/order/all-orders') !!}" class="text-decoration-underline">View all orders</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                                    </div>

                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{!! $order['total_customer'] !!}">0</span> </h4>
                                        <a href="#" class="text-decoration-underline">See details</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-warning rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Delivery Orders</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">&#8377;<span class="counter-value" data-target="{!! $order['total_delivery'] !!}">0</span> </h4>
                                        <a href="#" class="text-decoration-underline">Orders</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->





                <div class="row">
                    {{--<div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Month Orders</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Download Report</a>
                                            <a class="dropdown-item" href="#">Export</a>
                                            <a class="dropdown-item" href="#">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="store-visits-source" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div> <!-- .card-->
                    </div>--}} <!-- .col-->

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                                {{--<div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>--}}
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Amount</th>

                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($resent_orders) !=0)
                                                @foreach($resent_orders as $row)
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="fw-medium link-primary">{!! $row->order_id !!}</a>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{!! URL::asset($row->product_image) !!}" alt="" class="avatar-xs rounded-circle" />
                                                                </div>
                                                                <div class="flex-grow-1">{!! ucfirst($row->product_name) !!}</div>
                                                            </div>
                                                        </td>
                                                        <td>{!! ucfirst($row->size) !!}</td>
                                                        <td>{!! $row->qty !!}</td>
                                                        <td>{!! ucfirst($row->first_name.' '.$row->last_name) !!}</td>
                                                        <td>
                                                            <span class="text-success"> &#x20B9; {!! number_format($row->total_price, 2) !!}</span>
                                                        </td>

                                                        <td>
                                                            <span class="badge badge-soft-success">{!! $row->payment_status == "COD" ? "Cod" : "Paid"  !!}</span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                    @if(count($resent_orders) !=0)
                                        {!! $resent_orders->links() !!}
                                    @endif
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->


    </div>

@stop
@section('script')
    <!-- apexcharts -->
    <script src="{!! URL::asset('assets-admin/libs/apexcharts/apexcharts.min.js') !!}"></script>

    <!-- Vector map-->
    <script src="{!! URL::asset('assets-admin/libs/jsvectormap/js/jsvectormap.min.js') !!}"></script>
    <script src="{!! URL::asset('assets-admin/libs/jsvectormap/maps/world-merc.js') !!}"></script>

    <!--Swiper slider js-->
    <script src="{!! URL::asset('assets-admin/libs/swiper/swiper-bundle.min.js') !!}"></script>

    <!-- Dashboard init -->
    <script src="{!! URL::asset('assets-admin/js/pages/dashboard-ecommerce.init.js') !!}"></script>
    <!-- Apex chart -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@stop
@section('script-function')
    <script type="text/javascript">
        $(".date-range").flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: ["{!! date('Y-m-d', strtotime('-30days')) !!}", "{!! date('Y-m-d', time()) !!}"]
        });
    </script>
@stop
