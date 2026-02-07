<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('Frontend.Auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'firstName' => $validated['fname'],
            'lastName' => $validated['lname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('Frontend.Auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Incorrect credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
