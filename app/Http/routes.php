<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $aCats = \App\Category::all();
    return view('main', ['aCats' => $aCats]);
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/products/{category}', 'ProductsController@display');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('/home', 'HomeController');
	Route::resource('/order', 'OrderController');
	Route::get('/paypal/pay', 'OrderController@payPayPal');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::resource('home', 'Admin\HomeController');
    Route::resource('order', 'Admin\OrderController');
    Route::resource('product', 'Admin\ProductController');
});

Route::group(['prefix' => 'datatables'], function () {
    Route::get('admin/product', ['as'=>'datatables.admin.product', 'uses'=>'Datatable\Admin\ProductController@all']);
    Route::get('admin/order', ['as'=>'datatables.admin.order', 'uses'=>'Datatable\Admin\OrderController@all']);
    Route::get('product/cart',  ['as'=>'datatables.product.cart', 'uses'=>'Datatable\ProductController@cart']);
});