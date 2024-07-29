<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

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

    }
}
