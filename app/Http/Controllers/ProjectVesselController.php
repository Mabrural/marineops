<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectVessel;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectVesselController extends Controller
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
        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
        ]);

        // Cegah duplicate vessel dalam 1 project
        $exists = ProjectVessel::where('project_id', $project->id)->where('vessel_id', $request->vessel_id)->exists();

        if ($exists) {
            return back()->with('error', 'Vessel already registered in this project.');
        }

        ProjectVessel::create([
            'company_id' => Auth::user()->company->id,
            'period_id' => session('active_period_id'),
            'project_id' => $project->id,
            'vessel_id' => $request->vessel_id,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Vessel successfully registered.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectVessel $projectVessel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectVessel $projectVessel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectVessel $projectVessel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, ProjectVessel $projectVessel)
    {
        if ($projectVessel->project_id !== $project->id) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid vessel for this project.',
                ],
                403,
            );
        }

        $projectVessel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vessel removed successfully.',
        ]);
    }
}
