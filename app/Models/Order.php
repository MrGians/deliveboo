<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['restaurant_id', 'date', 'status', 'amount', 'email', 'full_name', 'address', 'tel'];

    public function restaurant()
    {
        $this->belongsTo('App\Models\Restaurant');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function sum($product_price, $quantity){
        $total = $product_price * $quantity;
        return $total;
    }
}
