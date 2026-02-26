<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectVoyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectVoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Project $project)
    {
        if ($project->voyages()->exists()) {
            return back()->with('error', 'Voyage already exists.');
        }

        $validated = $request->validate([
            'spal_number' => 'required|string|max:255',
            'cargo_id' => 'required|exists:cargos,id',
            'loading_port_id' => 'required|exists:ports,id',
            'discharge_port_id' => 'required|exists:ports,id',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $validated['period_id'] = session('active_period_id');
        $validated['company_id'] = $project->company_id;
        $validated['created_by'] = Auth::id();

        $project->voyages()->create($validated);

        return redirect()->route('projects.show', $project->uuid)->with('success', 'Voyage added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectVoyage $projectVoyage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectVoyage $projectVoyage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, ProjectVoyage $voyage)
    {
        // Security check (multi-company safety)
        if ($voyage->project_id !== $project->id) {
            abort(403);
        }

        $validated = $request->validate([
            'spal_number' => 'required|string|max:255',
            'cargo_id' => 'required|exists:cargos,id',
            'loading_port_id' => 'required|exists:ports,id',
            'discharge_port_id' => 'required|exists:ports,id',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $voyage->update($validated);

        return redirect()->route('projects.show', $project->uuid)->with('success', 'Voyage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, ProjectVoyage $voyage)
    {
        // Pastikan voyage milik project ini
        if ($voyage->project_id !== $project->id) {
            abort(404);
        }

        $voyage->delete();

        return redirect()->route('projects.show', $project->uuid)->with('success', 'Voyage deleted successfully.');
    }
}
