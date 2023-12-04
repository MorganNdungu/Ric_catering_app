@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
            </div>

            <!-- Add other profile fields as needed -->

            <div class="form-group">
                <label for="profile_pic">Profile Picture</label>
                <input type="file" id="profile_pic" name="profile_pic" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <!-- Display current profile picture -->
        @if(auth()->user()->profile_pic)
            <img src="{{ asset('storage/profile_pics/' . auth()->user()->profile_pic) }}" alt="Profile Picture" class="mt-3">
        @endif
    </div>
@endsection
