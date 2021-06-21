<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{

    public function showAllLeads()
    {
        return Lead::with('customer')->get();
    }

    // stuck at CORS blocking preflight for some reason
    public function update($id, Request $request)
    {
        Log::debug("save accepted");
        Log::debug($id);
        Log::debug($request->all());

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

    public function decline($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update(['status' => 'Declined']);

        return response()->json($lead, 200);
    }

    public function delete($id)
    {
        // Change to soft delete later
        Lead::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
