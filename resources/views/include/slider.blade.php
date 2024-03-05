<section class="">
    <div id="myCarousel" class="carousel slide slider-bg" data-ride="carousel">
        <ol class="carousel-indicators">
            @if(count($slider) !=0)
                @foreach($slider as $key=>$row)
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="{!! $key !!}" class="{!! $key == 0 ? "active" : "" !!}"></li>
                    </ol>
                @endforeach
            @endif
            {{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>

            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3" ></li>--}}
            <!--      <li data-target="#myCarousel" data-slide-to="3"></li>-->
        </ol>
        <div class="carousel-inner item-img">
            @if(count($slider) !=0)
                @foreach($slider as $key=>$row)
                    <div class="carousel-item {!! $key == 0 ? "active" : "" !!}">
                        <div class="zoominheader slider-{!! $key !!}">
                            <img src="{!! URL::asset($row->slider_image) !!}" alt="">
                        </div>
                        {{--<h1 class="slider-1-title">Welcome to SONA Pure Essentials</h1>--}}
                    </div>
                @endforeach
            @endif

        </div>
        <div id="pulse-container">
            <div class="item2"> <a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="{!! URL::asset('assets') !!}/Video/sona-video.mp4">
                    <h1><i class="fa fa-play" aria-hidden="true"></i></h1>
                </a> </div>
            <div class="circle" style="animation-delay: -2s"> </div>
            <div class="circle" style="animation-delay: -1s"></div>
            <div class="circle" style="animation-delay: 0s"></div>
        </div>
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <video controls class="sona-video">
                            <source src="{!! URL::asset('assets') !!}/Video/sona-video.mp4" type="video/mp4">
                            <source src="{!! URL::asset('assets') !!}/Video/sona-video.ogg" type="video/ogg">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
