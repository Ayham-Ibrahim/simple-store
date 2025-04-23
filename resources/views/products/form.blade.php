<div class="mb-3">
    <label>اسم المنتج</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>الفئة</label>
    <select name="category_id" class="form-control" required>
        <option value="">اختر فئة</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>الوحدة</label>
    <input type="text" name="unit" class="form-control" value="{{ old('unit', $product->unit ?? '') }}" >
</div>

<div class="mb-3">
    <label>السعر</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>الصورة</label>
    <input type="file" name="image" class="form-control">
    @if (!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" width="80" class="mt-2">
    @endif
</div>
