<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param   Request  $request
     *
     * @return void
     */
    public function search(Request $request)
    {
        $data    = $request->all();
        $product = Product::where('title', 'LIKE', "%{$data['text']}%")
                          ->orWhere('description', 'LIKE', "%{$data['text']}%")
                          ->orderBy('price', 'desc')
                          ->paginate(5);

        return \response($product);
    }
}
