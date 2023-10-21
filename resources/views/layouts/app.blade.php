<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('RicApp', 'RicHarry APP')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="main-navigation">
        <ul>
            <li><a href="/">Home</a></li>
            @hasrole('Admin')
            <li><a href="{{route('users.index')}}">Users</a></li>
            @endhasrole
            <li><a href="/items">Items</a></li>            
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a href="#">Catering Services</a>
                    <a href="#">Birthday Package</a>
                    <a href="#">Wedding Package</a>
                    <a href="#">Cakes</a>
                    <a href="#">Snacks</a>
                    <a href="#">Traditional Meals</a>
                </div>
            </li>
                        <li>
                @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            </li>
        </ul>
    </nav>
    

    <div class="container">
        <h1>@yield('page-title')</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Add additional JavaScript links here -->
</body>
</html>
