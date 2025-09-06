<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [CategoryController::class, 'all_categories'])->middleware('auth');

Route::get('master', function () {
    return view('layouts.master');
});
Route::middleware('auth')->group(function () {
    Route::get('categories', [CategoryController::class, 'all_categories'])->name('categories.index');
    Route::get('add_category', [CategoryController::class, 'add_category'])->name('categories.add');
    Route::post('store_category', [CategoryController::class, 'store_category']);

    Route::get('add_product', [ProductController::class, 'add_product'])->name('add.product');
    Route::post('store_product', [ProductController::class, 'store_product']);
    Route::get('products/{id?}', [ProductController::class, 'index'])->name('all_products');
    Route::get('edit_product/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('update_product/{id}', [ProductController::class, 'updated'])->name('product.update');
    Route::delete('remove_product/{id}', [ProductController::class, 'destroy'])->name('product.remove');
    Route::get('product_table', [ProductController::class, 'product_table'])->name('products.table');
    Route::get('search', [ProductController::class, 'search_product'])->name('products.search');
    Route::get('single_product/{id}', [ProductController::class, 'single_product'])->name('products.single');
    Route::post('product/add/images/{id}', [ProductController::class, 'add_images_to_product'])->name('product.images');


    Route::get('review_show', [ReviewController::class, 'show'])->name('reviews.show');
    Route::post('add_reviews', [ReviewController::class, 'store']);

    Route::post('add_to_cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('index', [CartController::class, 'index'])->name('cart.show');
    Route::delete('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('checkout', [CartController::class, 'complet'])->name('cart.complet');
    Route::post('order/store', [CartController::class, 'store_order'])->name('checkout.store');
    Route::get('previous', [CartController::class, 'previous_orders'])->name('checkout.previous');
});

Route::post('language/{id}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('language.change');

Route::get('/admin', function () {
    return 'your admin';
})->middleware('role:admin');

Route::get('/salesman', function () {
    return 'your salesman';
})->middleware('role:salesman');


// في routes/web.php
Route::get('/test-qr', function () {
    return QrCode::size(300)->generate('Hello World!');
});
