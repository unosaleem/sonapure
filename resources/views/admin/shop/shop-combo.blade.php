@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')

@stop
@section('body')

    @php
        $model = new \App\ShopModel;;
    @endphp
    <div class="card">
        <div class="card-header">
            All Combo Products
        </div>
        <div class="card-body ">
            <div class="row">
                @if(count($shop_combo_product) !=0)
                    @foreach($shop_combo_product as $row)
                        @php
                            $price = \App\FunctionModel::getData('tbl_product_price', array('product_id'=> $row->id), 'get');
                        @endphp
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{!! URL::asset($row->product_image) !!}"   style="height: 150px; width: 80%" alt="avatar">
                                        </div>
                                        <div class="col-md-7">
                                            <p>
                                                {!! ucfirst($row->product_title) !!} ({!! $row->product_hindi_title !!})
                                                <span class="badge m-1 {!! $row->is_active == '1' ? "bg-success" : "bg-light text-dark" !!}">{!! $row->is_active == '1' ? "active" : "non-active" !!}</span>
                                                <span class="badge m-1 {!! $row->is_front == '1' ? "bg-primary" : "bg-light text-dark" !!}">{!! $row->is_front == '1' ? "Font Yes" : "Font No" !!}</span>
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table table-custom table-lg">
                                                    <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Size</td>
                                                        <td>Price</td>
                                                        <td>selling Price</td>
                                                        <td>Status</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($price) !=0)
                                                        @foreach($price as $k=>$row_price)
                                                            <tr>
                                                                <td>{!! $k+1 !!}</td>
                                                                <td>{!! $row_price->size !!}</td>
                                                                <td>{!! number_format($row_price->price, 2) !!}</td>
                                                                <td>{!! number_format($row_price->selling_price, 2) !!}</td>
                                                                <td>
                                                                    <span class="badge {!! $row_price->is_active == '1' ? "bg-success" : "bg-light text-dark" !!}">{!! $row_price->is_active == '1' ? "active" : "non-active" !!}</span>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    <tr></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="dropdown ms-auto" style="float: right">
                                                <a href="#" data-bs-toggle="dropdown"
                                                   class="btn btn-dark dropdown-toggle"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-gear-wide-connected"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{!! url('admin/shop/update-shop-combo-product', $row->id) !!}" class="dropdown-item">Product Edit</a>

                                                    @if($row->is_active == '2')
                                                        <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-status="1" class="dropdown-item status-product">Product Active</a>
                                                    @else
                                                        <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-status="2" class="dropdown-item status-product">Product Non-Active</a>
                                                    @endif

                                                </div>
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
    </div>

@stop
@section('js')

    <script>
        $(document).on("click", ".status-product", function () {
            var id = $(this).data("id"), status = $(this).data('status');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do u want ' + (status == '1' ? "active" : "Non-Active") + ' this Product',
                buttons: {
                    confirm: {
                        text: 'Yes',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'a'],
                        isHidden: false, // initially not hidden
                        isDisabled: false, // initially not disabled
                        action: function () {
                            $.post("{!! url('admin/shop/update-status')  !!}", {
                                "where[id]": id,
                                "input[is_active]": status,
                                'tab': "combo",
                                'title': 'Combo Product',
                                '_token': "{!! csrf_token() !!}"
                            }, function (html) {
                                var obj = $.parseJSON(html);
                                $.alert(obj.msg);
                                setInterval(function () { location.reload(); }, 3000);
                            });
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

            //liveToast.show()
        });
    </script>

@stop
