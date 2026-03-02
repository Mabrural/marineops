<?php

namespace App\Http\Controllers;

use App\Models\AssetGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetGroups = AssetGroup::orderBy('id')->get();

        return view('asset-groups.index', compact('assetGroups'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:asset_groups,name',
        ]);

        AssetGroup::create([
            'name' => $validated['name'],
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('asset-groups.index')->with('success', 'Asset group created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetGroup $assetGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetGroup $assetGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetGroup $assetGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:asset_groups,name,' . $assetGroup->id,
        ]);

        $assetGroup->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('asset-groups.index')->with('success', 'Asset group updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetGroup $assetGroup)
    {
        $assetGroup->delete();

        return redirect()->route('asset-groups.index')->with('success', 'Asset group deleted successfully.');
    }
}
