@extends('layouts.app')

@section('title', 'Birthday Packages')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Venues & Pacakages</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @hasrole('Admin')
            <a href="{{ route('birthday_packages.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i></a>
        @endhasrole

        <div class="row">
            @foreach($birthdayPackages as $package)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($package->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $package->images->first()->image_path) }}" class="card-img-top" alt="{{ $package->name }}">
                        @else
                            <img src="{{ asset('path-to-your-default-image.jpg') }}" class="card-img-top" alt="{{ $package->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $package->name }}</h5>
                            <p class="card-text">{{ $package->description }}</p>
                            <p class="card-text"><strong>Price:</strong> KSH {{ $package->price }}</p>

                            <form method="GET" action="{{ route('birthday_packages.show_booking_form', $package->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success mb-3"><i class="bi bi-book"></i>Book Now</button>
                            </form>
                            


                            @hasrole('Admin')
                                <div class="btn-group">
                                    <a href="{{ route('birthday_packages.edit', $package->id) }}" ><i class="bi bi-pencil-square btn btn-outline-success"></i></a>

                                    <form method="POST" action="{{ route('birthday_packages.soft-delete', $package->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="bi bi-trash3 btn btn-outline-danger"></i></button>
                                    </form>
                                </div>
                            @endhasrole
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
