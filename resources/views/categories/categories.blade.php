@extends('layouts.master')
@section('content')
    {{ session('usname') }}
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                @foreach ($categories as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="products/{{ $item->id }}"><img src="{{ asset('storage/' . $item->imagepath) }}"
                                        alt=""></a>
                            </div>
                            <h3>{{ session('locale') == 'ar' ? $item->name : $item->nameEN }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
