@extends('layouts.master')
@section('content')
    <div class="barcode">
        <h3>الباركود الخاص بالمنتج</h3>
        {!! $barcode !!}
    </div>
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}"
                            enctype="multipart/form-data" id="fruitkha-contact" onsubmit="return valid_datas( this );">
                            @csrf
                            @method('PUT')
                            <p>
                                <input type="text" placeholder="Name" value="{{ $product->name }}" name="name"
                                    id="name">
                                <input type="number" placeholder="price" value="{{ $product->price }}" name="price"
                                    id="price">
                            </p>
                            <p>
                                <img src="{{ asset('storage/' . $product->imagepath) }}" alt="" srcset="">
                                <input type="file" placeholder="image" value="{{ $product->imagepath }}" name="imagepath"
                                    id="imagepath">
                            </p>
                            <div class="qr-code">
                                <h3>شارك المنتج بسهولة</h3>
                                {!! $qrCode !!}
                                <p>صور الكود لمشاركة المنتج</p>
                            </div>
                            <p>
                                <select name="category_id" id="">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <input type="hidden" name="token" value="FsWga4&amp;@f6aw">
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
