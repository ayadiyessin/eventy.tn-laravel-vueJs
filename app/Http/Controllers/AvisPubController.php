<?php

namespace App\Http\Controllers;

use App\Models\AvisPub;
use App\Models\Participant;
use App\Models\Publication;
use Illuminate\Http\Request;

class AvisPubController extends Controller
{
    public function index($partId, $publId)
    {
        $commentaires = AvisPub::where('participantsID', $partId)->where('publicationsID', $publId)->get();//->pluck('commentaire_pub')
        return $commentaires;
    }
    // pour la liste des comm par publication
    public function listeCommentaires($publId)
    {
        $commentaires = AvisPub::where('publicationsID', $publId)->orderBy('updated_at', 'asc')->get();//->pluck('commentaire_Event')
        return $commentaires;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$partId, $publId)
    {
        $commentaire = new AvisPub([
            'publicationsID' => $publId,
            'participantsID' => $partId,
            'commentaire_pub' => $request->input('commentaire_pub'),
            ]);
            $commentaire->save();
            return response()->json($commentaire,201);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $commentaire = AvisPub::find($id);
        //$commentaire->update($request->all());
        $commentaire->update([
            'commentaire_pub' => $request->input('commentaire_pub'),
        ]);
        $commentaire->touch(); // bech tbedeli update_at
        return response()->json($commentaire,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commentaire = AvisPub::find($id); // . find => nlawej alih
        $commentaire->delete();
        return response()->json('commentaire supprimée !');
    }

}
