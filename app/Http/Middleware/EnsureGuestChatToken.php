<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureGuestChatToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            return $next($request);
        }

        $cookieName = 'chat_guest_token';
        $token = $request->cookie($cookieName);

        if (!is_string($token) || strlen($token) < 32) {
            $token = hash('sha256', Str::random(64));
            $response = $next($request);

            return $response->withCookie(
                cookie($cookieName, $token, 60 * 24 * 30, null, null, true, true, false, 'Lax')
            );
        }

        return $next($request);
    }
}