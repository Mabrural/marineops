<?php

namespace App\Http\Controllers;

use App\Models\AssetGroup;
use Illuminate\Http\Request;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetGroup $assetGroup)
    {
        $assetGroup->delete();

        return redirect()->route('asset-groups.index')
            ->with('success', 'Asset group deleted successfully.');
    }
}
