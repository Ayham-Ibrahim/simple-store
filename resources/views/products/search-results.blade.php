{{-- resources/views/products/search-results.blade.php --}}
@extends('layouts.mainApp')

@section('title', 'Search Results for "' . request('query') . '"')

@section('content')
<section>
    <h2>Search Results for "{{ request('query') }}"</h2>

    @if($products->isEmpty())
    <p>No products found matching your search criteria.</p>
    @else
    <div class="category"> {{-- Re-use category grid style --}}
        @foreach($products as $product)
        <x-product-card :product="$product" />
        @endforeach
    </div>
    @endif
</section>

{{-- Optional: Pagination Links --}}
{{-- <div style="margin-top: 20px;">
         {{ $products->appends(request()->query())->links() }} {{-- Keep query parameters in pagination --}}
{{-- </div> --}}
@endsection
