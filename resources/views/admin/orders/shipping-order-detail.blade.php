@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Shipping Orders Details</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order Management</a></li>

                        <li class="breadcrumb-item active">Shipping Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Order Details</td>
                            <td>Customer Details</td>
                            <td>Pickup Details</td>
                            <td>Courier Details</td>
                            <td>Payment Details</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data['data']) !=0)
                            @foreach($data['data'] as $key=>$row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>
                                        <p>Order Id : {!! $row['channel_order_id'] !!}</p>
                                        <span>Shipping Date: {!! date('dF, Y', strtotime($row['channel_created_at'])) !!}</span>
                                    </td>
                                    <td>
                                        <p>Name: {!! ucfirst($row['customer_name']) !!}</p>
                                        <p>Contact number : {!! $row['customer_phone'] !!}</p>
                                        <p>Email : {!! $row['customer_email'] !!}</p>
                                    </td>
                                    <td>
                                        <p>Address: {!! $row['customer_address'].','.$row['customer_address_2'].' '.$row['customer_city'].','.$row['customer_state'].','.$row['customer_pincode'] !!}</p>

                                    </td>
                                    <td>
                                        <p>Courier Name: {!! $row['shipments'][0]['courier'] !!}</p>
                                        <p>Awb Code : {!! $row['shipments'][0]['awb'] !!}</p>
                                        <p>Shipping Id : {!! $row['id'] !!}</p>
                                    </td>
                                    <td>
                                        <p>Order Payment : {!! $row['total'] !!}</p>
                                        <p>Courier Payment : {!! $row['awb_data']['charges']['applied_weight_amount'] !!}</p>
                                    </td>
                                    <td>
                                        @if($row['status'] == "READY TO SHIP")
                                            <h4 class="badge bg-info">{!! $row['status'] !!}</h4>
                                        @elseif($row['status'] == "INVOICED")
                                            <h4 class="badge bg-warning">{!! $row['status'] !!}</h4>
                                        @elseif($row['status'] == "CANCELED")
                                            <h4 class="badge bg-danger">{!! $row['status'] !!}</h4>
                                        @else
                                            <h4 class="badge bg-dark">{!! $row['status'] !!}</h4>
                                        @endif

                                    </td>
                                    <td>
                                        @if($row['status'] == "READY TO SHIP")
                                            <a href="{!! url('admin/order/shipping-order-track/'.$row['shipments'][0]['awb']) !!}" target="_blank" class="btn btn-sm btn-outline-dark" title="Track Order"><i class="ri-git-branch-line"></i></a>
                                            <a href="{!! url('admin/order/shipping-order-invoice/'.$row['id']) !!}" target="_blank" class="btn btn-sm btn-outline-info" title="Invoice"><i class="ri-file-list-3-line "></i></a>
                                            <a href="{!! url('admin/order/shipping-order-detail/'.$row['id']) !!}" target="_blank" class="btn btn-sm btn-outline-warning" title="Order Details"><i class="ri-clipboard-line"></i></a>
                                            <a href="{!! url('admin/order/shipping-order-cancel/'.$row['id']) !!}" class="btn btn-sm btn-outline-danger" title="Cancel Order"><i class="ri-chat-delete-line"></i></a>
                                        @elseif($row['status'] == "INVOICED")
                                            <a href="{!! url('admin/order/shipping-order-invoice/'.$row['id']) !!}" target="_blank" class="btn btn-sm btn-outline-info" title="Invoice"><i class="ri-file-list-3-line "></i></a>
                                            <a href="{!! url('admin/order/shipping-order-detail/'.$row['id']) !!}" target="_blank" class="btn btn-sm btn-outline-warning" title="Order Details"><i class="ri-clipboard-line"></i></a>
                                            <a href="{!! url('admin/order/shipping-order-cancel/'.$row['id']) !!}" class="btn btn-sm btn-outline-danger" title="Cancel Order"><i class="ri-chat-delete-line"></i></a>
                                        @elseif($row['status'] == "CANCELED")
                                            <a href="{!! url('admin/order/shipping-order-detail/'.$row['id']) !!}" target="_blank" class="btn btn-sm btn-outline-warning" title="Order Details"><i class="ri-clipboard-line"></i></a>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@stop
