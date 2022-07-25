@extends('layouts.frontend')
@section('title', 'Checkout Page ')

@section('content')
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- breadcrumb-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-12">
                        <div class="box">
                            <h1>Checkout
                                <a class="btn btn-info" href="{{ route('frontend.cart.list') }}">Back to Cart</a>
                            </h1>
                            @include('backend.includes.flash')
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                        <th colspan="2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($carts) > 0)
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($carts as $index => $cart)
                                            @php
                                                $product = \App\Models\Backend\Product::find($cart->id);
                                                $image = $product->productImages()->first();
                                                $total += $cart->qty * $cart->price;
                                            @endphp
                                            <input type="hidden" name="row_id[]" value="{{ $index }}">
                                            <tr>
                                                <td><a href="#"><img src="" alt="brand"></a></td>
                                                <td><a href="#">{{ $cart->name }}</a></td>
                                                <td>
                                                    {{ $cart->qty }}
                                                </td>
                                                <td>{{ $cart->price }}</td>

                                                <td>{{ $cart->qty * $cart->price }}</td>
                                            </tr>
                                        @endforeach
                                   
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th colspan="1">Rs. {{ $total }}</th>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="6">Cart is empty</td>
                                    </tr>
                                @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <form action="{{ route('frontend.docheckout') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-control">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                </div>
                            <div class="form-group">
                                <label for="shipping_address">Shipping Address</label>
                                <textarea id="shipping_address" name="shipping_address" type="text" class="form-control"> </textarea>
                                @error('shipping_address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Contact</label>
                                <input id="phone" name="phone" type="text" class="form-control">
                                @error('phone')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="payment_mode">Payment Mode</label>
                                <input id="payment_mode" name="payment_mode" type="radio" value="cod"  checked>COD
                                <input id="payment_mode" name="payment_mode" type="radio" value="online">Online
                                @error('phone')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i>
                                    Process</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
