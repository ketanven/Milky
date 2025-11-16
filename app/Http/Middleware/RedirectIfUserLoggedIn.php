<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RedirectIfUserLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('user_token');

        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate();
                if ($user) return redirect()->route('home');
            } catch (\Exception $e) {
                session()->forget('user_token');
            }
        }

        return $next($request);
    }
}
