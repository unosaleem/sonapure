@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Shipment Orders</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order Management</a></li>

                        <li class="breadcrumb-item active">Shipment Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')

    @php
        $model = new \App\ShopModel;;
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
                                                        echo '<h4 class="badge bg-info">New Order</h4>';
                                                    break;
                                                    case "process":
                                                        echo '<h4 class="badge bg-secondary">Process Order</h4>';
                                                    break;
                                                    case "shipments":
                                                        echo '<h4 class="badge bg-success">Shipment Order</h4>';
                                                    break;
                                                    case "cancel":
                                                        echo '<h4 class="badge bg-danger">Cancel Order</h4>';
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
{{--                                                    <a href="javascript:void(0)" data-id="{!! $row->order_id !!}" class="dropdown-item shipOrder">Assign Courier</a>--}}
                                                    <a href="javascript:void(0)" data-id="{!! $row->order_id !!}"  class="dropdown-item order_details">Order Details</a>
                                                    <a href="{!! url('admin/order/order-invoice', base64_encode($row->id)) !!}" class="dropdown-item">Invoice</a>
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
                @endif
            </div>
        </div>
        <div class="col-md-4"></div>

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
    <div class="modal fade bd-example-modal-lg" id="order_ship" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oder Shipping</h5>
                </div>
                <form method="post" action="{!! url('admin/order/generate-shipment') !!}">
                    <div class="modal-body">
                        {!! csrf_field() !!}
                        <input type="hidden" name="order_id" id="order_id" value=""/>

                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Length <br><small style="color: red">The length of the item in cms. Must be more than 0.5.</small></label>
                            <input type="text" class="form-control" name="length" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Breadth <br><small style="color: red">The breadth of the item in cms. Must be more than 0.5.</small></label>
                            <input type="text" class="form-control" name="breadth" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Height <br><small style="color: red">The height of the item in cms. Must be more than 0.5.</small></label>
                            <input type="text" class="form-control" name="height" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="">Weight <br><small style="color: red"> 	The weight of the item in kgs. Must be more than 0.</small></label>
                            <input type="text" class="form-control" name="weight" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


@stop
@section('script-function')

    <script type="text/javascript">
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange').val(start.format('MM/D/YYYY') + ' - ' + end.format('MM/D/YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        $(document).on("click", ".order_details", function(){
            var order_id = $(this).data("id");
            $.post('{!! url('admin/order/order-details') !!}', {"_token": "{!! csrf_token() !!}", 'where[order_id]' : order_id}, function(html){
                var obj = $.parseJSON(html);
                $("#order_detail_modal tbody").html(obj.div);
                $("#order_detail_modal").modal("show");
            })

        });

        $(document).on("click", ".shipOrder", function (){
            var order_id = $(this).data("id");
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do u want shipping this order ?',
                buttons: {
                    confirm: {
                        text: 'Yes',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'a'],
                        isHidden: false, // initially not hidden
                        isDisabled: false, // initially not disabled
                        action: function () {
                            $("#order_ship input#order_id").val(order_id);
                            $("#order_ship").modal("show");
                        }
                    },
                    cancel: {
                        text: 'No',
                        btnClass: 'btn-danger',
                        isHidden: false, // initially not hidden
                        isDisabled: false, // initially not disabled
                        action: function () {
                            $.alert('Canceled!');
                        }
                    }
                }
            });
        });


    </script>

@stop
