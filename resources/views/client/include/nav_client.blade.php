<div class="col-md-3">
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image:url({!! URL::asset('assets/images/profile-pic-bg.png')!!});"> </div>
        </div>
    </div>
</div>
<div class="col-md-9 top-icon box-border">
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <a href="{!! url('my-profile/order-history') !!}" class="n-margin {!! $profile_nav=="order-history" ? "n-margin-active" : "" !!}">
                <i class="fa fa-list" aria-hidden="true"></i>
                <span class="ico-text">Orders</span>
                <span class="ico-num">{!! isset($order) ? count($order) : "0" !!}</span>
            </a>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">
            <a href="{!! url('my-profile/my-address') !!}" class="n-margin2 {!! $profile_nav == "my-address" ? "n-margin-active" : "" !!}">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="ico-text">Address</span>
                <span class="ico-num">{!! isset($address) ? count($address) : "0" !!}</span>
            </a>
        </div>

        <!-- <div class="col-md-3 col-sm-12 col-xs-12">
            <a href="{!! url('my-profile/my-address') !!}" class="n-margin2 ">
                <i class="fa fa-ticket" aria-hidden="true"></i>
                <span class="ico-text">Tickets</span>
                <span class="ico-num">0</span>
            </a>
        </div> -->

        <div class="col-md-4 col-sm-12 col-xs-12">
            <a href="{!! url('my-profile/profile') !!}" class="n-margin2 {!! $profile_nav == "profile" ? "n-margin-active" : "" !!}">
                <i class="fa fa-user" aria-hidden="true"></i> <span class="ico-text">Profile Update </span> <span class="ico-num"></span>
            </a>
        </div>
    </div>
</div>
