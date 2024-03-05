@extends('admin.layout.admin_layout')
@section('css')

@stop
@section('page-title')

@stop
@section('body')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card mb-5">
                <div class="card-body">
                    @include('admin.include.flash-msg')
                    <form method="post" enctype="multipart/form-data" action="{!! url('admin/shop/new-testimonial') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="where[id]" value="{!! isset($testimonial) ? base64_encode($testimonial->id) : "" !!}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Full Nmae</label>
                                    <input class="form-control" type="text" value="{!! isset($testimonial) ? $testimonial->name : "" !!}" placeholder="Name" name="input[name]" required/>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 top-label">
                                    <label>Designation</label>
                                    <input class="form-control" type="text" value="{!! isset($testimonial) ? $testimonial->designation : "" !!}" name="input[designation]" placeholder="Bussness Man">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 top-label">
                                    <label>Youtube Last Code</label>
                                    <input class="form-control" type="text" value="{!! isset($testimonial) ? $testimonial->via : "" !!}" name="input[via]" placeholder="google">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label>Client Image 64px*64px</label>
                                    <input accept="image/*" onchange="loadFile(event)" class="form-control" type="file" id="img-src" name="image" {!! isset($testimonial) ? "" : "required" !!} placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <img src="{!! isset($testimonial) ? asset($testimonial->image) : "https://media.flaticon.com/dist/min/img/collections/collection-tour.svg" !!}" class="img img-thumbnail" id="img-view" style="height: 200px; width: 200px; margin: 10px auto;">
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3 ">
                                    <label class="">Testimonial Message </label>
                                    <textarea class="form-control" rows="7" style="height: 200px;" name="input[message]" id="message" placeholder="testimonial message" required>{!! (isset($testimonial) ? $testimonial->message  : "") !!}</textarea>

                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit" >Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@stop
@section('js')

    <script>
        //Check File API support
        if(window.File && window.FileList && window.FileReader)
        {
            var filesInput = document.getElementById("img-src2");

            filesInput.addEventListener("change", function(event){

                var files = event.target.files; //FileList object
                var output = document.getElementById("result");

                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];

                    //Only pics
                    if(!file.type.match('image'))
                        continue;

                    var picReader = new FileReader();

                    picReader.addEventListener("load",function(event){

                        var picFile = event.target;

                        var div = document.createElement("div");

                        div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                            "title='" + picFile.name + "'/>";

                        output.insertBefore(div,null);

                    });

                    //Read the image
                    picReader.readAsDataURL(file);
                }

            });
        }
        else
        {
            console.log("Your browser does not support File API");
        }

        var loadFile = function(event) {
            var output = document.getElementById('img-view');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>

@stop
