<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
/*---------------------- Admin ----------------------*/
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('home', [AdminController::class, 'index'])->name('home');
    Route::resource('user', UserController::class);
    Route::get('product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::resource('product', ProductController::class);
    Route::resource('category', ProductCategoryController::class);
    Route::resource('order', OrderController::class);
    Route::resource('blog', PostCategoryController::class);
    Route::resource('comment', CommentController::class);
    Route::resource('promotion', PromotionController::class);
    Route::resource('banner', BannerController::class);

});