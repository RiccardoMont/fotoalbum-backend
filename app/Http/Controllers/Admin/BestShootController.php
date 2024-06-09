<?php

namespace App\Http\Controllers\Admin;

use App\Models\BestShoot;
use App\Http\Requests\StoreBestShootRequest;
use App\Http\Requests\UpdateBestShootRequest;
use App\Http\Controllers\Controller;


class BestShootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        return view('admin.best-shoots.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBestShootRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BestShoot $bestShoot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BestShoot $bestShoot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBestShootRequest $request, BestShoot $bestShoot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BestShoot $bestShoot)
    {
        //
    }
}
