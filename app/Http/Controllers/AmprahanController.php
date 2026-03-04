<?php

namespace App\Http\Controllers;

use App\Models\Amprahan;
use App\Models\Company;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmprahanController extends Controller
{
    public function index()
    {
        $amprahans = Amprahan::with(['company', 'vessel', 'creator'])
            ->latest()
            ->paginate(10);

        return view('amprahan.index', compact('amprahans'));
    }

    public function create()
    {
        $companies = Company::all();
        $vessels = Vessel::all();

        return view('amprahan.create', compact('companies', 'vessels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id'   => 'required|exists:companies,id',
            'vessel_id'    => 'required|exists:vessels,id',
            'supply_date'  => 'required|date',
            'item'         => 'required|string',
            'qty'          => 'required|integer',
            'unit'         => 'required|string',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // Auto hitung total_price jika unit_price diisi
        if ($request->unit_price) {
            $data['total_price'] = $request->qty * $request->unit_price;
        }

        Amprahan::create($data);

        return redirect()->route('amprahans.index')
            ->with('success', 'Data amprahan berhasil ditambahkan.');
    }

    public function edit(Amprahan $amprahan)
    {
        $companies = Company::all();
        $vessels = Vessel::all();

        return view('amprahan.edit', compact('amprahan', 'companies', 'vessels'));
    }

    public function update(Request $request, Amprahan $amprahan)
    {
        $request->validate([
            'company_id'   => 'required|exists:companies,id',
            'vessel_id'    => 'required|exists:vessels,id',
            'supply_date'  => 'required|date',
            'item'         => 'required|string',
            'qty'          => 'required|integer',
            'unit'         => 'required|string',
        ]);

        $data = $request->all();

        if ($request->unit_price) {
            $data['total_price'] = $request->qty * $request->unit_price;
        }

        $amprahan->update($data);

        return redirect()->route('amprahans.index')
            ->with('success', 'Data amprahan berhasil diupdate.');
    }

    public function destroy(Amprahan $amprahan)
    {
        $amprahan->delete();

        return redirect()->route('amprahans.index')
            ->with('success', 'Data amprahan berhasil dihapus.');
    }
}