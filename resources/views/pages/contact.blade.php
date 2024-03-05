@extends('layout.home_master')

@section('css')
<style>
.subscribe-grid {
    display: none;
}
.footer-middle {
    margin-top: 40px;
}
</style>
@stop
@section('body')
<div class="inner-grid" style="background: url(assets/images/inner-banners/Contact-Us.jpg) no-repeat top center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Contact Us</h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white"
                                href="https://sonapureessentials.com/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>

<section class="contact-grid">

    <div class="container">

        <div class="row">

            <div class="col-md-5">
                <div class="contact-address">
                    <h2>Get in Touch With Us</h2>

                    <h5> <img src="{!! URL::asset('assets') !!}/images/address-icon.png" alt="">
                        <p>17 / 1A, First Floor, Madan Mohan Malviya Marg, Lucknow-226001, UP, India</p>
                    </h5>


                    <h5><img src="{!! URL::asset('assets') !!}/images/mail-icon.png" alt="">
                        <p>support@sonapuressentials.com</p>
                    </h5>
                    <h5><img src="{!! URL::asset('assets') !!}/images/call-icon.png" alt="">
                        <p>+91-9839646686</p>
                    </h5>
                </div>
            </div>

            <div class="col-md-7">
                <form class="feedbackform" method="post" action="{!! url('/sendmail') !!}">
                    @csrf
                    <h2>Feedback Form</h2>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label class="label-txt2">Name</label>
                            <input type="text" name="input[Name]" class="input2">
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="label-txt2"> Email</label>
                            <input type="text" name="input[Email]" class="input2">
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <label class="label-txt2">Massage</label>
                            <textarea type="text" name="input[Massage]" class="input2" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <button type="submit" class="subbutton2">submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</section>

<iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.4824994027!2d80.95302901491436!3d26.856407368977447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd126796e817%3A0x42d640ba99933381!2s17-1a%2C%20Madan%20Mohan%20Malviya%20Marg%2C%20Parehta%2C%20Gokhale%20Vihar%2C%20Butler%20Colony%2C%20Lucknow%2C%20Uttar%20Pradesh%20226001!5e0!3m2!1sen!2sin!4v1644902658049!5m2!1sen!2sin"
    height="450" style="border:0; width: 100%;" allowfullscreen="" loading="lazy"></iframe>

@stop