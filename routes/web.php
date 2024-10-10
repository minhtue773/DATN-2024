<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\ProductUserController;

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
/*---------------------- Admin ----------------------*/
Route::prefix('admin')->middleware(AdminMiddleware::class)->name('admin.')->group(function(){
    Route::get('home', [AdminController::class, 'index'])->name('home');
    Route::get('trash', [AdminController::class, 'trash'])->name('trash');
    Route::resource('user', UserController::class);
    Route::post('category/update-status', [ProductCategoryController::class, 'updateStatus'])->name('category.updateStatus');
    Route::resource('category', ProductCategoryController::class);
    Route::get('product/delete/{product}', [ProductController::class,'delete'])->name('product.delete');
    Route::post('product/updateHidden', [ProductController::class, 'updateHidden'])->name('product.updateHidden');
    Route::post('product/destroyBox', [ProductController::class, 'destroyBox'])->name('product.destroyBox');
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::resource('post', PostController::class);
    Route::resource('comment', CommentController::class);
    Route::resource('promotion', PromotionController::class);
    Route::resource('banner', BannerController::class);
});


Route::get('/products', [ProductUserController::class, 'index'])->name('products.index');