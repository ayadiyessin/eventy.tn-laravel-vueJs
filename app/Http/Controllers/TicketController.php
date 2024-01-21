<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['evenement','Participant'])->get(); 
        return $tickets;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = new Ticket([
            'nb_Tick' => $request->input('nb_Tick'),
            'evenementsID' => $request->input('evenementsID'),
            'participantsID' => $request->input('participantsID'),
            ]);
            $ticket->save();
            return response()->json($ticket,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->update($request->all());
        return response()->json($ticket,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id); // . find => nlawej alih
        $ticket->delete();
        return response()->json('ticket supprimée !');
    }
    public function showTicketByPart($partID)
    {
        $ticket= Ticket::where('participantsID', $partID)->with('Participant')->get();
        return response()->json($ticket);
    }
    public function showTicketByEvent($evetID)
    {
        $ticket= Ticket::where('evenementsID', $evetID)->with('evenement')->get();
        return response()->json($ticket);
    }
    public function showtickbypartEvent($partId, $eventID)
    {
        $ticket = Ticket::where('participantsID', $partId)->where('evenementsID', $eventID)->get();//->pluck('commentaire_pub')
        if ($ticket->isEmpty()) {
            return 0; // traj3elna 0 ken mouch 3amel note 
        }
        return $ticket;
    }
}
