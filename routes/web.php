<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\ProductUserController;

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
/*---------------------- Admin ----------------------*/
Route::prefix('admin')->middleware(AdminMiddleware::class)->name('admin.')->group(function(){
    Route::get('home', [AdminController::class, 'index'])->name('home');
    // Trash
    Route::get('trash', [AdminController::class, 'trash'])->name('trash');
    Route::get('trash/restore/{type}/{id}', [AdminController::class, 'restore'])->name('trash.restore');
    Route::get('trash/delete/{type}/{id}', [AdminController::class, 'delete'])->name('trash.delete');
    Route::post('trash', [AdminController::class, 'deleteBox'])->name('trash.deleteBox');
    Route::resource('user', UserController::class);
    // Product
    Route::post('category/update-status', [ProductCategoryController::class, 'updateStatus'])->name('category.updateStatus');
    Route::resource('category', ProductCategoryController::class);
    Route::get('product/delete/{product}', [ProductController::class,'delete'])->name('product.delete');
    Route::post('product/updateHidden', [ProductController::class, 'updateHidden'])->name('product.updateHidden');
    Route::post('product/destroyBox', [ProductController::class, 'destroyBox'])->name('product.destroyBox');
    Route::resource('product', ProductController::class)->except(['destroy']);
    // Post
    Route::post('post-category/update-status',[PostCategoryController::class,'updateStatus'])->name('post-category.updateStatus');
    Route::resource('post-category',PostCategoryController::class);
    Route::post('post/update-featured',[PostController::class,'updateFeatured'])->name('post.updateFeatured');
    Route::get('post/delete/{post}', [PostController::class,'delete'])->name('post.delete');
    Route::post('post/destroyBox', [PostController::class,'destroyBox'])->name('post.destroyBox');
    Route::resource('post', PostController::class);
    // Order
    Route::get('order/updateStatus/{order}', [OrderController::class,'updateStatus'])->name('order.updateStatus');
    Route::get('order/delete/{order}', [OrderController::class,'delete'])->name('order.delete');
    Route::get('order/destroyBox', [OrderController::class,'destroyBox'])->name('order.destroyBox');
    Route::resource('order', OrderController::class)->only(['index', 'show']);

    // MORE
    Route::get('/configuration', [ConfigurationController::class,'index'])->name('configuration');
    Route::get('/configuration/info', [ConfigurationController::class,'info'])->name('configuration.info');
    Route::resource('comment', CommentController::class);
    Route::resource('promotion', PromotionController::class);
    Route::resource('banner', BannerController::class);
});


Route::get('/', function(){
    return view('clients.home');
});
