@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')

@stop
@section('body')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        @if(count($shop_brand) !=0)
                            @foreach($shop_brand as $key=>$row)
                                    <div class="col-md-3 sw-md-50">
                                        <div class="shadow-lg p-2 rounded">
                                            <div class="">
                                                <div class="row text-center">
                                                    <div class="col-12">
                                                        <img src="{!! URL::asset($row->brand_image) !!}" class=" card-img  sh-6 sw-6" alt="thumb">
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="m-0 p-1">{!! ucfirst($row->brand_title) !!} </p>
                                                    </div>
                                                    <div class="col-12">
                                                        @if($row->is_active == '1')
                                                            <a href="javascript:void(0)" class="status btn btn-outline-danger btn-sm ms-1" data-id="{!! $row->id !!}" data-status="2" title="Non Active">
                                                                Delete
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" class="status btn btn-outline-success btn-sm ms-1" data-id="{!! $row->id !!}" data-status="1" title="Active">
                                                                active
                                                            </a>
                                                        @endif
                                                        <a href="{!! url('admin/shop/update-brand', base64_encode($row->id)) !!}" class="btn btn-tertiary btn-outline-warning btn-sm ms-1" title="Edit">Edit
                                                        </a>
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
                content: 'Are you sure do u want '+(status == '1' ? "active" : "Non-Active")+' this Certificate',
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
                                'tab': "brand",
                                'title': 'Certificate',
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
