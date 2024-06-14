<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {

        if($request->has('category_id')){

            $category = Category::find($request->category_id);
            $photos = $category->photos;

            return response()->json([

                'success' => true,
                'sono qui' => true,
                //'results' => Category::with('photos')->where('slug', '=', 'doloribus-ut-quia')->get()
                //'results' => $request
                'results' => $photos
    
            ]);


        }

        return response()->json([
            'success' => true,
            'results' => Category::all()
        ]);



    }

    public function category_filter(Request $request) {

        if(!$request->category){
            return response()->json([
                'success' => false,
                'results' => 'cat not found'
            ]);
        }

        $category = Category::find($request->category);
        $photos = $category->photos;
        return response()->json([

            'success' => true,
            'prov' => true,     
            'results' => $photos
        ]);    
      
    }
}
