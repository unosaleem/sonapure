@extends('layout.home_master')
@section('css')
<link type="text/css" rel="stylesheet" href="{!! asset('assets') !!}/css/payment-style.css">
@stop
@section('body')
    <div class="inner-grid"></div>
    <section class="pay-grid">
        <div class="container">
            <h5 class="header-title">{!! Session::get('client')['first_name'].' '.Session::get('client')['last_name'] !!}</h5>
            <div class="row">
                @include('client.include.nav_client')
            </div>
            <div class="row">
                <div class="col-md-8">
                   
                        
                            <h5 class="header-title">My Profile</h5>
                     
                       
                            <form method="post" action="{!! url('my-profile/update-profile') !!}" class="shipping-info">
                                {!! csrf_field() !!}
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="{!! $profile->first_name !!}" name="input[first_name]" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="{!! $profile->last_name !!}" name="input[last_name]" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{!! $profile->email !!}" name="input[email]" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" class="form-control" name="input[mobile]" value="{!! $profile->mobile !!}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select type="text" class="form-control" name="input[gender]" required>
                                            <option value="male" {!! $profile->gender == "male" ? "selected" : "" !!}>Male</option>
                                            <option value="female" {!! $profile->gender == "female" ? "selected" : "" !!}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn-success submit-btn text-center">Submit</button>
                                </div>
                            </div>
                            </form>
                      
                    
                </div>
                <div class="col-md-4">
                   
                       
                            <h5 class="header-title">Update Login Password</h5>
                       
                        
                            <form method="post" action="{!! url('my-profile/update-password') !!}" class="shipping-info">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" name="old_password" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="new_password" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" required/>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn-success submit-btn text-center">Submit</button>
                                    </div>
                                </div>
                            </form>
                       
                  
                </div>

            </div>
        </div>
    </section>

@stop
@section('js')
    <script type="text/javascript">
        $("input[type='image']").click(function() {
            $("input[id='my_file']").click();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("input[type='image']").attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("input[id='my_file']").change(function() {
            readURL(this);
        });
    </script>

@stop

