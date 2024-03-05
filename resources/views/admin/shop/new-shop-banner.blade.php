@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/glide.core.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/introjs.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/select2-bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin') !!}/css/vendor/bootstrap-datepicker3.standalone.min.css">
@stop
@section('page-title')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{!! isset($category) ? "Update" : "New" !!} Banner </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{!! url('admin/shop/shop-banner') !!}">All Banner</a></li>
                        <li class="breadcrumb-item active">New Banner</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

@stop
@section('body')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card mb-5">
                <div class="card-body">
                    @include('admin.include.flash-msg')
                    <form class="row align-items-center" method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-banner') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($banner) ? base64_encode($banner->id) : "" !!}">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="mb-3 top-label w-100">
                                        <input class="form-control" type="text" value="{!! isset($banner) ? $banner->banner_title : "" !!}" name="input[banner_title]" required/>
                                        <span>Banner Redirect Link</span>
                                    </label>
                                </div>

                                {{--<div class="col-md-12">
                                    <label class="form-label">select Date Range</label>
                                    <div class="input-daterange input-group" id="datePickerRange">
                                        <input type="text" class="form-control" value="{!! isset($banner) ? $banner->start_date : "" !!}" name="input[start_date]" placeholder="Start Date">
                                        <span class="mx-2"></span>
                                        <input type="text" class="form-control" value="{!! isset($banner) ? $banner->end_date : "" !!}" name="input[end_date]" placeholder="End Date">
                                    </div>
                                </div>--}}

                                <div class="col-md-12">
                                    <label class="mb-3 mt-3 top-label w-100">
                                        <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="banner_url" {!! isset($banner) ? "" : "required" !!} placeholder="">
                                        <span>Bannner Image 1903W *414H</span>
                                    </label>
                                </div>

                                <div class="col-md-12" style="text-align: center">
                                    <button class="btn btn-primary" type="submit" >Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img src="{!! isset($banner) ? asset($banner->banner_url) : "https://media.flaticon.com/dist/min/img/collections/collection-tour.svg" !!}" class="img img-thumbnail" style="width: 100%; height:300px; object-fit: contain" id="img-view" >
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@stop
@section('js')
    <script src="{!! URL::asset('assets') !!}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{!! URL::asset('assets') !!}/js/vendor/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="{!! URL::asset('assets') !!}/js/forms/controls.datepicker.js"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('img-view');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

@stop
