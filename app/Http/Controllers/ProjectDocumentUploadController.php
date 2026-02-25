<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocumentType;
use App\Models\ProjectDocumentUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectDocumentUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project, ProjectDocumentType $documentType)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB
        ]);

        $file = $request->file('file');

        $path = $file->store(
            'project-documents/' . $project->id,
            'public'
        );

        $upload = ProjectDocumentUpload::updateOrCreate(
            [
                'project_id' => $project->id,
                'document_type_id' => $documentType->id,
            ],
            [
                'company_id' => auth()->user()->company_id,
                'period_id' => $project->period_id,
                'attachment' => $path,
                'created_by' => auth()->id(),
            ]
        );

        return response()->json([
            'success' => true,
            'file_url' => Storage::url($path),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectDocumentUpload $projectDocumentUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectDocumentUpload $projectDocumentUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectDocumentUpload $projectDocumentUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectDocumentUpload $projectDocumentUpload)
    {
        //
    }
}
