@extends('layouts.main', ["current" => "card/edit"])

@section('content')
    
    <div class="card border">
        <div class="card-body">
            <form action="/card/update/{{$card->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nomeCategoria">Edit front side</label>
                    <input type="text" class="form-control" name="front"  value="{{$card->front}}"
                     id="nomeCategoria" placeholder="Categoria" > 
                </div>
                <div class="form-group">
                    <label for="nomeCategoria">Edit back side</label>
                    <input type="text" class="form-control" name="back"  value="{{$card->back}}"
                     id="nomeCategoria" placeholder="Categoria" > 
                </div>

             
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>


            </form>
        </div>
    </div>

   

@endsection