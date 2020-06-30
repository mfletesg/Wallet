<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function transfers(){ //Retornamos la relacion a todas las transferencias
        return $this->hasMany('App\Transfer');
    }
}
