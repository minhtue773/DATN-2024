<?php

namespace App\Http\Controllers;
use App\Models\Comment; // Import model Comment nếu cần
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */

    

     public function product($product_id)
     {
         // Lấy danh sách bình luận đã phê duyệt cho sản phẩm và sắp xếp theo thời gian mới nhất
         $approvedComments = Comment::approved()
                                     ->where('product_id', $product_id)
                                     ->with('user:id,name') // Lấy thông tin user (chỉ lấy id và name)
                                     ->orderBy('created_at', 'desc')
                                     ->get();
     
         // Đếm số lượng bình luận đã phê duyệt
         $totalApprovedComments = $approvedComments->count();
     
         // Tính trung bình của rating_stars cho sản phẩm với các bình luận đã phê duyệt
         $averageRating = Comment::approved()
                                 ->where('product_id', $product_id)
                                 ->avg('rating_stars');
     
         // Nếu không có bình luận nào, thì averageRating sẽ là null, chuyển thành 0
         $averageRating = $averageRating ?: 0;
     
         // Chuẩn bị kết quả trả về
         $kq = [
             'status' => true,
             'message' => 'Lấy dữ liệu thành công!',
             'data' => $approvedComments,
             'total_comments' => $totalApprovedComments, // Số lượng bình luận đã phê duyệt
             'average_rating' => round($averageRating, 1) // Làm tròn rating đến 1 chữ số thập phân
         ];
     
         // Trả về response dưới dạng JSON
         return response()->json($kq, 200);
     }
     
     
     
     
    
    
     
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'product_id' => 'required|integer|exists:products,id',
        //     'content' => 'required|string|max:255',
        //     'rating' => 'required|integer|min:1|max:5',
        // ]);

        // Create and save the comment
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
       
        $comment->content = $request->content;
        $comment->rating_stars = $request->rating;
        $comment->save();

        // Prepare the response data
        $kq = [
            'status' => true,
            'message' => 'Đã thêm bình luận!',
        ];

        // Return the response as JSON with HTTP status 200
        return response()->json($kq, 200);
        dd($kq);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm bình luận theo ID
        $comment = Comment::find($id);
    
        // Kiểm tra xem bình luận có tồn tại không
        if (!$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Bình luận không tồn tại!',
            ], 404);
        }
    
        // Xóa bình luận
        $comment->delete();
    
        // Trả về phản hồi thành công
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa bình luận thành công!',
        ], 200);
    }
    
}
