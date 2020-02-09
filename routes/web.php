<?php

// Website
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// Product
Route::get('/products/{slug}', 'ProductController@show')->name('product.show');

// Cart
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/add/{slug}/{quantity}', 'CartController@add')->name('cart.add');
Route::post('/cart/update/{slug}', 'CartController@update')->name('cart.update');

// Order
Route::get('/order', 'OrderController@index')->name('order.index');
Route::post('/order', 'OrderController@create')->name('order.create');
Route::get('/order/{hash}', 'OrderController@show')->name('order.show');
