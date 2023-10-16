@extends('layouts.app')

@section('title', 'Create Item')

@section('page-title')
    Create Item
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}"> <!-- Link to your custom CSS file -->

    <form method="POST" action="/items" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="form-group">
            <button type="submit" class="button">Create Item</button>
        </div>
    </form>
    <a href="/" class="button">Back to Items</a>
@endsection
