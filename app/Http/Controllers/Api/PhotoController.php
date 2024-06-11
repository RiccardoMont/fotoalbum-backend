<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(Request $request) {

        if($request->has('search')) {

            return response()->json([
                'success' => true,
                'results' => Photo::with(['categories', 'user', 'bestShoot'])->orderByDesc('id')->where('title', 'LIKE', '%' . $request->search . '%')->get()
            ]);
        }


        return response()->json([
            'success' => true,
            'results' => Photo::all()
        ]);

    }

    public function show($id) {

        $photo = Photo::with(['categories', 'user', 'bestShoot'])->where('id', $id)->get();
        if($photo){
            return response()->json([
                'success' => true,
                'results' => $photo
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => '404 Not found'
            ]);
        }

    }
}
