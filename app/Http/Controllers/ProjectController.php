<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Period;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $activePeriodId = session('active_period_id');

        $projects = Project::where('company_id', Auth::user()->company->id)
            ->when($activePeriodId, function ($query) use ($activePeriodId) {
                $query->where('period_id', $activePeriodId);
            })
            ->latest()
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $companyId = Auth::user()->company->id;

        $clients = Client::where('company_id', $companyId)->get();

        $activePeriodId = session('active_period_id');

        $activePeriod = null;

        if ($activePeriodId) {
            $activePeriod = Period::where('company_id', $companyId)
                ->where('id', $activePeriodId)
                ->first();
        }

        // Kalau session tidak ada atau period invalid
        if (! $activePeriod) {
            return redirect()->route('projects.index')
                ->with('error', 'Active period not set. Please create or select a period first.');
        }

        return view('projects.create', compact('clients', 'activePeriod'));
    }

    public function store(Request $request)
    {
        $companyId = Auth::user()->company->id;
        $activePeriodId = session('active_period_id');

        // Guard keras
        if (! $activePeriodId) {
            return redirect()->route('projects.index')
                ->with('error', 'Active period not set. Cannot create project.');
        }

        $activePeriod = Period::where('company_id', $companyId)
            ->where('id', $activePeriodId)
            ->first();

        if (! $activePeriod) {
            return redirect()->route('projects.index')
                ->with('error', 'Active period is invalid or no longer exists.');
        }

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|in:time_charter,freight_charter,shipping_agency',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_value' => 'nullable|numeric|min:0',
        ]);

        /**
         * Generate project number (reset per active period)
         */
        $lastNumber = Project::where('company_id', $companyId)
            ->where('period_id', $activePeriod->id)
            ->max('project_number');

        $projectNumber = $lastNumber ? $lastNumber + 1 : 1;

        Project::create([
            'company_id' => $companyId,
            'period_id' => $activePeriod->id, // 🔒 dari session
            'client_id' => $request->client_id,
            'project_number' => $projectNumber,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'contract_value' => $request->contract_value ?? 0,
            'status' => 'draft',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        // Nanti: load voyage, timesheet, dll
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorizeCompany($project);

        $activePeriodId = session('active_period_id');

        if (! $activePeriodId) {
            return redirect()->route('projects.index')
                ->with('error', 'Active period not set. Please select a period first.');
        }

        // Project HARUS di period aktif
        if ($project->period_id != $activePeriodId) {
            return redirect()->route('projects.index')
                ->with('error', 'You cannot edit a project outside the active period.');
        }

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeCompany($project);

        $activePeriodId = session('active_period_id');

        if (! $activePeriodId) {
            return redirect()->route('projects.index')
                ->with('error', 'Active period not set. Cannot update project.');
        }

        if ($project->period_id != $activePeriodId) {
            return redirect()->route('projects.index')
                ->with('error', 'You cannot update a project outside the active period.');
        }

        $request->validate([
            'type' => 'required|in:time_charter,freight_charter,shipping_agency',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,active,finished,cancelled',
        ]);

        $project->update([
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'contract_value' => $request->contract_value ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeCompany($project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeCompany(Project $project)
    {
        if ($project->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
