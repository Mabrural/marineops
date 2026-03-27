<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VesselController extends Controller
{
    public function index()
    {
        $vessels = Vessel::where('company_id', Auth::user()->company->id)
            ->oldest()
            ->paginate(100); // <- penting

        return view('vessels.index', compact('vessels'));
    }

    public function create()
    {
        return view('vessels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Vessel::create([
            'company_id' => Auth::user()->company->id,
            'name' => $request->name,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('vessels.index')
            ->with('success', 'Vessel created successfully.');
    }

    public function edit(Vessel $vessel)
    {
        $this->authorizeClient($vessel);

        return view('vessels.edit', compact('vessel'));
    }

    public function update(Request $request, Vessel $vessel)
    {
        $this->authorizeClient($vessel);

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $vessel->update($request->only('name'));

        return redirect()->route('vessels.index')
            ->with('success', 'Vessel updated successfully.');
    }

    public function destroy(Vessel $vessel)
    {
        $this->authorizeClient($vessel);

        $vessel->delete();

        return redirect()->route('vessels.index')
            ->with('success', 'Vessel deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    // protected function authorizeClient(Vessel $vessel)
    // {
    //     if ($vessel->company_id !== Auth::user()->company->id) {
    //         abort(403);
    //     }
    // }
    protected function authorizeClient(Vessel $vessel)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'User not authenticated.');
        }

        if (!$user->company) {
            abort(403, 'User has no company.');
        }

        if ((int) $vessel->company_id !== (int) $user->company->id) {
            abort(403, 'Forbidden: different company.');
        }
    }
}
