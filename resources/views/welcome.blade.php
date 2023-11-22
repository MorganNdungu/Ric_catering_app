@extends('layouts.app')

@section('title', 'Welcome to RicHarry Catering Services')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <body style="background-image: url('{{ asset('images/Paneer Tikka Recipe.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; ">

    

    <div class="icons-details" style="position: relative; z-index: 1; color: #fff; text-align: center; padding: 20px; overflow: hidden;">
        <div class="row">
            <div class="col-md-3">
                <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Location</h4>
                    <p>123 Main Street, City</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="icon-box">
                    <i class="bi bi-list"></i>
                    <h4>Menu</h4>
                    <p>Explore our diverse menu</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="icon-box">
                    <i class="bi bi-credit-card"></i>
                    <h4>Payment</h4>
                    <p>Secure and convenient options</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="icon-box">
                    <i class="bi bi-info-circle"></i>
                    <h4>Details</h4>
                    <p>Learn more about us</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add other sections and content as needed -->

    <script>
        // Add any JavaScript specific to this page
    </script>
@endsection
