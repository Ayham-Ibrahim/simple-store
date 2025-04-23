<div class="mb-3">
    <label>Product Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control" required>
        <option value="">Select a category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Unit</label>
    <input type="text" name="unit" class="form-control" value="{{ old('unit', $product->unit ?? '') }}">
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    @if (!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" width="80" class="mt-2">
    @endif
</div>
