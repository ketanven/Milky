<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SellerAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('admin_token');   // Same session used for sellers
        $guard = session('admin_guard');   // This should be 'seller'

        if (!$token || $guard !== 'seller') {
            return redirect()->route('admin.login')->with('error', 'Please login as a seller to continue.');
        }

        try {
            $user = Auth::guard('seller')->setToken($token)->user();

            if (!$user) {
                session()->forget(['admin_token', 'admin_guard']);
                return redirect()->route('admin.login')->with('error', 'Invalid or expired session. Please login again.');
            }

            auth()->shouldUse('seller'); // Set guard to seller
            $request->merge(['auth_user' => $user, 'auth_guard' => 'seller']);

        } catch (\Exception $e) {
            Log::error('SellerAuthMiddleware error: ' . $e->getMessage());
            session()->forget(['admin_token', 'admin_guard']);
            return redirect()->route('admin.login')->with('error', 'Session expired. Please login again.');
        }

        return $next($request);
    }
}
