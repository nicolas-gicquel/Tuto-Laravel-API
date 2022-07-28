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

        $filename = "";
        if ($request->hasFile('logoClub')) {

            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('logoClub')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('logoClub')->getClientOriginalExtension();

            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;

            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('logoClub')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }
        
        $club = Club::create([
            'nameClub' => $request->nameClub,
            'logoClub' => $filename,
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
        $club =  Club::whereId($club->id)->firstOrFail();
        
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

        $filename = "";
        if ($request->hasFile('logoClub')) {

            // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
            $filenameWithExt = $request->file('logoClub')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //  On récupère l'extension du fichier, résultat $extension : ".jpg"
            $extension = $request->file('logoClub')->getClientOriginalExtension();

            // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $fileNameToStore : "jeanmiche_20220422.jpg"
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;

            // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin /storage/app
            $path = $request->file('logoClub')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }

        $club->update([
            'nameClub' => $request->nameClub,
            'logoClub' => $filename,
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
        // On supprime le club
        $club->delete();

        return response()->json([
            'status' => 'Supprimer avec succès']);
    }
}
