<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index()
    {
        // Fetch products from the database
        $products = Product::where('stock_quantity', '>', 0)
            ->latest()
            ->get();

        return view('pages.buyer.home', compact('products'));
    }
}