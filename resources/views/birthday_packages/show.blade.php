@extends('layouts.app')

@section('title', 'Birthday Package Details')

@section('content')
    <div class="container mt-5">
        <h1>{{ $package->name }}</h1>

        <p><strong>Description:</strong> {{ $package->description }}</p>
        <p><strong>Price:</strong> {{ $package->price }}</p>

        @if ($package->images && count($package->images) > 0)
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($package->images as $key => $image)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('/image'->image)) }}" class="d-block w-100" alt="Image {{ $key + 1 }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif

        <a href="{{ route('birthday_packages.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
