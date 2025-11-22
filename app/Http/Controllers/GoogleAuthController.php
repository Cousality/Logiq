<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

class GoogleAuthController extends Controller
{
    
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    
    public function callback()
    {
        try {
            
            $user = Socialite::driver('google')->user();
            $raw = $user->user ?? [];

            // keys from Google are given_name and family_name
            $firstname = $raw['given_name']  ?? $user->getName();
            $lastname  = $raw['family_name'] ?? '';
            
        } catch (Throwable $e) {
            return redirect('/')->with('error', 'Google authentication failed.');
        }

       
        $existingUser = User::where('email', $user->email)->first();
        
  
        if ($existingUser) {
           
            Auth::login($existingUser);
        } else {
            
            $newUser = User::updateOrCreate([
            
                'email' => $user->email
            ], [
                'firstName' => $firstname,
                'lastName' => $lastname,
                'password' => Hash::make(Str::random(16)),
              
            ]);
            Auth::login($newUser);
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect('dashboard');
    }
}