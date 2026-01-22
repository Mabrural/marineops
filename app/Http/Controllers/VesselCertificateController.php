<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use App\Models\VesselCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VesselCertificateController extends Controller
{
    public function index()
    {
        $certificates = VesselCertificate::where('company_id', Auth::user()->company->id)
            ->with('vessel')
            ->latest()
            ->paginate(10); // <- penting

        return view('vessel_certificates.index', compact('certificates'));
    }

    public function create()
    {
        $vessels = Vessel::where('company_id', Auth::user()->company->id)
            ->orderBy('name')
            ->get();

        return view('vessel_certificates.create', compact('vessels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vessel_id'        => 'required|exists:vessels,id',
            'name'             => 'required|string|max:100',
            'issue_date'       => 'required|date',
            'expiry_date'      => 'required|date|after_or_equal:issue_date',
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('certificate_file')) {
            $filePath = $request->file('certificate_file')
                ->store('vessel-certificates', 'public');
        }

        VesselCertificate::create([
            'company_id'       => Auth::user()->company->id,
            'vessel_id'        => $request->vessel_id,
            'name'             => $request->name,
            'issue_date'       => $request->issue_date,
            'expiry_date'      => $request->expiry_date,
            'certificate_file' => $filePath,
            'created_by'       => Auth::id(),
        ]);

        return redirect()->route('vessel-certificates.index')
            ->with('success', 'Vessel certificate created successfully.');
    }

    public function edit(VesselCertificate $vesselCertificate)
    {
        $this->authorizeCompany($vesselCertificate);

        $vessels = Vessel::where('company_id', Auth::user()->company->id)
            ->orderBy('name')
            ->get();

        return view('vessel_certificates.edit', compact('vesselCertificate', 'vessels'));
    }

    public function update(Request $request, VesselCertificate $vesselCertificate)
    {
        $this->authorizeCompany($vesselCertificate);

        $request->validate([
            'vessel_id'        => 'required|exists:vessels,id',
            'name'             => 'required|string|max:100',
            'issue_date'       => 'required|date',
            'expiry_date'      => 'required|date|after_or_equal:issue_date',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'vessel_id',
            'name',
            'issue_date',
            'expiry_date',
        ]);

        if ($request->hasFile('certificate_file')) {
            // delete old file
            if ($vesselCertificate->certificate_file) {
                Storage::disk('public')->delete($vesselCertificate->certificate_file);
            }

            $data['certificate_file'] = $request->file('certificate_file')
                ->store('vessel-certificates', 'public');
        }

        $vesselCertificate->update($data);

        return redirect()->route('vessel-certificates.index')
            ->with('success', 'Vessel certificate updated successfully.');
    }

    public function destroy(VesselCertificate $vesselCertificate)
    {
        $this->authorizeCompany($vesselCertificate);

        if ($vesselCertificate->certificate_file) {
            Storage::disk('public')->delete($vesselCertificate->certificate_file);
        }

        $vesselCertificate->delete();

        return redirect()->route('vessel-certificates.index')
            ->with('success', 'Vessel certificate deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeCompany(VesselCertificate $vesselCertificate)
    {
        if ($vesselCertificate->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
