<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($attributes)) {
            return back()
                ->withErrors(['password' => 'The provided credentials do not match our records.'])
                ->withInput();
        }
        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'Welcome Back!');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
