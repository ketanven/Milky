<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Show Register Page
    public function showRegister(Request $request)
    {
        $token = session('user_token');

        Log::info('Accessing register page', ['token_exists' => $token ? true : false]);

        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate();
                if ($user) {
                    Log::info('User already logged in, redirecting to home', ['user_id' => $user->id]);
                    return redirect()->route('home');
                }
            } catch (\Exception $e) {
                Log::warning('JWT token invalid or expired', ['error' => $e->getMessage()]);
                session()->forget('user_token');
            }
        }

        return view('register');
    }

    // Handle Registration
    public function storeRegister(Request $request)
    {
        Log::info('Register request received', ['request' => $request->except(['password', 'password_confirmation'])]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address_line' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pin_code' => 'nullable|string|max:10',
            'password' => 'required|min:6|confirmed',
        ]);

        $profilePath = $request->hasFile('profile_image')
            ? $request->file('profile_image')->store('profiles', 'public')
            : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'profile_image' => $profilePath,
            'password' => Hash::make($request->password),
            'is_active' => 1,
        ]);

        Log::info('New user created', ['user_id' => $user->id]);

        // Generate JWT token
        $token = JWTAuth::fromUser($user);
        Log::info('JWT token generated for user', ['user_id' => $user->id, 'token' => $token]);

        // Store token in session
        session(['user_token' => $token]);

        Log::info('User token stored in session', ['user_id' => $user->id]);

        return redirect()->route('home')->with('success', 'Welcome to Milkly! Your account has been created.');
    }


    public function showLogin(Request $request)
    {
        $token = session('user_token');
        Log::info('Accessing login page', ['token_exists' => $token ? true : false]);

        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate();
                if ($user) {
                    Log::info('User already logged in, redirecting to home', ['user_id' => $user->id]);
                    return redirect()->route('home');
                }
            } catch (\Exception $e) {
                Log::warning('Invalid or expired JWT token', ['error' => $e->getMessage()]);
                session()->forget('user_token');
            }
        }

        return view('login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        Log::info('Login request received', ['email' => $request->email]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
        }

        // Generate JWT token
        $token = JWTAuth::fromUser($user);
        Log::info('JWT token generated on login', ['user_id' => $user->id, 'token' => $token]);

        // Store in session
        session(['user_token' => $token]);
        Log::info('User JWT stored in session', ['user_id' => $user->id]);

        return redirect()->route('home')->with('success', 'Welcome back, ' . $user->name . '!');
    }

    // Logout
    public function logout(Request $request)
    {
        try {
            $token = session('user_token');
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
                Log::info('User logged out and JWT token invalidated', ['token' => $token]);
            }
        } catch (\Exception $e) {
            Log::error('Logout error', ['error' => $e->getMessage()]);
        }

        session()->forget('user_token');
        Log::info('User session cleared');

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
