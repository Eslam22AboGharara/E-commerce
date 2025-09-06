@extends('layouts.master')
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                @foreach ($product as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="single-product.html"><img src="{{ asset('storage/' . $item->imagepath) }}"
                                        alt=""></a>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p class="product-price"><span>Per Kg</span> {{ $item->price }}$ </p>

                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> إضافه إلى العربه</a>
                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i>
                                تعديل
                                المنتج</a>
                            <form action="{{ route('product.remove', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> حذف المنتج
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
