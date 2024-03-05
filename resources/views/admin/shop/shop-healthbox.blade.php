@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Health Box Products </h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">Health Box Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop
@section('body')

    @php
        $model = new \App\ShopModel;;
    @endphp
    <div class="row">
        @if(count($shop_product) !=0)
            @foreach($shop_product as $key=>$row)

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
                                                <td>Id</td>
                                                <td>Price</td>
                                                <td>Selling Price</td>
                                                <td>Status</td>
                                                 
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td>{!! $row->id !!}</td>
                                                <td>{!! number_format($row->price, 2) !!}</td>
                                                <td>{!! number_format($row->selling_price, 2) !!}</td>
                                                <td>
                                                    <span class="badge {!! $row->is_active == '1' ? "bg-success" : "bg-light text-dark" !!}">{!! $row->is_active == '1' ? "active" : "non-active" !!}</span>
                                                </td>

                                            </tr>

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
                                            <a href="{!! url('admin/shop/update-shop-healthbox', $row->id) !!}" class="dropdown-item">Health Box Edit</a>
                                            <a href="{!! url('admin/shop/shop-healthbox-gallery', $row->id) !!}" class="dropdown-item">Health Box Gallery</a>
{{--                                            <a href="{!! url('admin/shop/shop-healthbox-banner', $row->id) !!}" class="dropdown-item">Health Box Banner</a>--}}

                                            @if($row->is_active == '2')
                                                <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-status="1" class="dropdown-item status-product">
                                                    Health Box Active
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-status="2" class="dropdown-item status-product">
                                                    Health Box Non-Active
                                                </a>
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
                                'tab': "healthbox",
                                'title': 'Health Box',
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
