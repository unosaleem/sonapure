@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Update Product Gallery </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Event Management</a></li>
                        <li class="breadcrumb-item"><a href="{!! url('admin/shop/new-event') !!}">All Event </a></li>
                        <li class="breadcrumb-item active">Update Event Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('body')
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Add Gallery Images</h6>
                            <span class="text-danger"> image size upload with <span class="text-success">1080w * 1080h</span> and max <span class="text-success">file-size = 1mb</span></span>
                        </div>
                       {{-- <div class="col-md-4">
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning add_gallery_click" style="float: right">+ Add </a>
                        </div>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.include.flash-msg')
                    <form method="post" action="{!! url('admin/shop/shop-event-gallery') !!}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" name="event_id" value="{!! $event_id !!}">
                        <div class="row clearfix" id="add_gallery_div">
                            <div class="col-md-4">
                                <img id="imag_view_0" src="https://st2.depositphotos.com/1561359/5358/v/380/depositphotos_53581711-stock-illustration-blank-box-product.jpg?forcejpeg=true" class="" style = "height: 150px; width: 90%">
                                <input type="file" name="image[]" data-id="0" class="image" required multiple />
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Upload Image</button>
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
                        <div class="col-md-2 col-sm-6 p-3">
                            <div class="shadow">
                                <img class="pic-1 img img-thumbnail img-rounded" src="{!! asset($row->image) !!}" width="100%">
                                <a href="javascript:void(0)" data-id="{!! $row->id !!}" class="btn btn-sm btn-danger changeStatus w-100"  data-tip="Remove">
                                    <i class="ri-delete-bin-line"></i> Removed
                                </a>
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
                            $.post("{!! url('admin/shop/update-status') !!}", {'where[id]': id, 'input[is_active]': status, 'tab': "event_media", '_token': "{!! csrf_token() !!}"}, function(html){
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
