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


Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function (){
    // Homepage Route
    Route::get('/', 'HomeController@index')->name('home');

    // 404 Route
    Route::get('/{any}', function () {
        abort('404');
    })->where('any', '.*');
});

// Guests Route (check front.js)
Route::get('/', function () {
    return view('guests.home');
})->where('any', '.*');