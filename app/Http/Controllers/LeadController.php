<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{

    public function showAllLeads()
    {
        return Lead::with('customer')->get();
    }

    // stuck at CORS blocking preflight for some reason
    public function update($id, Request $request)
    {
        $author = Lead::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function accept($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update(['status' => 'Accepted']);

        return response()->json($lead, 200);
    }
}
