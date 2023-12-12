<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function bookVenue(Request $request)
    {
        // Validate the form data
        $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        // Create and store the booking in the database
        $booking = Booking::create([
            'full_name' => $request->input('full_name'),
            'phone_number' => $request->input('phone_number'),
        ]);

        // Redirect to the booking confirmation page
        return redirect()->route('bookings.confirmation')->with([
            'success' => 'Event booked successfully!',
            'full_name' => $booking->full_name,
            'phone_number' => $booking->phone_number,
        ]);
    }

    public function showConfirmation()
    {
        return view('bookings.confirmation', [
            'full_name' => session('full_name'),
            'phone_number' => session('phone_number'),
        ]);
    }

    public function index()
    {
        // Retrieve booked venues data from the database
        $bookedVenues = Booking::all(); 

        return view('bookings.index', [
            'bookedVenues' => $bookedVenues,
        ]);
    }
}
