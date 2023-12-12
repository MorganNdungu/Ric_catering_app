@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
    <div class="container mt-5">
        <h1>Booking Confirmation</h1>

        <div class="alert alert-success">
            <p>Event booked successfully!</p>
            <p>Full Name: {{ $full_name }}</p>
            <p>Phone Number: {{ $phone_number }}</p>
        </div>


        <p>Thank you for booking with us!</p>
    </div>
@endsection
