<?php

namespace App\Http\Controllers;

use App\Models\AssetMaintenanceLog;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;

class AssetMaintenanceLogController extends Controller
{

    public function getByAsset(Asset $asset)
    {
        $logs = $asset->maintenanceLogs()->latest()->get();

        return response()->json($logs);
    }

    public function ajaxStore(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'type' => 'required|in:routine,repair,inspection',
        ]);

        $log = AssetMaintenanceLog::create([
            'company_id' => Auth::user()->company->id,
            'asset_id' => $request->asset_id,
            'maintenance_date' => $request->maintenance_date,
            'type' => $request->type,
            'description' => $request->description,
            'performed_by' => $request->performed_by,
            'cost' => $request->cost ?? 0,
            'result_status' => $request->result_status,
            'estimate_next_maintenance' => $request->estimate_next_maintenance,
            'created_by' => Auth::id(),
        ]);

        return response()->json(['success' => true]);
    }

    public function ajaxUpdate(Request $request, AssetMaintenanceLog $log)
    {
        $request->validate([
            'type' => 'required|in:routine,repair,inspection',
        ]);

        $log->update($request->all());

        return response()->json(['success' => true]);
    }

    public function ajaxDelete(AssetMaintenanceLog $log)
    {
        $log->delete();

        return response()->json(['success' => true]);
    }
}
