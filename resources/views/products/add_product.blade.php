@extends('layouts.master')
@section('content')
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="store_product" enctype="multipart/form-data" id="fruitkha-contact"
                            onsubmit="return valid_datas( this );">
                            @csrf
                            <p>
                                <input type="text" placeholder="Name" name="name" id="name">
                                <input type="number" placeholder="price" name="price" id="price">
                            </p>
                            <p>
                                <input type="file" placeholder="image" name="imagepath" id="imagepath">
                            </p>
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
