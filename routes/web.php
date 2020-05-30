<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LoginPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('Pages/Home');
// });

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'HomePageController@index');
    // Route::get('/home', 'HomePageController@index')->name('home')->middleware('verified');
});


Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductsPageController@index')->name('products.index');
    Route::get('{id}', 'HomePageController@getProductById');
    // Route::get('/category/{id}', 'ProductsPageController@getProductsByIdCategory');
});

Route::get('/compare', 'CompareController@index');

Route::get('/contact', 'ContactController@index');

Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'LoginPageController@index')->name('login');
    Route::post('/', 'LoginPageController@postLogin')->name('login.post');
});

Route::group(['prefix' => 'forgotpassword'], function () {
    Route::get('/', "ForgotPasswordController@index");
    Route::post('/', 'ForgotPasswordController@postForgotPassword');
    Route::get('/change', "ForgotPasswordController@changePassword");
    Route::post('/change', "ForgotPasswordController@postChangePassword");
});

Route::get('/logout', 'LoginPageController@logout');

Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'RegisterPageController@index')->name('register.index');
    Route::post('/', 'RegisterPageController@postRegister')->name('register.post');
});

Route::get('/verify', 'VerifyPageController@index');

Route::group(['prefix' => 'infouser'], function () {
    Route::get("/", 'InfoUserController@index');
    Route::post("/changepassword", 'ChangePasswordController@postChangePassword');
});

Route::group(['prefix' => 'wishlist'], function () {
    Route::get('/', 'WishListController@index');
    Route::post('/add', 'WishListController@addWishList');
    Route::post('/remove', 'WishListController@removeWishList');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@index');
    Route::post('/add', 'CartController@addItemCart');
    Route::post('/remove', 'CartController@removeItemCart');
    Route::post('/update', 'CartController@updateItemCart');
    Route::post('/destroy', 'CartController@destroyCart');
    Route::get('gettotalprice', 'CartController@getTotalPriceCart');
});

Route::get('/checkout', 'CheckoutController@index');


Route::group(['prefix' => 'ajax'], function () {
    Route::get('{id}', 'AjaxController@getProductQuickView');
    Route::get('suppliers/{id}', 'AjaxController@getSuplliersByCategory');
    Route::get('colors/getcolors', 'AjaxController@getColors');
    Route::get('colors/getcolorsbyproduct/{id}', 'AjaxController@getColorsByProduct');
    Route::post('suggestsearch', 'AjaxController@suggestSearch')->name('search.suggetSearch');
});

Route::fallback(function () {
    return view('Pages.404');
});

Route::get('/home', 'HomeController@index')->name('home');
