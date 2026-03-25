<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
use App\Models\Vessel;
use App\Models\Client;
use App\Models\Project;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $activePeriodId = session('active_period_id');

        if(!$activePeriodId){
            // Default value (kosong) untuk menghindari error
            $totalVessels = 0;
            $totalClients = 0;
            $totalProjects = 0;
            $totalAssets = 0;
            $totalUsers = 0;

            return view('dashboard.index', compact(
                'totalVessels',
                'totalClients',
                'totalProjects',
                'totalAssets',
                'totalUsers'
            ));
        }

        // Data ringkasan jika periodenya sudah dipilih
        $totalVessels = Vessel::where('company_id', Auth::user()->company->id)->count();
        $totalClients = Client::where('company_id', Auth::user()->company->id)->count();
        $totalProjects = Project::where('company_id', Auth::user()->company->id)->count();
        $totalAssets = Asset::where('company_id', Auth::user()->company->id)->count();
        $totalUsers = User::count();

        return view('dashboard.index', compact(
            'totalVessels',
            'totalClients',
            'totalProjects',
            'totalAssets',
            'totalUsers'
        ));
    }
}
