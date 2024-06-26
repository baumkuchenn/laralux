<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelTypeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HotelController::class, 'index'])->middleware('auth');
Route::resource('hoteltype', HotelTypeController::class)->middleware('auth');
Route::resource('hotel', HotelController::class)->middleware('auth');
Route::resource('product', ProductController::class)->middleware('auth');
Route::get('/product/create/{id}', [ProductController::class, 'create'])->middleware('auth')->name('product.create');
Auth::routes();

Route::get('/home', [HotelController::class, 'index'])->name('home');

Auth::routes();