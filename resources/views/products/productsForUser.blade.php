@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Products</h2>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->description }}</p>
                    <p><strong>{{ $product->price }}Dl</strong></p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                        <button class="btn btn-success w-100">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
