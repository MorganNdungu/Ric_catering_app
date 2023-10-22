@extends('layouts.app')

@section('title', 'Edit Item')

@section('page-title')
    Edit Item
@endsection

@section('content')
<link href="{{ asset('css/edit_item.css') }}" rel="stylesheet">

<form action="{{ route('items.update', $item->id) }}" method="POST">
    @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $item->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $item->price }}">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="button">Update Item</button>
    </form>
@endsection
