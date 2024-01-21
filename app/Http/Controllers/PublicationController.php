<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::with(['restauration'])->where('archive_pub', 0)->get(); // methode eli fi wost el restoration
        return $publications;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $publication = new Publication([
            'dersc_pub' => $request->input('dersc_pub'),
            'photo_pub' => $request->input('photo_pub'),
            'restaurationID' => $request->input('restaurationID'),
            ]);
            $publication->save();
            return response()->json($publication,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $publication = Publication::with(['restauration'])->find($id);
        return response()->json($publication);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $publication = Publication::find($id);
        $publication->update($request->all());
        return response()->json($publication,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publication = Publication::find($id); // . find => nlawej alih
        $publication->delete();
        return response()->json('publication supprimée !');
    }
    public function showPublicationByRes($idres)
    {
        $publication= Publication::where('restaurationID', $idres)->with('restauration')->get();
        return response()->json($publication);
    }

    public function archiver($id)
    {
        $publication = Publication::find($id);
        // if ($request->has('archive_pub')) {
        //     $publication->archive_pub = 1;
        // }
        $publication->update([
            'archive_pub' => 1,
        ]);

        $publication->save();

        return response()->json($publication, 200);
    }
    public function desarchiver($id)
    {
        $publication = Publication::find($id);
        $publication->update([
            'archive_pub' => 0,
        ]);

        $publication->save();

        return response()->json($publication, 200);
    }


}
