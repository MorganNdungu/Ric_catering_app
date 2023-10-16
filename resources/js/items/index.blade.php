@extends('layouts.app')

@section('RicApp', 'Items Listing')

@section('RicHarrry-Catering-Sevices')
    Items
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/items.css') }}">
    <h1>Items</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>${{ $item->price }}</td>
                    <td>
                        @if ($item->image)
                            <img src="{{ asset('images/' . $item->image) }}" alt="Item Image" width="100">
                        @else
                            No Image
                        @endif
                        
                    </td>
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="button">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/items/create" class="button">Add Item</a>
    @endsection
