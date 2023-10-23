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
                <th></th>                

                @hasrole('Admin')
                <th>Action</th>
                @endhasrole
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>KSH{{ $item->price }}</td>
                    <td>
                        @if ($item->image)
                            <img src="{{ asset('images/' . $item->image) }}" alt="Item Image" width="200">
                        @else
                            No Image
                        @endif
                        
                    </td>
                    @hasrole('Admin')
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="button">Edit</a>

                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                        @endhasrole
                        <td>
                            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1">
                                <button type="submit" class="button">Add to Cart</button>
                            </form>
                        </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @hasrole('Admin')
    <a href="/items/create" class="button">Add Item</a>
    @endhasrole
    @endsection
