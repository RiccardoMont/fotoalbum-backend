<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all();
        //dd($leads);

        return view('admin.leads.index', compact('leads'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {

        $lead->delete();
        
        return to_route('admin.leads.index');
        
    }
}
