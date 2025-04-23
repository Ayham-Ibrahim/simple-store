@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Products</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>image</th>
                <th>name</th>
                <th>unit</th>
                <th>price</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" width="60"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->unit}}</td>
                <td>{{ $product->price }} ID</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
