@extends('layouts.app')

@section('title', 'Edit snacks')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cake-edit.css') }}">

<div class="container">
    <h1>Edit snacks</h1>

    <form method="POST" action="{{ route('snacks.update', $snack->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">snacks Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $snack->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $snack->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price (KSH)</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $snack->price }}" required>
        </div>

        <div class="form-group">
            <label for="image">snacks Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Update snacks</button>
        <a href="{{ route('snacks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
