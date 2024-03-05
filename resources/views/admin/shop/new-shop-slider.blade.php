@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/libs/dropzone/min/dropzone.min.css') !!}" type="text/css">
@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Home Page Slider </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Web Management</a></li>
                        <li class="breadcrumb-item active">Home Page Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload New Sliders</h4>

                </div>
                <div class="card-body">
                    <div>
                        @include('admin.include.flash-msg')
                        <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-slider') !!}" class="dropzone">
                            {!! csrf_field() !!}
                            <input type="hidden" name="where[id]" value="{!! isset($slider) ? base64_encode($slider->id) : "" !!}">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label>Slider Title <span class="text-primary">*</span></label>
                                        <input class="form-control" type="text" value="{!! isset($slider) ? $slider->slider_title : "" !!}" placeholder=" Title" name="input[slider_title]" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label>Slider Sub Title</label>
                                        <input class="form-control" type="text" value="{!! isset($slider) ? $slider->slider_sub_title : "" !!}" placeholder=" Sub Title" name="input[slider_sub_title]" required/>
                                    </div>
                                </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 ">
                                            <label>Slider Heading <span class="text-info">*</span></label>
                                            <input class="form-control" type="text" value="{!! isset($slider) ? $slider->slider_header : "" !!}" placeholder="Heading " name="input[slider_header]" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 ">
                                            <label>Slider Sub text</label>
                                            <input class="form-control" type="text" value="{!! isset($slider) ? $slider->slider_text : "" !!}" placeholder="Markup" name="input[slider_text]" required/>
                                        </div>
                                    </div>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                </div>
                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </form>
                    </div>

{{--
                    <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-slider') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($slider) ? base64_encode($slider->id) : "" !!}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label>Title</label>
                                    <input class="form-control" type="text" value="{!! isset($slider) ? $slider->slider_title : "" !!}" placeholder="slider text" name="input[slider_title]" required/>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Slider Image 1903px*790px</label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="file" {!! isset($testimonial) ? "" : "required" !!} placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <img src="{!! isset($slider) ? asset($slider->image) : "https://media.flaticon.com/dist/min/img/collections/collection-tour.svg" !!}" class="img img-thumbnail" id="img-view" style="height: 200px; width: 200px; margin: 10px auto;">
                            </div>

                            <div class="col-md-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit" >Submit</button>
                            </div>
                        </div>

                    </form>--}}

                    {{--<div class="text-center mt-4">
                        <button type="button" class="btn btn-primary waves-effect waves-light upload">Send Files</button>
                    </div>--}}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Uploaded Sliders </div>
                <div class="card-body">
                    @if(count($shop_slider) !=0)
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($shop_slider as $key=>$row)
                                    <div class="carousel-item {!! $key==0 ? "active" : "" !!}">
                                        <img class="d-block w-100 rounded" src="{!! URL::asset($row->slider_image) !!}" alt="...">
                                        @if($row->is_active == '1')
                                            <a href="javascript:void(0)" class="status btn btn-danger btn-lg text-center" data-id="{!! $row->id !!}" data-status="2" title="Non Active" style="position: absolute;bottom: 0;top: auto;left: auto;right: 0;z-index: 99;"><i class="fa fa-trash bi bi-trash" aria-hidden="true"></i> Deactive Slider</a>
                                        @else
                                            <a href="javascript:void(0)" class="status btn btn-success btn-lg text-center" data-id="{!! $row->id !!}" data-status="1" title="Active" style="position: absolute;bottom: 0;top: auto;left: auto;right: 0;z-index: 99;"><i class="fa fa-check-square-o bi bi-check-square-fill" aria-hidden="true"></i> Active Slider</a>
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                               data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                               data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{!! URL::asset('assets-admin/libs/dropzone/min/dropzone.min.js') !!}"></script>


@stop
@section('script-function')
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

        $(document).on("click", ".upload", function (){
            $("form.dropzone").submit();
        });
    </script>

@stop
