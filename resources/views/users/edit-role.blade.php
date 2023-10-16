@extends('layouts.app')

@section('title', 'Edit User Role')

@section('content')
<div class="container">
    <h1>Edit User Role</h1>
    <form method="POST" action="{{ route('users.update-role', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Role</button>
        </div>
    </form>
</div>
@endsection
