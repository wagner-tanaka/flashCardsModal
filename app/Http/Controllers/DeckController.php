<?php

namespace App\Http\Controllers;

use App\Deck;
use App\Card;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset(Auth::user()->decks->first()->id)) {
            $decks = Auth::user()->decks;
        }

        return view('/index', compact('decks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $decks = Deck::all();
        return view('deck/create', compact('decks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'name.required' => 'Digite um nome para o baralho'
        ];

        $request->validate([
            'name' => 'required'
        ], $message);

        $deck = new Deck();
        $deck->name = $request->input('name');
        $deck->user_id = Auth::user()->id;
        $deck->save();
        return redirect('/decks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Deck $deck)
    {
        if (isset($deck)) {
            return view('deck/edit', compact('deck'));
            return redirect('deck/show');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deck $deck)
    {
        $deck->name = $request->input('name');

        $deck->save();

        return redirect('/decks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {

        if (isset($deck)) {
            $deck->delete();
        }

        return redirect('/decks');
    }

    public function decks()
    {
        $decks = Auth::user()->decks;

        return view('/decks', compact('decks'));
    }

    public function selectDeck(Deck $deck)
    {
        $deckId = $deck->id;

        session(['current_deck' => $deckId]); // pq o dd dessa session da null? não era pra ser o id do deck atual?
        // dd(session(['current_deck' => $deckId]));

        $cards = Auth::user()->deck()->cards;

        return view('/deck/index', compact('deckId', 'cards'));
    }
}
