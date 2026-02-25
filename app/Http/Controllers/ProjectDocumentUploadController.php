<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocumentType;
use App\Models\ProjectDocumentUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectDocumentUploadController extends Controller
{
    public function store(Request $request, Project $project, ProjectDocumentType $documentType)
    {
        try {

            $request->validate([
                'file' => 'required|file|max:10240',
            ]);

            $file = $request->file('file');

            // cek file lama
            $existing = ProjectDocumentUpload::where([
                'project_id' => $project->id,
                'document_type_id' => $documentType->id,
            ])->first();

            if ($existing && $existing->attachment) {
                Storage::disk('public')->delete($existing->attachment);
            }

            $path = $file->store(
                'project-documents/'.$project->id,
                'public'
            );

            $upload = ProjectDocumentUpload::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'document_type_id' => $documentType->id,
                ],
                [
                    'company_id' => Auth::user()->company->id,
                    'period_id' => $project->period_id,
                    'attachment' => $path,
                    'created_by' => auth()->id(),
                ]
            );

            return response()->json([
                'success' => true,
                'file_url' => Storage::url($path),
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Project $project, ProjectDocumentType $documentType)
    {
        try {

            $upload = ProjectDocumentUpload::where([
                'project_id' => $project->id,
                'document_type_id' => $documentType->id,
            ])->first();

            if ($upload) {

                if ($upload->attachment) {
                    Storage::disk('public')->delete($upload->attachment);
                }

                $upload->delete();
            }

            return response()->json([
                'success' => true,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
