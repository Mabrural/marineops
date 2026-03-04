<?php

namespace App\Http\Controllers;

use App\Models\Amprahan;
use App\Models\Company;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmprahanController extends Controller
{
    public function index(Request $request)
    {
        $query = Amprahan::with(['company', 'vessel', 'creator'])->where('company_id', Auth::user()->company->id);

        // ======================
        // SEARCH
        // ======================
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('item', 'like', '%' . $request->search . '%')
                    ->orWhere('vendor_name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('vessel', function ($v) use ($request) {
                        $v->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('company', function ($c) use ($request) {
                        $c->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // ======================
        // FILTER
        // ======================
        if ($request->filled('vessel_id')) {
            $query->where('vessel_id', $request->vessel_id);
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $amprahans = $query->latest()->paginate(10)->appends($request->query());

        // ======================
        // DATA UNTUK FILTER DROPDOWN
        // ======================
        $vessels = Vessel::where('company_id', Auth::user()->company->id)->get();

        return view('amprahans.index', compact('amprahans', 'vessels'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'supply_date' => 'required|date',
            'item' => 'required|string|max:255',
            'specification' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'vendor_name' => 'nullable|string|max:255',
            'unit_price' => 'nullable|numeric|min:0',
        ]);

        $total = 0;

        if ($request->unit_price) {
            $total = $request->qty * $request->unit_price;
        }

        Amprahan::create([
            'company_id' => Auth::user()->company->id,
            'vessel_id' => $request->vessel_id,
            'supply_date' => $request->supply_date,
            'item' => $request->item,
            'specification' => $request->specification,
            'qty' => $request->qty,
            'unit' => $request->unit,
            'vendor_name' => $request->vendor_name,
            'unit_price' => $request->unit_price,
            'total_price' => $total,
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('amprahans.index', $request->only(['current_search', 'current_vessel_id', 'current_page']))
            ->with('success', 'Amprahan created successfully.');
    }

    public function edit(Amprahan $amprahan)
    {
        $companies = Company::all();
        $vessels = Vessel::all();

        return view('amprahans.edit', compact('amprahan', 'companies', 'vessels'));
    }

    public function update(Request $request, Amprahan $amprahan)
    {
        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'supply_date' => 'required|date',
            'item' => 'required|string|max:255',
            'specification' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'vendor_name' => 'nullable|string|max:255',
            'unit_price' => 'nullable|numeric|min:0',
        ]);

        $total = 0;

        if ($request->unit_price) {
            $total = $request->qty * $request->unit_price;
        }

        $amprahan->update([
            'vessel_id' => $request->vessel_id,
            'supply_date' => $request->supply_date,
            'item' => $request->item,
            'specification' => $request->specification,
            'qty' => $request->qty,
            'unit' => $request->unit,
            'vendor_name' => $request->vendor_name,
            'unit_price' => $request->unit_price,
            'total_price' => $total,
        ]);

        return redirect()->route('amprahans.index')->with('success', 'Amprahan updated successfully.');
    }

    public function destroy(Amprahan $amprahan)
    {
        $amprahan->delete();

        return redirect()->route('amprahans.index')->with('success', 'Data amprahan berhasil dihapus.');
    }
}
