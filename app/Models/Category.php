<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function restaurants()
    {
        return $this->belongsToMany('App\Models\Restaurant')->withPivot('id','category_id', 'restaurant_id');
    }
}
