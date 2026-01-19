<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCompany;

class UserCompanyController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user-company-assign.index', compact('users'));
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
