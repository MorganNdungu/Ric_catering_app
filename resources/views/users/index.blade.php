@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">

<div class="container">
    <h1>User Management</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->role !== 'admin')
                            <a href="{{ route('users.edit-role', $user->id) }}" class="btn btn-sm btn-primary">Edit Role</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
