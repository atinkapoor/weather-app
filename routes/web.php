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

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/', 'WeatherController@index')->name('home');
Route::get('/', [App\Http\Controllers\WeatherController::class, 'index'])->name('home');
Route::get('/{location}', [App\Http\Controllers\WeatherController::class, 'index'])->name('home');

