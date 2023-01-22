<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'edges';
    public $timestamps = false;
    //protected $with=['regions'];

    public function regions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Region::class, 'id', 'edge_id');
    }

    public function cities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(City::class, 'edge_id', 'id');
    }
}
