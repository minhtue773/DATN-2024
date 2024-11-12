<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Order;
use App\Models\Visit;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $revenue = $this->getRevenueData($request->chartOrder ?? 'month');
        $productTop = $this->getTopProducts($request->input('productTop', 5));
        $access = $this->getAccess();
        $monthVisit = $this->getMonthVisits();
        $orderStatus = $this->getOrderStatus();
        
        return view('admin.home', compact('revenue', 'productTop', 'access', 'monthVisit', 'orderStatus'));
    }

    public function filterProductTop(Request $request)
    {
        return response()->json($this->getTopProducts($request->input('productTop', 5)));
    }

    public function filterRevenue(Request $request)
    {
        return response()->json($this->getRevenueData($request->input('chartOrder', 'month')));
    }

    private function getRevenueData($filterBy)
    {
        $currentYear = Carbon::now()->year;

        if ($filterBy === 'month') {
            $monthRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->pluck('total', 'month');

            $labels = [
                'Tháng 1',
                'Tháng 2',
                'Tháng 3',
                'Tháng 4',
                'Tháng 5',
                'Tháng 6',
                'Tháng 7',
                'Tháng 8',
                'Tháng 9',
                'Tháng 10',
                'Tháng 11',
                'Tháng 12'
            ];
            $data = array_map(fn($i) => $monthRevenue[$i] ?? 0, range(1, 12));
        } else {
            $yearRevenue = Order::selectRaw('YEAR(created_at) as year, SUM(total) as total')
                ->groupBy('year')
                ->pluck('total', 'year');

            $labels = $yearRevenue->keys()->map(fn($year) => 'Năm ' . $year)->toArray();
            $data = $yearRevenue->values()->toArray();
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getTopProducts($limit)
    {
        $topProducts = OrderDetail::select('product_id', Product::raw('SUM(quantity) as total_quantity'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get();

        return [
            'labels' => $topProducts->pluck('product.name'),
            'data' => $topProducts->pluck('total_quantity')
        ];
    }
    
    private function getAccess()
    {
        $onlineUsers = User::where('status', 'online')->count() ?? '';
        // Lượt truy cập trong tuần (7 ngày gần nhất)
        $accessWeek = Visit::whereBetween('visited_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
        // Lượt truy cập trong tháng (30 ngày gần nhất)
        $accessMonth = Visit::whereMonth('visited_at', Carbon::now())->count();
        // Tổng lượt truy cập
        $accessTotal = Visit::count();
        $access = [
            'online' => $onlineUsers,
            'access_week' => $accessWeek,
            'access_month' => $accessMonth,
            'access_total' => $accessTotal
        ];

        return $access;
    }

    private function getMonthVisits() {
        
        $visitMonth = Visit::selectRaw('DAY(visited_at) as day, COUNT(*) as count')
            ->whereMonth('visited_at', Carbon::now()->month)  
            ->groupBy('day')
            ->orderBy('day', 'asc')  
            ->get();
        
        $daysInMonth = Carbon::now()->daysInMonth;
        
        $labels = [];
        $data = [];
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $labels[] = $day;  
            $data[$day] = 0;  
        }
    
        foreach ($visitMonth as $visit) {
            $data[$visit->day] = $visit->count;  
        }

        $getMonthVisit = [
            'labels' => $labels,
            'data' => array_values($data)  
        ];
        return $getMonthVisit;
    }

    private function getOrderStatus() {
        $orders = Order::selectRaw('status ,COUNT(*) as count')
        ->whereIn('status', [3, 5])
        ->groupBy('status')
        ->orderBy('status')
        ->get();

        $labels = ['Đơn hàng thành công', 'Đơn hàng đã hủy'];
        $data = $orders->pluck('count')->toArray();
        
        $orderStatus = [
            'labels' => $labels,
            'data' => $data
        ];

        return $orderStatus;
    }
    

    public function login()
    {
        return view('admin.account.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:7',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ]);
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'role' => 1])) {
            return redirect()->route('admin.home')->with('ok', 'Đăng nhập thành công');
        }
        return redirect()->back()->with('no', 'Hãy thử đăng nhập lại');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('ok', 'Đăng xuất thành công');
    }

    public function trash()
    {
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

    public function restore($type, $id)
    {
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

    public function delete($type, $id)
    {
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

    public function deleteBox(Request $request)
    {
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
