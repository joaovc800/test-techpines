<?php

namespace App\Http\Controllers;

use App\Models\Album;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Album::with('tracks')->get(),
            'message' => 'List Albums'
        ]);
    }

    public function search(Request $request)
    {
        $query = Album::query();
        $keyword = $request->input('name');

        if($keyword){
            $query->where('name', 'like', "%{$keyword}%");
        }


        $albums = $query->get();

        if($albums->isEmpty()){
            return response()->json([
                'message' => 'Album not found'
            ], Response::HTTP_NOT_FOUND);
        }else{
            return response()->json([
                'data' => $albums,
                'message' => 'List articles',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    }

    public function store(Request $request)
    {

        $validate = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'release_year' => 'required|integer|digits:4'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        try {

            $data = Album::create($request->all());
            return response()->json([
                'data' => $data,
                'message' => 'Album stored'
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            Log::error("Error storing :" . $e->getMessage());

            return response()->json([
                'message' => 'Failed Stored'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $album = Album::with('tracks')->where('id', $id)->first();

        if($album){
            return response()->json([
                'data' => $album
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'Album not found'
            ], Response::HTTP_NOT_FOUND);
        }

    }

    public function update(Request $request, $id)
    {

        $album = Album::find($id);

        if(!$album){
            return response()->json([
                'message' => 'Album not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validate = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'release_year' => 'required|integer|digits:4'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        try {

            $data = $album->update($request->all());

            return response()->json([
                'data' => $data,
                'message' => 'Album Update'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::error("Error storing :" . $e->getMessage());

            return response()->json([
                'data' => $data,
                'message' => 'Failed Update'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function destroy(Request $request, $id)
    {

        $album = Album::find($id);

        try {
            $album->delete();

            return response()->json([
                'message' => 'Album deleted'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::error("Error Delete Album:" . $e->getMessage());

            return response()->json([
                'message' => 'Failed Delete Album'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
