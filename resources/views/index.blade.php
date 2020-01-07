@extends('layouts.main', ["current" => "home"])

@section('content')

<h1>Bem vindo {{ \Auth::user()->name }}!</h1>

<br>

<div class="container row">

    <div class="col-md-6">
        <a href="/deck/create"><h2>Crie um novo baralho</h2><img src="/img/newDeck2.png"></a>
    </div>


    <br>

    <div class="col-md-6">
        @if(isset($decks))
        <a href="/decks">
            <h2>Todos os baralhos</h2>
            <img src="/img/allDecks.jpg"></a>
        </a>
        @endif
    </div>

</div>






@endsection