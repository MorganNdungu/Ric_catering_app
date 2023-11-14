@extends('layouts.app')

@section('title', 'snacks')

@section('content')

<link rel="stylesheet" href="{{ asset('css/cake-card.css') }}">
@hasrole('Admin')
    <a href="{{ route('snacks.create') }}" class="btn"><i class="bi bi-plus"></i></a>
@endhasrole
    <div class="snacks-container">
        @foreach ($snacks as $snack)
            <div class="snacks-card">
                <img src="{{ asset('storage/' . $snack->image_path) }}" alt="{{ $snack->name }}" class="snacks-image">
                <h5 class="snacks-title">{{ $snack->name }}</h5>
                <p class="snacks-description">{{ $snack->description }}</p>
                <p class="snacks-price">Price: KSH{{ $snack->price }}</p>
                <a href="{{ route('snacks.order', $snack->id) }}" class="order-button">Order Now</a>
    @hasrole('Admin')
        <a href="{{ route('snacks.edit', $snack->id) }}">
        <i class="bi bi-pencil-square btn btn-outline-success"></i>
        </a>
    
        <form method="POST" action="{{ route('snacks.soft-delete', $snack->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">
            <i class="bi bi-trash3 btn btn-outline-danger"></i>
        </button>
        </form>
    @endhasrole

            </div>
        @endforeach
    </div>
@endsection
