<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::with(['evenement','publication'])->get();
        return $photos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $photo = new Photo([
            'imagePhoto' => $request->input('imagePhoto'),
            'evenementsID' => $request->input('evenementsID'),
            'publicationsID' => $request->input('publicationsID'),
            ]);
            $photo->save();
            return response()->json($photo,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        return response()->json($photo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        $photo->update($request->all());
        return response()->json($photo,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::find($id); // . find => nlawej alih
        $photo->delete();
        return response()->json('photo supprimée !');
    }
    public function showPhotoByPub($pubID)
    {
        $photo= Photo::where('publicationsID', $pubID)->with('publication')->get();
        return response()->json($photo);
    }
    public function showPhotoByEvent($evetID)
    {
        $photo= Photo::where('evenementsID', $evetID)->with('evenement')->get();
        return response()->json($photo);
    }
}
