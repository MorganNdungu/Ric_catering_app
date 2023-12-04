@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="profile-info">
                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

                    <!-- Display other profile details as needed -->

                    <!-- Display profile picture with smaller size -->
                    @if(auth()->user()->profile_pic)
                        <img src="{{ asset('storage/profile_pics/' . auth()->user()->profile_pic) }}" alt="Profile Picture" class="profile-pic mt-3">
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        <a href="{{ route('profile.change-password.form') }}" class="btn btn-primary">Change Password</a>
                        <a href="{{ route('profile.change-email.form') }}" class="btn btn-primary">Change Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
