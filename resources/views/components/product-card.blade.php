{{-- resources/views/components/product-card.blade.php --}}
@props(['product']) {{-- Define the $product variable expected by this component --}}

<div class="product">
    {{-- Add data attributes for JavaScript --}}
    <div class="favorite-icon" onclick="toggleFavorite(this)" data-product-id="{{ $product->id }}">
        <i class="fas fa-heart"></i>
    </div>

    <div class="image-placeholder">
        {{-- Use asset() helper and access product image path --}}
        {{-- Assumes image_path stores path relative to storage/app/public --}}
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    </div>

    <h3>{{ $product->name }}</h3>
    {{-- Access product price and unit (add 'unit' column to your products table or default) --}}
    <p class="price">{{ number_format($product->price) }} ID / {{ $product->unit ?? 'item' }}</p>

    <div class="qyt">
        <label for="quantity_{{ $product->id }}">Quantity:</label> {{-- Unique ID --}}
        <input id="quantity_{{ $product->id }}" type="number" value="1" min="1"> {{-- Use unique ID --}}
    </div>

    <div class="productbtns">
        {{-- Add data attributes to the button for JS addToCart function --}}
        <button class="add-to-cart-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-image="{{ asset('storage/' . $product->image_path) }}" data-product-unit="{{ $product->unit ?? 'item' }}">
            Add to Cart
        </button>
    </div>
</div>
