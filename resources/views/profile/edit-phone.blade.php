@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Phone Number</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Phone</button>
        </form>
    </div>
@endsection
