@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin/css/vendor/select2-bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('assets-admin') !!}/css/vendor/bootstrap-datepicker3.standalone.min.css">
@stop
@section('page-title')
    <div class="page-title-container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h1 class="mb-0 pb-0 display-4" id="title">{!! isset($offers) ? "Update" : "New" !!} Slider</h1>
                <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                    <ul class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('admin/shop/shop-offers') !!}">All Slider</a></li>
                    </ul>
                </nav>
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
                    @include('admin.include.flash-msg')
                    <form class="row" method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-offers') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($offers) ? base64_encode($offers->id) : "" !!}">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="mb-3 top-label">
                                        <input class="form-control" type="text" value="{!! isset($offers) ? $offers->offer_title : "" !!}" name="input[offer_title]" required/>
                                        <span>Offer Title</span>
                                    </label>

                                </div>
                                <div class="col-md-7">
                                    <label class="mb-3 top-label">
                                        <input class="form-control" type="text" value="{!! isset($offers) ? $offers->offer_url : "" !!}" name="input[offer_url]" required/>
                                        <span>Offer Url</span>
                                    </label>

                                </div>
                                <div class="col-md-5">
                                    <label class="mb-3 top-label">
                                        <input class="form-control" type="text" value="{!! isset($offers) ? $offers->offer_discount : "" !!}" name="input[offer_discount]" required/>
                                        <span>Offer Discount</span>
                                    </label>

                                </div>
                                <div class="col-md-5">
                                    <label class="mb-3 top-label">
                                            <select class="form-control" name="input[discount_type]" required>
                                                <option value="R" {!! (isset($offers) ? ($offers->is_front=="R" ? "Selected" : "" ) : "") !!}> Rupee</option>
                                                <option value="P" {!! (isset($offers) ? ($offers->is_front=="P" ? "Selected" : "" ) : "") !!}> Percentage</option>
                                            </select>
                                        </select>
                                        <span>Discount Type</span>
                                    </label>

                                </div>
                                <div class="col-md-7">
                                    <label class="mb-3 top-label">
                                        <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="offer_image" {!! isset($offers) ? "" : "required" !!} placeholder="">
                                        <span>Offer Image 597W *260H</span>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">select Date Range</label>
                                    <div class="input-daterange input-group mb-3" id="datePickerRange">
                                        <input type="text" class="form-control" value="{!! isset($offers) ? $offers->start_date : "" !!}" name="input[start_date]" placeholder="Start Date">
                                        <span class="mx-2"></span>
                                        <input type="text" class="form-control" value="{!! isset($offers) ? $offers->end_date : "" !!}" name="input[end_date]" placeholder="End Date">
                                    </div>
                                </div>


                                <div class="col-md-12" style="text-align: center">
                                    <button class="btn btn-primary" type="submit" >Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img src="{!! isset($offers) ? asset($offers->offer_image) : "https://media.flaticon.com/dist/min/img/collections/collection-tour.svg" !!}" class="img img-thumbnail" style="width: 100%; height:300px; object-fit: contain" id="img-view" >
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
        $(document).on("keyup", "input[name='input[offer_title]']", function(){
            var txtVal = $(this).val();
            txtVal = txtVal.toLowerCase().replace(/\s/g, '-');
            $("input[name='input[offer_url]']").val(txtVal);
        });

    </script>
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
