@extends('layouts.master')
@section('content')
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            @foreach ($orders as $item)
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Billing Address
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample" style="">
                                        <div class="card-body">
                                            <div class="billing-address-form">
                                                <form action="index.html">
                                                    <p><input type="text" placeholder="Name" value="{{ $item->name }}">
                                                    </p>
                                                    <p><input type="email" placeholder="Email"
                                                            value="{{ $item->email }}">
                                                    </p>
                                                    <p><input type="text" placeholder="Address"
                                                            value="{{ $item->address }}"></p>
                                                    <p><input type="tel" placeholder="Phone"
                                                            value="{{ $item->phone }}">
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="cart-table-wrap">
                                            <table class="cart-table">
                                                <thead class="cart-table-head">
                                                    <tr class="table-head-row">
                                                        <th class="product-remove">order id</th>
                                                        <th class="product-image">Product id</th>
                                                        <th class="product-name">Name</th>
                                                        <th class="product-price">Quantity</th>
                                                        <th class="product-quantity">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item->items as $i)
                                                        <tr class="table-body-row">
                                                            <td>{{ $i->order_id }}</td>
                                                            <td>{{ $i->product_id }}</td>
                                                            <td>{{ $i->product->name }}</td>
                                                            <td>{{ $i->quantity }}</td>
                                                            <td>{{ $i->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
