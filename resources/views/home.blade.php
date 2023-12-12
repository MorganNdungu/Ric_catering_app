@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="mt-4">
                        <h2>Cakes</h2>
                        <div class="row">
                            @foreach ($cakes as $cake)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $cake->name }}</h5>
                                            <p class="card-text">{{ $cake->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Category: Snacks --}}
                    {{-- <div class="mt-4">
                        <h2>Snacks</h2>
                        <div class="row">
                            @foreach ($snacks as $snack)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $snack->name }}</h5>
                                            <p class="card-text">{{ $snack->description }}</p> --}}
                                            {{-- Add other snack card details here --}}
                                        {{-- </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                    {{-- Category: Packages Offered --}}
                    {{-- <div class="mt-4">
                        <h2>Packages Offered</h2>
                        <div class="row">
                            @foreach ($packages as $package)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $package->name }}</h5>
                                            <p class="card-text">{{ $package->description }}</p> --}}
                                            {{-- Add other package card details here --}}
                                        {{-- </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
