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
    Route::post('/thien', 'HomePageController@subscribe');
    // Route::get('/home', 'HomePageController@index')->name('home')->middleware('verified');
});


Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductsPageController@index')->name('products.index');
    Route::get('{id}', 'HomePageController@getProductById');
    Route::post('{id}', 'CommentController@comment');
    // Route::get('/category/{id}', 'ProductsPageController@getProductsByIdCategory');
});

Route::group(['prefix' => 'compare'], function () {
    Route::get('/', 'CompareController@index');
    Route::post('/', 'CompareController@compare');
});

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
    Route::get('/gettotalprice', 'CartController@getTotalPriceCart');
    Route::post('/paypal/getbutton', 'CartController@getPaypalButton');
    Route::post('/paypal/getbuttondeposit', 'CartController@getPaypalButtonDeposit');
});


Route::group(['prefix' => 'checkout'], function () {
    Route::get("/", 'CheckoutController@index');
    Route::post("/bills/add", 'CheckoutController@addBills');
    Route::get("/success", 'CheckoutController@success');
    Route::post("/coupon/check", 'CheckoutController@checkCoupon');
});

Route::group(['prefix' => 'promotions'], function () {
    Route::get('/', 'PromotionController@index');
    Route::get('{id}', 'PromotionController@single');
});

Route::group(['prefix' => 'ajax'], function () {
    Route::get('{id}', 'AjaxController@getProductQuickView');
    Route::get('suppliers/{id}', 'AjaxController@getSuplliersByCategory');
    Route::get('colors/getcolors', 'AjaxController@getColors');
    Route::get('colors/getcolorsbyproduct/{id}', 'AjaxController@getColorsByProduct');
    Route::post('qty/getqtybycolor', 'AjaxController@getQtyByColors');
    Route::post('/suggestsearch', 'AjaxController@suggestSearch')->name('search.suggetSearch');
    Route::post('/suggestsearch1', 'AjaxController@suggestSearch1')->name('search.suggetSearch1');
    Route::post('/suggestsearch2', 'AjaxController@suggestSearch2')->name('search.suggetSearch2');

    Route::group(['prefix' => 'location'], function () {
        Route::get('/', 'AjaxController@getLocation');
        Route::get('/province', 'AjaxController@getProvince');
        Route::get('/province/{id}/district', 'AjaxController@getDistrictByProvince');
        Route::get('/district/{id}/ward', 'AjaxController@getWardByDistrict');
    });
});

Route::fallback(function () {
    return view('Pages.404');
});
