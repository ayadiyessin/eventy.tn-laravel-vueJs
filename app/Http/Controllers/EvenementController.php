<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evenements = Evenement::with(['organisateurs','categorieEvent'])->get(); // methode eli fi wost el restoration
        return $evenements;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $evenement = new Evenement([
            'nom_Event' => $request->input('nom_Event'),
            'categorieEventID' => $request->input('categorieEventID'),
            'organisateursID' => $request->input('organisateursID'),
            'nbPlace_Event' => $request->input('nbPlace_Event'),
            'date_Event' => $request->input('date_Event'),
            'prix_Event' => $request->input('prix_Event'),
            'adresse_Event' => $request->input('adresse_Event'),
            ]);
            $evenement->save();
            return response()->json($evenement,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evenement = Evenement::find($id);
        return response()->json($evenement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evenement = Evenement::find($id);
        $evenement->update($request->all());
        return response()->json($evenement,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evenement = Evenement::find($id); // . find => nlawej alih
        $evenement->delete();
        return response()->json('evenement supprimée !');
    }
    public function showEvenementByOrg($orgID)
    {
        $evenement= Evenement::where('organisateursID', $orgID)->with('organisateurs')->get();
        return response()->json($evenement);
    }
    public function showEvenementBycateg($categID)
    {
        $evenement= Evenement::where('categorieEventID', $categID)->with('categorieEvent')->get();
        return response()->json($evenement);
    }
}
