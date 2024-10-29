<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class FavoriteProductController extends Controller
{
    /**
     * Thêm hoặc xóa sản phẩm khỏi danh sách yêu thích.
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function toggleFavorite($productId)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthenticated', 'message' => 'Vui lòng đăng nhập để thực hiện thao tác.'], 401);
        }

        $userId = Auth::id();

        try {
            $favorite = FavoriteProduct::where('product_id', $productId)->where('user_id', $userId)->first();

            if ($favorite) {
                $favorite->delete();
                return response()->json(['status' => 'removed', 'message' => 'Đã bỏ thích sản phẩm.']);
            } else {
                FavoriteProduct::create(['product_id' => $productId, 'user_id' => $userId]);
                return response()->json(['status' => 'added', 'message' => 'Đã thêm vào danh sách yêu thích.']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
}
