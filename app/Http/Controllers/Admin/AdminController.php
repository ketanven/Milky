<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Show login form (redirect if already authenticated)
     */
    public function showLoginForm(Request $request)
    {
        $token = session('admin_token');
        $guard = session('admin_guard');

        if ($token && $guard) {
            try {
                // Authenticate using the correct guard
                $user = Auth::guard($guard)->setToken($token)->user();

                if ($user) {
                    return redirect()->route($guard === 'seller' ? 'admin.seller.dashboard' : 'admin.dashboard');
                }
            } catch (\Exception $e) {
                Log::info('Token validation failed: ' . $e->getMessage());
                session()->forget(['admin_token', 'admin_guard']);
            }
        }

        return view('Admin.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $guard = $request->role; // 'admin' or 'seller'

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,seller',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $token = Auth::guard($guard)->attempt($credentials);

            if (!$token) {
                return back()->with('error', 'Invalid credentials.')->withInput();
            }

            $user = Auth::guard($guard)->user();

            // Store token and guard in session
            session([
                'admin_token' => $token,
                'admin_guard' => $guard,
            ]);

            $redirectRoute = $guard === 'seller' ? route('admin.seller.dashboard') : route('admin.dashboard');

            return redirect($redirectRoute)->with('success', 'Logged in successfully!');

        } catch (\Exception $e) {
            Log::error('Login exception: ' . $e->getMessage());
            return back()->with('error', 'Login failed. Please try again.')->withInput();
        }
    }

    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();
        Log::info('Admin dashboard accessed', ['user_id' => $user->id, 'user_type' => get_class($user)]);

        return view('Admin.index');
    }

    public function profile()
    {
        // Get currently logged-in admin
        $admin = Auth::guard('admin')->user();

        return view('Admin.profile', compact('admin'));
    }

    /**
     * Seller Dashboard
     */
    public function sellerDashboard()
    {
        $user = auth()->user();
        Log::info('Seller dashboard accessed', ['user_id' => $user->id, 'user_type' => get_class($user)]);

        return view('Admin.sellerDashboard');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        try {
            $token = session('admin_token');
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }
        } catch (\Exception $e) {
            Log::error('Logout exception: ' . $e->getMessage());
        }

        session()->forget(['admin_token', 'admin_guard']);

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
