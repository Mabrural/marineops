<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectDocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentTypes = ProjectDocumentType::oldest()->paginate(20);

        return view('document-types.index', compact('documentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('document-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:time_charter,freight_charter,shipping_agency',
        ]);

        ProjectDocumentType::create([
            'name' => $request->name,
            'type' => $request->type,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('document-types.index')
            ->with('success', 'Document type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectDocumentType $projectDocumentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectDocumentType $projectDocumentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectDocumentType $projectDocumentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectDocumentType $documentType)
    {
        $documentType->delete();

        return redirect()->route('document-types.index')
            ->with('success', 'Document type deleted successfully.');
    }
}
