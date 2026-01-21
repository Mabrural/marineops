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
        $clients = Client::where('company_id', Auth::user()->company->id)->get();
        $periods = Period::where('company_id', Auth::user()->company->id)->get();

        return view('projects.create', compact('clients', 'periods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'period_id' => 'required|exists:periods,id',
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|in:time_charter,freight_charter,shipping_agency',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_value' => 'nullable|numeric|min:0',
        ]);

        /**
         * Generate project number (reset per period)
         */
        $lastNumber = Project::where('company_id', Auth::user()->company->id)
            ->where('period_id', $request->period_id)
            ->max('project_number');

        $projectNumber = $lastNumber ? $lastNumber + 1 : 1;

        Project::create([
            'company_id' => Auth::user()->company->id,
            'period_id' => $request->period_id,
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

        $clients = Client::where('company_id', Auth::user()->company->id)->get();
        $periods = Period::where('company_id', Auth::user()->company->id)->get();

        return view('projects.edit', compact('project', 'clients', 'periods'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeCompany($project);

        $request->validate([
            'type' => 'required|in:time_charter,freight_charter,shipping_agency',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,active,finished,cancelled',
        ]);

        $project->update($request->only([
            'type',
            'start_date',
            'end_date',
            'contract_value',
            'status',
        ]));

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
