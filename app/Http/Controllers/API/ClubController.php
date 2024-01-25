<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::all();
        return response()->json($clubs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nameClub' => 'required|max:100',
        ]);

        $filename = "";
        if ($request->hasFile('logoClub')) {
            $filenameWithExt = $request->file('logoClub')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logoClub')->getClientOriginalExtension();
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            $path = $request->file('logoClub')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }

       
        $club = Club::create(array_merge($request->all(), ['logoClub' => $filename]));
        return response()->json([
            'status' => 'Success',
            'data' => $club,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        return response()->json($club);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        $this->validate($request, [
            'nameClub' => 'required|max:100',
        ]);

        $filename = "";
        if ($request->hasFile('logoClub')) {
            $filenameWithExt = $request->file('logoClub')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logoClub')->getClientOriginalExtension();
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            $path = $request->file('logoClub')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }

       
        $club->update(array_merge($request->all(), ['logoClub' => $filename]));
        
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        $club->delete();
        return response()->json([
            'status' => 'Supprimer avec succès'
        ]);
    }
}
