@extends('admin.layout.admin_layout')
@section('css')
@stop
@section('page-title')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{!! isset($category) ? "Update" : "New" !!} Event </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{!! url('admin/shop/shop-event') !!}">All Event</a></li>
                        <li class="breadcrumb-item active">New Event</li>
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
                    <form class="row align-items-center" method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-event') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($event) ? base64_encode($event->id) : "" !!}">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="mb-3 top-label w-100">
                                        <input class="form-control" type="text" id="title" value="{!! isset($event) ? $event->title : "" !!}" name="input[title]" required/>
                                        <span>Event Title</span>
                                    </label>
                                </div>
                                <div class="col-md-7">
                                    <label class="mb-3 top-label w-100">
                                        <input class="form-control" type="text" id="url" value="{!! isset($event) ? $event->event_url : "" !!}" name="input[event_url]" required/>
                                        <span>Event URL</span>
                                    </label>
                                </div>

                                {{--<div class="col-md-12">
                                    <label class="form-label">select Date Range</label>
                                    <div class="input-daterange input-group" id="datePickerRange">
                                        <input type="text" class="form-control" value="{!! isset($event) ? $event->start_date : "" !!}" name="input[start_date]" placeholder="Start Date">
                                        <span class="mx-2"></span>
                                        <input type="text" class="form-control" value="{!! isset($event) ? $event->end_date : "" !!}" name="input[end_date]" placeholder="End Date">
                                    </div>
                                </div>--}}

                                <div class="col-md-6">
                                    <label class="mb-3 mt-3 top-label w-100">
                                        <input accept="image/*" onchange="loadFile(event, 'img-view')" class="form-control" type="file" id="img-src-1" name="image" {!! isset($event) ? "" : "required" !!} placeholder="">
                                        <span>Event Image 1080W * 1080H</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-3 mt-3 top-label w-100">
                                        <input accept="image/*" onchange="loadFile(event, 'img-views')" class="form-control" type="file" id="img-src-2" name="banner_image" {!! isset($event) ? "" : "required" !!} placeholder="">
                                        <span>Banner Image 1903W * 327H</span>
                                    </label>
                                </div>

                                <div class="col-md-12" style="text-align: center">
                                    <button class="btn btn-primary" type="submit" >Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <label> Image <span style="color:red"></span></label>
                                        <img src="{!! isset($event) ? asset($event->image) : asset('assets/images/green-logo.png') !!}" id="img-view" width="100%" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <label> Image <span style="color:red"></span></label>
                                        <img src="{!! isset($event) ? asset($event->banner_image) : asset('assets/images/green-logo.png') !!}" id="img-views" width="100%" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@stop
@section('script-function')
    <script>
        function loadFile(event, imgId) {
            const image = document.getElementById(imgId);
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <script>
        // Get references to the input fields
        const titleInput = document.getElementById('title');
        const urlInput = document.getElementById('url');
        // Add an event listener to the title input field
        titleInput.addEventListener('input', function () {
            // Get the value of the title input
            const inputValue = titleInput.value;
            // Convert to lowercase, replace spaces and symbols with '-'
            const urlValue = inputValue.toLowerCase().replace(/[^a-z0-9]+/g, '-');
            // Set the value of the url input
            urlInput.value = urlValue;
        });
    </script>
@stop
