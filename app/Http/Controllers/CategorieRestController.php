<?php

namespace App\Http\Controllers;

use App\Models\CategorieRest;
use Illuminate\Http\Request;

class CategorieRestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategorieRest::all();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorie = new CategorieRest([
            'nomcategorie' => $request->input('nomcategorie')
            ]);
        $categorie->save();
        return response()->json($categorie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorie = CategorieRest::find($id);
        return response()->json($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categorie = CategorieRest::find($id);
        $categorie->update($request->all());
        return response()->json($categorie, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = CategorieRest::find($id);
        $categorie->delete();
        return response()->json('Catégorie de rest supprimée !');

    }
}
