<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use App\Models\BestShoot;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        

        //Aggiungo la session per poter ricevere i dati dal FilterController
        $photos = session('photos', Photo::orderByDesc('id')->where('published', '=', true)->paginate(12));

        //Aggiungo la session per tenere memorizzati i checkbox dopo la ricerca 
        $checks = session('checks', []);
       
        $categories = Category::all();




        return view('admin.photos.index', compact('photos', 'categories', 'checks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $best_shoots = BestShoot::all();

        return view('admin.photos.create', compact('categories', 'best_shoots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {

        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');

        //Unique "weekly shoot" and "monthly shoot"
        if ($validated['best_shoot_id'] == 2 || $validated['best_shoot_id'] == 3) {

            $photo_retag = Photo::where('best_shoot_id', '=', $validated['best_shoot_id'])
                ->where('title', '!=', $validated['title'])
                ->first();

            if ($photo_retag) {
                $photo_retag->best_shoot_id = null;
                $photo_retag->update();
            }
        }

        if ($request->has('image')) {

            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()) . '.' . 'jpeg';

            $img = $manager->read($request->file('image')->getRealPath());

            $destination = storage_path('app/public/uploads');

            $img->toJpeg()->save($destination . '/' . $name_gen);

            $validated['image'] = 'uploads/' . $name_gen;
        }


        $validated['user_id'] = auth()->id();

        $photo = Photo::create($validated);

        if ($request->has('categories')) {
            $photo->categories()->attach($validated['categories']);
        }

        return to_route('admin.photos.index')->with('message', 'New Photo uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {

        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        if (auth()->id() != $photo->user_id) {
            abort(403, 'Access denied');
        }
        $categories = Category::all();
        $best_shoots = BestShoot::all();

        return view('admin.photos.edit', compact('photo', 'categories', 'best_shoots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {

        if (auth()->id() != $photo->user_id) {
            abort(403, 'Access denied');
        }

        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');

        //Unique "weekly shoot" and "monthly shoot"
        if ($validated['best_shoot_id'] == 2 || $validated['best_shoot_id'] == 3) {

            $photo_retag = Photo::where('best_shoot_id', '=', $validated['best_shoot_id'])
                ->where('title', '!=', $validated['title'])
                ->first();

            if ($photo_retag) {
                $photo_retag->best_shoot_id = null;
                $photo_retag->update();
            }
        }

        if ($request->has('image')) {

            if ($photo->image) {

                Storage::delete($photo->image);
            }

            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()) . '.' . 'jpeg';

            $img = $manager->read($request->file('image')->getRealPath());

            $destination = storage_path('app/public/uploads');

            $img->toJpeg()->save($destination . '/' . $name_gen);

            $validated['image'] = 'uploads/' . $name_gen;

            //$validated['image'] = Storage::put('uploads', $request->image);
        }


        $photo->update($validated);

        if ($request->has('categories')) {
            $photo->categories()->sync($validated['categories']);
        }

        return to_route('admin.photos.index')->with('message', 'Photo edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {

        if (auth()->id() != $photo->user_id) {
            abort(403, 'Access denied');
        }

        if ($photo->image && !Str::startsWith($photo->image, 'https://')) {

            Storage::delete($photo->image);
        }

        $photo->delete();

        return to_route('admin.photos.index')->with('Photo deleted successfully!');
    }
}
