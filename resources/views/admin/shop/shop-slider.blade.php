@extends('admin.layout.admin_layout')
@section('css')
@stop
@section('page-title')

@stop
@section('body')
    @if(count($shop_slider) !=0)
        <div class="row">
            <div class="col-md-12">

                <h5 class="mb-4">My Sliders</h5>
                <div class="row g-4">
                    @foreach($shop_slider as $key=>$row)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card card-hover">
                            <a href="#">
                                <img src="{!! asset($row->slider_image) !!}" class="card-img-top" alt="{!! ucfirst($row->slider_title) !!}">
                            </a>
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="card-title mb-3">{!! ucfirst($row->slider_title) !!}</h5>
                                </a>
                                <div class="text-center">
                                    @if($row->is_active == '1')
                                        <span class="badge bg-success text-uppercase text-right">Active</span>
                                    @else
                                        <span class="badge bg-danger text-uppercase text-right">Non-Active</span>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    @if($row->is_active == '1')
                                        <a href="javascript:void(0)" class="status btn btn-danger " data-id="{!! $row->id !!}" data-status="2" title="Non Active">Delete</a>
                                    @else
                                        <a href="javascript:void(0)" class="status btn btn-success" data-id="{!! $row->id !!}" data-status="1" title="Active">active</a>
                                    @endif

                                    <a href="{!! url('admin/shop/update-slider', base64_encode($row->id)) !!}" class="btn btn-warning ms-auto text-primary">
                                        <i class="bi bi-heart-fill text-white"></i> Update
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    @endif


    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="live" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="">
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
@section('js')
    <script>
        $(document).on("click", ".status", function (){
            var id = $(this).data("id"), status= $(this).data('status');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do u want '+(status == '1' ? "active" : "Non-Active")+' this Slider',
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
                                'tab': "slider",
                                'title': 'Slider',
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
