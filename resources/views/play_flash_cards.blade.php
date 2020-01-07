@extends('layouts.main', ["current" => "play_flash_cards"])

@section('content')


@if($current_card)
<a class="link-style" href="/play_flash_cards/{{$deck->id}}?side={{ request('side')  == 'back' ? 'front' : 'back'}}">
    @endif
    <div class="estilo container d-flex justify-content-center " style="padding-top:130px">
        @if( $current_card)
        <h1>{{ $current_card[request('side') ?? 'front'] }} </h1>
        @else
        
                Você revisou todas as cartas de hoje
           
        @endif
    </div>
</a>

@if($current_card)

<div class="row">
    <div class="col-md-6 d-flex justify-content-center ">
        <a class="mt-2"
            href="{{action('CardController@play_flash_cards',[$deck->id, 'side' => 'front', 'errou' => $current_card])}}">
            <button class="btn btn-danger">Errei</button>
        </a>
    </div>

    <div class="col-md-6 d-flex justify-content-center ">
        <a class="mt-2"
            href="{{action('CardController@play_flash_cards',[$deck->id, 'side' => 'front', 'acertou' => $current_card])}}">
            <button class="btn btn-success">Acertei</button>
        </a>
    </div>

</div>

@else
<div>
    <a class="mt-2 d-flex justify-content-center" href="{{action('DeckController@decks')}}">
        <button class="btn btn-success">Voltar</button>
    </a>
</div>
@endif

@endsection