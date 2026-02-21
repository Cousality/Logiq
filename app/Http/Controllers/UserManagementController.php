<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        $users = $query->paginate(20)->appends($request->except('page'));

        return view('Frontend.dashboard.user_management', compact('users'));
    }
}
