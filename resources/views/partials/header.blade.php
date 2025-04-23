{{-- resources/views/partials/header.blade.php --}}
<header>
    <div class="navbar">
        <div class="logo">
            {{-- Use h1 for better semantics if it's the main site logo --}}
            <h1>
                <p>
                    Azadi Market
                </p>
            </h1>
            {{-- Removed the <p> tag inside span as it was likely causing styling issues
                 If you need a tagline, add it separately:
                 <p class="tagline">Your Fresh Choice</p>
            --}}
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>

                @isset($allNavCategories, $navCategoryLimit)
                @php
                $totalCategories = $allNavCategories->count();
                $showDropdown = $totalCategories > $navCategoryLimit;
                @endphp

                @foreach($allNavCategories->take($navCategoryLimit) as $navCategory)
                <li>
                    {{-- Add class to identify category links if needed --}}
                    <a href="{{ route('category.show', $navCategory->name) }}" class="nav-category-link">
                        {{ $navCategory->name }}
                    </a>
                </li>
                @endforeach

                @if($showDropdown)
                {{-- Make sure the parent LI has the 'dropdown' class from your CSS --}}
                <li class="dropdown">
                    {{-- Ensure the link has 'dropdown-toggle' class --}}
                    <a href="#" class="dropdown-toggle" role="button">
                        More <i class="fas fa-caret-down fa-xs"></i>
                    </a>
                    {{-- Ensure the UL has 'dropdown-menu' class --}}
                    <ul class="dropdown-menu">
                        @foreach($allNavCategories->skip($navCategoryLimit) as $dropdownCategory)
                        <li>
                            {{-- Ensure the link has 'dropdown-item' class --}}
                            <a class="dropdown-item" href="{{ route('category.show', $dropdownCategory->name) }}">
                                {{ $dropdownCategory->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @endisset

            </ul>
        </nav>

        {{-- Search Form --}}
        <form action="{{ route('search') }}" method="GET" class="search">
            <input id="searchInput" name="query" type="search" placeholder="Search products..." value="{{ request('query') }}"> {{-- Changed type to "search" --}}

            {{-- ***** ADD THIS HIDDEN INPUT ***** --}}
            @isset($category) {{-- Check if $category variable exists (passed from CategoryController::show) --}}
            <input type="hidden" name="category_context" value="{{ $category->name }}">
            @endisset
            {{-- ******************************** --}}

            <button type="submit">Search</button>
        </form>

        {{-- Cart Icon --}}
        <div class="cart-icon">
            <a href="{{ route('cart.index') }}" aria-label="View Shopping Cart"> {{-- Added aria-label --}}
                <i class="fas fa-shopping-cart"></i>
                {{-- Optional: Add badge here if needed --}}
                {{-- <span class="cart-count-badge" style="display: none;">0</span> --}}
            </a>
        </div>
    </div>
</header>
