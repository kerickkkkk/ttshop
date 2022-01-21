<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\ProductCategoryController;

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

// 前臺

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::prefix('products')->name('products.')->group(function(){
    Route::get('/', [FrontController::class,'products'])->name('index');
    Route::get('/show/{product}', [FrontController::class,'productsShow'])->name('show');
});

Route::prefix('carts')->name('carts.')->group(function(){
    // 測試用
    Route::get('/content', [CartController::class, 'content'])->name('content');
    Route::get('/clear', [CartController::class, 'clear'])->name('clear');
    // 主要功能
    Route::post('/store', [CartController::class, 'store'])->name('store');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/destroy', [CartController::class, 'destroy'])->name('destroy');

    Route::middleware('cart.check')->group(function(){
        Route::get('/step01', [CartController::class, 'step01'])->name('step01.index');
        Route::get('/step02', [CartController::class, 'step02'])->name('step02.index');
        Route::post('/step02', [CartController::class, 'step02Store'])->name('step02.store');
        Route::get('/step03', [CartController::class, 'step03'])->name('step03.index');
        Route::post('/step03', [CartController::class, 'step03Store'])->name('step03.store');
        Route::get('/step04/{order_no}', [CartController::class, 'step04'])->name('step04.index');
    });
});

Auth::routes();

// 後臺

// Route::resource('products', ProductController::class)->except('create', 'edit');

Route::middleware(['auth'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // customer
    Route::middleware('customer.check')->get('/customer/profile', [CustomerController::class,'profile'])->name('customer.profile');
    
    // admin
    Route::prefix('admin')->middleware('admin.check')->name('admin.')->group(function()
    {
        Route::get('/', [AdminController::class,'index'])->name('index');

        Route::resource('/product-categories', ProductCategoryController::class)->except('show');

        Route::resource('/products', ProductController::class)->except('show');
        Route::delete('/delete-product-image', [ProductController::class, 'delete'])->name('delete-product-image');

        // 最新消息
        Route::resource('/event-categories', EventCategoryController::class)->except('show');
        Route::resource('/events', EventController::class)->except('show');

        // Contact
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    });
});

