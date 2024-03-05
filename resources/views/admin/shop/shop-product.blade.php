@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">All Products </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">All Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop
@section('body')

    @php
        $model = new \App\ShopModel;
    @endphp
    <div class="row">
        @if(count($shop_product) !=0)
            @foreach($shop_product as $row)
                @php
                    $price = \App\FunctionModel::getData('tbl_product_price', array('product_id'=> $row->id, 'is_active'=>'1'), 'get');
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
                                                        <td>
                                                            <a href="javascript:void(0)" data-id="{!! $row_price->id !!}" data-status="2" class="btn btn-sm btn-danger active_size">
                                                                <i class="ri-close-line"></i>
                                                            </a>
                                                        </td>
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
                                            <a href="javascript:void(0)" data-id="{!! $row->id !!}" class="dropdown-item add-price">Add Price</a>
                                            <a href="{!! url('admin/shop/update-shop-product', $row->id) !!}" class="dropdown-item">Product Edit</a>
                                            <a href="{!! url('admin/shop/shop-product-gallery', $row->id) !!}" class="dropdown-item">Product Gallery</a>
{{--                                            <a href="{!! url('admin/shop/shop-product-banners', $row->id) !!}" class="dropdown-item">Product Banners</a>--}}
                                            <a href="{!! url('admin/shop/product-faq', $row->id) !!}" class="dropdown-item">Add Product FAQ</a>

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
    <div class="modal fade" id="add_price_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Product Price</h5>
                </div>
                <form method="post" id="addProduct">
                    {!! csrf_field() !!}
                    <input type="hidden" name="product_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Size</label>
                                    <select name="size" class="form-control" required>
                                        <option value="">Select</option>
                                        @if(count($size) !=0)
                                            @foreach($size as $row)
                                                <option value="{!! $row->size_title !!}">{!! $row->size_title !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal" >Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
@section('script-function')

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
                                'tab': "product",
                                'title': 'Product',
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
        $(document).on("click", ".active_size", function () {
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
                                'tab': "product_price",
                                'title': 'Product Price',
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

        $(document).on("click", ".add-price", function (){
            var id = $(this).data("id");
            $("#add_price_product input[name=product_id]").val("");
            $("#add_price_product input[name=price]").val("");
            $("#add_price_product input[name=selling_price]").val("");
            $("#add_price_product select[name=size]").val("");

            $("#add_price_product input[name=product_id]").val(id);
            $("#add_price_product").modal("show");
        });

        $(document).on("submit", "form#addProduct", function(){
            $.post("{!! url('admin/shop/add-product-price') !!}", $("form#addProduct").serialize(), function(html){
                $("#add_price_product").modal("hide");
                var obj = $.parseJSON(html);
                $.alert(obj.msg);
                setInterval(function () { location.reload() }, 3000);
            });
            return false;
        });

        $(document).on("click", ".close-modal", function (){
            $("#add_price_product").modal("hide");
        })
    </script>

@stop
