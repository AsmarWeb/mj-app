<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::with([
            'shop',
            'listing',
            'user',
        ])
        ->latest()
        ->paginate(20);

        return view('admin.leads.index', compact('leads'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $lead->load([
            'shop',
            'listing',
            'user',
        ]);

        return view('admin.leads.show', compact('lead'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}
