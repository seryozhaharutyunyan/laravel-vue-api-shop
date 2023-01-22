<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return \response($product);
    }

    public function getQuantity(Product $product){
        return \response($product->quantity);
    }

    /*public function topProducts()
    {
        $products = Product::orderBy('reviews_count', 'desc')
                           ->limit(1)
                           ->get();

        return \response('$products');
    }*/

    public function updateReviewsCount(Product $product){
        $count=$product->reviews_count+1;

        $product->update([
            'reviews_count'=>$count,
        ]);

        return \response($count);
    }
}
