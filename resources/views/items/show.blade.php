@extends('layouts.app')

@section('title', 'Item Details')

@section('page-title')
    Item Details
@endsection

@section('content')
    <h2>{{ $item->title }}</h2>
    <p>Description: {{ $item->description }}</p>
    <p>Price: KSH{{ $item->price }}</p>
    @if ($item->image)
        <img src="{{ asset('images/' . $item->image) }}" alt="Item Image" width="200">
    @else
        No Image
    @endif
@endsection
