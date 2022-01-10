<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('products', ProductController::class)->except('create', 'edit');

Route::middleware(['auth'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // customer
    Route::middleware('customer.check')->get('/customer/profile', [CustomerController::class,'profile'])->name('customer.profile');
    
    // admin
    Route::prefix('admin')->group(function()
    {
        Route::middleware('admin.check')->get('/', [AdminController::class,'index'])->name('admin.index');
    });
});

