<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.buyer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegister()
    {
        return view('pages.buyer.auth.register');
    }

    public function register(Request $request)
    {
        // Custom Error Messages for a better user experience
        $messages = [
            'birthday.before_or_equal' => 'You must be at least 18 years old to register.',
        ];

        // Validation rules updated for spaces in names and 11-digit contact numbers
        $request->validate([
            'first_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'middle_initial' => 'nullable|alpha|max:1',
            'sex' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users',
            'contact_no' => 'required|string|size:11',
            'birthday' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'password' => 'required|min:8' 
        ], $messages);

        // Data is formatted for consistent capitalization before saving
        User::create([
            'first_name' => ucwords(strtolower($request->first_name)),
            'last_name' => ucwords(strtolower($request->last_name)),
            'middle_initial' => strtoupper($request->middle_initial),
            'sex' => $request->sex,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'birthday' => $request->birthday,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}