@extends('layouts.master')
@section('content')
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="{{ route('checkout.store') }}" method="POST" id = "check_store">
                                                @csrf
                                                <p><input type="text" name="name" placeholder="Name"></p>
                                                <p><input type="email" name="email" placeholder="Email"></p>
                                                <p><input type="text" name="address" placeholder="Address"></p>
                                                <p><input type="tel" name="phone" placeholder="Phone"></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Shipping Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <div class="shipping-address-form">
                                            <p>Your shipping address form is here.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            Card Details
                                        </button>
                                    </h5>
                                </div>
                                <div class="cart-section mt-150 mb-150">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <div class="cart-table-wrap">
                                                    <table class="cart-table">
                                                        <thead class="cart-table-head">
                                                            <tr class="table-head-row">
                                                                <th class="product-remove"></th>
                                                                <th class="product-image">Product Image</th>
                                                                <th class="product-name">Name</th>
                                                                <th class="product-price">Price</th>
                                                                <th class="product-quantity">Quantity</th>
                                                                <th class="product-total">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cart->items as $item)
                                                                <tr class="table-body-row">
                                                                    <td class="product-remove">
                                                                        <form action="{{ route('cart.remove', $item) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">حذف</button>
                                                                        </form>
                                                                    </td>
                                                                    <td class="product-image"><img
                                                                            src="{{ asset('storage/' . $item->product->imagepath) }}"
                                                                            alt="">
                                                                    </td>
                                                                    <td class="product-name">{{ $item->product->name }}</td>
                                                                    <td class="product-price">${{ $item->product->price }}
                                                                    </td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td class="product-total">
                                                                        {{ $item->product->price * $item->quantity }}</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="total-section">
                                                    <table class="total-table">
                                                        <thead class="total-table-head">
                                                            <tr class="table-total-row">
                                                                <th>Total</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="total-data">
                                                                <td><strong>Total: </strong></td>
                                                                <td>
                                                                    {{ $cart->total }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="cart-buttons">
                        <a onclick="event.preventDefault();
                                                     document.getElementById('check_store').submit();"
                            class="boxed-btn">place
                            order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
