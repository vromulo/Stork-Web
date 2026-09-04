<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        // View for individual product details
        return view('pages.buyer.product-show', compact('product'));
    }
}