<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ------------------------------------------------------------

Route::get('get_cards/{deck}', 'CardController@getCards'); // quando tenta acessar get_cards/1(número do id), nao aparece nada, entao,
// api nao funciona como rota, mas essa rota serve para acessar CardController

// -------------------------------------------------------------
