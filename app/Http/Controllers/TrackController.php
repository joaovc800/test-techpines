<?php

namespace App\Http\Controllers;

use App\Models\Track;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TrackController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Track::latest()->get(),
            'message' => 'List Tracks'
        ]);
    }

    public function search(Request $request)
    {
        $query = Track::query();
        $keyword = $request->input('name');

        if($keyword){
            $query->where('name', 'like', "%{$keyword}%");
        }


        $track = $query->get();

        if($track->isEmpty()){
            return response()->json([
                'message' => 'Track not found'
            ], Response::HTTP_NOT_FOUND);
        }else{
            return response()->json([
                'data' => $track,
                'message' => 'List Tracks',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'album_id' => 'required|exists:albums,id'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        try {

            $data = Track::create($request->all());
            return response()->json([
                'data' => $data,
                'message' => 'Track stored'
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            Log::error("Error storing :" . $e->getMessage());

            return response()->json([
                'message' => 'Failed Track Stored'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $track = Track::where('id', $id)->first();

        if($track){
            return response()->json([
                'data' => $track
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'Track not found'
            ], Response::HTTP_NOT_FOUND);
        }

    }

    public function update(Request $request, $id)
    {

        $track = Track::find($id);

        if(!$track){
            return response()->json([
                'message' => 'Track not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'album_id' => 'required|exists:albums,id'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        try {

            $data = $track->update($request->all());

            return response()->json([
                'data' => $data,
                'message' => 'Track Update'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::error("Error storing :" . $e->getMessage());

            return response()->json([
                'data' => $data,
                'message' => 'Failed Update'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function destroy($id)
    {

        $track = Track::find($id);

        try {
            $track->delete();

            return response()->json([
                'message' => 'Track deleted'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::error("Error Delete Track:" . $e->getMessage());

            return response()->json([
                'message' => 'Failed Delete Track'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
