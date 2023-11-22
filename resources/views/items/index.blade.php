@extends('layouts.app')

@section('title', 'Items Listing')

@section('page-title')
    Items
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">
    @hasrole('Admin')
        <div>
            <a href="{{ route('items.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i></a>
        </div>
    @endhasrole
    <div class="row">
        @foreach ($items as $item)
        <div class="col-md-3 mb-3">
            <div class="card">
                @if ($item->image)
                    <img src="{{ asset('images/' . $item->image) }}" alt="Item Image" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <p class="card-text">Price: KSH{{ $item->price }}</p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="number" name="quantity" value="1" min="1" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success"><i class="bi bi-cart-check-fill"></i></button>
                            </div>
                        </div>
                    </form>

                    @hasrole('Admin')
                    <div class="mt-3">
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i> </a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')"><i class="bi bi-trash3"></i> </button>
                        </form>
                    </div>
                    @endhasrole
                </div>
            </div>
        </div>
    @endforeach
</div>



@endsection
