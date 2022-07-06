<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /***** 1ère Méthode *****/
        // On récupère tous les joueurs
        // $players = Player::all();

        // On retourne les informations des utilisateurs en JSON
        // return response()->json($players);

        /***** 2ème Méthode *****/
        // On récupère tous les joueurs
        $players = DB::table('players')
            ->get()
            ->toArray();

        // On retourne les informations des utilisateurs en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $players,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'height' => 'required|max:100',
            'position' => 'required|max:100',
        ]);

        

        // On crée un nouvel utilisateur
        $player = Player::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'height' => $request->height,
            'position' => $request->position,
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $player,
          ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Playerr  $playerr
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        // On retourne les informations de l'utilisateur en JSON
        return response()->json($player);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playerr  $playerr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $this->validate($request, [
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'height' => 'required|max:100',
            'position' => 'required|max:100',
        ]);

        // On crée un nouvel utilisateur
        $player->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'height' => $request->height,
            'position' => $request->position,
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($player, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playerr  $playerr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        // On supprime l'utilisateur
        $player->delete();

        // On retourne la réponse JSON
        return response()->json();
    }
}
