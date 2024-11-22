<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Visit;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index(Request $request) {
        return view('admin.home', [
            'access' => $this->getAccess(),
            'monthVisits' => $this->getMonthVisit(),
            'totalRevenue' => $this->getTotalRevenue($request->input('fillter', 'month')),
            'productTop' => $this->getTopProduct($request->input('limit', 5)),
            'orderStatus' => $this->getOrderStatus(),
        ]);
    }

    public function getAccess() {
        // Mặc định onlineUser là 0
        $onlineUser = 0;
    
        // Tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek()->startOfDay();
        $endOfWeek = Carbon::now()->endOfWeek()->endOfDay();
        $weekAccess = Visit::whereBetween('visited_at', [$startOfWeek, $endOfWeek])->count();
    
        // Tháng hiện tại
        $startOfMonth = Carbon::now()->startOfMonth()->startOfDay();
        $endOfMonth = Carbon::now()->endOfMonth()->endOfDay();
        $monthAccess = Visit::whereBetween('visited_at', [$startOfMonth, $endOfMonth])->count();
    
        // Tổng số lượt truy cập
        $totalAccess = Visit::count();

        return [
            'onlineUser' => $onlineUser,
            'weekAccess' => $weekAccess,
            'monthAccess' => $monthAccess,
            'totalAccess' => $totalAccess,
        ];
    }
    public function getMonthVisit() {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $labels = [];
        $data = [];
        
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $labels[] = $date->format('d');
            $count = Visit::whereDate('visited_at', $date->toDateString())->count();
            $data[] = $count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
    public function getTotalRevenue($fillter) {

        $labels = [];
        $data = [];
    
        switch ($fillter) {
            case 'month': 
                $now = Carbon::now();
                $labels = array_map(fn($month) => "Tháng $month", range(1, 12));
                $orders = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
                    ->whereYear('created_at', $now->year)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->keyBy('month');
                
                $data = [];
                foreach (range(1, 12) as $month) {
                    $data[] = $orders->get($month)?->total ?? 0; 
                }
                break;
            case 'year': 
                $startYear = Carbon::now()->year - 3; 
                $endYear = Carbon::now()->year;
                $labels = range($startYear, $endYear);
                $orders = Order::selectRaw('YEAR(created_at) as year, SUM(total) as total')
                    ->whereBetween('created_at', [
                        Carbon::createFromDate($startYear, 1, 1)->startOfYear(),
                        Carbon::createFromDate($endYear, 12, 31)->endOfYear(),
                    ])
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get()
                    ->keyBy('year');
                $data = [];
                foreach ($labels as $year) {
                    $data[] = $orders->get($year)?->total ?? 0; 
                }
                break;
        }
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
    public function updateTotalRevenue(Request $request){
        return response()->json($this->getTotalRevenue($request->fillter, 'month'));
    }
    public function getTopProduct($limit) { 
        $products = OrderDetail::selectRaw('product_id, SUM(quantity) as total_quantity')
            ->with('product') 
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get();
        
        $labels = $products->map(fn($item) => $item->product->name ?? "Sản phẩm ID {$item->product_id}")->toArray();
        $data = $products->pluck('total_quantity')->toArray();
        
        return [
            'labels' => $labels, 
            'data' => $data,     
        ];
    }
    public function updateTopProduct(Request $request){
        return response()->json($this->getTopProduct($request->limit, 5));
    }
    public function getOrderStatus() {
        $labels = ['Đơn hàng thành công', 'Đơn hàng đã hủy'];
        $orders = Order::selectRaw('status, COUNT(*) as count')
        ->whereIn('status', [3, 5])
        ->groupBy('status')
        ->orderBy('status')
        ->get();
        $data = [];
        foreach ($orders as $order) {
            $data[] = $order->count;
        }
        return [
            'labels' => $labels, 
            'data' => $data,     
        ];
    }
}
