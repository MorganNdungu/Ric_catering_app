@extends('layouts.app')

@section('title', 'Confirm Delete Cake')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cake-delete.css') }}">

<div class="container">
    <h1>Confirm Delete Cake</h1>

    <div class="alert alert-danger">
        Are you sure you want to delete this cake?
    </div>

    <div class="cake-details">
        <h2>{{ $cake->name }}</h2>
        <p>{{ $cake->description }}</p>
        <p>Price: KSH{{ $cake->price }}</p>
    </div>

    <form method="POST" action="{{ route('cakes.destroy', $cake->id) }}">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('cakes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
