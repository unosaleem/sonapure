@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@stop
@section('page-title')
    <div class="page-title-container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                    <ul class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Reports</a></li>
                        <li class="breadcrumb-item"><a href="#">Order Reports</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
@stop
@section('body')
    @php

        if(isset($filter)){
            $date = $filter['date_range'];
        }else{
            $date = "'".date('Y-m-d', strtotime('-30days'))." to ".date('Y-m-d', time())."'";
        }
        //echo $date;
        //echo '<pre>'; print_r($date); exit;

    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Filters</div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date Validation</label>
                                    <select class="form-control" name="date_validate">
                                        <option value="y" {!! isset($filter) ? ($filter['date_validate'] == "y" ? "selected" : "") : "" !!}>With Date</option>
                                        <option value="n" {!! isset($filter) ? ($filter['date_validate'] == "n" ? "selected" : "") : "" !!}>Without Date</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Order Date</label>
                                    <input type="text" name="date_range" value="{!! isset($filter) ? $filter['date_range'] : "" !!}" class="form-control date-range" required/>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search By Customer </label>
                                    <input type="text" class="form-control" name="customer" placeholder="Enter Name .. " value="{!! isset($filter) ? $filter['customer'] : "" !!}" id="customer"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Search By Mobile Number </label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" value="{!! isset($filter) ? $filter['mobile'] : "" !!}" id="mobile"/>
                                </div>
                            </div>
                            <div class="col-md-1" >
                                <div class="form-group">
                                    <label>Paid Status </label>
                                    <select class="form-control" name="paid_status" id="paid_status">
                                        <option value="" {!! isset($filter) ? ($filter['paid_status'] == "" ? "selected" : "") : "" !!}>All </option>
                                        <option value="online" {!! isset($filter) ? ($filter['paid_status'] == "online" ? "selected" : "") : "" !!}>Paid </option>
                                        <option value="cod" {!! isset($filter) ? ($filter['paid_status'] == "cod" ? "selected" : "") : "" !!}>Cod </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                                    <button type="submit" name="submit" value="download" class="btn btn-warning">Download</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Orders Reports</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Id</th>
                                            <th>Order Date</th>
                                            <th>Customer Name</th>
                                            <th>Customer Mobile</th>
                                            <th>Shipping Pin Code</th>
                                            <th>Payment Type</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
                                            <th>Tax Amount</th>
                                            <th>Sub Total</th>
                                            <th>Order Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data))
                                            @if(count($data) !=0)
                                                @foreach($data as $key=>$row)
                                                    <tr>
                                                        <td>{!! $key+1 !!}.</td>
                                                        <td>{!! $row->order_id !!}</td>
                                                        <td>{!! date('F d, Y', strtotime($row->date_time)) !!}</td>
                                                        <td>{!! ucfirst($row->first_name.' '.$row->last_name) !!}</td>
                                                        <td>{!! $row->mobile !!}</td>
                                                        <td>{!! $row->shipping_post_code !!}</td>

                                                        <td>{!! $row->payment_method == "online" ? "PAID" : "COD" !!}</td>
                                                        <td>{!! $row->payment_status !!}</td>
                                                        <td>{!! ucfirst($row->status) !!}</td>
                                                        <td>{!! number_format($row->gst, 2) !!}</td>
                                                        <td>{!! number_format($row->sub_total, 2) !!}</td>
                                                        <td>{!! number_format($row->total_amount, 2) !!}</td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                                @if(isset($data))
                                    {!! $data->appends($filter)->links() !!}
                                @endif

                            </div>
                        </div>
                    </div>
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
    </script>
    {{--<script>
        $( function() {
            $( "#customer" ).autocomplete({
                source: function( request, response ) {
                    $.get("{!! url('admin/search-customer-number') !!}", {term: request.term}, function (html){
                        response( html.value );
                    });
                },
                minLength: 2,
                select: function (event, ui) {
                    $('#customer').val(ui.item.value); // save selected id to input
                    return false;
                },
                focus: function(event, ui){
                    $("#customer").val(ui.item.value);
                    return false;
                },

            } );
        } );
    </script>--}}
@stop
