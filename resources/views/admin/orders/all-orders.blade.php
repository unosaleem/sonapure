@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">All Orders</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Orders Management</a></li>

                        <li class="breadcrumb-item active">All Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')
    @php
        $model = new \App\ShopModel;
        if(isset($filter)){
            $date = $filter['date_range'];
        }else{
            $date = "'".date('Y-m-d', strtotime('-30days'))." to ".date('Y-m-d', time())."'";
        }
    @endphp
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @if(count($data) !=0)
                    @foreach($data as $row)
                        <div class="col-md-12" style="margin-bottom: 20px">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            {!! ucfirst($row->first_name).' '.ucfirst($row->last_name) !!}<br>
                                            @php
                                                switch($row->status){
                                                    case "new":
                                                        echo '<h4 class="badge bg-info">New Order</h5>';
                                                    break;
                                                    case "process":
                                                        echo '<h4 class="badge bg-secondary">Process Order</h5>';
                                                    break;
                                                    case "shipments":
                                                        echo '<h4 class="badge bg-success">Shipment Order</h5>';
                                                    break;
                                                    case "cancel":
                                                        echo '<h4 class="badge bg-danger">Cancel Order</h5>';
                                                    break;

                                                }
                                            @endphp
                                        </div>
                                        <div class="col-md-4" >
                                            <div class="dropdown ms-auto" style="float: right">
                                                <a href="#" data-bs-toggle="dropdown"
                                                   class="btn btn-dark dropdown-toggle"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-gear-wide-connected"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:void(0)" data-id="{!! $row->order_id !!}" class="dropdown-item order_details">Order Details</a>
                                                    <a href="{!! url('admin/order/order-invoice', base64_encode($row->id)) !!}" target="_blank" class="dropdown-item">Invoice</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>Order Id : {!! $row->order_id !!}</span><br>
                                            <span>Order Date : {!! date('d-m-Y', strtotime($row->date_time)) !!}</span><br>
                                            <span>Payment Status : {!! $row->payment_status == "COD" ? "Cash on Delivery" : "Payed Order" !!}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="float-right">
                                                <span>Contact : {!! $row->mobile !!}</span><br>
                                                <span>Address : {!! $row->shipping_locality.' '.$row->shipping_address.', '.$row->shipping_city.' '.$row->shipping_post_code !!}</span><br>
                                                <span>Amount : {!! number_format($row->total_amount, 2) !!}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(isset($filter))
                        {!! $data->appends($filter)->links() !!}
                    @else
                        {!! $data->links() !!}
                    @endif

                @endif

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Filters
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date Validation</label>
                                    <select class="form-control" name="date_validate">
                                        <option value="y" {!! isset($filter) ? ($filter['date_validate'] == "y" ? "selected" : "") : "" !!}>With Date</option>
                                        <option value="n" {!! isset($filter) ? ($filter['date_validate'] == "n" ? "selected" : "") : "" !!}>Without Date</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label>Order Date</label>
                                    <input type="text" name="date_range" value="{!! isset($filter) ? $filter['date_range'] : "" !!}" class="form-control date-range" required/>

                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label>Search By Customer </label>
                                    <input type="text" class="form-control" name="customer" placeholder="Enter Mobile Number.. " value="{!! isset($filter) ? $filter['customer'] : "" !!}" id="customer"/>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label>Paid Status </label>
                                    <select class="form-control" name="paid_status" id="paid_status">
                                        <option value="" {!! isset($filter) ? ($filter['paid_status'] == "" ? "selected" : "") : "" !!}>All </option>
                                        <option value="online" {!! isset($filter) ? ($filter['paid_status'] == "online" ? "selected" : "") : "" !!}>Paid </option>
                                        <option value="COD" {!! isset($filter) ? ($filter['paid_status'] == "COD" ? "selected" : "") : "" !!}>Cod </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label>Order Status </label>
                                    <select class="form-control" name="order_status" id="order_status">
                                        <option value="" {!! isset($filter) ? ($filter['order_status'] == "" ? "selected" : "") : "" !!}>All Status</option>
                                        <option value="new" {!! isset($filter) ? ($filter['order_status'] == "new" ? "selected" : "") : "" !!}>New </option>
                                        <option value="process" {!! isset($filter) ? ($filter['order_status'] == "process" ? "selected" : "") : "" !!}>Process </option>
                                        <option value="shipments" {!! isset($filter) ? ($filter['order_status'] == "shipments" ? "selected" : "") : "" !!}>Shipped </option>
                                        {{--<option value="pickup">Pickup </option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="text-center" style="margin-top: 10px;">

                                    <button type="submit" name="submit" value="view" class="btn btn-info">View</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade bd-example-modal-lg" id="order_detail_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oder Items Details</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td></td>
                                            <td>Product Details</td>
                                            <td>Qty</td>
                                            <td>Price</td>
                                            <td>Total Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@stop
@section('script-function')
    <script type="text/javascript">
        $(".date-range").flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",

        });

        $(document).on("click", ".order_details", function(){
            var order_id = $(this).data("id");
            $.post('{!! url('admin/order/order-details') !!}', {"_token": "{!! csrf_token() !!}", 'where[order_id]' : order_id}, function(html){
                var obj = $.parseJSON(html);
                $("#order_detail_modal tbody").html(obj.div);
                $("#order_detail_modal").modal("show");
            })

        });
    </script>
@stop
