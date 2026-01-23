<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrewController extends Controller
{
    public function index()
    {
        $crews = Crew::where('company_id', Auth::user()->company->id)
            ->with('vessel')
            ->latest()
            ->paginate(10); // <- penting

        return view('crews.index', compact('crews'));
    }

    public function create()
    {
        $vessels = Vessel::where('company_id', Auth::user()->company->id)
            ->orderBy('name')
            ->get();

        return view('crews.create', compact('vessels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'name' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
            'seafarer_code' => 'nullable|string|max:100',
            'seafarer_book_number' => 'nullable|string|max:100',
            'seafarer_book_expired_at' => 'nullable|date',
            'position' => 'nullable|string|max:100',
            'certificate' => 'nullable|string|max:255',
            'certificate_number' => 'nullable|string|max:100',
        ]);

        Crew::create([
            'company_id' => Auth::user()->company->id,
            'vessel_id' => $request->vessel_id,
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'nationality' => $request->nationality ?? 'Indonesia',
            'seafarer_code' => $request->seafarer_code,
            'seafarer_book_number' => $request->seafarer_book_number,
            'seafarer_book_expired_at' => $request->seafarer_book_expired_at,
            'position' => $request->position,
            'certificate' => $request->certificate,
            'certificate_number' => $request->certificate_number,
            'is_active' => true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('crews.index')
            ->with('success', 'Crew created successfully.');
    }

    public function edit(Crew $crew)
    {
        $this->authorizeClient($crew);

        $vessels = Vessel::where('company_id', Auth::user()->company->id)
            ->orderBy('name')
            ->get();

        return view('crews.edit', compact('crew', 'vessels'));
    }

    public function update(Request $request, Crew $crew)
    {
        $this->authorizeClient($crew);

        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'name' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
            'seafarer_code' => 'nullable|string|max:100',
            'seafarer_book_number' => 'nullable|string|max:100',
            'seafarer_book_expired_at' => 'nullable|date',
            'position' => 'nullable|string|max:100',
            'certificate' => 'nullable|string|max:255',
            'certificate_number' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $crew->update($request->only([
            'vessel_id',
            'name',
            'gender',
            'date_of_birth',
            'nationality',
            'seafarer_code',
            'seafarer_book_number',
            'seafarer_book_expired_at',
            'position',
            'certificate',
            'certificate_number',
            'is_active',
        ]));

        return redirect()->route('crews.index')
            ->with('success', 'Crew updated successfully.');
    }

    public function show(Crew $crew)
    {
        $this->authorizeClient($crew);

        $crew->load(['vessel', 'company', 'creator']);

        return view('crews.show', compact('crew'));
    }

    public function destroy(Crew $crew)
    {
        $this->authorizeClient($crew);

        $crew->delete();

        return redirect()->route('crews.index')
            ->with('success', 'Crew deleted successfully.');
    }

    /**
     * Simple company ownership check
     */
    protected function authorizeClient(Crew $crew)
    {
        if ($crew->company_id !== Auth::user()->company->id) {
            abort(403);
        }
    }
}
