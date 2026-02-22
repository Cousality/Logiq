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

    public function makeAdmin($id)
    {
        $user = User::where('userID', $id)->firstOrFail();

        $user->update(['admin' => true]);

        return back()->with('success', "{$user->firstName} {$user->lastName} has been granted Admin privileges.");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', "User {$user->email} has been deleted.");
    }
}
