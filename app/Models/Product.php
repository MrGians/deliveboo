<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['restaurant_id', 'name', 'price', 'description', 'image', 'is_visible'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    } 

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
}
