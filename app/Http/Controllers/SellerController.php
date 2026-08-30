<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        // Note: If you didn't rename the folder to 'seller' and it is still 'selller', 
        // you will need to use 'selller.seller-dashboard' here instead.
        return view('pages.seller.seller-dashboard'); 
    }
}