@extends('layouts.frontend')
@section('title', $title)
@section('content')
    <!-- Hero  Section Start -->
    @include('frontend.home.hero')
    <!-- Hero  Section End -->

    <!-- Features  Section Start -->
    @include('frontend.home.features')
    <!-- Features  Section End -->

    <!-- Special Moments  Section Start -->
    @include('frontend.home.special-moments')
    <!-- Special Moments  Section End -->

    <!-- Latest Additions  Section Start -->
    @include('frontend.home.latest-additions')
    <!-- Latest Additions  Section End -->

    <!-- CTA  Section Start -->
    @include('frontend.home.cta')
    <!-- CTA  Section End -->

    <!-- Top-Selling  Section Start -->
    @include('frontend.home.top-selling')
    <!-- Top-Selling  Section End -->

    <!-- Testimonials  Section Start -->
    @include('frontend.home.testimonials')
    <!-- Testimonials  Section End -->

    <!-- Final CTA   Section Start -->
    @include('frontend.home.final-cta')
    <!-- Final CTA   Section End -->
@endsection
