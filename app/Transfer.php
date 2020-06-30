<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function wallet(){ //Retornamos la relacion a todas las transferencias
        return $this->belongsTo('App\Wallet');
    }
}
