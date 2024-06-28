<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
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

// Route::get('/', [HotelController::class, 'index'])->middleware('auth');
Route::get('/', [HotelController::class, 'index']);

Route::resource('hotel', HotelController::class);
Route::resource('product', ProductController::class);
// Route::resource('producttype', ProductType::class)->middleware('auth');
// Route::get('/product/create/{id}', [ProductController::class, 'create'])->middleware('auth')->name('product.create');
// Route::resource('hoteltype', HotelTypeController::class)->middleware('auth');

// Rute untuk Owner & Staff
Route::group(['middleware' => ['auth', 'checkRole:owner,staff']], function () {
    // Route::resource('hotel', HotelController::class);
    // Route::resource('product', ProductController::class);
    Route::resource('hoteltype', HotelTypeController::class);
    // Route::resource('producttype', ProductType::class);
    Route::get('/product/create/{id}', [ProductController::class, 'create'])->name('product.create');
    Route::resource('producttype', ProductTypeController::class);
});

// Rute untuk customer
Route::group(['middleware' => ['auth', 'checkRole:customer']], function () {
    // Route::resource('hotel', HotelController::class);
});

Auth::routes();

Route::get('/home', [HotelController::class, 'index'])->name('home');

Auth::routes();
