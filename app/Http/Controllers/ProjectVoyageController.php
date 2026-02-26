<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectVoyage;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, ProjectVoyage $projectVoyage)
    {
        //
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
