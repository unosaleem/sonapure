<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'  =>  [] , 'prefix' => 'auth'], function() {
    Route::post('login','API\AuthController@authenticate');
    Route::post('register','API\AuthController@register');
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('auth/logout','API\AuthController@logout');
    Route::post('auth/profile','API\AuthController@profile');
    Route::post('auth/profile_image','API\AuthController@profile_image');

    Route::post('auth/update/profile','API\AuthController@profileUpdate');
    Route::post('auth/update/password','API\AuthController@passwordUpdate');


    Route::post('add-to-cart','API\CartController@addToCart');
    Route::post('view-cart','API\CartController@viewCart');

    Route::post('add-wishlist','API\WishlistController@addToWishlist');
    Route::post('view-wishlist','API\WishlistController@viewWishlist');

    Route::post('add-update-address','API\AuthController@addUpdateAddress');
    Route::post('address-list','API\AuthController@addressList');

    Route::post('get-address-via-pincode','API\AuthController@getAddressViaPinCode');
    Route::post('get-address-type','API\AuthController@getAddressType');


    Route::post('make-order','API\OrderController@makeOrder');
    Route::post('final-payment','API\OrderController@final_payment');
    Route::post('re-check-payment','API\OrderController@ReCheck_payment');

});

Route::post('/home', 'API\HomeController@index');

Route::post('/product/details', 'API\HomeController@product_details');
Route::post('/healthbox/ingradient', 'API\HomeController@healthboxIngradient');
// Route::post('/product/healthbox/details', 'API\HomeController@product_details');


