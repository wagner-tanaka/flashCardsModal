@extends('layouts.main', ["current" => "card/create"])

@section('content')

@php
$deck_id = $_GET['id'];
@endphp

<h2>Create Cards</h2>

<form action="/card" method="POST">
    @csrf

    Add front side:
    <input type="text" name="front">

    Add back side:
    <input type="text" name="back">

    Choose deck:

    <input type="text" name="deck_id" value="{{$deck_id}}">

    {{-- <select  name="deck_id">

 @foreach($decks as $deck)
 
        <option value={{$deck->id}} ></option>
    @endforeach

    </select>
    --}}
    <button type="submit">Adicionar</button>


</form>





@endsection