@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Heath Box Gallery</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('admin/shop/shop-healthbox') !!}">List Health Box</a></li>

                        <li class="breadcrumb-item active">Heath Box Gallery</li>
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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Add Gallery Images</h6>
                            <span class="text-danger"> image size upload with <span class="text-success">269w * 332h</span> and max <span class="text-success">file-size = 1mb</span></span>
                        </div>
                        <div class="col-md-4">
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning add_gallery_click" style="float: right">+ Add </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.include.flash-msg')
                    <form method="post" action="{!! url('admin/shop/shop-healthbox-gallery') !!}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" name="product_id" value="{!! $product_id !!}">
                        <div class="row clearfix" id="add_gallery_div">
                            <div class="col-md-4">
                                <img id="imag_view_0" src="https://st2.depositphotos.com/1561359/5358/v/380/depositphotos_53581711-stock-illustration-blank-box-product.jpg?forcejpeg=true" class="" style = "height: 150px; width: 90%">
                                <input type="file" name="gallery_pic[]" data-id="0" class="image" required />
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="row">
                @if(count($data)!=0)
                    @foreach($data as $key=>$row)
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid" style="padding: 0">
                                <div class="product-image">
                                    <img class="pic-1" src="{!! asset($row->image_url) !!}" style="height: 200px !important;">
                                    <ul class="social" style="list-style:none">
                                        <li>
                                            <a href="javascript:void(0)" data-id="{!! $row->id !!}" class="btn btn-sm btn-danger changeStatus" data-tip="Remove">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@stop
@section('script-function')
    <script type="application/javascript">
        $(document).on("click", ".changeStatus", function(){
            var id= $(this).data("id"), status = '2';
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do you want ?',
                buttons: {
                    Confirm: {
                        btnClass: 'btn-blue done',
                        action: function(){
                            $.post("{!! url('admin/shop/update-status') !!}", {'where[id]': id, 'input[is_active]': status, 'tab': "healthbox_gallery", '_token': "{!! csrf_token() !!}"}, function(html){
                                var obj = $.parseJSON(html);
                                if(obj.code == 200){
                                    $.alert(obj.msg);
                                    setInterval(function(){ location.reload(); }, 3000);
                                }else{
                                    $.alert(obj.msg);
                                }
                            });

                        }
                    },
                    Cancel: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.alert("You click cancel.");
                        }
                    },
                }
            });
        });


        $(document).on("click", ".add_gallery_click", function(){
            var length= 0, div = '';
            length = $(".row#add_gallery_div .col-md-4").length;
            div +='<div class="col-md-4">'+
                    '<img id="imag_view_'+length+'" src="https://st2.depositphotos.com/1561359/5358/v/380/depositphotos_53581711-stock-illustration-blank-box-product.jpg?forcejpeg=true" class="" style = "height: 150px; width: 90%">'+
                    '<input type="file" name="gallery_pic[]" data-id="'+length+'"   class="image" >'+
                  '</div>';
            $(div).insertAfter(".row#add_gallery_div .col-md-4:last");
        });



        $(document).on("change", ".image", function(){
            len = $(this).data("id");
            document.getElementById('imag_view_'+len).src = window.URL.createObjectURL(this.files[0])

        });




    </script>
@stop
