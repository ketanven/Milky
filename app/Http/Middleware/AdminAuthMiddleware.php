<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Get token and guard from session
        $token = session('admin_token');
        $guard = session('admin_guard');

        if (!$token || !$guard) {
            return redirect()->route('admin.login')->with('error', 'Please login to continue.');
        }

        try {
            $user = null;

            // Authenticate based on guard
            if ($guard === 'admin') {
                $user = Auth::guard('admin')->setToken($token)->user();
            } elseif ($guard === 'seller') {
                $user = Auth::guard('seller')->setToken($token)->user();
            }

            // If token invalid or expired
            if (!$user) {
                session()->forget(['admin_token', 'admin_guard']);
                return redirect()->route('admin.login')->with('error', 'Invalid or expired session. Please login again.');
            }

            // ✅ Set the active guard
            auth()->shouldUse($guard);

            // Add user info to request
            $request->merge([
                'auth_user' => $user,
                'auth_guard' => $guard
            ]);

            // Optional: restrict sellers from certain routes
            if ($guard === 'seller') {
                $allowedRoutesForSeller = [
                    'admin.dashboard',
                    'admin.seller.dashboard',
                    'admin.products.*',
                    'admin.categories.*',
                    'admin.orders.*',
                    'admin.profile',
                ];

                $currentRoute = $request->route()->getName();

                $isAllowed = false;
                foreach ($allowedRoutesForSeller as $routePattern) {
                    if (fnmatch($routePattern, $currentRoute)) {
                        $isAllowed = true;
                        break;
                    }
                }

                if (!$isAllowed) {
                    return redirect()->route('admin.seller.dashboard')->with('error', 'Access denied.');
                }
            }

        } catch (\Exception $e) {
            Log::error('AdminAuthMiddleware error: ' . $e->getMessage());
            session()->forget(['admin_token', 'admin_guard']);
            return redirect()->route('admin.login')->with('error', 'Session expired. Please login again.');
        }

        return $next($request);
    }
}
