@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Testimonial</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Web Management</a></li>
                        <li class="breadcrumb-item active">All Testimonial</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop
@section('body')

            <div class="card mb-5">
                <div class="card-body table-responsive">
                    <table class="table table-custom table-lg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Name</th>
                            <th>designation</th>
                            <th>Youtube Links</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(count($shop_testimonial) !=0)
                            @foreach($shop_testimonial as $key=>$row)
                                <tr>
                                    <td>{!! ($key+1) !!}.</td>
                                    <td>
                                        <img src="{!! URL::asset($row->image) !!}" class="img img-thumbnail" style="height: 64px">
                                    </td>
                                    <td>{!! ucfirst($row->name) !!}</td>
                                    <td>{!! $row->designation !!}</td>
                                    <td> <div class="text-truncate">https://www.youtube.com/embed/{!! $row->via !!}
                                        </div>
                                       </td>
                                    <td>
                                        @if($row->is_active == '1')
                                            <span class="badge bg-success text-uppercase">Active</span>
                                        @else
                                            <span class="badge bg-danger text-uppercase">Non-Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->is_active == '1')
                                            <a href="javascript:void(0)" class="status btn btn-danger m-1" data-id="{!! $row->id !!}" data-status="2" title="Non Active">
                                                <i class="icon-20 text-white bi-trash-fill"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="status btn btn-success m-1" data-id="{!! $row->id !!}" data-status="1" title="Active">
                                                <i class="icon-20 text-white bi-check2-square"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-warning m-1" href="{!! url('admin/shop/update-testimonial', base64_encode($row->id)) !!}" title="Edit">
                                            <i class="icon-20 text-black bi-pencil-square"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
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
                content: 'Are you sure do u want '+(status == '1' ? "active" : "Non-Active")+' this Product',
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
                                'tab': "testimonials",
                                'title': 'testimonial',
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
