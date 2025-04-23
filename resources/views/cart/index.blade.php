@extends('layouts.cart')

@section('content')
    <div class="container mt-5">
        <h2 style="font-weight: bold;margin-bottom:30px;">Your Cart</h2>
        
        @if($cartItems->isNotEmpty())
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->product->name }}</td>
                            <td>{{ number_format($cartItem->product->price) }} ID</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>{{ number_format($cartItem->total_price) }} ID</td>
                            <td>
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
          
            <div class="d-flex justify-content-between">
                <h4>Total: {{ number_format($cartItems->sum('total_price')) }} ID</h4>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                </form>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        table th, table td {
            text-align: center;
        }

        /* .table {
            margin-top: 30px;
            font-size: 16px;
        } */

        .table th {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }

        .table td {
            vertical-align: middle;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .thead-dark th {
            background-color: #343a40;
            color: #fff;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .d-flex a {
            text-decoration: none;
            font-size: 18px;
        }

        .d-flex a:hover {
            text-decoration: underline;
        }

        .cart-icon i {
            font-size: 18px;
        }
    </style>
@endsection
