@extends('layouts.main', ["current" => "card/show"])

@section('content')
<h1>Here is your cards {{ \Auth::user()->name }}!</h1>


<table class="table table-ordered table-hover">
        <thead>
            <tr>
                <th>Front Side</th>
                <th>Back Side</th>
                <th>Deck Id</th>
                <th>Actions</th>
            </tr>
        </thead>
    
    
        <tbody>

@foreach($cards as $card)
    
            <tr>
                <td>{{$card->front}}</td>
                <td>{{$card->back}}</td>
                <td>{{$card->deck_id}}</td>
                <td>
                <a href="/card/edit/{{$card->id}}" class="btn btn-sm btn-primary">Edit</a>
                <a href="/card/destroy/{{$card->id}}" class="btn btn-sm btn-primary">Delete</a>
                </td>
          
    



            </tr>
@endforeach    
        </tbody>
    
    </table>


@endsection