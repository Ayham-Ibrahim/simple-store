@props(['product'])

<div class="product">
    <div class="favorite-icon" onclick="toggleFavorite(this)" data-product-id="{{ $product->id }}">
        <i class="fas fa-heart"></i>
    </div>

    <div class="image-placeholder">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    </div>

    <h3>{{ $product->name }}</h3>
    <p class="price">{{ number_format($product->price) }} ID / {{ $product->unit ?? 'item' }}</p>

    <div class="qyt">
        <label for="quantity_{{ $product->id }}">Quantity:</label>
        <input id="quantity_{{ $product->id }}" type="number" value="1" min="1">
    </div>

    <div class="productbtns">
        <button class="add-to-cart-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-image="{{ asset('storage/' . $product->image) }}" data-product-unit="{{ $product->unit ?? 'item' }}" onclick="addToCart({{ $product->id }})">
            Add to Cart
        </button>
    </div>
</div>
<script>
    function addToCart(productId) {
        var quantity = document.getElementById('quantity_' + productId).value;

        // إرسال البيانات باستخدام AJAX
        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message); // إظهار رسالة النجاح
                // يمكن تحديث عدد السلة في واجهة المستخدم هنا إذا رغبت
                console.log('Cart count: ', data.cart_count);
            } else if (data.error) {
                alert(data.error); // إظهار رسالة الخطأ
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
