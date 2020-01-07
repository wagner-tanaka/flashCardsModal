<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
     function user() {
         return $this->belongsTo('App\User');
     }

     function cards(){
        return $this->hasMany('App\Card');
    }
}
