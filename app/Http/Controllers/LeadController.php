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

    public function showAllLeadsByStatus(Request $request)
    {
        $status = $request->get("status");
        return Lead::with('customer')->where('status', $status)->get();
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
