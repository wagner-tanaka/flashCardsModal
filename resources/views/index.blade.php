@extends('layouts.main', ["current" => "home"])

@section('content')

<h1>Bem vindo {{ \Auth::user()->name }}!</h1>

<br>

<div class="container row">

    <div class="col-md-6 view zoom">
        <button class="btn btn-primary-outline" type="button" data-toggle="modal" data-target="#myModal"><h2>Crie um novo baralho</h2><img src="/img/newDeck2.png" class="img-fluid " alt="smaple image"></button> <!---->
        <div class="mask rgba-red-strong">

        </div>
    </div>

    


    <br>

    <div class="col-md-6 zoom">
        @if(isset($decks))
        <a href="/decks">
            <h2>Todos os baralhos</h2>
            <img src="/img/allDecks.jpg"></a>
        </a>
        @endif
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