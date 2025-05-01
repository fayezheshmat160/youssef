<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the register form
    public function showRegister()
    {
        return view('student.auth.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Automatically log in the user

        return redirect()->route('student.index'); // Redirect to dashboard
    }

    // Show the login form
    public function showLogin()
    {
        return view('student.auth.login');
    }

    // Handle login
    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Explicitly log the user in using 'web' guard
            Auth::guard('web')->login($user);

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            \Log::info('Login success for user: ' . $request->email);

            return redirect()->route('student.index');
        }

        \Log::warning('Login failed for email: ' . $request->email);

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();        // Invalidate the session
        $request->session()->regenerateToken();   // Regenerate CSRF token

        return redirect()->route('login.form');
    }
}
