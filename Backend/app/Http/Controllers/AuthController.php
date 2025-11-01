<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('Frontend.register');
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
    }

    public function showLoginForm()
    {
        return view('Frontend.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (Auth::attempt($validated)){
            $request->session()->regenerate();
            
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Incorrect credentials'
        ]);
    }
}