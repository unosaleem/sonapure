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
                <div class="col-md-6">
                    <h5 class="header-title">My Order History</h5>
                    @if(count($address)!=0)
                        @foreach($address as $row)
                            <div class="card">
                                
                                    <h5 class="home-header">{!! ucfirst($row->type) !!}</h5>
                                
                                <div class="card-body add-history">

                                    <p>{!! $row->locality.', '.$row->address !!}</p>
                                    <p>{!! $row->city.', '.$row->state.' '.$row->zip !!}</p>
                                    <p>{!! $row->country !!}</p>


                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
                <div class="col-md-6">
                    <h5 class="header-title">Add Address</h5>
                   
                        
                            <form method="post" id="add_address_form" class="shipping-info">
                                {!! csrf_field() !!}
                                <input type="hidden" id="customer_id" name="customer_id" value="{!! Session::get('client')['id'] !!}" required/>
                                <input type="hidden" id="address_id" name="address_id" value="" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address Type</label>
                                            <select class="form-control" name="type" required="">
                                                <option value="">Select Type</option>
                                                <option value="home">Home</option>
                                                <option value="office">Office</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Locality</label>
                                            <input type="text" value="" class="form-control" placeholder="" name="locality" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea  class="form-control" placeholder="" name="" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Zip</label>
                                        <div class="form-group">
                                            <input type="text" value="" class="form-control" placeholder="" name="zip" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" value="" class="form-control" placeholder="" name="city" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" value="" class="form-control" placeholder="" name="state" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" value="" class="form-control" placeholder="" name="country" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="submit-btn">Save changes</button>
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
    <script>
        $(document).on("change", "input[name=zip]", function(){
            var val = $(this).val();
            if(val !=""){
                $.post("{!! url('get-address') !!}", {'_token' : '{!! csrf_token() !!}', 'pincode' : val }, function(html){
                    console.log(html);
                    var obj = $.parseJSON(html);

                    //$("#shipping_city").val(obj['region']);
                    $("#add-address-modal input[name=city]").val(obj['region']);
                    $("#add-address-modal input[name=state]").val(obj['state']);
                    $("#add-address-modal input[name=country]").val(obj['country']);
                    return false;
                });
            }
        });
        $(document).on("submit", "form#add_address_form", function(){
            $.post("{!! url('my-profile/add-address') !!}", $(this).serialize(), function(html){
                console.log('html');
                var obj = $.parseJSON(html);
                if(obj.code == 200){
                    alert(obj.msg);
                    setInterval(function(){ location.reload() }, 3000);
                }
            });
            return false;
        });
    </script>
@stop

