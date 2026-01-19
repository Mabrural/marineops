<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::where('company_id', Auth::user()->company->id)
            ->latest()
            ->paginate(10); // <- penting

        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Cargo::create([
            'company_id' => Auth::user()->company->id,
            'name' => $request->name,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo created successfully.');
    }

    public function edit(Cargo $cargo)
    {
        $this->authorizeClient($cargo);

        return view('cargos.edit', compact('cargo'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $this->authorizeClient($cargo);

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $cargo->update($request->only('name'));

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo updated successfully.');
    }

    public function destroy(Cargo $cargo)
    {
        $this->authorizeClient($cargo);

        $cargo->delete();

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeClient(Cargo $cargo)
    {
        if ($cargo->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
