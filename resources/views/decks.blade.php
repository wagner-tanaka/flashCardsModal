@extends('layouts.main', ["current" => "decks"])

@section('content')

<div class="container row">

    <div class="col-md-2 view zoom">

        <button class="btn btn-primary-outline" type="button" data-toggle="modal" data-target="#myModal"><h2>Novo baralho</h2><img src="/img/newDeck2.png" class="img-fluid " alt="smaple image"></button> <!---->


    </div>

    <div class="col-md-10">

        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Escolha Seu Baralho para adicionar cartas</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($decks as $deck)
                {{-- quando uso o foreach, estou acessando cada deck, se nao tiver nenhum, retorna o primeiro deck
                                   por isso retorna o deck->id e deck->name, mas do primeiro deck se nao tiver nenhum otro  --}}
                <tr>
                    {{-- <td><a class="btn btn-primary" href="/select_deck/{{$deck->id}}">{{ $deck->name }}</a></td>
                    --}}
                    <td><a class="btn btn-primary"
                            href="{{action('DeckController@selectDeck', [$deck->id])}}">{{ $deck['name']}}</a>
                        {{-- aqui no action, inves de ir pra rota select_deck, acessa direto o controller selectDeck, 
                    que esta relacionado com a rota select_deck,
                    enviando o parametro necessario, e nesse caso o id = deckId na frente do parametro id --}}
                    </td>
                    <td>
                        <a href="/deck/edit/{{$deck->id}}" class="btn btn-sm btn-primary">Renomear</a>
                        <a href="/deck/destroy/{{$deck->id}}" class="btn btn-sm btn-danger">Deletar</a>
                        {{-- operação ternária                                             operação ternária --}}
                        <a class="btn btn-sm btn-success {{$deck->cards->count() == 0 ? 'disabled' : ''}}"
                            href="{{$deck->cards->count() == 0 ? '#' : action('CardController@play_flash_cards', [$deck->id])}}">
                        Praticar</a>
                        {{-- css com ope ternario          classe BS                  link ope ternario --}}
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">  
        <!-- Modal content-->

        <div class="modal-content">

        <div class="md-form container mt-3">
        <h5 class="modal-title" id="exampleModalLabel">Novo Baralho</h5>
     
       
   
         <form action="/deck" method="POST">
          @csrf
    
        
           
          <input placeholder="Digite o nome do baralho" name="name" type="text" id="inputPlaceholderEx" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}">
        @if($errors->has('name'))
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
        @endif
        
        

        <div class="mt-3">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Criar</button>
          </div>

        </div>  
         </form>
        
        
    
 

    </div>
</div>



@endsection
{{--
<br>
current Deck {{session('current_deck')}}
<br>
{{Auth::user()->deck()->cards}} --}}