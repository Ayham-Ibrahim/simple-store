{{-- resources/views/products/category.blade.php --}}
@extends('layouts.mainApp')

@section('title', 'Azadi Market - ' . $category->name)

@section('content')
<section>
    <h2 class="category-head" id="{{ $category->name }}">
        <a href="{{ route('category.show', $category->name) }}" style="color: white; text-decoration: none;">
            {{ $category->name }}
        </a>
    </h2>

    {{-- Check if products exist --}}
    @if($products->isEmpty())
    <p>No products found in the {{ $category->name }} category.</p>
    @else
    <div class="category">
        {{-- Loop through products for this specific category --}}
        @foreach($products as $product)
        <x-product-card :product="$product" />
        @endforeach
    </div>
    @endif
</section>

{{-- Optional: Add Pagination Links if you implement pagination in controller --}}
{{-- <div style="margin-top: 20px;">
         {{ $products->links() }}
</div> --}}
@endsection

@push('scripts')
{{-- <script> console.log('Category page script loaded for {{ $category->name }}'); </script> --}}
@endpush
