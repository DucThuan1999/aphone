<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request, $id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->product_id = $id;
            $comment->content = $request->comment;
            $comment->user_rate = $request->rate;
            $comment->save();

            $comments = Comment::where('product_id', $id)->get();
            $product = Products::find($id);
            $old_rate = $product->rate;
            $new_rate = $request->rate;
            $total = $old_rate;
            foreach ($comments as $cmt) {
                $total += $cmt->user_rate;
            }
            $rate = (($old_rate * $total) + $new_rate) / ($total + 1);
            $product->rate = $rate;
            $product->save();
            return redirect('products/' . $id)->with('thongbao', 'Thêm thành công');
        } else
            return redirect('login');
    }
}
