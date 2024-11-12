<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::query();
        if ($request->status > 0) {
            $query->where('status', $request->status);
        }
        $comments = $query->get();
        return view('admin.comment.comment', compact('comments'));
    }

    public function create()
    {
        //
    }

    public function store(StoreCommentRequest $request)
    {
        //
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    public function delete(comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->back()->with("success", "Xóa bình luận của $comment->name $comment->user->name thành công!");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Xóa bình luận của '$comment->user->name' thất bại!");
        }
    }

    public function destroyBox(Request $request)
    {
        if (is_array($request->comment_ids)) {
            comment::destroy($request->comment_ids);
            $count = count($request->comment_ids);
            return redirect()->back()->with('ok', "Xóa $count bình luận thành công!");
        } else {
            return redirect()->back()->with('no', 'Bạn chưa chọn bình luận nào!');
        }
    }

    public function updateHidden(Request $request)
    {
        $Comment = Comment::find($request->id);
        if ($Comment) {
            $Comment->status = $request->status;
            $Comment->save();
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
        return response()->json(['message' => 'Không tìm thấy danh mục!']);
    }
}
