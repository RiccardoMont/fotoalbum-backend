<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BestShoot;
use Illuminate\Http\Request;


class BestShootController extends Controller
{
    public function index(){
        $highlighted = BestShoot::where('slug', '=', 'highlighted')->first();
        $photos = $highlighted->photos;

        return response()->json([
            'success' => true,
            'results' => $photos
        ]);

    }

    public function bests(){
        $bests = BestShoot::with(['photos'])->where('slug', '!=', 'highlighted')->get();
        $photos = $bests->all();

        
        return response()->json([
            'success' => true,
            'results' => $photos
        ]);

    }
}
