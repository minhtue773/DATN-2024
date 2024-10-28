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
    public function toggleFavorite($productId): JsonResponse
    {
        // Kiểm tra người dùng đã đăng nhập
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $userId = Auth::id();

        // Kiểm tra nếu sản phẩm đã được thêm vào danh sách yêu thích
        try {
            $favorite = FavoriteProduct::where('product_id', $productId)->where('user_id', $userId)->first();

            if ($favorite) {
                // Nếu đã có, xóa sản phẩm khỏi danh sách yêu thích
                $favorite->delete();
                return response()->json(['status' => 'removed']);
            } else {
                // Nếu chưa có, thêm vào danh sách yêu thích
                FavoriteProduct::create([
                    'product_id' => $productId,
                    'user_id' => $userId,
                ]);
                return response()->json(['status' => 'added']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}