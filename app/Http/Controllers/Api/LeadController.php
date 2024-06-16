<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadMarkdown;
use App\Mail\NewLeadMessage;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request){

        $val_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:2000'
        ]);

        $newLead = Lead::create($val_data);

        Mail::to('admin-photoalbum@example.com')->send(new NewLeadMessage($newLead));

        return response()->json([
            'success' => true,
        ]);

    }
}
