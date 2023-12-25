<?php

namespace App\Http\Controllers;

use App\Models\AvisPub;
use App\Models\Participant;
use App\Models\Publication;
use Illuminate\Http\Request;

class AvisPubController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    // public function afficherCom($partId, $publId)
    // {
    //     // $participant = Participant::findOrFail($partId);
    //     // $publication = Publication::findOrFail($publId);
    //     $commentaires = AvisPub::where('participantsID', $partId)->where('publicationsID', $publId)->pluck('commentaire_pub');
    //     return $commentaires;
    // }
    // public function afficherNote($partId, $publId)
    // {
    //     // $participant = Participant::findOrFail($partId);
    //     // $publication = Publication::findOrFail($publId);
    //     $note = AvisPub::where('participantsID', $partId)->where('publicationsID', $publId)->max('note_pub');
    //     //->orderBy('champ_critere', 'desc')->first(); // tri décroissant basé sur le champ_critere
    //     if ($note === null) {
    //         $note = 0;
    //     }
    //     return $note;
    // }
    // public function ajoutCom(Request $request,$partId, $publId)
    // {
    //     $note = AvisPub::where('participantsID', $partId)
    //     ->where('publicationsID', $publId)
    //     ->pluck('note_note_pub')
    //     ->max('note_pub');
    //     if ($note === null) {
    //         $note = 0;
    //     }
    //     $ajoutcoment = new AvisPub([
    //         'publicationsID' => $request->input('publicationsID'),
    //         'participantsID' => $request->input('participantsID'),
    //         'note_pub' => $note,
    //         'commentaire_pub' => $request->input('commentaire_pub'),
    //         ]);
    //         $ajoutcoment->save();
    //         return response()->json($ajoutcoment,201);

    // }
    // public function ajoutnote(Request $request,$partId, $publId)
    // {
    //     $nouvelleNote = $request->input('note_pub');
    //     $note = AvisPub::where('participantsID', $partId)
    //     ->where('publicationsID', $publId)
    //     ->pluck('note_note_pub')
    //     ->max('note_pub');
    //     if($note ===null){
    //          $ajoutnote = new AvisPub([
    //             'publicationsID' => $request->input('publicationsID'),
    //             'participantsID' => $request->input('participantsID'),
    //             'note_pub' => $nouvelleNote,
    //             ]);
    //             $ajoutnote->save();
    //             //pdate
    //             AvisPub::where('participantsID', $partId)
    //             ->where('publicationsID', $publId)
    //             ->update(['note_pub' => $nouvelleNote]);
    //             return response()->json($ajoutnote,201);
    //     }
    //     else {
    //         AvisPub::where('participantsID', $partId)
    //             ->where('publicationsID', $publId)
    //             ->update(['note_pub' => $nouvelleNote]);

    //         return "Toutes les lignes mises à jour avec la nouvelle note : $nouvelleNote";
    //     }



    // }



    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, AvisPub $avisPub)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(AvisPub $avisPub)
    // {
    //     //
    // }

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
