@extends('admin.layout.admin_layout')
@section('css')
@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Shipping Orders</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order Management</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('admin/order/process-orders') !!}">Process Order</a></li>

                        <li class="breadcrumb-item active">Process Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Order Details</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="from-group">
                                <label>Order Id</label>
                                <input type="text" class="form-control" value="{!! $order->order_id !!}" readonly/>
                            </div>
                            <div class="from-group" style="margin-top: 10px;">
                                <label>Order Date</label>
                                <input type="text" class="form-control" value="{!! date('d-M-Y', strtotime($order->date_time)) !!}" readonly/>
                            </div>
                            <div class="from-group" style="margin-top: 10px;">
                                <label>Invoice Id</label>
                                <input type="text" class="form-control" value="{!! $order->invoice_id !!}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="from-group">
                                <label>Client Name</label>
                                <input type="text" class="form-control" value="{!! $order->first_name.' '.$order->last_name !!}" readonly/>
                            </div>
                            <div class="from-group" style="margin-top: 10px;">
                                <label>Client Email</label>
                                <input type="text" class="form-control" value="{!! $order->email !!}" readonly/>
                            </div>
                            <div class="from-group" style="margin-top: 10px;">
                                <label>Client Mobile</label>
                                <input type="text" class="form-control" value="{!! $order->mobile !!}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="from-group">
                                <label>Shipping Details</label>
                                <textarea class="form-control"  readonly>{!! $order->shipping_locality.', '.$order->shipping_address.','.$order->shipping_city !!}</textarea>
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Pincode</label>
                                <input type="text" class="form-control" value="{!! $order->shipping_post_code !!}" readonly/>
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Order Amount</label>
                                <input type="text" class="form-control" value="{!! $order->total_amount !!}" readonly/>
                            </div>
                        </div>
                        {{--<div class="form-group" style="margin-top: 10px;">
                                <label>Payment Method</label>
                                <select class="form-control" name="" required>
                                    <option value="Prepaid">Prepaid</option>
                                    <option value="cod">COD</option>
                                </select>
                            </div>--}}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Order Item(s) Details</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Product Details</td>
                                            <td>Qty</td>
                                            <td>Price</td>
                                            <td>Total Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($order_item)!=0)
                                            @foreach($order_item as $row)
                                                <tr>
                                                    <td>
                                                        <img src="{!! asset($row->product_image) !!}" style="height: 50px;">
                                                    </td>
                                                    <td>
                                                        <p>{!! $row->product_name !!}</p>
                                                        <p>{!! $row->size !!}</p>
                                                    </td>
                                                    <td>{!! $row->qty !!}</td>
                                                    <td>{!! $row->price !!}</td>
                                                    <td>{!! $row->total_price !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{!! url('admin/order/generate-shipment') !!}">
                        <div class="form-group">
                            <label class="">Payment Method</label>
                            <select class="form-control" required>
                                <option value="Prepaid">Prepaid</option>
                                <option value="COD">COD</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Length</label>
                            <input type="text" class="form-control" name="length" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Breadth</label>
                            <input type="text" class="form-control" name="breadth" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Height</label>
                            <input type="text" class="form-control" name="height" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Weight</label>
                            <input type="text" class="form-control" name="weight" required>
                        </div>
                        <div class="text-center" style="margin-top: 10px">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script-function')
@stop
