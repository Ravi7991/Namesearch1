<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('username', $credentials['username'])->first();

        // Check if user exists and is active
        if (!$user || !$user->is_active) {
            return back()->withErrors([
                'username' => 'Invalid credentials or account is inactive.',
            ]);
        }

        // Check for too many failed login attempts
        if ($user->failed_login_attempts >= 5) {
            $lastAttempt = $user->last_login_attempt;
            $now = Carbon::now();
            
            // If last attempt was less than 30 minutes ago, block login
            if ($lastAttempt && $lastAttempt->diffInMinutes($now) < 30) {
                return back()->withErrors([
                    'username' => 'Account temporarily locked due to too many failed login attempts. Please try again later.',
                ]);
            } else {
                // Reset counter after 30 minutes
                $user->failed_login_attempts = 0;
                $user->save();
            }
        }

        // Attempt login
        if (Auth::attempt($credentials)) {
            // Reset failed attempts counter on successful login
            $user->failed_login_attempts = 0;
            $user->last_login_attempt = Carbon::now();
            $user->save();
            
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Increment failed attempts counter
        $user->failed_login_attempts += 1;
        $user->last_login_attempt = Carbon::now();
        $user->save();

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'user', // Default role
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
