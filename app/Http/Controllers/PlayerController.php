<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $players= Player::all();

        return view('players.index', [
       'players' => $players
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
    return view('players.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        //$player = Player::select()->where('id', '=', $id)->get();
        $player = Player::find($id);
       
              return view('players.show', ['player' => $player]);
    }
       

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
