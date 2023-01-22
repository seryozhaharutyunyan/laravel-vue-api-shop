<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index (Product $product) {
        $comment=Comment::where('product_id', $product->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);

        return \response($comment);
    }

    public function destroy(Comment $comment){
        $comment->delete();
    }


}
