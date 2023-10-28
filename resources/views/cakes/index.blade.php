@extends('layouts.app')

@section('title', 'Cakes')

@section('content')

<link rel="stylesheet" href="{{ asset('css/cake-card.css') }}">
@hasrole('Admin')
    <a href="{{ route('cakes.create') }}" class="btn"><i class="bi bi-plus"></i></a>
    @endhasrole
    <div class="cake-container">
        @foreach ($cakes as $cake)
            <div class="cake-card">
                <img src="{{ asset('storage/' . $cake->image_path) }}" alt="{{ $cake->name }}" class="cake-image">
                <h5 class="cake-title">{{ $cake->name }}</h5>
                <p class="cake-description">{{ $cake->description }}</p>
                <p class="cake-price">Price: KSH{{ $cake->price }}</p>
                <a href="{{ route('cakes.order', $cake->id) }}" class="order-button">Order Now</a>
                @hasrole('Admin')
                <a href="{{ route('cakes.edit', $cake->id) }}" ><i class="bi bi-pencil-square btn btn-outline-success"></i></a>
        
                <a href="{{ route('cakes.confirm-delete', $cake->id) }}" ><i class="bi bi-trash3 btn btn-outline-danger"></i></a>
                @endhasrole
            </div>
        @endforeach
    </div>
@endsection
