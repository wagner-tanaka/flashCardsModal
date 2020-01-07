@extends('layouts.main', ["current" => "deck/create"])

@section('content')

<form action="/deck" method="POST">
    @csrf

    <div class="md-form container">
        <label for="inputPlaceholderEx">Nome do Baralho</label>
    <input placeholder="Digite o nome do baralho" name="name" type="text" id="inputPlaceholderEx" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}">
    @if($errors->has('name'))
    <div class="invalid-feedback">
        {{$errors->first('name')}}
    </div>
    @endif
    <div class="mt-1">
            <button type="submit" class="btn btn-success">Criar</button>
        </div>
    </div>


</form>






@endsection