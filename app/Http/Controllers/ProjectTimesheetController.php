<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTimesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectTimesheetController extends Controller
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
        $validated = $request->validate([
            'datetime' => 'required|date',
            'position' => 'required|string|max:50',
            'status' => 'required|string|max:255',
        ]);

        // Ambil period dari session
        $periodId = session('active_period_id');

        if (!$periodId) {
            return back()->with('error', 'No active period selected.');
        }

        $validated['project_id'] = $project->id;
        $validated['company_id'] = $project->company_id;
        $validated['period_id'] = $periodId;
        $validated['created_by'] = Auth::id();

        ProjectTimesheet::create($validated);

        return redirect()->route('projects.show', $project->uuid)->with('success', 'Timesheet added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectTimesheet $projectTimesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectTimesheet $projectTimesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, ProjectTimesheet $timesheet)
    {
        // Security check
        if ($timesheet->project_id !== $project->id || $timesheet->company_id !== $project->company_id) {
            abort(403);
        }

        $validated = $request->validate([
            'datetime' => 'required|date',
            'position' => 'required|string|max:50',
            'status' => 'required|string|max:255',
        ]);

        // Pastikan period tetap dari session
        $periodId = session('active_period_id');

        if (!$periodId || $periodId != $timesheet->period_id) {
            return back()->with('error', 'You cannot edit timesheet from different period.');
        }

        $timesheet->update($validated);

        return redirect()->route('projects.show', $project->uuid)->with('success', 'Timesheet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, ProjectTimesheet $timesheet)
    {
        if ($timesheet->project_id !== $project->id) {
            abort(403);
        }

        $timesheet->delete();

        return redirect()->route('projects.show', $project->uuid)->with('success', 'Timesheet deleted successfully.');
    }

    public function exportPdf(Project $project)
    {
        $periodId = session('active_period_id');

        if (!$periodId) {
            abort(403, 'Period not selected.');
        }

        $project->load(['voyages.loadingPort', 'voyages.dischargePort']);

        $timesheets = $project->timesheets()->where('period_id', $periodId)->orderBy('datetime')->get();

        $pdf = Pdf::loadView('pdf.project-timesheet', [
            'project' => $project,
            'timesheets' => $timesheets,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('project-timesheet-' . substr($project->uuid, -5) . '.pdf');
    }
}
