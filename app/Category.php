<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model 
{
    use SoftDeletes;

    protected $fillable = [
        'name','parent_id'
    ];

    protected $dates =['deleted_at'];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }

    public function children()
    {
        return $this->hasMany('App\Category','parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category','parent_id');
    }

 
}
