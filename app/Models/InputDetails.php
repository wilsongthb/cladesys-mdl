<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class InputDetails extends Model
{
    public function getProduct(){
        $this->product = Products::find($this->products_id);
        return $this->product;
    }
    // public function product(){
    //     return $this->hasOne(
    //         'App\Models\Products',
    //         'id',
    //         'products_id'
    //     )->first();
    // }
}
