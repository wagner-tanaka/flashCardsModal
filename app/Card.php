<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
   function user() {
       return $this->belongsTo('App\Deck');
   }
}
