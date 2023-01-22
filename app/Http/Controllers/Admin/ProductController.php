<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateQuantityRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $products=Product::paginate(50);
        $categories=Category::all();
        $tags=Tag::all();

        return \response([
            'products'=>$products,
            'categories'=>$categories,
            'tags'=>$tags
        ]);
    }

    public function show(Product $product){
        $categories=Category::all();
        $tags=Tag::all();
        return \response([
            'product'=>$product,
            'categories'=>$categories,
            'tags'=>$tags
        ]);
    }

    public function store(StoreRequest $request){
        $data=$request->validated();

        if (isset($data['tag_ids']) && !empty($data['tag_ids'])) {
            $tagIds = $data['tag_ids'];

        }
        unset($data['tag_ids']);
        foreach ($data['images'] as $kay=>$img){
            $data['images'][$kay]=\url('storage/'.Storage::disk('public')->
            put('img/product/'.$data['title'], $img));
        }
        $data['images'] = \json_encode($data['images']);
        $product = Product::firstOrCreate($data);
        if (isset($tagIds)) {
            $product->tags()->attach($tagIds);
        }

    }

    public function update (UpdateRequest $request, Product $product){
        $data=$request->validated();

        if (isset($data['tag_ids']) && !empty($data['tag_ids'])) {
            $tagIds = $data['tag_ids'];

        }
        unset($data['tag_ids']);
        if(isset($data['images']) && !empty($data['images'])){
            foreach ($data['images'] as $kay=>$img){
                $data['images'][$kay]=\url('storage/'.Storage::disk('public')->
                put('/img/product/'.$data['title'], $img));
            }
            if(isset($data['img']) && !empty($data['img'])){
                $data['images']=\array_merge($data['images'], $data['img']);
                unset($data['img']);
            }
            $data['images'] = \json_encode($data['images']);
        }else{
            if(isset($data['img']) && !empty($data['img'])){
                $data['images'] = \json_encode($data['img']);
                unset($data['img']);
            }else{
                return response(['err'=>'You have not selected an image!']);
            }

        }

        if(isset($data['img_d']) && !empty($data['img_d'])){
            foreach ($data['img_d'] as $img){
                Storage::disk('public')->delete($img);
            }
            unset($data['img_d']);
        }

        $product -> update($data);
        if (isset($tagIds)) {
            $product->tags()->sync($tagIds);
        } else {
            $product->tags()->detach();
        }
    }


    public function updateQuantity(UpdateQuantityRequest $request,Product $product){
        $data=$request->validated();
        $product->update($data);
    }

    public function destroy(Product $product)
    {
        $product->tags()->detach();
        $product->delete();
    }
}
