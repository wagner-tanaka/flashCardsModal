@extends('layouts.main', ["current" => "deck/index"])

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h2>Criar Cartas</h2>
        </div>

        <div class="col-md-6">
            <a class="btn btn-sm btn-success " href="{{action('CardController@play_flash_cards', [$deckId])}}">
                <h3>Praticar</h3>
            </a>
        </div>

    </div>
    <form action="/card" method="POST">
        @csrf



        <div class="md-form container">
            <label for="inputPlaceholderEx">Lado da frente</label>
            <input type="text" name="front" class="form-control {{ $errors->has('front') ? 'is-invalid' : ''}}">

            @if($errors->has('front')) 
            <div class="invalid-feedback">
                {{ $errors->first('front') }}
            </div>
            @endif

        </div>
       

        <div class="md-form container mt-2">
            <label for="inputPlaceholderEx">Lado de trás</label>
            <input type="text" name="back" class="form-control {{ $errors->has('back') ? 'is-invalid' : ''}}">

            @if($errors->has('back')) 
            <div class="invalid-feedback">
                {{ $errors->first('back') }}
            </div>
            @endif

        </div>

        <input type="hidden" name="deck_id" value="{{$deckId}}">

        <div class="ml-3 mt-1">
            <button type="submit" class="btn btn-success">Criar</button>
        </div>



</div>
</form>





<table class="table table-ordered table-hover">
    <thead>
        <tr>
            <th>Front Side</th>
            <th>Back Side</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach($cards as $card)

        <tr>
            <td>{{$card->front}}</td>
            <td>{{$card->back}}</td>
            <td>
                <a href="/card/edit/{{$card->id}}" class="btn btn-sm btn-primary">Edit</a>
                <a href="/card/destroy/{{$card->id}}" class="btn btn-sm btn-primary">Delete</a>
            </td>





        </tr>
        @endforeach
    </tbody>

</table>


@endsection
{{-- 
<br>
current Deck {{session('current_deck')}}
<br>
{{Auth::user()->deck()->cards}} --}}