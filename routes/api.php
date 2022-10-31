<?php

use App\Models\Restaurant;
use App\Models\Category;
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


Route::get('/home', 'Api\HomeController@index');
Route::get('/restaurants', 'Api\RestaurantController@index');
Route::get('/restaurants/{id}', 'Api\RestaurantController@show');

// Generate Client Token
Route::get('/orders/token', 'Api\OrderController@generateToken');
// Make Payment
Route::post('/orders/payment', 'Api\OrderController@makePayment');