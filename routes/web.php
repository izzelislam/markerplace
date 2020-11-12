<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

// fronnt store
Route::get('/categories', 'CategoryController@index')->name('category');
Route::get('/categories/{id}', 'CategoryController@detail')->name('category-detail');
Route::get('/detail/{id}', 'DetailController@index')->name('detail');
Route::post('/detail/{id}', 'DetailController@add')->name('detail-add');


Route::post('/checkout/callback', 'CheckController@callback')->name('midtrans-callback');

Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');



Route::group(['middleware' => ['auth']], function () {
     Route::get('/cart', 'CartController@index')->name('cart');
     Route::delete('/cart/{id}', 'CartController@destroy')->name('cart-delete');

     Route::post('/checkout', 'CheckoutController@process')->name('checkout');

     // dashboard
     Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

     Route::get('/dashboard/product', 'DashboardProductsController@index')->name('dashboard-product');
     Route::get('/dashboard/product/create', 'DashboardProductsController@create')->name('dashboard-product-create');
     Route::post('/dashboard/product', 'DashboardProductsController@store')->name('dashboard-product-store');
     Route::get('/dashboard/product/{id}', 'DashboardProductsController@detail')->name('dashboard-product-detail');
     Route::post('/dashboard/product/{id}', 'DashboardProductsController@update')->name('dashboard-product-update');

     Route::post('/dashboard/product/gallery/upload', 'DashboardProductsController@uploadgallery')->name('dashboard-product-gallery-upload');
     Route::get('/dashboard/product/gallery/delete/{id}', 'DashboardProductsController@delete')->name('dashboard-product-gallery-delete');

     Route::get('/dashboard/transaction', 'DashboardTransactionController@index')->name('dashboard-transaction');
     Route::get('/dashboard/transaction/{id}', 'DashboardTransactionController@detail')->name('dashboard-transaction-detail');
     Route::post('/dashboard/transaction/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

     Route::get('/dashboard/setting', 'DashboardSettingController@store')->name('dashboard-setting-store');
     Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-account');

     Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-redirect');

});

// admin dashboarr

Route::prefix('admin')->namespace('Admin')->middleware(['auth','admin'])->group(function(){
     Route::get('/','DashboardController@index')->name('dashboard-admin');
     Route::resource('category', 'CategoryController');
     Route::resource('user', 'UserController');
     Route::resource('product', 'ProductController');
     Route::resource('product-gallery', 'ProductGalleryController');
});



Auth::routes();

