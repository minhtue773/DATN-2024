<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $filterBy = $request->chartOrder ?? 'month';
        switch ($filterBy) {
            case 'month':
                $monthRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');
                $labels = [
                    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ];
                $data = [];
                for($i=1; $i<=12; $i++) {
                    $data[] = $monthRevenue[$i] ?? 0;
                }
                $revenue = [
                    'labels' => $labels,
                    'data' => $data
                ];
                break;
            case 'year':
                $yearRevenue = Order::selectRaw('YEAR(created_at) as year, SUM(total) as total')
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('total', 'year');
                $labels = $yearRevenue->keys()->map(fn($year) => 'Năm ' . $year)->toArray();
                $data = $yearRevenue->values()->toArray();
                $revenue = [
                    'labels' => $labels,
                    'data' => $data
                ];
                break;
                
            }
            // Lọc đơn hàng thành công và đã hủy theo tháng và năm
            $orderStats = Order::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
            $canceledOrders = $orderStats[0] ?? 0;   // Đơn hàng đã hủy
            $successfulOrders = $orderStats[1] ?? 0; // Đơn hàng thành công
        return view('admin.home', compact('revenue'));
    }


    
    public function login() {
        return view('admin.account.login');
    }
    
    public function postLogin(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:3',
        ],[
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ]);
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'role' => 1])){
            return redirect()->route('admin.home')->with('ok', 'Đăng nhập thành công');
        }
        return redirect()->back()->with('no', 'Hãy thử đăng nhập lại');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login')->with('ok', 'Đăng xuất thành công');
    }

    public function trash() {
        $products = Product::onlyTrashed()->get(); 
        $posts = Post::onlyTrashed()->get(); 
        $orders = Order::onlyTrashed()->get();
    
        $data = [
            "product" => [
                "data" => $products,
                "quantity" => $products->count()
            ],
            "post" => [
                "data" => $posts,
                "quantity" => $posts->count()
            ],
            "order" => [
                "data" => $orders,
                "quantity" => $orders->count()
            ]
        ];
        
        return view('admin.trash.trash', compact('data'));
    }    

    public function restore($type, $id) {
        switch ($type) {
            case 'product':
                $product = Product::onlyTrashed()->find($id);
                if ($product) {
                    $product->restore();
                    return redirect()->back()->with('success', "Khôi phục sản phẩm $product->name thành công");
                }
                return redirect()->back()->with('error', 'Không tìm thấy sản phẩm để khôi phục');
    
            case 'post':
                $post = Post::onlyTrashed()->find($id);
                if ($post) {
                    $post->restore();
                    return redirect()->back()->with('success', "Khôi phục bài viết $post->title thành công");
                }
                return redirect()->back()->with('error', 'Không tìm thấy bài viết để khôi phục');
    
            case 'order':
                $order = Order::onlyTrashed()->find($id);
                if ($order) {
                    $order->restore();
                    return redirect()->back()->with('success', "Khôi phục đơn hàng $order->invoice_code thành công");
                }
                return redirect()->back()->with('error', 'Không tìm thấy đơn hàng để khôi phục');
    
            default:
                return redirect()->back()->with('error', 'Có lỗi khi khôi phục');
        }
    }    

    public function delete($type, $id) {
        switch ($type) {
            case 'product':
                $product = Product::onlyTrashed()->find($id);
                if ($product) {
                    if ($product->image && file_exists(public_path('uploads/images/product/' . $product->image))) {
                        unlink(public_path('uploads/images/product/' . $product->image));
                    }
                    $oldImages = ProductImage::where('product_id', $product->id)->get();
                    foreach ($oldImages as $oldImage) {
                        if (file_exists(public_path('uploads/images/product/' . $oldImage->image))) {
                            unlink(public_path('uploads/images/product/' . $oldImage->image));
                        }
                    }
                    $product->forceDelete();
                    return redirect()->back()->with('success', "Xóa vĩnh viễn sản phẩm $product->name thành công");
                }
                return redirect()->back()->with('error', 'Không tìm thấy sản phẩm để xóa');
    
            case 'post':
                $post = Post::onlyTrashed()->find($id);
                if ($post) {
                    if ($post->image && file_exists(public_path('uploads/images/post/' . $post->image))) {
                        unlink(public_path('uploads/images/post/' . $post->image));
                    }
                    $post->forceDelete();
                    return redirect()->back()->with('success', "Xóa vĩnh viễn bài viết $post->title thành công");
                }
                return redirect()->back()->with('error', 'Không tìm thấy bài viết để xóa');
    
            case 'order':
                $order = Order::onlyTrashed()->find($id);
                if ($order) {
                    $order->forceDelete();
                    return redirect()->back()->with('success', "Xóa vĩnh viễn đơn hàng $order->invoice_code thành công");
                }
                return redirect()->back()->with('error', 'Không tìm thấy đơn hàng để xóa');
    
            default:
                return redirect()->back()->with('error', 'Có lỗi khi xóa');
        }
    }    
    
    public function deleteBox(Request $request) {
        $type = $request->input('type');
        $ids = $request->input('ids', []);
    
        // Kiểm tra nếu không có mục nào được chọn
        if (empty($ids)) {
            return redirect()->back()->with('no', 'Bạn chưa chọn mục nào');
        }
    
        switch ($type) {
            case 'product':
                $products = Product::onlyTrashed()->whereIn('id', $ids)->get();
                if ($products->isEmpty()) {
                    return redirect()->back()->with('error', 'Không tìm thấy sản phẩm nào để xóa');
                }
                foreach ($products as $product) {
                    if ($product->image && file_exists(public_path('uploads/images/product/' . $product->image))) {
                        unlink(public_path('uploads/images/product/' . $product->image));
                    }
                    $oldImages = ProductImage::where('product_id', $product->id)->pluck('image');
                    foreach ($oldImages as $oldImage) {
                        if (file_exists(public_path('uploads/images/product/' . $oldImage))) {
                            unlink(public_path('uploads/images/product/' . $oldImage));
                        }
                    }
                    $product->forceDelete();
                }
                return redirect()->back()->with('success', 'Xóa vĩnh viễn các sản phẩm đã chọn thành công');
    
            case 'post':
                $posts = Post::onlyTrashed()->whereIn('id', $ids)->get();
                if ($posts->isEmpty()) {
                    return redirect()->back()->with('error', 'Không tìm thấy bài viết nào để xóa');
                }
                foreach ($posts as $post) {
                    if ($post->image && file_exists(public_path('uploads/images/post/' . $post->image))) {
                        unlink(public_path('uploads/images/post/' . $post->image));
                    }
                    $post->forceDelete();
                }
                return redirect()->back()->with('success', 'Xóa vĩnh viễn các bài viết đã chọn thành công');
    
            case 'order':
                $orders = Order::onlyTrashed()->whereIn('id', $ids)->get();
                if ($orders->isEmpty()) {
                    return redirect()->back()->with('error', 'Không tìm thấy đơn hàng nào để xóa');
                }
                foreach ($orders as $order) {
                    $order->forceDelete();
                }
                return redirect()->back()->with('success', 'Xóa vĩnh viễn các đơn hàng đã chọn thành công');
            default:
                return redirect()->back()->with('error', 'Có lỗi khi xóa các mục đã chọn');
        }
    }    
}
