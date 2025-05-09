@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('products.form', ['product' => $product])
        <button class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
