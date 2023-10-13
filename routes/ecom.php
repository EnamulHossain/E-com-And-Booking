<?php

use Illuminate\Support\Facades\Route;

Route::prefix('product-category')->group(function () {
	Route::get('/', 'ProductCategories@index')->name('productcategory.index');
	Route::get('/create', 'ProductCategories@create')->name('productcategory.create');
	Route::post('/create', 'ProductCategories@createAction')->name('productcategory.createaction');
	Route::get('/show/{id}', 'ProductCategories@show')->name('productcategory.show');
	Route::get('/edit/{id}', 'ProductCategories@edit')->name('productcategory.edit');
	Route::post('/edit/{id}', 'ProductCategories@editAction')->name('productcategory.editaction');
	Route::get('/delete/{id}', 'ProductCategories@delete')->name('productcategory.delete');
	Route::get('/status/{id}', 'ProductCategories@Status')->name('productcategory.status');
});

// product
Route::prefix('product')->group(function () {
	Route::get('/', 'Products@index')->name('product.index');
	Route::get('/create', 'Products@create')->name('product.create');
	Route::post('/create', 'Products@createAction')->name('product.createaction');
	Route::get('/show/{id}', 'Products@show')->name('product.show');
	Route::get('/edit/{id}', 'Products@edit')->name('product.edit');
	Route::post('/edit/{id}', 'Products@editAction')->name('product.editaction');
	Route::get('/delete/{id}', 'Products@delete')->name('product.delete');
	Route::post('/remove-media', 'Products@removeMedia');
	//  Route::get('/status/{id}', 'Products@Status')->name('product.status');
});

// order product
Route::prefix('order-product')->group(function () {
	Route::get('/', 'OrderProducts@index')->name('orderproduct.index');
	Route::get('/create', 'OrderProducts@create')->name('orderproduct.create');
	Route::post('/create', 'OrderProducts@createAction')->name('orderproduct.createaction');
	Route::get('/show/{id}', 'OrderProducts@show')->name('orderproduct.show');
	Route::get('/edit/{id}', 'OrderProducts@edit')->name('orderproduct.edit');
	Route::post('/edit/{id}', 'OrderProducts@editAction')->name('orderproduct.editaction');
	Route::get('/delete/{id}', 'OrderProducts@delete')->name('orderproduct.delete');
	//  Route::get('/status/{id}', 'Products@Status')->name('product.status');
});

// order product
Route::resource('orderedproduct', OrderedProductsController::class);
// Tag
Route::prefix('tag')->group(function () {
	Route::get('/', 'Tags@index')->name('tag.index');
	Route::get('/create', 'Tags@create')->name('tag.create');
	Route::post('/create', 'Tags@createAction')->name('tag.createaction');
	Route::get('/show/{id}', 'Tags@show')->name('tag.show');
	Route::get('/edit/{id}', 'Tags@edit')->name('tag.edit');
	Route::post('/edit/{id}', 'Tags@editAction')->name('tag.editaction');
	Route::get('/delete/{id}', 'Tags@delete')->name('tag.delete');
	//  Route::get('/status/{id}', 'Products@Status')->name('product.status');
});