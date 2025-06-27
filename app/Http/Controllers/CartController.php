<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $quantity = $request->input('quantity', 1);

        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function viewCart()
    {
        $user = auth()->user();
        $cart = $user ? $user->cart : null;
        $items = $cart ? $cart->items()->with('product')->get() : collect();
        return view('viewCart', compact('cart', 'items'));
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $request->validate([
            'action' => 'required|in:increment,decrement',
        ]);
        $item = \App\Models\CartItem::findOrFail($itemId);
        // Ensure the item belongs to the current user's cart
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }
        if ($request->action === 'increment') {
            $item->quantity += 1;
        } elseif ($request->action === 'decrement' && $item->quantity > 1) {
            $item->quantity -= 1;
        }
        $item->save();
        return redirect()->route('viewCart');
    }

    public function removeItem($itemId)
    {
        $item = \App\Models\CartItem::findOrFail($itemId);
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }
        $item->delete();
        return redirect()->route('viewCart');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:500',
        ]);
        $user = auth()->user();
        $user->shipping_name = $request->name;
        $user->shipping_phone = $request->phone;
        $user->shipping_address = $request->address;
        $user->save();
        return redirect()->route('viewCart')->with('success', 'Shipping address updated!');
    }

    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $quantity = $request->input('quantity', 1);

        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('viewCart');
    }
}