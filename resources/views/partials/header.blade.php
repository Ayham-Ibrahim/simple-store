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
            <a href="{{ route('cart.index') }}"> {{-- Link to cart page route --}}
                <i class="fas fa-shopping-cart"></i>
                {{-- Optionally display cart count here later --}}
            </a>
        </div>
    </div>
</header>
