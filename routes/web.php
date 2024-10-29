<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Mail;
// Đường dẫn cho trang giới thiệu

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\BlogController;
use App\Mail\GuiEmail;
use App\Http\Controllers\ContactController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderControllers;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\CommentControllers;
use App\Http\Controllers\PasswordResetController;

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
/*---------------------- Admin ----------------------*/
Route::prefix('admin')->middleware(AdminMiddleware::class)->name('admin.')->group(function () {
    Route::get('home', [AdminController::class, 'index'])->name('home');
    Route::resource('user', UserController::class);
    Route::post('category/update-status', [ProductCategoryController::class, 'updateStatus'])->name('category.updateStatus');
    Route::resource('category', ProductCategoryController::class);
    Route::post('product/updateHidden', [ProductController::class, 'updateHidden'])->name('product.updateHidden');
    Route::get('product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
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
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductUserController::class, 'index'])->name('products.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');// Route cho danh sách bài viết
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::post("/guilienhe", function (Illuminate\Http\Request $request) {
    $arr = $request->post();
    $ht = trim(strip_tags($arr['ht']));
    $em = trim(strip_tags($arr['em']));
    $nd = trim(strip_tags($arr['nd']));
    $adminEmail = 'dinhngochoangdq@gmail.com'; // Gửi thư đến ban quản trị

    try {
        // Gửi mail
        Mail::mailer('smtp')->to($adminEmail)
            ->send(new GuiEmail($ht, $em, $nd));

        // Thiết lập thông báo thành công
        $request->session()->$request->flash('success', "Đã gửi mail thành công!");
    } catch (\Exception $e) {
        // Thiết lập thông báo lỗi
        $request->session()->$request->flash('error', "Có lỗi xảy ra: " . $e->getMessage());
    }

    return redirect()->back(); // Chuyển hướng về trang trước
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/order', [CheckoutController::class, 'order'])->name('checkout.order');
Route::get('/blogs/{idCataPost?}', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'loginUser']);
Route::get('/register',[UserAuthController::class,'register'])->name('register');
Route::post('/register',[UserAuthController::class,'registerUser']);
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::get('/my_account',[UserAuthController::class,'showAccount'])->name('my_account');
Route::post('/my_account', [UserAuthController::class, 'updateAccount'])->name('account.update');

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('forgot-password');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}',[PasswordResetController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password',[PasswordResetController::class, 'resetPasswordPost'])->name('reset.password.post');
Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/orders', [OrderControllers::class, 'index'])->name('orders');
Route::post('/orders/{id}/cancel', [OrderControllers::class, 'cancel'])->name('orders.cancel');

Route::get('/product/{id}', [ProductUserController::class, 'detail'])->name('product.detail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::prefix('api')->group(function () {
    Route::get('/comments/product/{product_id}', [CommentController::class, 'product']);
    Route::resource('/comments', CommentController::class);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::resource('/cart', CartController::class);
});


Route::post('/favorite/toggle/{productId}', [FavoriteProductController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::get("/thongbao", function (Illuminate\Http\Request $request) {
    $tb = $request->session()->get('thongbao');
    return view('thongbao', ['thongbao' => $tb]);
});
Route::fallback(function () {
    $index1 = 0; // Khởi tạo biến $index1
    return response()->view('errors.404', ['index1' => $index1], 404);
});
