<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('RicApp', 'RicHarry APP')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body{
            background-image:image(C:\XAMPP\htdocs\RicApp-app\public\images\Paneer Tikka Recipe.jpeg)
        }
        .navbar-toggler-icon {
            background-color: red; /* Customize the hamburger icon color */
        }

        /* Additional styles for positioning cart and username */
        .cart-username {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            color: red;
            background-color: rgb(87, 32, 32); /* Set the color to white for better visibility */
        }

        .navbar-nav {
            width: 100%;
            text-align: center;
            color: aliceblue
            background-color: rgb(36, 36, 102);

        }

        .navbar-toggler {
            margin: 10px;
        }

        .navbar-collapse {
            border-top: 1px solid #190202;
            padding: 10px;
            text-align: left;
            position: relative; /* Required for positioning the image */
        }

        /* Blur the background image */
        .navbar-collapse::after {
            content: '';
            background: url('path/to/your/image.jpg') center/cover no-repeat;
            filter: blur(10px);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Customize color for login, register, and cart links */
        .navbar-nav .nav-item a {
            color: #007bff; /* Set the color to blue (you can change it) */
        }

        .cart-username a {
            color: blue; 
        }
    </style>
</head>
<body>

    <div class="cart-username">
        <a href="{{ route('cart.view') }}"><i class="bi bi-cart3"></i>
            @if(isset($cartItemCount) && $cartItemCount > 0)
                ({{ $cartItemCount }} items)
            @else
                (0 items)
            @endif
        </a>
        @guest
            @if (Route::has('login'))
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            @endif
            @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        @else
            <div class="dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        @endguest
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                @hasrole('Admin')
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                @endhasrole
                <li class="nav-item"><a class="nav-link" href="/items">Items</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Services
</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Catering Services</a>
                        <a class="dropdown-item" href="{{ route('birthday_packages.index') }}">Birthday Packages</a>
                        <a class="dropdown-item" href="#">Wedding Package</a>
                        <a class="dropdown-item" href="{{ route('cakes.index') }}">Cakes</a>
                        <a class="dropdown-item" href="{{ route('snacks.index') }}">Snacks</a>
                        <a class="dropdown-item" href="#">Traditional Meals</a>
                    </div>
                </li>
            </ul>
        </div>
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

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>About Us</h4>
                    <p>Your catering app provides delicious food for all occasions. We offer a wide range of services to
                        make your events special.</p>
                </div>
                <div class="col-md-4">
                    <h4>Follow Us</h4>
                    <ul class="social-icons">
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                        <li>
                            <a href="fb://page/{https://www.facebook.com/morgan.ndungu.52}">
                                <img src="facebook-icon.png" alt="Facebook">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <p>Phone: 07XX XXX XXX</p>
                    <p>Email: ric@gmail.com</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="copyright">Site designed by Morgan Ndung'u &copy; {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    
</body>
</html>
