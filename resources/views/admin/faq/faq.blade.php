@extends('admin.layout.admin_layout')
@section('css')
    <style>
        div#datatable_wrapper {
            margin: 24px 12px;
        }

        .dataTables_wrapper {
            margin-top: 10px;
        }
    </style>
@stop
@section('page_title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">ADD Product FAQ</h4>
            </div>
        </div>
    </div>
@stop
@section('body')

    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{!! url('admin/shop/product-faq') !!}" enctype="multipart/form-data">
                <input type="hidden" class="form-control" value="{!! $product_id !!}" name="product_id" required/>
                {!! csrf_field() !!}

                <div class="row pt-2 " id="div_response">
                    <div class="col-md-12 pt-2 div" id="div_0">
                        <div class="card">
                            <div class="card-body pt-2">
                                <div class="row pt-2">
                                    <div class="col-md-8">
                                        <h5>Add Product FAQ </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-info addNewRow" style="float: right"><i class="fas fa-plus ri-add-box-line"></i> Add More</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label id="name">Question * </label>
                                        <input type="text" class="form-control" data-id="0" name="input[0][question]"
                                               required/>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="Answer">Answer * </label>
                                        <textarea class="form-control editor" rows="3" name="input[0][answer]"
                                                  id="our_story"
                                                  placeholder="Our Answer">{!! (isset($faq) ? $product->answer  : "") !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 pt-2  div" id="div_1">
                        <div class="card">
                            <div class="card-body pt-2">
                                <div class="row pt-2">
                                    <div class="col-md-8">
                                        <h5>Add Product FAQ </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger" data-id="1" style="float: right"><i
                                                    class="ri-delete-bin-line"></i> Delete
                                        </button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label id="name">Question * </label>
                                        <input type="text" class="form-control" data-id="0" name="input[1][question]"
                                               required/>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="name">Answer * </label>
                                        <textarea class="form-control editor" rows="3" name="input[1][answer]"
                                                  id="our_story"
                                                  placeholder="Our Story">{!! (isset($faq) ? $product->answer  : "") !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center pt-2">
                        <button type="submit" class="btn btn-lg btn-success">Insert New Product FAQ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-5">
                <div class="card" id="orderList">
                    <div class="card-header">
                        <h5>List Product Faq</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            @if(count($data) !=0)
                                <div class="table-responsive table-card mb-1">
                                    <table id="datatable"
                                           class="table table-bordered text-nowrap key-buttons table-nowrap align-middle border-bottom">
                                        <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th data-sort="center">Question</th>
                                            <th data-sort="center">Answer</th>
                                            <th data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @foreach($data as $key=>$row)
                                            <tr>
                                                <td>{!! $key+1 !!}</td>

                                                <td class="contact_number">{!! $row->question !!}</td>
                                                <td class="center">{!! ucfirst($row->answer) !!}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary  remove-item-btn"
                                                       data-id="{!! base64_encode($row->id) !!}" data-status="2"
                                                       href="javascript:void(0)"
                                                       style="background: #df3f1d;border-color: #ff7e7e;">
                                                        <i class="fas fa-trash ri-delete-bin-line"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                {{--<div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        @if(count($member) !=0)
                                            {!! $data->links() !!}
                                        @endif
                                    </div>
                                </div>--}}

                                <!-- Modal -->
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="{!! url()->current() !!}" trigger="loop"
                                                   colors="primary:#405189,secondary:#0ab39c"
                                                   style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted">We've searched more than 150+ Orders We did not find any
                                            orders for you search.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>

@stop
@section('script-src')

    <script src="{!! URL::asset('assets/libs/list.js/list.min.js') !!}"></script>

    <!--list pagination js-->
    <script src="{!! URL::asset('assets/libs/list.pagination.js/list.pagination.min.js') !!}"></script>

    <!-- ecommerce-order init js -->
    <script src="{!! URL::asset('assets/js/pages/ecommerce-order.init.js') !!}"></script>

    <!-- Sweet Alerts js -->
    <script src="{!! URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') !!}"></script>
@stop
@section('script')
    <script>
        $(document).on("click", ".addNewRow", function () {
            let div = '';
            let length = $("div#div_response .div").length;
            div = '<div class="col-md-12 mt-2 pt-2 div" id="div_'+ length + '">'+
                    '<div class="card">'+
                        '<div class="card-body pt-2">'+
                            '<div class="row pt-2">'+
                                '<div class="col-md-8">'+
                                    '<h5>Add Product FAQ </h5>'+
                                '</div>'+
                                '<div class="col-md-4" >'+
                                    '<button type="button" class="btn btn-danger" data-id="'+ length + '" style="float: right "><i class="ri-delete-bin-line"></i> Delete</button>'+
                                '</div>'+
                            '</div>'+
                            '<hr/>'+
                            '<div class="row">'+
                                '<div class="col-md-12">'+
                                    '<label id="name">Question * </label>'+
                                    '<input type="text" class="form-control" data-id="0" name="input['+ length + '][question]" required/>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                    '<label id="Answer">Answer * </label>'+
                                    '<textarea class="form-control editor" rows="3" name="input['+ length + '][answer]" id="our_story" placeholder="Our Answer"></textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            $(div).insertAfter("div#div_response .div:last");
        });

        $(document).on("click", ".btn-danger", function () {
            let id = $(this).data("id");
            $("#div_" + id).remove();
        });


    </script>
    <script>
        $(document).on("click", ".remove-item-btn", function () {
            var id = $(this).data("id"), status = $(this).data("status");
            $.confirm({
                title: 'Confirm!',
                content: 'Are sure confirm delete this!',
                buttons: {
                    yes: {
                        text: 'Yes',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function () {
                            $.post("{!! url('helper/delete-single-row') !!}", {
                                'id': id,
                                "_token": "{!! csrf_token() !!}",
                                "tab": "faq",
                                "data[is_active]": status
                            }, function (html) {
                                var obj = $.parseJSON(html);
                                if (obj.code == 200) {
                                    $.dialog({
                                        title: 'Success !',
                                        type: "green",
                                        content: obj.msg,
                                    });
                                } else {
                                    $.dialog({
                                        title: 'Error !',
                                        type: "red",
                                        content: obj.msg,
                                    });
                                }
                                setInterval(function () {
                                    location.reload()
                                }, 3000);
                            });
                        }
                    },
                    no: {
                        text: 'No',
                        btnClass: 'btn-danger',
                        action: function () {
                            $.alert('You clicked no.');
                        }
                    }
                }
            });
        });
    </script>

@stop
