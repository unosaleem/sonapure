@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
@stop
@section('page-title')

@stop
@section('body')
    <div class="header">
        <div class="menu-toggle-btn"> <!-- Menu close button for mobile devices -->
            <a href="#">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <!-- Logo -->
        <a href="index.html" class="logo">
            <img src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo" width="100">
        </a>
        <!-- ./ Logo -->
        <div class="page-title">Customers</div>
        <form class="search-form">
            <div class="input-group">
                <button class="btn btn-outline-light" type="button" id="button-addon1">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" class="form-control" placeholder="Search..." aria-label="Example text with button addon" aria-describedby="button-addon1">
                <a href="#" class="btn btn-outline-light close-header-search-bar">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
        <div class="header-bar ms-auto">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="#notifications">
                        <i class="bi bi-bell icon-lg"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link nav-link-notify" data-count="3" data-bs-toggle="dropdown">
                        <i class="bi bi-cart2 icon-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <h6 class="m-0 px-4 py-3 border-bottom">Shopping Cart</h6>
                        <div class="dropdown-menu-body" style="overflow: hidden; outline: currentcolor none medium;" tabindex="3">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="../../assets/images/products/3.jpg" class="rounded" alt="..." width="60">
                                    </a>
                                    <div>
                                        <h6>Digital clock</h6>
                                        <div>1 x $1.190,90</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="../../assets/images/products/4.jpg" class="rounded" alt="..." width="60">
                                    </a>
                                    <div>
                                        <h6>Toy Car</h6>
                                        <div>1 x $139.58</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="../../assets/images/products/5.jpg" class="rounded" alt="..." width="60">
                                    </a>
                                    <div>
                                        <h6>Sunglasses</h6>
                                        <div>2 x $50,90</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center">
                                    <a href="#" class="text-danger me-3" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" class="me-3 flex-shrink-0 ">
                                        <img src="../../assets/images/products/6.jpg" class="rounded" alt="..." width="60">
                                    </a>
                                    <div>
                                        <h6>Cake</h6>
                                        <div>1 x $10,50</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="m-0 px-4 py-3 border-top small">Sub Total : <strong class="text-primary">$1.442,78</strong></h6>
                        <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr" style="width: 8px; z-index: 1000; cursor: default; position: absolute; top: 0px; left: -8px; height: 0px; display: none;"><div style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;" class="nicescroll-cursors"></div></div><div id="ascrail2002-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 8px; z-index: 1000; top: -8px; left: 0px; position: absolute; cursor: default; display: none;"><div style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;" class="nicescroll-cursors"></div></div></div>
                </li>
                <li class="nav-item ms-3">
                    <button class="btn btn-primary btn-icon">
                        <i class="bi bi-plus-circle"></i> Add Customers
                    </button>
                </li>
            </ul>
        </div>
        <!-- Header mobile buttons -->
        <div class="header-mobile-buttons">
            <a href="#" class="search-bar-btn">
                <i class="bi bi-search"></i>
            </a>
            <a href="#" class="actions-btn">
                <i class="bi bi-three-dots"></i>
            </a>
        </div>
        <!-- ./ Header mobile buttons -->
    </div>
    <div class="card">
        <div class="card-header text-center">
            @include('include.flash-msg')
            Home About
            <button type="button" class="btn btn-sm btn-danger float-right new-package"> + New Video Slider</button>
        </div>
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <td>#</td>
                    <td></td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @if(count($data) !=0)
                    @foreach($data as $key=>$row)
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                                <img src="{!! URL::asset($row->image) !!}" class="img img-colarge" style="height: 75px;"/>
                            </td>

                            <td>{!! $row->title !!}</td>
                            {{--                            <td>{!! $row->sub_title !!}</td>--}}
                            <td>{!! $row->description !!}</td>
                            <td>
                                <span class="badge {!! $row->is_active == '1' ? "badge-success" : "badge-secondary" !!}">{!! $row->is_active == '1' ? "Active" : "Non-Active" !!}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit" data-id="{!! $row->id !!}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="new_package_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Video Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{!! url('admin/shop/new-about-page') !!}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="where[id]" value="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label> Title</label>
                                                <input type="text" class="form-control" id="category_title" name="input[title]" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label>Sub Title</label>
                                                <input type="text" class="form-control" id="category_url" name="input[sub_title]" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3 ">
                                            <label class="">Product Description</label>
                                            <textarea class="form-control editor" rows="7" style="height: 200px;" name="description" id="description" placeholder="Description" required> </textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>youtube Image	1080*1080</label>
                                            <input type="file" id="imgInp" class="form-control" name="image" />
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <script>

        CKEDITOR.replace( 'description', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        $(".new-package").on("click", function(){
            $("#new_package_modal form").trigger("reset");
            $("#new_package_modal input[name='where[id]']").val("");
            $(".modal-title").text("New About");
            $("#new_package_modal").modal("show");
        });

        $(document).on("click", ".edit", function (){
            var id = $(this).data("id");
            $.confirm({
                title: 'What is up?',
                content: 'Are you sure want edit this',
                type: 'green',
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function(){
                            $.get("{!! url('admin/get-single-details') !!}", {'where[id]' : id, 'tab': "about_page"}, function (html){
                                var obj = $.parseJSON(html);
                                if(obj.code == 200){
                                    $("#new_package_modal input[name='where[id]']").val(obj.data['id']);
                                    $("#new_package_modal input[name='input[title]']").val(obj.data['title']);
                                    $("#new_package_modal input[name='input[sub_title]']").val(obj.data['sub_title']);
                                    $("#new_package_modal input[name='input[description]']").val(obj.data['description']);


                                    $("#imgInp").attr("required", false);
                                    $("#imgInp1").attr("required", false);
                                    $("#blah").attr("src", "{!! URL::asset('/') !!}"+obj.data['image'])

                                    $(".modal-title").text("Update Home  About");
                                    $("#new_package_modal").modal("show");
                                }else{
                                    $.alert(obj.msg);
                                    location.reload();
                                }

                            });
                        }
                    },
                    cancel: function(){
                        console.log('the user clicked cancel');
                    }
                }
            });
        });


    </script>
    {{--<script>
        CKEDITOR.replace( 'input[category_long_description]' );
    </script>--}}
@stop