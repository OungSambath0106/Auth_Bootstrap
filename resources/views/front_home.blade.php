@extends('front_master')

@section('title')
    Coffee Shop
@endsection

@section('banner_page')
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('coffee') }}/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2>
                        <h1 class="display-1 text-white m-0">COFFEE</h1>
                        <h2 class="text-white m-0">* SINCE 1950 *</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('coffee') }}/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2>
                        <h1 class="display-1 text-white m-0">COFFEE</h1>
                        <h2 class="text-white m-0">* SINCE 1950 *</h2>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <!-- About Start -->
    @include('pages.about')
    <!-- About End -->


    <!-- Service Start -->
    @include('pages.service')
    <!-- Service End -->


    <!-- Offer Start -->
    @include('pages.offer')
    <!-- Offer End -->


    <!-- Menu Start -->
    @include('pages.menu')
    <!-- Menu End -->


    <!-- Reservation Start -->
    @include('pages.reservation')
    <!-- Reservation End -->


    <!-- Testimonial Start -->
    @include('pages.testimonial')
    <!-- Testimonial End -->
@endsection
