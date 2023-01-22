<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function showTop()
    {

        $products = Product::orderBy('reviews_count', 'desc')->limit(10)->get();

        return \response($products);

    }

}
