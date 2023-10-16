@extends('layouts.app')

@section('title', 'Welcome to FoodieLand')

@section('content')
<div id="foodCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/Chicken and Cauliflower Rice.jpeg') }}" class="d-block w-100" alt="image1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Finger Licking</h5>
                <p>All available at RicHarry Catering Services</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/Paneer Tikka recipe.jpeg') }}" class="d-block w-100" alt="image2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Finger Licking</h5>
                <p>All available at RicHarry Catering Services</p>
            </div>
        </div>
    </div>
    
    <a class="carousel-control-prev" href="#foodCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#foodCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endsection
