<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Azadi Market</title>
    <link href="{{ asset('css/cartStyle.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        {{-- resources/views/partials/header.blade.php --}}
            <header>
                <div class="navbar">
                    <div class="logo">
                        <span>
                            {{-- Use route() helper for dynamic links --}}
                            <a href="{{ route('home') }}" style="text-decoration: none;">
                                <p>Azadi Market</p>
                            </a>
                        </span>
                    </div>
                    <nav>
                        <ul>
                            {{-- Example: Fetch categories dynamically or define routes --}}
                            <li><a href="{{ route('home') }}">Home</a></li>
                            {{-- You'll likely fetch these categories from the DB --}}
                            <li><a href="{{ route('category.show', 'vegetables') }}">Vegetables</a></li> {{-- Assuming 'vegetables' is the slug --}}
                            <li><a href="{{ route('category.show', 'fruits') }}">Fruits</a></li> {{-- Assuming 'fruits' is the slug --}}
                            <li><a href="{{ route('category.show', 'drinks') }}">Drinks</a></li> {{-- Assuming 'drinks' is the slug --}}
                        </ul>
                    </nav>
                    {{-- Search Form pointing to a search route --}}
                    <form action="{{ route('search') }}" method="GET" class="search">
                        {{-- No @csrf needed for GET requests --}}
                        <input id="searchInput" name="query" type="text" placeholder="Search products..." value="{{ request('query') }}">
                        <button type="submit">Search</button> {{-- Changed from onclick JS to form submit --}}
                    </form>
                    <div class="cart-icon">
                        <a href="{{ route('cart.show') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">
                                {{ auth()->user()->cartItems->count() }} {{-- Assuming you have a relation cartItems on the User model --}}
                            </span>
                        </a>
                    </div>
                </div>
            </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
