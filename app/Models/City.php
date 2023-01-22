<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table='cities';
    public $timestamps=false;
    protected $with=['region', 'edge'];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function edge(){
        return $this->belongsTo(Edge::class, 'edge_id', 'id');
    }
}
