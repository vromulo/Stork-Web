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
            // --- WOMEN (5 Products) ---
            [
                'name' => 'Floral Summer Dress',
                'category' => 'Women',
                'price' => 45.00,
                'desc' => 'Lightweight and breathable floral dress perfect for warm weather outings.',
                'rating' => 5,
                'reviews' => 24
            ],
            [
                'name' => 'Classic White Blouse',
                'category' => 'Women',
                'price' => 32.50,
                'desc' => 'Versatile button-down blouse suitable for office wear and casual days.',
                'rating' => 4,
                'reviews' => 18
            ],
            [
                'name' => 'High-Waist Yoga Pants',
                'category' => 'Women',
                'price' => 28.00,
                'desc' => 'Stretchy, moisture-wicking activewear designed for maximum comfort.',
                'rating' => 5,
                'reviews' => 41
            ],
            [
                'name' => 'Silk Sleepwear Set',
                'category' => 'Women',
                'price' => 50.00,
                'desc' => 'Luxurious soft silk pajama set for a restful night of sleep.',
                'rating' => 4,
                'reviews' => 12
            ],
            [
                'name' => 'Tailored Trench Coat',
                'category' => 'Women',
                'price' => 89.99,
                'desc' => 'Chic outer layer featuring a classic belt and double-breasted buttons.',
                'rating' => 5,
                'reviews' => 30
            ],

            // --- MEN (5 Products) ---
            [
                'name' => 'Slim Fit Blazer',
                'category' => 'Men',
                'price' => 75.00,
                'desc' => 'Sharp, modern blazer tailored for formal events and business casual.',
                'rating' => 5,
                'reviews' => 19
            ],
            [
                'name' => 'Casual Oxford Shirt',
                'category' => 'Men',
                'price' => 35.00,
                'desc' => 'Timeless button-down shirt made from durable cotton fabric.',
                'rating' => 4,
                'reviews' => 27
            ],
            [
                'name' => 'Waterproof Windbreaker',
                'category' => 'Men',
                'price' => 60.00,
                'desc' => 'Lightweight jacket designed to shield you from unexpected weather shifts.',
                'rating' => 5,
                'reviews' => 15
            ],
            [
                'name' => 'Performance Training Shorts',
                'category' => 'Men',
                'price' => 24.99,
                'desc' => 'Flexible fitness shorts with deep pockets and breathable mesh panels.',
                'rating' => 4,
                'reviews' => 33
            ],
            [
                'name' => 'Leather Casual Boots',
                'category' => 'Men',
                'price' => 95.00,
                'desc' => 'Sturdy, comfortable leather boots built for daily urban wear.',
                'rating' => 5,
                'reviews' => 50
            ],

            // --- KIDS (5 Products) ---
            [
                'name' => 'Organic Cotton Romper',
                'category' => 'Kids',
                'price' => 18.00,
                'desc' => 'Super soft and gentle on sensitive baby skin with easy snap buttons.',
                'rating' => 5,
                'reviews' => 22
            ],
            [
                'name' => 'Interactive Building Blocks',
                'category' => 'Kids',
                'price' => 29.99,
                'desc' => 'Colorful stacking blocks that encourage creative problem-solving and motor skills.',
                'rating' => 5,
                'reviews' => 64
            ],
            [
                'name' => 'Plush Animal Toy',
                'category' => 'Kids',
                'price' => 15.00,
                'desc' => 'Cuddly, hypoallergenic stuffed animal companion for nap times.',
                'rating' => 4,
                'reviews' => 11
            ],
            [
                'name' => 'Toddler Walking Shoes',
                'category' => 'Kids',
                'price' => 25.00,
                'desc' => 'Flexible, lightweight footwear designed to support early steps safely.',
                'rating' => 5,
                'reviews' => 16
            ],
            [
                'name' => 'Illustrated Story Book',
                'category' => 'Kids',
                'price' => 12.50,
                'desc' => 'Engaging bedtime storybook filled with vibrant, captivating illustrations.',
                'rating' => 4,
                'reviews' => 8
            ],

            // --- HOME & GARDEN (5 Products) ---
            [
                'name' => 'Stainless Steel Blender',
                'category' => 'Home & Garden',
                'price' => 65.00,
                'desc' => 'High-powered kitchen blender for smoothies, soups, and food prep.',
                'rating' => 5,
                'reviews' => 38
            ],
            [
                'name' => 'Ceramic Planter Pot',
                'category' => 'Home & Garden',
                'price' => 22.00,
                'desc' => 'Minimalist decorative pot with a drainage hole for indoor house plants.',
                'rating' => 4,
                'reviews' => 14
            ],
            [
                'name' => 'Ergonomic Gardening Trowel',
                'category' => 'Home & Garden',
                'price' => 14.99,
                'desc' => 'Rust-resistant hand tool with a comfortable grip handle for planting.',
                'rating' => 5,
                'reviews' => 25
            ],
            [
                'name' => 'Scented Soy Wax Candle',
                'category' => 'Home & Garden',
                'price' => 19.50,
                'desc' => 'Long-burning clean candle infused with relaxing lavender and vanilla notes.',
                'rating' => 5,
                'reviews' => 47
            ],
            [
                'name' => 'Woven Storage Basket',
                'category' => 'Home & Garden',
                'price' => 34.00,
                'desc' => 'Sturdy natural fiber basket to keep your living space neat and organized.',
                'rating' => 4,
                'reviews' => 19
            ],

            // --- HEALTH & BEAUTY (5 Products) ---
            [
                'name' => 'Hydrating Facial Serum',
                'category' => 'Health & Beauty',
                'price' => 28.00,
                'desc' => 'Nourishing formula packed with hyaluronic acid for deep skin moisture.',
                'rating' => 5,
                'reviews' => 72
            ],
            [
                'name' => 'Argan Oil Hair Mask',
                'category' => 'Health & Beauty',
                'price' => 24.00,
                'desc' => 'Deep conditioning treatment to repair split ends and restore shine.',
                'rating' => 5,
                'reviews' => 53
            ],
            [
                'name' => 'Matte Lipstick Collection',
                'category' => 'Health & Beauty',
                'price' => 20.00,
                'desc' => 'Long-lasting, smudge-proof rich color that keeps lips feeling soft.',
                'rating' => 4,
                'reviews' => 29
            ],
            [
                'name' => 'Ionic Hair Dryer',
                'category' => 'Health & Beauty',
                'price' => 49.99,
                'desc' => 'Fast-drying professional blow dryer designed to reduce frizz and heat damage.',
                'rating' => 5,
                'reviews' => 44
            ],
            [
                'name' => 'Multivitamin Supplement',
                'category' => 'Health & Beauty',
                'price' => 22.50,
                'desc' => 'Daily essential nutrient capsules to support overall wellness and energy.',
                'rating' => 4,
                'reviews' => 31
            ],
        ];

        return view('pages.buyer.home', compact('products'));
    }
}