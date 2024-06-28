<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\TransactionController;
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
// Route::get('/product/create/{id}', [ProductController::class, 'create'])->middleware('auth')->name('product.create');
// Route::resource('hoteltype', HotelTypeController::class)->middleware('auth');

// Rute untuk Owner & Staff
Route::group(['middleware' => ['auth', 'checkRole:owner,staff']], function () {
    // Route::resource('hotel', HotelController::class);
    // Route::resource('product', ProductController::class);
    Route::resource('hoteltype', HotelTypeController::class);
    Route::get('/product/create/{id}', [ProductController::class, 'create'])->name('product.create');
});

// Rute untuk customer
Route::group(['middleware' => ['auth', 'checkRole:customer']], function () {
    // Route::resource('hotel', HotelController::class);
    Route::get('laralux/cart', function(){
        return view('frontend.cart');
        })->name('cart');

        Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
        Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
        Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
        Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
        Route::get('laralux/cart/checkout',[TransactionController::class,'checkout'])->name('checkout');
        
});

Auth::routes();

Route::get('/home', [HotelController::class, 'index'])->name('home');

Auth::routes();
