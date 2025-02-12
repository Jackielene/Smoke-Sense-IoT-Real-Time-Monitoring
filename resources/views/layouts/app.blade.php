<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IoT Smoke Detector') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
      <!-- Include Gauge.js from CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gauge.js/1.2.1/gauge.min.js" integrity="sha512-CvDF0JVxliK2VV8gGA7qEEyRPcORRA2miPvpDhXvlfw0TpbGAmoQHMmEP2eziwKLsNz8PaoNfs4yjnlcpn4E3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div id="app"> 
        <!-- Header Section -->
        <header class="header-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- Logo -->
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                            </a>

                            <!-- Navigation Menu -->
                            <ul class="nav">
                                @if (Auth::check())
                                    <!-- Display Home button only if the user is authenticated -->
                                    <li><a href="{{ url('/') }}" class="nav-link active">Home</a></li>
                                @endif
                                <li><a href="{{ url('/about') }}" class="nav-link">About</a></li>
                            
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                                    @endif
                                @else
                                    <li><a class="nav-link">{{ Auth::user()->name }}</a></li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="nav-link logout-button">Logout</button>
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                            

                            <a class="menu-trigger">
                                <span>Menu</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright © 2024 <a href="#">Smoke Sense</a>. All rights reserved.</p>
                    <!-- Add the link to the Terms and Conditions page -->
                    <p><a href="{{ route('terms') }}">Terms and Conditions</a></p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script>
    
    $(document).ready(function () {
    const nav = $('.main-nav .nav'); // Select the navigation menu
    const menuTrigger = $('.menu-trigger'); // Select the hamburger menu button

    // Toggle the menu when the hamburger is clicked
    menuTrigger.click(function () {
        nav.slideToggle(); // Toggle menu visibility
        $(this).toggleClass('active'); // Toggle hamburger active state
    });

    // Function to reset navigation menu on window resize
    function handleResize() {
        if (window.innerWidth > 992) {
            nav.show(); // Ensure the menu is always visible on desktop
            menuTrigger.removeClass('active'); // Reset hamburger state
        } else {
            nav.hide(); // Hide the menu by default on mobile
        }
    }

    // Run handleResize on page load and whenever the window is resized
    handleResize();
    $(window).resize(handleResize);
});



    </script>

</body>
</html>
