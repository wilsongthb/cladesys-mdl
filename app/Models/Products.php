<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brands;

class Products extends Model
{
    public function brand(){
        return $this->hasOne('App\Models\Brands');
    }
}
