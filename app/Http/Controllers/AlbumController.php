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
            'data' => Album::latest()->get(),
            'message' => 'List Albums'
        ]);
    }

    public function create(Request $request)
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
                'data' => $data,
                'message' => 'Failed Stored'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id){
        $album = Album::where('id', $id)->first();

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
}
