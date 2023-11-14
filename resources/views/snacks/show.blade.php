@extends('layouts.app')

@section('title', 'snack Details')

@section('page-title')
    snack Details
@endsection

@section('content')
    <h2>{{ $snack->name }}</h2>
    <p>Description: {{ $snack->description }}</p>
    <p>Price: KSH{{ $snack->price }}</p>
    <img src="{{ asset('storage/' . $snack->image_path) }}" alt="{{ $snack->name }}" width="">
@endsection
