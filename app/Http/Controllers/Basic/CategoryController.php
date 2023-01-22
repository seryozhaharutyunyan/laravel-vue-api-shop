<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();

        return \response($categories);
    }

    public function showProducts(Category $category){
        $products=$category->products()->paginate(5);

        return \response($products);
    }
}
