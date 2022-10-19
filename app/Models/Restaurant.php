<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'logo', 'address', 'p_iva',];


    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
