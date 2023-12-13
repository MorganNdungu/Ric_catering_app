@extends('layouts.app')

@section('content')

    {{-- Your Dashboard Content --}}
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        {{-- Welcome message --}}
                        <p>{{ __('Welcome back, :name!', ['name' => Auth::user()->name]) }}</p>
                        @php
                            $user = Auth::user()->load('orders');
                        @endphp
                        {{-- Display user-specific content --}}
                        <div class="mt-4">
                            <h4>Your Orders</h4>
                            @if($user->orders->count() > 0)
                            <ul>
                                @foreach ($user->orders as $order)
                                     <li>{{ $order->name }} - {{ $order->created_at->diffForHumans() }}</li>
                                @endforeach
                             </ul>
                            @else
                                 <p>No orders found.</p>
                            @endif                            
                        </div>

                        <div class="mt-4">
                            <h4>Your Profile</h4>
                            <p>Name: {{ Auth::user()->name }}</p>
                            <p>Email: {{ Auth::user()->email }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <!-- Optional: Add Bootstrap and other libraries if not included in your layout -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> --}}
    
    <!-- Optional: Separate Popper and Bootstrap JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
@endsection
