<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/products', [FrontController::class,'products'])->name('products');


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

