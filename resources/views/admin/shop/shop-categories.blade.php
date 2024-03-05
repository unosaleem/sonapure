@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Category</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">All Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card mb-5">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Title</th>
                            <th>Category Url</th>
                            <th>Header Url</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($shop_category) !=0)
                            @foreach($shop_category as $key=>$row)
                                <tr>
                                    <td>{!! ($key+1) !!}.</td>
                                    <td><img src="{!! asset($row->category_image) !!}" width="50" height="50" alt=""> {!! ucfirst($row->category_title_eng) !!}</td>
                                    <td>{!! $row->category_url !!}</td>
                                    <td><img src="{!! asset($row->banner_images) !!}" width="50" alt=""><a href="{!! ucfirst($row->product_url) !!}"> {!! ucfirst($row->product_url) !!}</a></td>
                                    <td>
                                        @if($row->is_active == '1')
                                            <span class="badge bg-success text-uppercase">Active</span>
                                        @else
                                            <span class="badge bg-danger text-uppercase">Non-Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->is_active == '1')
                                            <a href="javascript:void(0)" class="status" data-id="{!! $row->id !!}" data-status="2" title="Non Active">
                                                <i class="icon-30 fs-20 text-danger bi-trash-fill"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="status" data-id="{!! $row->id !!}" data-status="1" title="Active">
                                                <i class="icon-30 fs-20 text-success bi-check2-square"></i>
                                            </a>
                                        @endif
                                        <a href="{!! url('admin/shop/update-category/'.base64_encode($row->id)) !!}" title="Edit">
                                            <i class="icon-30 fs-20 text-warning bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="">
            <div class="toast-header">
                <strong class="me-auto text-white">Bootstrap</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-white">
                <p>Hello, world! This is a toast message.</p>
                <button type="button" class="btn btn-sm btn-info ok float-right">Ok</button>
            </div>
        </div>
    </div>

@stop
@section('script-function')
    <script>
        $(document).on("click", ".status", function (){
            var id = $(this).data("id"), status= $(this).data('status');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do u want '+(status == '1' ? "active" : "Non-Active")+' this category',
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
                                'tab': "category",
                                'title': 'Category',
                                '_token': "{!! csrf_token() !!}"
                            }, function (html) {
                                var obj = $.parseJSON(html);
                                this._liveToast = new bootstrap.Toast(document.getElementById("liveToast"));
                                if (obj.code == 200) {
                                    $.alert(obj.msg);
                                    location.reload()
                                } else if (obj.code == 400) {
                                    $.alert(obj.msg);
                                } else if (obj.code == 404) {
                                    $.alert(obj.msg);
                                }
                                console.log(obj);
                            });
                        }
                    },
                    cancel : {
                        text: 'No',
                        btnClass: 'btn-danger',
                        isHidden: false, // initially not hidden
                        isDisabled: false, // initially not disabled
                        action: function (){
                            $.alert('Canceled!');
                        }
                    }
                }
            });

            //liveToast.show()
        });

        $(document).on("click", ".ok", function (){
            location.reload()
        });
    </script>

@stop
