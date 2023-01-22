<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='products';
    protected $guarded=[];
    protected $with=['category', 'tags'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
