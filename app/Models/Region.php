<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table='regions';
    protected $guarded=[];
    public $timestamps=false;
    protected $with=['edge'];

    public function edge(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Edge::class, 'edge_id', 'id');
    }

    public function cities(){
        return$this->hasMany(City::class, 'region_id', 'id');
    }
}
