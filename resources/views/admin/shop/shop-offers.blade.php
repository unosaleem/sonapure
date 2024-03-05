@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
@stop
@section('page-title')
    <div class="page-title-container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h1 class="mb-0 pb-0 display-4" id="title">All Offers</h1>
                <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                    <ul class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('admin/shop/shop-offers') !!}">All Slider</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                <a href="{!! url('admin/shop/new-offers') !!}" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto">
                    <i class="bi bi-plus"></i>
                    <span>Add New Offers</span>
                </a>
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
                    <div class="row">
                        @if(count($shop_offers) !=0)
                            @foreach($shop_offers as $key=>$row)
                                <div class="col-md-4 p-3 ">

                                    <div class="card  m-3 shadow-lg">
                                        <p class="">Start date : <b class="text-primary">{!! ucfirst($row->start_date) !!}</b> <span class=" text-right" style="float: right;">End Date : <b class="text-warning">{!! ucfirst($row->end_date) !!} </b></span></p>
                                        <img src="{!! URL::asset($row->offer_image) !!}" class=" card-img " alt="thumb">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-5">

                                                    {!! ucfirst($row->offer_title) !!} <br>
                                                    @if($row->is_active == '1')
                                                        <span class="badge bg-success text-uppercase text-right">Active</span>
                                                    @else
                                                        <span class="badge bg-danger text-uppercase text-right">Non-Active</span>
                                                    @endif
                                                </div>

                                                <div class=" col-7 ">
                                                    @if($row->is_active == '1')
                                                        <a href="javascript:void(0)" class="status btn btn-danger btn-lg ms-1" data-id="{!! $row->id !!}" data-status="2" title="Non Active">Delete</a>
                                                    @else
                                                        <a href="javascript:void(0)" class="status btn btn-success btn-lg ms-1" data-id="{!! $row->id !!}" data-status="1" title="Active">active</a>
                                                    @endif
                                                    <a href="{!! url('admin/shop/update-offers', base64_encode($row->id)) !!}" class="btn btn-primary btn-lg ms-1" title="Edit">Edit</a>
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
                {{--                <button type="button" class="btn btn-sm btn-info ok float-right">Ok</button>--}}
            </div>
        </div>
    </div>

@stop
@section('js')
    <script>
        $(document).on("click", ".status", function (){
            var id = $(this).data("id"), status= $(this).data('status');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do u want '+(status == '1' ? "active" : "Non-Active")+' this Offers',
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
                                'tab': "offer",
                                'title': 'offer',
                                '_token': "{!! csrf_token() !!}"
                            }, function (html) {
                                var obj = $.parseJSON(html);
                                this._liveToast = new bootstrap.Toast(document.getElementById("liveToast"));
                                if (obj.code == 200) {
                                    $("#liveToast .me-auto").text("Success Message");
                                    $("#liveToast .toast-body P").text(obj.msg);
                                    $("#liveToast").addClass("bg-primary");
                                    this._liveToast.show();
                                    //setInterval(function(){ alert(location.reload()); }, 3000);
                                } else if (obj.code == 400) {
                                    $("#liveToast .me-auto").text("Warning Message");
                                    $("#liveToast .toast-body P").text(obj.msg);
                                    $("#liveToast").addClass("bg-warning");
                                    this._liveToast.show();
                                    //setInterval(function(){ alert(location.reload()); }, 3000);
                                } else if (obj.code == 404) {
                                    $("#liveToast .me-auto").text("Error Message");
                                    $("#liveToast .toast-body P").text(obj.msg);
                                    $("#liveToast").addClass("bg-danger");
                                    this._liveToast.show();

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
