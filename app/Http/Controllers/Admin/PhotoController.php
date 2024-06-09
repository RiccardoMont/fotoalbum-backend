<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $photos = Photo::orderByDesc('id')->get();

        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();

        return view('admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');

        if ($request->has('image')) {

            $validated['image'] = Storage::put('uploads', $request->image);
        }


        $photo = Photo::create($validated);

        if ($request->has('categories')) {
            $photo->categories()->attach($validated['categories']);
        }

        return to_route('admin.photos.index')->with('message', 'New Photo uploaded successfully');
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

        $categories = Category::all();

        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {

        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');

        if ($request->has('image')) {

            if ($photo->image) {

                Storage::delete($photo->image);
            }

            $validated['image'] = Storage::put('uploads', $request->image);
        }


        $photo->update($validated);

        if ($request->has('categories')) {
            $photo->categories()->sync($validated['categories']);
        }

        return to_route('admin.photos.index')->with('message', 'Edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {

        if ($photo->image && !Str::startsWith($photo->image, 'https://')) {

            Storage::delete($photo->image);
        }

        $photo->delete();

        return to_route('admin.photos.index')->with('Photo deleted successfully');
    }
}
