@extends('admin.layout.admin_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
@stop
@section('page-title')

@stop
@section('body')
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
                            <form method="post" action="{!! url('admin/new-about-page') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" name="where[id]" value="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Title</label>
                                            <input type="text" class="form-control" id="category_title" name="input[title]" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sub Title</label>
                                            <input type="text" class="form-control" id="category_url" name="input[sub_title]" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control" id="category_icon" name="input[description]" required/>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>youtube Image	1080*1080</label>
                                            <input type="file" id="imgInp" class="form-control" name="image" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <img id="blah" src="{!! URL::asset('assets/images/logo.webp') !!}" style="width:100%;object-fitt:cover;height:300px" class="img img-thumbnail" />
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        {{--                                        <button type="reset" class="btn btn-warning">Reset</button>--}}
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
    <script type="text/javascript">


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

    </script>
    <script>
        $(".new-package").on("click", function(){
            $("#new_package_modal form").trigger("reset");
            $("#new_package_modal input[name='where[id]']").val("");
            $(".modal-title").text("New Slider");
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