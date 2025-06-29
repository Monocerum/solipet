<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        $reviews = $product->reviews()->get();
        return view('itempage', compact('product', 'reviews'));
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string|max:1000',
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'reviewer_name' => $request->reviewer_name,
            'review_text' => $request->review_text,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
