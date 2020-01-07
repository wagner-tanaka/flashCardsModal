@extends('layouts.main', ["current" => "play_flash_cards"])

@section('content')


<?php

// echo current($cards)['id'];
// echo '<br>';
// echo next($cards[0]);
// echo '<br>';
// echo next($cards[0]);
// echo '<br>';
// echo next($cards[0]);
// echo '<br>';
// echo prev($cards[0]);

// dd($cards[-1]);

$id = $_GET['id'] ?? 0 ;

$front = $cards[$id]['front'];
$back = $cards[$id]['back'];

if (isset($_GET['side'])) {
            if ($_GET['side'] == $cards[$id]['front']) {
                $side = $cards[$id]['front'];
            } else if ($_GET['side'] == $cards[$id]['back']) {
                $side = $cards[$id]['back'];
            }
        } else {
            $side = $front
            ;
        }

        
?>






<div class="container d-flex justify-content-center mt-5">



</div>

<a href="/play_flash_cards?id=<?php echo $id ?>&side=<?php echo $side == $front ? $back : $front ?> ">

    <?php



// $people = array("Peter", "Joe", "Glenn", "Cleveland");

// echo current($people) . "<br>";
// echo next($people);

  echo '<h1>' . $side . '</h1>';

 


  

  
 
//   dd(($cards));

?>


</a>






@if(isset($cards[$id-1]))




<a class="mr-5" href="/play_flash_cards?id={{$id - 1}}&side={{current($cards[$id-1])}}">
    <button class="btn btn-danger">Anterior</button></a>


@endif




@if(isset($cards[$id+1]))


<a class="ml-5" href="/play_flash_cards?id={{$id + 1}}&side={{current($cards[$id+1])}}">
    <button class="btn btn-success">Proxima</button></a>




@endif









@endsection