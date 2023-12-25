<?php

namespace App\Http\Controllers;

use App\Models\Organisateur;
use Illuminate\Http\Request;

class OrganisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organisateurs = Organisateur::with('user')->get();
        return $organisateurs;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organisateur = new Organisateur([
            'nom_org' => $request->input('nom_org'),
            'usersID' => $request->input('usersID'),
            ]);
            $organisateur->save();
            return response()->json($organisateur,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $organisateur = Organisateur::find($id);
        return response()->json($organisateur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $organisateur = Organisateur::find($id);
        $organisateur->update($request->all());
        return response()->json($organisateur,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $organisateur = Organisateur::find($id); // . find => nlawej alih
        $organisateur->delete();
        return response()->json('organisateur supprimée !');
    }
    public function showOrganisateurByUser($iduser)
    {
        $organisateur= Organisateur::where('usersID', $iduser)->with('user')->get();
        return response()->json($organisateur);
    }
}
