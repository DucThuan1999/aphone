<?php

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


Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'LoginPageController@index')->name('login');
    Route::post('/', 'LoginPageController@postLogin')->name('login.post');
});

Route::get('/logout', 'LoginPageController@logout');

Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'RegisterPageController@index')->name('register.index');
    Route::post('/', 'RegisterPageController@postRegister')->name('register.post');
});

// Route::get('/verify', 'VerificationController');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('{id}', 'AjaxController@getProductQuickView');
    Route::get('suppliers/{id}', 'AjaxController@getSuplliersByCategory');
    Route::get('colors/getcolors', 'AjaxController@getColors');
    Route::get('colors/getcolorsbyproduct/{id}', 'AjaxController@getColorsByProduct');
});

Route::fallback(function () {
    return view('Pages.404');
});

Route::get('/home', 'HomeController@index')->name('home');
