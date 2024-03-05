@extends('layout.home_master')
@section('css')@stop
@section('body')
<div class="inner-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Our Strengths</h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white"
                                href="https://sonapureessentials.com/">Home</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">About Us</li>
                        <li class="breadcrumb-item active" aria-current="page">Our Strengths</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>

<section class="our-strength">
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <p>
                    Our Ecosystem at SONA Pure Essentials works closely with farmers, beekeepers & rural women to
                    empower them with proper livelihood. The entire product range is proudly made in India and extracted
                    according to traditional, Vedic methods & ISO Certified Dairy and grown in natural soil without any
                    pesticides, chemicals or flavours; hence richer in antioxidants & micronutrients. We diligently
                    ensure quality standards through periodic reports from NABL accredited Labs. Our product packaging
                    is completely Eco-friendly promoting sustainability at the grassroot level thus, making world a
                    better place to live in! </p>
            </div>



        </div>
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="imgStrengths">
                    <img src="{!! URL::asset('assets') !!}/images/Colors.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="imgStrengths">
                    <img src="{!! URL::asset('assets') !!}/images/Flavors.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="imgStrengths">
                    <img src="{!! URL::asset('assets') !!}/images/Natural.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="imgStrengths">
                    <img src="{!! URL::asset('assets') !!}/images/Preservatives.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>


    </div>

</section>
@stop