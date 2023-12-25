<?php

namespace App\Http\Controllers;

use App\Models\NotePub;
use Illuminate\Http\Request;

class NotePubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($partId, $publId)
    {
        $notes = NotePub::where('participantsID', $partId)->where('publicationsID', $publId)->get();//->pluck('note_pub')
        if ($notes->isEmpty()) {
            return 0; // traj3elna 0 ken mouch 3amel note 
        }
        return $notes;
    }
    // pour la liste des note par publication
    public function Moyenenotes($publId)
    {
        $notes = NotePub::where('publicationsID', $publId)->get();//->pluck('note_pub')
        $averageNote= $notes->avg('note_pub');
        return $averageNote;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$partId, $publId)
    {
        $note = new NotePub([
            'publicationsID' => $publId,
            'participantsID' => $partId,
            'note_pub' => $request->input('note_pub'),
            ]);
            $note->save();
            return response()->json($note,201);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $note = NotePub::find($id);
        //$note->update($request->all());
        $note->update([
            'note_pub' => $request->input('note_pub'),
        ]);
        $note->touch(); // bech tbedeli update_at
        return response()->json($note,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = NotePub::find($id); // . find => nlawej alih
        $note->delete();
        return response()->json('note supprimée !');
    }
}
