@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="{!! URL::asset('assets-admin') !!}/libs/dropzone/dropzone.css" type="text/css">
@stop
@section('page-title')

@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <h4 class="card-title">
                Add Product
            </h4>
            @include('admin.include.flash-msg')
            <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-combo-product') !!}">
                <div class="card mb-5">
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($product) ? base64_encode($product->id) : "" !!}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Tags <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_tag : "" !!}" name="product_tag" />

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
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_hindi_title : "" !!}" name="product_hindi_title" />

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Url <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->product_url : "" !!}" name="product_url" required placeholder="">

                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">SKU Number</label>
                                    <input class="form-control text-center" type="text" value="SPECP{!! isset($product) ? $product->sku_number : $last_id !!}" name="sku_number"  readonly style="padding: 6px;height: 44px;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Price</label>
                                            <input class="form-control" type="text" value="{!! isset($product) ? $product->price : $last_id !!}" name="price" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Selling Price</label>
                                            <input class="form-control" type="text" value="{!! isset($product) ? $product->selling_price : $last_id !!}" name="selling_price" required>
                                        </div>
                                    </div>
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
                                    <label class="form-label">BG Color</label>
                                    <input class="form-control" type="color" value="{!! isset($product) ? $product->background_color : "" !!}" name="background_color" style="height: 44px;width: 100%" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label class="form-label">Font Color</label>
                                    <input class="form-control" type="color" value="{!! isset($product) ? $product->font_color : "" !!}" name="font_color" style="height: 44px;width: 100%" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 ">
                                    <label class="form-label">Batch No.</label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->batch_no : "" !!}" name="batch_no" style="height: 44px;width: 100%" />
                                </div>
                            </div>
                            {{--<div class="col-md-4">
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label">Product Tag Title</label>
                                    <input class="form-control" type="text" value="{!! isset($product) ? $product->tag : "" !!}" name="tag" required/>

                                </div>
                            </div>--}}

                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label class="form-label">Product Properties</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="product_properties" id="product_properties" placeholder="Product Properties" >{!! (isset($product) ? $product->product_properties  : "") !!}</textarea>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label>Interesting Facts</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="interesting_facts" id="interesting_facts" placeholder="Interesting Facts" >{!! (isset($product) ? $product->interesting_facts  : "") !!}</textarea>

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
                                    <label>Storage Instructions</label>
                                    <textarea class="form-control editor" rows="7" style="height: 200px;" name="storage_instructions" id="storage_instructions" placeholder="Storage Instructions" >{!! (isset($product) ? $product->storage_instructions  : "") !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 ">
                                    <label>Product Image 390px * 293px</label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="product_image" {!! isset($product) ? "" : "required" !!} placeholder="">

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
@section('js')
    <!-- Javascript -->
    <script src="{!! URL::asset('assets-admin') !!}/libs/dropzone/dropzone.js"></script>
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <script>

        CKEDITOR.replace( 'product_properties', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'interesting_facts', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'health_benefits', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'storage_instructions', {
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

    </script>
@stop
