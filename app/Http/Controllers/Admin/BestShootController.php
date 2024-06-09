<?php

namespace App\Http\Controllers\Admin;

use App\Models\BestShoot;
use App\Http\Requests\StoreBestShootRequest;
use App\Http\Requests\UpdateBestShootRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BestShootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $best_shoots = BestShoot::all();

        return view('admin.best-shoots.index', compact('best_shoots'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBestShootRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->name, '-');

        BestShoot::create($validated);

        return to_route('admin.best-shoots.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBestShootRequest $request, BestShoot $bestShoot)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->name, '-');

        $bestShoot->update($validated);

        return to_route('admin.best-shoots.index')->with('message', 'Categories updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BestShoot $bestShoot)
    {
        $bestShoot->delete();

        return to_route('admin.best-shoots.index')->with('message', 'Category deleted!');
    }
}
