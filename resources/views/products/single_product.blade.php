@extends('layouts.master')
@section('content')
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset('storage/' . $product->imagepath) }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{ $product->name }}</h3>
                        <p class="single-product-pricing"><span>Per Kg</span> ${{ $product->price }}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi cum
                            voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi perferendis
                            eos eum modi! Tempora, earum.</p>
                        <div class="single-product-form">
                            <form action="index.html">
                                <input type="number" placeholder="0">
                            </form>
                            <div>
                                <a href="" class="cart-btn"
                                    onclick="event.preventDefault();
                                                     document.getElementById('single_pro').submit();"><i
                                        class="fas fa-shopping-cart"></i> Add to Cart</a>
                                <form id="single_pro" action="{{ route('cart.add', $product->id) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                <p><strong>Categories: </strong>{{ $product->category->name }}</p>
                            </div>
                            @if (Auth::user() && Auth::user()->role == 'admin')
                                <form action="{{ route('product.images', $product->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <p>إضافة صور للمنتج</p>
                                    <input type="file" name="images[]" multiple id="">
                                    <input type="submit">
                                </form>
                            @endif
                            @foreach ($images->productimages as $item)
                                <img src="{{ asset('storage/' . $item->images) }}" alt="" srcset=""
                                    width="50px" height="50px">
                            @endforeach
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
