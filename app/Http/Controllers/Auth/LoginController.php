<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Ensure 'remember' is true/false explicitly
        $request->merge(['remember' => $request->has('remember')]);

        $credentials = $request->only('email', 'password');
        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('dashboard');
        }

        return back()->withInput($request->only('email', 'remember')) // Keep inputs filled
            ->with('error', 'Invalid login credentials.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Clear session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        return redirect()->route('login');
    }
}
