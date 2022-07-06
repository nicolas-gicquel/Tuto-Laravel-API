<?php

namespace App\Http\Controllers\API;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = DB::table('clubs')
            ->get()
            ->toArray();

        return response()->json([
            'status' => 'Success',
            'data' => $clubs,
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
            'nameClub' => 'required|max:100',
        ]);
        
        $club = Club::create([
            'nameClub' => $request->nameClub,
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $club,
          ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        return response()->json($club);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $this->validate($request, [
            'nameClub' => 'required|max:100',
        ]);

        $club->update([
            'nameClub' => $request->nameClub,
        ]);

         return response()->json([
            'status' => 'Mise à jour avec succèss']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        return response()->json([
            'status' => 'Supprimer avec succès']);
    }
}
