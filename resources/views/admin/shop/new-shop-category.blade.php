@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{!! isset($category) ? "Update" : "New" !!} Category </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('/admin/shop/all-category') !!}">All Category</a></li>
                        <li class="breadcrumb-item active">New Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop
@section('body')
    <div class="row">

        <div class="col-md-12">
            @include('admin.include.flash-msg')
            <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-category') !!}">
                        <div class="card mb-5">
                            <div class="card-body">
                                @csrf
                                <input type="hidden" name="where[id]" value="{!! isset($category) ? base64_encode($category->id) : "" !!}">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3 ">
                                                    <label for="exampleInputPassword1" class="form-label">Category Title <span style="color:red">*</span></label>
                                                    <input class="form-control" type="text" id="title" value="{!! isset($category) ? $category->category_title_eng : "" !!}" name="category_title_eng" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 ">
                                                    <label for="exampleInputPassword1" class="form-label">Category URL <span style="color:red">*</span></label>
                                                    <input class="form-control" type="text"   value="{!! isset($category) ? $category->category_url : "" !!}" name="category_url" required/>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 ">
                                                    <label>Image W-272px * H-450px Max File Size 500kb  <span style="color:red">*</span></label>
                                                    <input accept="image/*" onchange="loadFile(event, 'img-view')" class="form-control" type="file" id="img-src-1" name="category_image" {!! isset($category) ? "" : "required" !!} placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="mb-3 ">
                                                    <label for="exampleInputPassword1" class="form-label">Product Target URL Header <span style="color:red">*</span></label>
                                                    <input class="form-control" type="text" value="{!! isset($category) ? $category->product_url : "" !!}" name="product_url" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3 ">
                                                    <label>Header Image W-1190px * H-258px Max File Size 500kb  <span style="color:red">*</span></label>
                                                    <input accept="image/*" onchange="loadFile(event, 'img-views')" class="form-control" type="file" id="img-src-2" name="banner_images" {!! isset($category) ? "" : "required" !!} placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 ">
                                                    <label> Image <span style="color:red"></span></label>
                                                    <img src="{!! isset($category) ? asset($category->category_image) : asset('assets/images/green-logo.png') !!}" id="img-view" width="100%" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 ">
                                                    <label> Image <span style="color:red"></span></label>
                                                    <img src="{!! isset($category) ? asset($category->banner_images) : asset('assets/images/green-logo.png') !!}" id="img-views" width="100%" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="text-align: center">
                                        <button class="btn btn-primary" type="submit" >Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>

        </div>
        <div class="col-md-3"></div>
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
