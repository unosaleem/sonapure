@extends('layout.home_master')
@section('css')@stop
@section('body')
<div class="inner-grid" style="background: url(assets/images/inner-banners/Our-Certifications.jpg) no-repeat top center;">

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Our Certifications</h1>
            </div>
            <div class="col-lg-12 text-center">
                <div aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="https://sonapureessentials.com/">Home</a></li>
                                <li class="breadcrumb-item text-white" aria-current="page">About Us</li>
                        <li class="breadcrumb-item active" aria-current="page">Our Certifications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="certifications-grid">

  <div class="container">
    <div class="row">
      <div class="col-md-4"> <a href="{!! URL::asset('assets/Certifications/FSSAI-CERTIFICATE-NEW-2023.pdf') !!}" target="_blank" class="btn effect-1" data-toggle="tooltip" title="Food Safety and Standards Authority of India"><img src="{!! URL::asset('assets') !!}/images/Client1.png" alt=""> <span>SONA Pure
                                    Essentials proudly holds an FSSAI (Food Safety and Standards Authority of India)
                                    license, assuring our customers of the highest standards of food safety and quality
                                    in our products.</span> </a> </div>

      <div class="col-md-4"> <a href="#" class="btn effect-1" data-toggle="tooltip" title="Make in India"><img src="{!! URL::asset('assets') !!}/images/Client2.png" alt=""> <span>SONA Pure Essentials proudly holds a "Make in India" license, a testament to our dedication to supporting the Indian economy and promoting local manufacturing. </span></a> </div>
      
      <div class="col-md-4"> <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="Equinox Labs"><img src="{!! URL::asset('assets') !!}/images/Client3.png" alt=""> <span>SONA Pure Essentials is honored to be licensed by Equinox Labs, a respected authority in quality assurance and safety. </span></a> </div>

      <div class="col-md-4"> <a href="{!! URL::asset('assets/Certifications/Udyam-Registration-Certificate.pdf') !!}" target="_blank" class="btn effect-1" data-toggle="tooltip" title="Msme Udyam Registration Consultancy Portal"><img src="{!! URL::asset('assets') !!}/images/Client4.png" alt=""> <span>We understand the importance of a smooth and hassle-free registration experience, and we strive to provide the best service possible. </span> </a> </div>

      <div class="col-md-4"> <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="International Organization for Standardization"><img src="{!! URL::asset('assets') !!}/images/Client5.png" alt=""> <span>With the ISO license, we ensure that our customers receive products that adhere to globally recognized quality benchmarks</span> </a> </div>

      <div class="col-md-4"> <a href="#" class="btn effect-1" target="_blank" data-toggle="tooltip" title="National Accreditation Board for Testing and Calibration Laboratories (NABL)"><img src="{!! URL::asset('assets') !!}/images/Client6.png" alt=""> <span>NABL accreditation assures our customers that our products undergo rigorous testing and calibration processes, meeting the highest industry standards</span></a> </div>

      <div class="col-md-4"> <a href="{!! URL::asset('assets/Certifications/Certified-Organic.pdf') !!}" class="btn effect-1" target="_blank" data-toggle="tooltip" title="Certified Organic"><img src="{!! URL::asset('assets') !!}/images/Client7.png" alt=""> <span>This certification assures our customers that our offerings are crafted with pure, natural ingredients, free from synthetic chemicals or pesticides.</span></a> </div>

      <div class="col-md-4"> <a href="{!! URL::asset('assets/Certifications/GST-CERTIFICATE.pdf') !!}" target="_blank" class="btn effect-1" data-toggle="tooltip" title="GST registration"><img src="{!! URL::asset('assets') !!}/images/Client8.png" alt=""> <span>The next GST Council meeting is scheduled to be held at Srinagar, J&K on 18th and 19th May, 2017. The Central Government has already informed that GST will be rolled-out from 1st July, 2017. </span></a> </div>

      <div class="col-md-4"> <a href="{!! URL::asset('assets/Certifications/SPE-LABOUR-REG.pdf') !!}" target="_blank" class="btn effect-1" data-toggle="tooltip" title="Labour Department,
Government of Uttar Pradesh"><img src="{!! URL::asset('assets') !!}/images/Client9.png" alt=""> <span>The Principal
                                    Secretary is the head of the Labour & Employment Department. </span></a> </div>
    </div>
  </div>
</section>
@stop 