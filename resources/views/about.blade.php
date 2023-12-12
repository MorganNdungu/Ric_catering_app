@extends('layouts.app')

@section('title', 'About Us')

@section('page-title')
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Our Story</h2>
                <p class="lead">Welcome to RICHARRY CATERING COMPANY, where we are passionate about providing delightful culinary experiences for every occasion. Our journey began with a love for creating exceptional food and delivering outstanding service to our clients.</p>
                <p>We believe in the power of good food to bring people together and make every event memorable. Whether it's a corporate gathering, wedding, or a casual get-together, we strive to exceed your expectations with our diverse menu and impeccable service.</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/riharry.png') }}" class="img-fluid" alt="About Us Image">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2 class="mb-4">Our Mission</h2>
                <p class="lead">At RICHARRY, our mission is to create culinary experiences that leave a lasting impression. We are committed to using the finest ingredients, innovative techniques, and a passion for excellence to make every event extraordinary.</p>
                <p>Whether it's crafting a personalized menu, ensuring impeccable presentation, or providing top-notch service, we are dedicated to making your special moments truly unforgettable.</p>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
@endsection
