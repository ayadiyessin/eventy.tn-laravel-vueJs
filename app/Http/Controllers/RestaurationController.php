<?php

namespace App\Http\Controllers;

use App\Models\Restauration;
use Illuminate\Http\Request;

class RestaurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurations = Restauration::with(['user','categorieRest'])->get(); // methode eli fi wost el restoration
        return $restaurations;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restauration = new Restauration([
            'nom_rest' => $request->input('nom_rest'),
            'usersID' => $request->input('usersID'),
            'categorieRestID' => $request->input('categorieRestID'),
            ]);
            $restauration->save();
            return response()->json($restauration,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restauration = Restauration::find($id);
        return response()->json($restauration);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $restauration = Restauration::find($id);
        $restauration->update($request->all());
        return response()->json($restauration,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restauration = Restauration::find($id); // . find => nlawej alih
        $restauration->delete();
        return response()->json('restauration supprimée !');
    }
    public function showRestaurationByUser($iduser)
    {
        $restauration= Restauration::where('usersID', $iduser)->with('user')->get();
        return response()->json($restauration);
    }
    public function showRestaurationBycategorieRest($categorieRestID)
    {
        $restauration= Restauration::where('categorieRestID', $categorieRestID)->with('categorieRest')->get();
        return response()->json($restauration);
    }
}
