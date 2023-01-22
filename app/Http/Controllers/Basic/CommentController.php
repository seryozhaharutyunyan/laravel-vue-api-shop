<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basic\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index (Product $product) {
        $comment=Comment::where('product_id', $product->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return \response($comment);
    }
    /**
     * @param   StoreRequest  $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        $data=$request->validated();
        Comment::create($data);


    }

}
