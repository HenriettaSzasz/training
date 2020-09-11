<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'is-admin', 'prefix' => 'admin'],function (){
    Route::resources([
        'products' => 'ProductsController',
        'categories' => 'CategoriesController',
        'orders' => 'OrdersController',
        'users' => 'UsersController',
    ]);
});

Route::group(['middleware' => array('auth', 'verified')], function (){
    Route::get('/products', 'CartController@products')->name('products');

    Route::get('/products/{id}', 'CartController@showProduct')->name('show-products');

    Route::get('products/category/{id}', 'CartController@category')->name('category');

    Route::get('/cart', 'CartController@cart')->name('cart');

    Route::get('/add-to-cart/{id}', 'CartController@addToCart')->name('add-to-cart');

    Route::get('/subtract-from-cart/{id}', 'CartController@subtractFromCart')->name('subtract-from-cart');

    Route::get('/remove-from-cart/{id}', 'CartController@removeFromCart')->name('remove-from-cart');

    Route::get('/update-cart/{id}/quantity/{quantity}', 'CartController@updateCart')->name('update-cart');

    Route::get('/place-order', 'PlaceOrderController@placeOrder')->name('place-order');

    Route::get('order-history', 'PlaceOrderController@orderHistory')->name('order-history');

    Route::get('order-details/{id}', 'PlaceOrderController@orderDetails')->name('order-details');

    Route::get('create-pdf/{id}', 'PlaceOrderController@createPDF')->name('create-pdf');
});




