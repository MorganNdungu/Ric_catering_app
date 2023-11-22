@extends('layouts.app')

@section('title', 'Snacks')

@section('content')

<div class="container mt-4">
    @hasrole('Admin')
        <a href="{{ route('snacks.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Add Snack</a>
    @endhasrole

    <div class="row mt-3">
        @foreach ($snacks as $snack)
            <div class="col-md-2 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $snack->image_path) }}" alt="{{ $snack->name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $snack->name }}</h5>
                        <p class="card-text">{{ $snack->description }}</p>
                        <p class="card-text"><strong>Price:</strong> KSH{{ $snack->price }}</p>
                        <a href="{{ route('snacks.order', $snack->id) }}" class="btn btn-primary">Order Now</a>

                        @hasrole('Admin')
                            <a href="{{ route('snacks.edit', $snack->id) }}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i> Edit</a>

                            <form method="POST" action="{{ route('snacks.soft-delete', $snack->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash3"></i> Delete</button>
                            </form>
                        @endhasrole
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
