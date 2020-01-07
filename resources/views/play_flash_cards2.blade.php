@extends('layouts.main', ["current" => "play_flash_cards"])

@section('content')

<?php
    '<pre>';   
    var_dump($cards[0]);
    '</pre>'; 
?>

@if(isset($cards[0]))

<a href="/play_flash_cards/{{$deck->id}}?id=<?php echo $id ?>&side=<?php echo $side == 'front' ? 'back' : 'front' ?> ">
   
    @endif

    <div class="estilo container d-flex justify-content-center" style="padding-top:130px">
        <?php
        // -------------------------------foi mudado aqui tambem, vereificar o que é -------------------------------------------------------
if(isset($cards[0])){ 
            echo '<h1>' . $current_card[$side] . '</h1>'; // $next_card = $card[$id] e adicionando o [$side] , fica $card[$id][$side].
}else {
    echo 'Você revisou todas as cartas de hoje!';
}
        // ------------------------------------------------------------------------------------------------------------------------------
    
        ?>
    </div>
</a>




@if(isset($cards[$id+1]))



<div class="row">

    <div class="col-md-6 d-flex justify-content-center border">
        <a class="mt-2"
            href="{{action('CardController@play_flash_cards',[$deck->id, 'id' => $id+1, 'side' => 'front', 'acertou' => 'false', 'id_card' => $cards[$id]['id']])}}">
            <button class="btn btn-danger">Refazer</button>
        </a>
    </div>

    <div class="col-md-6 d-flex justify-content-center border">
        <a class="mt-2"
            href="{{action('CardController@play_flash_cards',[$deck->id, 'id' => $id+1, 'side' => 'front', 'acertou' => 'true', 'id_card' => $cards[$id]['id']])}}">
            <button class="btn btn-success">Certo</button>
        </a>
    </div>

    <div class="col-md">
        <a class="d-flex justify-content-center mt-2"
            href="{{action('CardController@play_flash_cards',[$deck->id, 'id' => $id+1, 'side' => 'front'])}}">
            <button class="btn btn-primary">Proxima</button>
        </a>
    </div>

</div>



@elseif(isset($cards[0]))

<div class="col-md-6 d-flex justify-content-center border">
    <a class="mt-2"
        href="{{action('CardController@play_flash_cards',[$deck->id,  'acertou' => 'false', 'id_card' => $cards[$id]['id']])}}">
        <button class="btn btn-danger">Refazer</button> // parei tentando entender aqui, como fazer pra quando apertar a
        pagina ser
        redirecionada para o fim do deck, que nao tera nenhuma carta
    </a>
</div>

<div class="col-md-6 d-flex justify-content-center border">
    <a class="mt-2"
        href="{{action('CardController@play_flash_cards',[$deck->id, 'side' => 'front', 'acertou' => 'true', 'id_card' => $cards[$id]['id']])}}">
        <button class="btn btn-success">Certo</button>
    </a>
</div>

@else

<div class="d-flex justify-content-center mt-2">
</div>
<a class="d-flex justify-content-center mt-2" href="{{action('DeckController@decks')}}">
    <button class="btn btn-success">Encerrar</button>
</a>

@endif

@endsection