<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup () {
        return view('auth.signup');
    }

    public function register (Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
    }

    public function login () {
        return view('auth.login');
    }

    public function authentication (Request $request) {
        $credential = $request->only('email', 'password');
        
        if (Auth::attempt($credential)) {
            return redirect('/students');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    public function logout () {
        Auth::logout();
        return redirect()->route('dashboard');
    }
}
