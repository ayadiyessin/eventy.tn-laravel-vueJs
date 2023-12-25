<?php

namespace App\Http\Controllers;

use App\Models\Telephone;
use Illuminate\Http\Request;

class TelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telephones = Telephone::with('user')->get();
        return $telephones;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $telephone = new Telephone([
            'numero_tell' => $request->input('numero_tell'),
            'usersID' => $request->input('usersID'),
            ]);
            $telephone->save();
            return response()->json($telephone,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $telephone = Telephone::find($id);
        return response()->json($telephone);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $telephone = Telephone::find($id);
        $telephone->update($request->all());
        return response()->json($telephone,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $telephone = Telephone::find($id); // . find => nlawej alih
        $telephone->delete();
        return response()->json('telephone supprimée !');
    }
    public function showTelephoneByUser($iduser)
    {
        $telephone= Telephone::where('usersID', $iduser)->with('user')->get();
        return response()->json($telephone);
    }
}
