<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;


class SearchPhotoController extends Controller
{
    public function search(Request $request){

        if($request->has('title')){

            $photos = Photo::orderByDesc('id')->where('title', 'LIKE', '%' . $request->title . '%')->where('published', '=', true)->paginate(12);

            session()->flash('photos', $photos);
        }


        return to_route('admin.photos.index');
    }
}
