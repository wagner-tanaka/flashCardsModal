<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     function decks(){
         return $this->hasMany('App\Deck');
     }

     public function deck() {
         // decks() - retorna os decks relacionada a esse usuario, todos os decks
        return $this->decks()->where('id', session('current_deck'))->first();
// retorna  de todos os decks - onde (id = variavel de seção que corresponde ao id que vem do session) -> mais o first() que tem que ter
     }
}
