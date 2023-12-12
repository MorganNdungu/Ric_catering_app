
@extends('layouts.app')

@section('title', 'Booked Venues')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Booked Venues</h1>

        <!-- Display booked venues data here -->
        @foreach($bookedVenues as $booking)
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Display booking details -->
                    <h5 class="card-title">Full Name: {{ $booking->full_name }}</h5>
                    <p class="card-text">Phone Number: {{ $booking->phone_number }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
