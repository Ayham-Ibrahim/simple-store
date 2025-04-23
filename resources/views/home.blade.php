{{-- resources/views/home.blade.php --}}
@extends('layouts.mainApp') {{-- Use the master layout --}}

@section('title', 'Azadi Market - Home') {{-- Set the page title --}}

@section('content') {{-- Define the content section --}}

{{-- Check if categories exist --}}
@if($categoriesWithProducts->isEmpty())
<p>No categories or products found.</p>
@else
{{-- Loop through categories passed from the controller --}}
@foreach($categoriesWithProducts as $category)
<section>
    {{-- Check if products exist in this category --}}
    @if($category->products->isEmpty())
    {{-- <p>No products found in this category.</p> --}}
    @else
    {{-- Display category name, link to category page --}}
    <h2 class="category-head" id="{{ $category->name }}">
        <a href="{{ route('category.show', $category->name) }}" style="color: white; text-decoration: none;">
            {{ $category->name }}
        </a>
    </h2>

    <div class="category">
        {{-- Loop through products in the category --}}
        @foreach($category->products as $product)
        {{-- Use the ProductCard component, passing the product data --}}
        <x-product-card :product="$product" />
        @endforeach
    </div>
    @endif
</section>
@endforeach
@endif

@endsection

{{-- Add page-specific scripts if needed --}}
@push('scripts')
{{-- <script> console.log('Home page script loaded'); </script> --}}
@endpush
