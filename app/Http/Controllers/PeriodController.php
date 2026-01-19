<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::where('company_id', Auth::user()->company->id)
            ->latest()
            ->paginate(10); // <- penting

        return view('periods.index', compact('periods'));
    }

    public function create()
    {
        return view('periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Period::create([
            'company_id' => Auth::user()->company->id,
            'name' => $request->name,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('periods.index')
            ->with('success', 'Period created successfully.');
    }

    public function edit(Period $period)
    {
        $this->authorizeClient($period);

        return view('periods.edit', compact('period'));
    }

    public function update(Request $request, Period $period)
    {
        $this->authorizeClient($period);

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $period->update($request->only('name'));

        return redirect()->route('periods.index')
            ->with('success', 'Period updated successfully.');
    }

    public function destroy(Period $period)
    {
        $this->authorizeClient($period);

        $period->delete();

        return redirect()->route('periods.index')
            ->with('success', 'Period deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeClient(Period $period)
    {
        if ($period->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
