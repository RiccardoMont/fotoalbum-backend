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

        $validated['user_id'] = auth()->id();

        BestShoot::create($validated);

        return to_route('admin.best-shoots.index')->with('message', 'New Best Shoots Tag created!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBestShootRequest $request, BestShoot $bestShoot)
    {

        if(auth()->id() != $bestShoot->user_id){
            abort(403, 'Access denied');
        }

        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->name, '-');

        $bestShoot->update($validated);

        return to_route('admin.best-shoots.index')->with('message', 'Best shoots Tag edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BestShoot $bestShoot)
    {
        if(auth()->id() != $bestShoot->user_id){
            abort(403, 'Access denied');
        }

        $bestShoot->delete();

        return to_route('admin.best-shoots.index')->with('message', 'Best shoots Tag deleted!');
    }
}
