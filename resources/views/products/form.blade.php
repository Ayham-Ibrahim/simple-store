<div class="mb-3">
    <label>اسم المنتج</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>الوصف</label>
    <textarea name="description" class="form-control" required>{{ old('description', $product->description ?? '') }}</textarea>
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