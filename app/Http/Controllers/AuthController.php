<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {

        if (!Auth::attempt($request->validate([
            'email' => 'required|email|string',
            'password' => 'required|min:6|max:10'
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        } else {
            $request->session()->regenerate();
            return redirect()->intended('/listing')->with('success', 'Login success!');
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
}
