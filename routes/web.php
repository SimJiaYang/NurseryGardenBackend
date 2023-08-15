<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Settings Login and Home Page
Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::group(['middleware' => 'isAdmin'], function () {
    // Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/form/insert', [CategoryController::class, 'insertForm'])->name('category.insert');

    // Plant
    Route::get('/plant', [PlantController::class, 'index'])->name('plant.index');

    // Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    // Bidding
    Route::get('/bidding', [BiddingController::class, 'index'])->name('bidding.index');
});

Route::group(['middleware' => 'isUser'], function () {
});
