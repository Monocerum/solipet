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
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        // Check if product is in stock
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        // Check if requested quantity is available
        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Requested quantity exceeds available stock. Only ' . $product->stock . ' items available.');
        }

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();
        if ($cartItem) {
            // Check if adding the new quantity would exceed stock
            if (($cartItem->quantity + $quantity) > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more items. Only ' . $product->stock . ' items available in total.');
            }
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
            'quantity' => 'required|integer|min:1',
        ]);
        
        $item = \App\Models\CartItem::findOrFail($itemId);
        
        // Ensure the item belongs to the current user's cart
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if requested quantity exceeds available stock
        $product = $item->product;
        if ($request->quantity > $product->stock) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Requested quantity exceeds available stock. Only ' . $product->stock . ' items available.'], 422);
            }
            return redirect()->route('viewCart')->with('error', 'Requested quantity exceeds available stock. Only ' . $product->stock . ' items available.');
        }

        $item->quantity = $request->quantity;
        $item->save();
        
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'quantity' => $item->quantity]);
        }
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
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        // Check if product is in stock
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        // Check if requested quantity is available
        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Requested quantity exceeds available stock. Only ' . $product->stock . ' items available.');
        }

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();
        if ($cartItem) {
            // Check if adding the new quantity would exceed stock
            if (($cartItem->quantity + $quantity) > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more items. Only ' . $product->stock . ' items available in total.');
            }
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