@extends('layouts.app')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center " >
    <div class="container container-make position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h2>MakeMyFly <br>your one-stop destination</h2>
      <h3>for Domestic and International flight bookings.</h3>
      <button class="btn btn-contact"><a href="{{ route('contact') }}">Contact Us</a></button>

    </div>
  </section><!-- End Hero -->
<!-- ======= About Section ======= -->
<section id="about" class="about pt-5 pb-3">
    <div class="container container-make" data-aos="fade-up">

      <div class="row">


        <div class="col-lg-7 content">
          <h3>Welcome to <br> <span >MakeMyFly</span></h3>

          <p class="text-justify mt-5 mb-5" style="text-align:justify; ">
              Makemyfly is the leading flight booking website that inspires people to book tickets and
              travel across the world at the best prices. We cover all popular destinations and offer you
              a wide range of services including domestic and international flight booking. From social
              occasions and festivals to entertainment and tours, we’ve got all packages covered.
          </p>

          <a href="{{ route('about') }}" class="btn more-btn">Read More <i class="bx bx-chevron-right"></i></a>
        </div>
          <div class="col-lg-5 text-center" data-aos="fade-left" data-aos-delay="100">
          <img src="{{ asset('assets/img/home_center.png')}}" class="img-fluid" alt="" style="height: 75%;">
        </div>
      </div>

    </div>
  </section>
@endsection