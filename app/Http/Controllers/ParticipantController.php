<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participant::with('user')->get();
        return $participants;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $participant = new Participant([
            'nom_part' => $request->input('nom_part'), // bech natih nomparticipantbel input
            'prenom_part' => $request->input('prenom_part'),
            'usersID' => $request->input('usersID'),
            ]);
            $participant->save();
            return response()->json($participant,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $participant = Participant::find($id);
        return response()->json($participant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $participant = Participant::find($id);
        $participant->update($request->all());
        return response()->json($participant,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $participant = Participant::find($id); // . find => nlawej alih
        $participant->delete();
        return response()->json('participant supprimée !');
    }
    public function showParticipantByUser($iduser)
    {
        $participant= Participant::where('usersID', $iduser)->with('user')->get();
        return response()->json($participant);
    }
}
