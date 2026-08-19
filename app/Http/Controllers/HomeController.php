<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Product; // Uncomment once your Product model is populated

class HomeController extends Controller
{
    public function index()
    {
        // Mock data moved here temporarily until your Product DB table is populated. 
        // Once ready, replace with: $products = Product::all();
        $products = [
            ['id' => 1, 'name' => 'Wireless Noise-Canceling Earbuds', 'category' => 'Electronics', 'price' => 89.00, 'desc' => 'High-fidelity audio with deep bass', 'rating' => 5, 'reviews' => 121],
            ['id' => 2, 'name' => 'Premium Pet Carrier Backpack', 'category' => 'Pet', 'price' => 45.00, 'desc' => 'Breathable mesh, travel certified', 'rating' => 4, 'reviews' => 84],
            ['id' => 3, 'name' => 'Organic Cotton Baby Onesie', 'category' => 'Kids & Baby', 'price' => 22.00, 'desc' => 'Fairtrade certified, ultra-soft', 'rating' => 5, 'reviews' => 312],
            ['id' => 4, 'name' => 'Ceramic Minimalist Plant Pot', 'category' => 'Home & Garden', 'price' => 34.00, 'desc' => 'Matte finish with drainage hole', 'rating' => 4, 'reviews' => 56],
        ];

        return view('pages.home', compact('products'));
    }
}