<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function show(Product $product)
    {
        $likes=Like::where('product_id', $product->id)->get();

        return \response($likes);
    }

    public function store(Product $product)
    {
        \auth()->user()->likedProduct()->toggle($product->id);
    }

}
