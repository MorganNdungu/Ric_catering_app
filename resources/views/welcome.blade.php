
@extends('layouts.app')

@section('title', 'Welcome to RicHarry Catering Services')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <body style="background-image: url('{{ asset('images/Paneer Tikka Recipe.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; ">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Location</h4>
                    <p>, Kiambu</p>
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

        <div class="row mt-5">
            @php
                $categoryImages = [
                    'images/Taekook one shots.jpg',
                    'images/Soft.jpg',
                    'images/15th Birthday Party.jpg',
                    'images/10 Party & Wedding Table Ideas That Totally Transformed These Events - PartySlate.jpg',
                    'images/Chicken and Cauliflower Rice.jpeg',
                    'images/Paneer Tikka Recipe.jpeg',
                    'images/Rice with Chicken a Nigerian Recipe.jpeg',
                    'images/Spicy bean sauce.jpeg',
                    'images/cocktail.jpg',
                    'images/Cookies and Milk Milkshakes.jpg',
                    'images/Hot Dog.jpg',
                    'images/Waffle Cone.jpg',
                    'images/Father Day.jpeg',
                    'images/Les dripping.jpeg',
                    'images/Peanut Butter.jpeg',
                    'images/Wedding Cake.jpeg',
                ];
            @endphp

            @foreach ($categoryImages as $index => $image)
                <div class="col-md-3">
                    <div class="card d-flex flex-column h-100">
                        <img src="{{ asset($image) }}" class="card-img-top" alt="Category Image {{ $index + 1 }}">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $index + 1 }}</h5>
                            <p class="card-text">enjoy your shopiiing.</p>
                            <a href="/items" class="btn btn-primary mt-auto">View</a>
                        </div>
                    </div>
                </div>
                @if (($index + 1) % 4 === 0)
                    </div>
                    <div class="row mt-3">
                @endif
            @endforeach
        </div>
    </div>


    <script>
    </script>
</body>
</html>
@endsection
