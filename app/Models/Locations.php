<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    public function user(){
        return $this->hasOne(
            'App\User', 
            'id', // clave foranea
            'user_id' // clave local
        );
    }
}
