@extends('layouts.main', ["current" => "deck/edit"])

@section('content')
    
    <div class="card border">
        <div class="card-body">
            <form action="/deck/update/{{$deck->id}}" method="POST">

                @csrf

                @method('PUT')
                
                <div class="form-group">
                    <label for="nomeCategoria">Rename</label>
                    <input type="text" class="form-control" name="name"  value="{{$deck->name}}"> 
                </div>
             
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>


            </form>
        </div>
    </div>

   

@endsection

             