@extends('admin.layout.admin_layout')
@section('style')

@stop
@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product Size</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">Product Size</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
@stop

@section('body')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Product Sizes
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Size</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data))
                            @foreach($data as $key=>$row)
                                <tr>
                                    <td>{!! $key+1 !!}.</td>
                                    <td>{!! $row->size_title !!}</td>
                                    <td>
                                        <span class="badge {!! $row->is_active == '1' ? "bg-primary" : "bg-light text-dark" !!}">{!! $row->is_active == '1' ? "active" : "non-active" !!}</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-title="{!! $row->size_title !!}"  class="btn btn-sm btn-primary edit-size" data-toggel="tooltip"  data-tilte="edit" style="margin-right: 10px;">
                                            <i class="ri-pen-nib-line"></i>
                                        </a>
                                        @if($row->is_active == '2')
                                            <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-status="1" class="btn btn-sm btn-warning active_size" >
                                                <i class="ri-check-double-line"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" data-id="{!! $row->id !!}" data-status="2" class="btn btn-sm btn-danger active_size">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card" id="formAddSize">
                <div class="card-header">
                    Add Size Details
                </div>
                <div class="card-body" >
                    @include('admin.include.flash-msg')
                    <form method="post" action="{!! url('admin/shop/shop-product-size') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" />
                        <div class="form-group">
                            <label>Size Title</label>
                            <input type="text" class="form-control" name="size_title" required/>
                        </div><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script-function')
    <script>
        $(document).on("click", ".edit-size", function(){
            var id = $(this).data("id"), title = $(this).data("title");
            $("#formAddSize .card-header").text("Update Size Details");
            $("#formAddSize .card-body input[name='where[id]']").val(id);
            $("#formAddSize .card-body input[name='size_title']").val(title);
        });
        $(document).on("click", ".active_size", function(){
            var id = $(this).data("id"), status = $(this).data("status");
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do u want '+(status == '1' ? "active" : "Non-Active")+' this size',
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
                                'tab': "size",
                                'title': 'Size',
                                '_token': "{!! csrf_token() !!}"
                            }, function (html) {
                                var obj = $.parseJSON(html);
                                $.alert(obj.msg);
                                setInterval(function () { location.reload(); }, 3000);
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
        });

        $(document).on("click", ".ok", function (){
            location.reload()
        });

    </script>

@stop
