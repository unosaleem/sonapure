@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/glide.core.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/introjs.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/select2-bootstrap4.min.css') !!}">
@stop
@section('page-title')
   
@stop
@section('body')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    @include('admin.include.flash-msg')
                    <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-brand') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($brand) ? base64_encode($brand->id) : "" !!}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Certificate Title</label>
                                    <input class="form-control" type="text" value="{!! isset($brand) ? $brand->brand_title : "" !!}" name="brand_title" required/>

                                </div>

                                <div class="mb-3 ">
                                    <label>View Home Page</label>
                                    <select class="form-control" name="is_front" required>
                                        <option value="Y" {!! (isset($brand) ? ($brand->is_front=="Y" ? "Selected" : "" ) : "") !!}>Yes</option>
                                        <option value="N" {!! (isset($brand) ? ($brand->is_front=="N" ? "Selected" : "" ) : "") !!}>No</option>
                                    </select>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 top-label">
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="brand_image" {!! isset($brand) ? "" : "required" !!} placeholder="">
                                    <label>Certificate Image</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{!! isset($brand) ? asset($brand->brand_image) : "https://media.flaticon.com/dist/min/img/collections/collection-tour.svg" !!}" class="img img-thumbnail" id="img-view" style="height: 65px; width: 65px; float: right">
                            </div>
                            <div class="col-md-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit" >Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@stop
@section('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('img-view');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script>
        $(document).on("keyup", "input[name='brand_title']", function(){
            var txtVal = $(this).val();
            txtVal = txtVal.toLowerCase().replace(/\s/g, '-');
            $("input[name='brand_url']").val(txtVal);
        });

    </script>
@stop
