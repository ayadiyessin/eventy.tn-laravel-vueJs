<?php

namespace App\Http\Controllers;

use App\Models\CategorieEvent;
use Illuminate\Http\Request;

class CategorieEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategorieEvent::all();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorie = new CategorieEvent([
            'nomcategorieEvent' => $request->input('nomcategorieEvent')
            ]);
        $categorie->save();
        return response()->json($categorie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorie = CategorieEvent::find($id);
        return response()->json($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categorie = CategorieEvent::find($id);
        $categorie->update($request->all());
        return response()->json($categorie, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = CategorieEvent::find($id);
        $categorie->delete();
        return response()->json('Catégorie de Event supprimée !');

    }
}
