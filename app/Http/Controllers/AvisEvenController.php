<?php

namespace App\Http\Controllers;

use App\Models\AvisEven;
use Illuminate\Http\Request;

class AvisEvenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($partId, $eventID)
    {
        $commentaires = AvisEven::where('participantsID', $partId)->where('evenementsID', $eventID)->get();//->pluck('commentaire_Event')
        return $commentaires;
    }

    public function listeCommentaires($eventID)
    {
        $commentaires = AvisEven::where('evenementsID', $eventID)->orderBy('updated_at', 'asc')->get();//->pluck('commentaire_Event')
        return $commentaires;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$partId, $eventID)
    {
        $commentaire = new AvisEven([
            'evenementsID' => $eventID,
            'participantsID' => $partId,
            'commentaire_Event' => $request->input('commentaire_Event'),
            ]);
            $commentaire->save();
            return response()->json($commentaire,201);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $commentaire = AvisEven::find($id);
        //$commentaire->update($request->all());
        $commentaire->update([
            'commentaire_Event' => $request->input('commentaire_Event'),
        ]);
        $commentaire->touch(); // bech tbedeli update_at
        return response()->json($commentaire,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commentaire = AvisEven::find($id); // . find => nlawej alih
        $commentaire->delete();
        return response()->json('commentaire supprimée !');
    }
}
