<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user-company-assign.index', compact('users'));
    }

    public function create($id)
    {
        $user = User::findOrFail($id);
        $companies = Company::orderBy('name')->get();

        return view('user-company-assign.create', compact('user', 'companies'));
    }

    public function store(Request $request, $userId)
    {
        // Pastikan user ada
        $user = User::findOrFail($userId);

        // Validasi input
        $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
        ]);

        // Cegah user di-assign lebih dari 1 company
        $existing = UserCompany::where('user_id', $user->id)->first();

        if ($existing) {
            return redirect()->back()
                ->with('warning', 'User is already assigned to a company.');
        }

        // Simpan assignment
        UserCompany::create([
            'user_id' => $user->id,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('user-company-assign.index')
            ->with('success', 'Company assigned successfully to '.$user->name);
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        $userCompany = UserCompany::where('user_id', $user->id)->first();

        if (! $userCompany) {
            return redirect()->back()
                ->with('warning', 'User does not have any company assigned.');
        }

        $userCompany->delete();

        return redirect()->back()
            ->with('success', 'Company access removed from '.$user->name);
    }
}
