<!DOCTYPE html>
<html>
<head>
    <!-- Add your CSS styles here -->
    <style>
        .navbar-toggler-icon {
            background-color: red; /* Set the background color to red */
        }
    </style>

    <!-- Include Bootstrap CSS and JS files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">RicHarry Catering</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/items">Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cakes.index') }}">Cakes</a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('snacks.index') }}">Snacks</a>
                    
                </li>
                
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
    </nav>            </ul>
        </div>
    </nav>

    <div class="hero-section" style="position: relative; color: #fff; text-align: center; padding: 100px 20px; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('{{ asset('images/Paneer Tikka Recipe.jpeg') }}') center/cover no-repeat; filter: blur(10px);"></div>
        <div style="position: relative; z-index: 1; max-width: 600px; margin: 0 auto;">
            <h1>Welcome to RicHarry Catering Services</h1>
            <p>Discover a world of delicious meals and treats.</p>
        </div>
    </div>
    
    <div class="container">
        <h1>@yield('page-title')</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
