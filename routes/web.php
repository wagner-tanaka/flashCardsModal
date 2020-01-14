<?php

use App\User;
Use App\Card;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'DeckController@index')->name('home');
Route::get('/card/create', 'CardController@create');
Route::post('/card','CardController@store');
Route::get('/card','CardController@index');
Route::get('/card/destroy/{card}', 'CardController@destroy');
Route::get('/card/edit/{card}', 'CardController@edit');
Route::put('/card/update/{card}', 'CardController@update');



Route::get('/deck/create', 'DeckController@create');
Route::post('/deck','DeckController@store');
Route::get('/deck/destroy/{deck}', 'DeckController@destroy');
Route::get('/deck/edit/{deck}', 'DeckController@edit');
Route::put('/deck/update/{deck}', 'DeckController@update');

// Route::get('/select_deck?id={deck}', 'DeckController@selectDeck');
Route::get('/select_deck/{deck}', 'DeckController@selectDeck');

Route::get('/decks', 'DeckController@decks');

Route::get('/play_flash_cards/{deck}', 'CardController@play_flash_cards');


Route::get('/testeComponente', 'CardController@testeComponente');