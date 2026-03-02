<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetGroup;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asset::with(['vessel', 'group', 'creator'])->where('company_id', Auth::user()->company->id);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('model', 'like', '%' . $request->search . '%')
                    ->orWhereHas('vessel', function ($v) use ($request) {
                        $v->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('group', function ($g) use ($request) {
                        $g->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->filled('vessel_id')) {
            $query->where('vessel_id', $request->vessel_id);
        }

        if ($request->filled('asset_group_id')) {
            $query->where('asset_group_id', $request->asset_group_id);
        }

        $assets = $query->oldest()->paginate(100)->appends($request->query());

        $vessels = Vessel::where('company_id', Auth::user()->company->id)->get();
        $groups = AssetGroup::all();

        return view('assets.index', compact('assets', 'vessels', 'groups'));
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
    public function store(Request $request)
    {
        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'asset_group_id' => 'required|exists:asset_groups,id',
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        Asset::create([
            'company_id' => Auth::user()->company->id,
            'vessel_id' => $request->vessel_id,
            'asset_group_id' => $request->asset_group_id,
            'name' => $request->name,
            'model' => $request->model,
            'qty' => $request->qty,
            'remarks' => $request->remarks,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Asset created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $assets_management)
    {
        $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'asset_group_id' => 'required|exists:asset_groups,id',
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        $assets_management->update([
            'vessel_id' => $request->vessel_id,
            'asset_group_id' => $request->asset_group_id,
            'name' => $request->name,
            'model' => $request->model,
            'qty' => $request->qty,
            'remarks' => $request->remarks,
        ]);

        return redirect()->back()->with('success', 'Asset updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);

        $asset->delete();

        return redirect()->route('assets-management.index')->with('success', 'Asset deleted successfully.');
    }
}
