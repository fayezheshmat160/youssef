<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Session::put('user_id', $user->id);

        return redirect()->route('login.form'); // or wherever
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();


        if ($user && Hash::check($request->password, $user->password)) {

          //  Session::put('user_id', $user->id);
            return redirect()->route('student.index');
            //return view("student.student");
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout() {
        //Session::forget('user_id');
        return redirect()->route('login.form');
    }
}
