<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'logo', 'address', 'p_iva',];
}
