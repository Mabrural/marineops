<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortController extends Controller
{
    public function index()
    {
        $ports = Port::where('company_id', Auth::user()->company->id)
            ->latest()
            ->paginate(10); // <- penting

        return view('ports.index', compact('ports'));
    }

    public function create()
    {
        return view('ports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Port::create([
            'company_id' => Auth::user()->company->id,
            'name' => $request->name,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('ports.index')
            ->with('success', 'Port created successfully.');
    }

    public function edit(Port $port)
    {
        $this->authorizeClient($port);

        return view('ports.edit', compact('port'));
    }

    public function update(Request $request, Port $port)
    {
        $this->authorizeClient($port);

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $port->update($request->only('name'));

        return redirect()->route('ports.index')
            ->with('success', 'Port updated successfully.');
    }

    public function destroy(Port $port)
    {
        $this->authorizeClient($port);

        $port->delete();

        return redirect()->route('ports.index')
            ->with('success', 'Port deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeClient(Port $port)
    {
        if ($port->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
