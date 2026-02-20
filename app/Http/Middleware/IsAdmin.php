<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        if (Auth::user()->admin == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized access. Admin privileges required.');
    }
}
