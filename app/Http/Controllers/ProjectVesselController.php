<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectVessel;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
