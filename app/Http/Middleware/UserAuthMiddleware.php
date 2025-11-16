<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('user_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) throw new \Exception('User not found');
        } catch (\Exception $e) {
            session()->forget('user_token');
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        return $next($request);
    }
}
