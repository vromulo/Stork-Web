<?php

namespace App\Http\Controllers;

use App\Models\SellerApplication;
use App\Models\SellerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index()
    {
        $profile = SellerProfile::where('user_id', Auth::id())->first();
        $latestApp = SellerApplication::where('user_id', Auth::id())->latest('version')->first();

        return view('pages.seller.seller-dashboard', compact('profile', 'latestApp'));
    }

    public function showReapply()
    {
        $latestApp = SellerApplication::where('user_id', Auth::id())->latest('version')->first();

        // Only allow re-applying if the seller's latest application was rejected.
        if (!$latestApp || $latestApp->status !== 'rejected') {
            return redirect()->route('seller.seller-dashboard');
        }

        return view('pages.seller.auth.reapply');
    }
}