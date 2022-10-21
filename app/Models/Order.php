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
}
