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
        $companies = Company::all();
        $vessels = Vessel::all();

        return view('amprahans.create', compact('companies', 'vessels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'vessel_id' => 'required|exists:vessels,id',
            'supply_date' => 'required|date',
            'item' => 'required|string',
            'qty' => 'required|integer',
            'unit' => 'required|string',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // Auto hitung total_price jika unit_price diisi
        if ($request->unit_price) {
            $data['total_price'] = $request->qty * $request->unit_price;
        }

        Amprahan::create($data);

        return redirect()->route('amprahans.index')->with('success', 'Data amprahan berhasil ditambahkan.');
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
            'company_id' => 'required|exists:companies,id',
            'vessel_id' => 'required|exists:vessels,id',
            'supply_date' => 'required|date',
            'item' => 'required|string',
            'qty' => 'required|integer',
            'unit' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->unit_price) {
            $data['total_price'] = $request->qty * $request->unit_price;
        }

        $amprahan->update($data);

        return redirect()->route('amprahans.index')->with('success', 'Data amprahan berhasil diupdate.');
    }

    public function destroy(Amprahan $amprahan)
    {
        $amprahan->delete();

        return redirect()->route('amprahans.index')->with('success', 'Data amprahan berhasil dihapus.');
    }
}
