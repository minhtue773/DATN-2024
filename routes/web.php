<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Mail\GuiEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
/*---------------------- Admin ----------------------*/
Route::prefix('admin')->middleware(AdminMiddleware::class)->name('admin.')->group(function () {
    Route::get('home', [AdminController::class, 'index'])->name('home');
<<<<<<< HEAD
    // Trash
    Route::get('trash', [AdminController::class, 'trash'])->name('trash');
=======
>>>>>>> PS34351
    Route::resource('user', UserController::class);
    // Product
    Route::post('category/update-status', [ProductCategoryController::class, 'updateStatus'])->name('category.updateStatus');
    Route::resource('category', ProductCategoryController::class);
    Route::post('product/updateHidden', [ProductController::class, 'updateHidden'])->name('product.updateHidden');
<<<<<<< HEAD
    Route::post('product/destroyBox', [ProductController::class, 'destroyBox'])->name('product.destroyBox');
    Route::resource('product', ProductController::class)->except(['destroy']);
    // Post
    Route::post('post-category/update-status',[PostCategoryController::class,'updateStatus'])->name('post-category.updateStatus');
    Route::resource('post-category',PostCategoryController::class);
    Route::post('post/update-featured',[PostController::class,'updateFeatured'])->name('post.updateFeatured');
    Route::get('post/delete/{post}', [PostController::class,'delete'])->name('post.delete');
    Route::post('post/destroyBox', [PostController::class,'destroyBox'])->name('post.destroyBox');
=======
    Route::get('product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
>>>>>>> PS34351
    Route::resource('post', PostController::class);
    // Order
    Route::get('order/updateStatus/{order}', [OrderController::class,'updateStatus'])->name('order.updateStatus');
    Route::get('order/delete/{order}', [OrderController::class,'delete'])->name('order.delete');
    Route::get('order/destroyBox', [OrderController::class,'destroyBox'])->name('order.destroyBox');
    Route::resource('order', OrderController::class)->only(['index', 'show']);

    Route::resource('comment', CommentController::class);
    Route::resource('promotion', PromotionController::class);
    Route::resource('banner', BannerController::class);
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductUserController::class, 'index'])->name('products.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');// Route cho danh sách bài viết
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::post("/guilienhe", function (Illuminate\Http\Request $request) {
    $arr = request()->post();
    $ht = trim(strip_tags($arr['ht']));
    $em = trim(strip_tags($arr['em']));
    $nd = trim(strip_tags($arr['nd']));
    $adminEmail = 'dinhngochoangdq@gmail.com'; //Gửi thư đến ban quản trị
    Mail::mailer('smtp')->to($adminEmail)
        ->send(new GuiEmail($ht, $em, $nd));
    $request->session()->flash('thongbao', "Đã gửi mail");
    return redirect("thongbao");
});
Route::get('/blogs/{idCataPost?}', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'loginUser']);
Route::get('/register',[UserAuthController::class,'register'])->name('register');
Route::post('/register',[UserAuthController::class,'registerUser']);
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::get('/product/{id}', [ProductUserController::class, 'detail'])->name('product.detail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/order', [CheckoutController::class, 'order'])->name('checkout.order');

Route::prefix('api')->group(function () {
    Route::get('/comments/product/{product_id}', [CommentController::class, 'product']);
    Route::resource('/comments', CommentController::class);
    Route::resource('/cart', CartController::class);
});
Route::get("/thongbao", function (Illuminate\Http\Request $request) {
    $tb = $request->session()->get('thongbao');
    return view('thongbao', ['thongbao' => $tb]);
});
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
