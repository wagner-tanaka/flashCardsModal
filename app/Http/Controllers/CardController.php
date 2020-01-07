<?php

namespace App\Http\Controllers;

use App\Card;
use App\Deck;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{



    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $mensagens = [
        'front.required' => 'Digite o lado da frente',
        'back.required' => 'Digite o lado de trás',
        ];

        $request->validate([
            'front' => 'required',
            'back' => 'required',
        ], $mensagens);

        $card = new Card();
        $card->front = $request->input('front');
        $card->back = $request->input('back');
        $card->deck_id = $request->input('deck_id'); // usar essa linha para salvar no id do usuario autenticado
        $card->save();

        return redirect('select_deck/' . $card->deck_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    { }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        if (isset($card)) {
            return view('card/edit', compact('card'));
            return redirect('card');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $card->front = $request->input('front');
        $card->back = $request->input('back');
        $card->save();

        $deck_id = $card->deck_id;

        return redirect('select_deck/' . $deck_id . '?id=' . $deck_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {

        if (isset($card)) {
            $card->delete();
        }

        $deck_id = $card->deck_id;

        return redirect('select_deck/' . $deck_id . '?id=' . $deck_id);
    }

    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function play_flash_cards(Deck $deck)
    {
        session(['current_deck' => $deck->id]); // aqui criou a variavel de seção, que nao morre, id no caso
        $decks = Auth::user()->decks;       // pega todos os decks do usuartio atual

        // dd($cards->id); nao pode
        // dd($current_card->id); pode

        if (Auth::check()) {
            if (request('acertou')) { // se request('acertou') = true, ou se existir
                $card = Card::find(request('acertou')); // $card = a carta com o respectivo id
                $card->strength += 1;
                $card->save();
            } elseif (request('errou')) {
                $card = Card::find(request('errou'));
                $card->strength = 0;
                $card->save();
            }
        }

        $cards = Auth::user()->deck()->cards; // pega todas as cartas do deck atual

        $cards = $cards->reject(function ($card) {                                  // reject é uma função - reject espera uma função, por isso foi criada essa função
            // que pega cada carta, esse reject está esperando 'true' or 'false', se for true ele rejeita o que esta dentro.
            return ($card->strength == 1 && $card->updated_at > now()->subHours(6));   //cada vez que passar por aqui essa função vai ver todas as cartas se é numero 1 e 

        });
        $cards = $cards->reject(function ($card) {

            return ($card->strength == 2 && $card->updated_at > now()->subDays(2));   // aqui compara se a força da carta é igual a 1.
            //  E o dia que a carta foi atualizada com  a data de hoje menos
            // 3 dias. se os dois derem true, a carta vai ser rejeitada(nao aparecera.), se algum der false
            // ela passa a aparecer.
        });
        $cards = $cards->reject(function ($card) {
            return ($card->strength == 3 && $card->updated_at > now()->subDays(5));
        });
        $cards = $cards->reject(function ($card) {
            return ($card->strength == 4 && $card->updated_at > now()->subDays(10));
        });
        $cards = $cards->reject(function ($card) {
            return ($card->strength >= 5 && $card->updated_at > now()->subDays(30));
        });

        $current_card = $cards->first(); // carta atual é a primeira carta de $cards

        return view('play_flash_cards', compact('deck', 'current_card'));
    }
}




// public function play_flash_cards(Deck $deck) // quando coloca Deck na frente do $deck, quer dizer que $deck passa a ser uma variavel
// {                                           // que carrega todas informações do objeto Deck, que esta la no App/deck. 
//     // em outras palavras $deck = new Deck;

//     // dd($deck);

//     session(['current_deck' => $deck->id]); // aqui criou a variavel de seção, que nao morre, id no caso
    
    

//     if (Auth::check()) { // se tiver um usuario autenticado

//     //     if (!session('current_deck')) { // se nao tiver a variavel de seção current deck

//     //         session(['current_deck' => Auth::user()->decks->first()->id]); // a seesion vai ser o primeiro id do deck
//     //     }

//         
       
//         echo '<pre>';   
//     var_dump($cards[0]['front']);
//     echo '</pre>'; 

//         $get_current_card = Card::find(request('id_card')); // para pegar o strength da carta que foi mandada pro back end
//         // dd($get_current_card);
//         $acertou = request('acertou');
//         if ($acertou == 'true') {

//             $get_current_card->strength = $get_current_card->strength + 1;
//             $get_current_card->save();

//         } elseif ($acertou == 'false') {

//             $get_current_card->strength = 0;
//             $get_current_card->save();
//         }

//         echo '<pre>';   
//         var_dump($cards[0]['front']);
//         echo '</pre>'; 
//         // $front = $cards[$id]['front'];
//         // $back = $cards[$id]['back'];

//         // if (isset($_GET['side'])) {
//         //     if ($_GET['side'] == $cards[$id]['front']) {
//         //         $side = $cards[$id]['front'];
//         //     } else if ($_GET['side'] == $cards[$id]['back']) {
//         //         $side = $cards[$id]['back'];
//         //     }
//         // } else {
//         //     $side = $front;
//         // }

        //$cards = Auth::user()->deck()->cards; // pega todas as cartas do deck atual
//         $decks = Auth::user()->decks;       // pega todos os decks do usuartio atual

//     }

   
// // -------------------------------------------- ver essa logica que ta pegando o side agora ----------------------------------------------------------------------------------
//     $side = request('side') ?? 'front'; // aqui é só uma string
// // ------------------------------------------------------------------------------------------------------------------------------
//     // dd($side);
    
// // --------------------------------logica do reject, usando o strengt, update_at, now e subHours;Days ----------------------------------------------------------------------------------------------

//     $cards = $cards->reject(function ($card) {                                  // reject é uma função - reject espera uma função, por isso foi criada essa função
//                                                                             // que pega cada carta, esse reject está esperando 'true' or 'false', se for true ele rejeita o que esta dentro.
//          return ($card->strength == 1 && $card->updated_at > now()->subHours(6));   //cada vez que passar por aqui essa função vai ver todas as cartas se é numero 1 e 
          
//     });
//     $cards = $cards->reject(function ($card) {

//        return ($card->strength == 2 && $card->updated_at > now()->subDays(2));   // aqui compara se a força da carta é igual a 1.
//                                                                                 //  E o dia que a carta foi atualizada com  a data de hoje menos
//                                                                                 // 3 dias. se os dois derem true, a carta vai ser rejeitada(nao aparecera.), se algum der false
//                                                                                 // ela passa a aparecer.
//     });
//     $cards = $cards->reject(function ($card) {
//         return ($card->strength == 3 && $card->updated_at > now()->subDays(5));
//     });
//     $cards = $cards->reject(function ($card) {
//         return ($card->strength == 4 && $card->updated_at > now()->subDays(10));
//     });
//     $cards = $cards->reject(function ($card) {
//         return ($card->strength >= 5 && $card->updated_at > now()->subDays(30));
//     });

    
// // ------------------------------------------------------------------------------------------------------------------------------
// $id = $_GET['id']  ?? 0; 



// // -----------------array_values, serve para resetar os indices de um array, para começar do 0 novamente -----------------------------------
//     $cards = array_values($cards->toArray());       // preciso fazer isso pq o reject só rejeita os indices, mas nao reagrupa para o 0 novamente, entao
//                                               // quando tenta acessar o indice 0, da offset se esse indice foi rejeitado
// // ------------------------------------------------------------------------------------------------------------------------------

// // if($id >= 1) {
// //     $id = $id - 1;
// // }          // da primeira vez o id é 0, nas proximas é o id da carta
// // dd($cards);
// // -------------------------ver o que é isso aqui-----------------------------------------------------------------------------------------------------
// if(isset($cards[0])){
// $next_card = ($cards[$id] ?? $cards[0]);        // criado pra poder aparecer as cartas com a logica do strength, se usar do outro jeito apareca a primeria carta sempre
// }    
// // dd($current_card);
// echo '<pre>';   
// var_dump($cards[0]['front']);
// echo '</pre>'; 
// //------------------------------------------------------------------------------------------------------------------------------
//     return view('play_flash_cards', compact('cards', 'decks', 'id', 'side', 'deck', 'next_card'));
// }                                               // 'front', 'back',
