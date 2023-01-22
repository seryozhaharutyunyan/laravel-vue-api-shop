<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $guarded=[];
    protected $with=['user', 'city'];
    public $timestamps=false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
