<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }
}
