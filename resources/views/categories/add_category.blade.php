@extends('layouts.master')
@section('content')
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">

                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="store_category" enctype="multipart/form-data" id="fruitkha-contact"
                            onsubmit="return valid_datas( this );">
                            @csrf
                            <p>
                                <input type="text" placeholder="Name" name="name" id="name">
                            </p>
                            <p>
                                <input type="file" name="imagepath" id="">
                            </p>
                            <input type="hidden" name="token" value="FsWga4&amp;@f6aw">
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Shop Address</h4>
                            <p>34/8, East Hukupara <br> Gifirtok, Sadan. <br> Country Name</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Shop Hours</h4>
                            <p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Contact</h4>
                            <p>Phone: +00 111 222 3333 <br> Email: support@fruitkha.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
