<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle the initial credentials check.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        // Check credentials (removed role check since they are in the admins table)
        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our administrative records.',
            ]);
        }

        // Generate a 6-digit OTP
        $otp = (string) random_int(100000, 999999);
        
        // Save OTP to admin record
        $admin->update([
            'otp_code' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Put the user's ID and 'remember' choice in the session temporarily
        $request->session()->put('admin_auth_id', $admin->id);
        $request->session()->put('admin_auth_remember', $request->filled('remember'));

        Mail::to($admin->email)->send(new \App\Mail\AdminOtpMail($otp));

        return redirect()->route('admin.otp.form');
    }

    /**
     * Show the OTP verification form.
     */
    public function showOtpForm(Request $request)
    {
        if (! $request->session()->has('admin_auth_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.auth.otp');
    }

    /**
     * Verify the OTP and finalize authentication.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => ['required', 'numeric', 'digits:6'],
        ]);

        $AdminId = $request->session()->get('admin_auth_id');
        $admin = Admin::find($AdminId);

        if (! $admin || ! $admin->otp_expires_at || $admin->otp_expires_at->isPast() || ! Hash::check($request->code, $admin->otp_code)) {
            throw ValidationException::withMessages([
                'code' => 'The provided verification code is invalid or has expired.',
            ]);
        }

        // Clear OTP data
        $admin->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Fully log the admin in using the admin guard
        $remember = $request->session()->pull('admin_auth_remember', false);
        Auth::guard('admin')->login($admin, $remember); // Added guard('admin')

        $request->session()->forget('admin_auth_id');
        $request->session()->regenerate();

        // Redirect to admin dashboard
        return redirect()->route('admin.dashboard');
    }

    /**
     * Resend the OTP.
     */
    public function resendOtp(Request $request)
    {
        if (! $request->session()->has('admin_auth_id')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::find($request->session()->get('admin_auth_id'));
        
        $otp = (string) random_int(100000, 999999);
        $admin->update([
            'otp_code' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($admin->email)->send(new \App\Mail\AdminOtpMail($otp));

        return back()->with('status', 'A new verification code has been sent.');
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}