<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('company_id', Auth::user()->company->id)
            ->latest()
            ->paginate(10); // <- penting

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string',
        ]);

        Client::create([
            'company_id' => Auth::user()->company->id,
            'name' => $request->name,
            'address' => $request->address,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $this->authorizeClient($client);

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorizeClient($client);

        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string',
        ]);

        $client->update($request->only('name', 'address'));

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->authorizeClient($client);

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeClient(Client $client)
    {
        if ($client->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
