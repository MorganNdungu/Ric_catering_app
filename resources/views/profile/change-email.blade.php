
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Change Email</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.change-email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">New Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Current Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Change Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection
