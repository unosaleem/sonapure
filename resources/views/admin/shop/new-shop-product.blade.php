@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">New Product </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">New Product</li>
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
            <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-product') !!}">
                <div class="card mb-5">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="where[id]" value="{!! isset($product) ? base64_encode($product->id) : "" !!}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="ProductIndex" class="form-label">Product Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option>Select Category</option>
                                        @foreach($category as $row)
                                            <option value="{!! $row->id !!}" {!! (isset($product) ? ($product->category_id==$row->id ? "Selected" : "" ) : "") !!}>{!! ucfirst($row->category_title_eng) !!}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Tags <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_tag : "" !!}" name="product_tag" required/>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Name (English) <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_title : "" !!}" name="product_title" required/>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Name (Hindi) <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_hindi_title : "" !!}" name="product_hindi_title" required/>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Url <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_url : "" !!}" name="product_url" required placeholder="">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">SKU Number <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->sku_number : 'SPE'.$last_id !!}" name="sku_number" required readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label for="ProductIndex" class="form-label">Product Index</label>
                                    <select class="form-control" name="is_front" required>
                                        <option value="1" {!! (isset($product) ? ($product->is_front=="1" ? "Selected" : "" ) : "") !!}>Yes</option>
                                        <option value="2" {!! (isset($product) ? ($product->is_front=="2" ? "Selected" : "" ) : "") !!}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label class="form-label">Price Color</label>
                                    <input class="form-control" type="color" value="{!! isset($product) ? $product->background_color : "" !!}" name="background_color" style="height: 44px;width: 100%" required/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label class="form-label">Title Color</label>
                                    <input class="form-control" type="color" value="{!! isset($product) ? $product->font_color : "" !!}" name="font_color" style="height: 44px;width: 100%" required/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label class="form-label">Batch No.</label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->batch_no : "" !!}" name="batch_no" style="height: 44px;width: 100%" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label class="form-label">Collected At.</label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->collected_at : "" !!}" name="collected_at" style="height: 44px;width: 100%" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label class="form-label">Source of Extraction <span style="color:red">*</span></label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="product_properties" id="product_properties" placeholder="Product Properties" required>{!! (isset($product) ? $product->product_properties  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Features</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="features" id="features" placeholder="features">{!! (isset($product) ? $product->features  : "") !!}</textarea>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Health  Benefits</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="health_benefits" id="health_benefits" placeholder="Health  Benefits" >{!! (isset($product) ? $product->health_benefits  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Nutritional Facts</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="nutritional_facts" id="nutritional_facts" placeholder="Nutritional Facts" >{!! (isset($product) ? $product->health_benefits  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Storage Instructions</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="storage_instructions" id="storage_instructions" placeholder="Storage Instructions" >{!! (isset($product) ? $product->storage_instructions  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Our Story</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="our_story" id="our_story" placeholder="Our Story">{!! (isset($product) ? $product->our_story  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Interesting Facts</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="interesting_facts" id="interesting_facts" placeholder="Interesting Facts">{!! (isset($product) ? $product->interesting_facts  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>About</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="about" id="about" placeholder="about">{!! (isset($product) ? $product->about  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Product Image W-269px * H-332px Max File Size 500kb  <span style="color:red">*</span></label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="product_image" {!! isset($product) ? "" : "required" !!} placeholder="">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Menu image W-1600px * H-576px  Max File Size 500kb <span style="color:red">*</span></label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src1" name="product_banner_image" {!! isset($product) ? "" : "required" !!} placeholder="">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Gallery Image W-269px * H-332px  Max File Size 500kb  <span style="color:red">*</span></label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src2"  name="gallery_pic[]" {!! isset($product) ? "" : "required" !!} placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Breadcrumbs Image 1903px *327px</label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src1" name="header_background_banner" {!! isset($product) ? "" : "required" !!} placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="price_table">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Price  <span style="color:red">*</span></td>
                                                <td>Selling Price  <span style="color:red">*</span></td>
                                                <td>Size  <span style="color:red">*</span></td>
                                                <td><button type="button" class="btn btn-sm btn-info add-row">+</button></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="div_0">
                                                <td>1. </td>
                                                <td>
                                                    <input type="text" name="product_price[0][price]" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="product_price[0][selling_price]" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <select name="product_price[0][size]" class="form-control" required>
                                                        <option value="">Select Size</option>
                                                        @if(count($size) != 0)
                                                            @foreach($size as $row)
                                                                <option value="{!! $row->size_title !!}">{!! $row->size_title !!}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center">
                    <button class="btn btn-primary" type="submit" >Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('script')
    <!-- Javascript -->

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@stop
@section('script-function')

    <script>
        CKEDITOR.replace( 'product_properties', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'product_properties', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'features', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'health_benefits', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'nutritional_facts', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'storage_instructions', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'our_story', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace( 'interesting_facts', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'about', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        $(document).on("keyup", "input[name='product_title']", function(){
            var txtVal = $(this).val();
            txtVal = txtVal.toLowerCase().replace(/\s/g, '-');
            $("input[name='product_url']").val(txtVal);
        });

        function add_row(){
            var length = $("#price_table tbody tr").length;
            var new_length = length+1;
            var div = '';
            div = '<tr id="div_'+new_length+'"> ' +
                    '<td>'+new_length+'. </td>'+
                    '<td>'+
                        '<input type="text" name="product_price['+(new_length-1)+'][price]" class="form-control" required/>'+
                    '</td>'+
                '<td>'+
                '<input type="text" name="product_price['+(new_length-1)+'][selling_price]" class="form-control" required/>'+
                '</td>'+
                    '<td>'+
                        '<select name="product_price['+(new_length-1)+'][size]" class="form-control" required>'+
                            '<option value="">Select Size</option>';
                            @if(count($size) != 0)
                                @foreach($size as $row)
                                div +='<option value="{!! $row->size_title !!}">{!! $row->size_title !!}</option>';
                                @endforeach
                            @endif
                        div +='</select>'+
                    '</td>'+
                    '<td>' +
                        '<a href="javascript:void(0)" class="btn btn-sm btn-warning remove" data-id="'+new_length+'"><i class="ri-close-line"></i></a>'+
                    '</td>'+
                  '</tr>';
            $(div).insertAfter("#price_table tbody tr:last");
        }

        $(document).on("click", ".remove", function(){
            var id = $(this).data("id");
            console.log("hello");
            $("#div_"+id).remove();
        });

        $(document).on("click", ".add-row", function(){
            add_row();
        });

    </script>
@stop
