<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function index(){
        $photos = Photo::where('published', '=', false)->paginate(12);

        return view('admin.drafts.index', compact('photos'));
    }
}
