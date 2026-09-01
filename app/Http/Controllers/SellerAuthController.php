<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerAuthController extends Controller
{
    /**
     * Show the seller registration wizard.
     */
    public function showRegister()
    {
        return view('pages.seller.auth.register');
    }
}