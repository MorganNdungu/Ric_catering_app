@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cake-create.css') }}">

    <div class="container">
        <h1>Create a New Cake</h1>

        <form method="POST" action="{{ route('cakes.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Cake Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (USD)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="image">Cake Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Create Cake</button>
        </form>
    </div>
@endsection
