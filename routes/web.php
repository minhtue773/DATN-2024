<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
/*---------------------- Admin ----------------------*/
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('home', [AdminController::class, 'index'])->name('home');
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('order', OrderController::class);
});