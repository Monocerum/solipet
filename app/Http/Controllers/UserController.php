<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'day' => 'nullable|integer|min:1|max:31',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Handle date of birth
        if ($request->day && $request->month && $request->year) {
            $validated['dob'] = sprintf('%04d-%02d-%02d', $request->year, $request->month, $request->day);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid('profile_') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/profile_images'), $filename);
            $validated['profile_image'] = 'assets/profile_images/' . $filename;
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // at least one lowercase
                'regex:/[A-Z]/', // at least one uppercase
                'regex:/[0-9]/', // at least one digit
                'regex:/[@$!%*#?&]/', // at least one special char
                'confirmed',
            ],
        ]);
        // Check current password
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()
                ->with('password_error', 'Current password is incorrect.')
                ->with('active_section', 'password')
                ->withInput();
        }
        // Update password
        $user->password = bcrypt($request->new_password);
        $user->save();
        return back()
            ->with('password_success', 'Password updated successfully!')
            ->with('active_section', 'password');
    }

    public function showUserPage()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.product')->latest()->get();
        return view('userpage', compact('user', 'orders'));
    }

    public function pay(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart;
        if ($cart) {
            // Here you would integrate with a payment gateway and process payment
            // For now, just clear the cart to simulate a successful payment
            $cart->items()->delete();
        }
        return redirect()->route('userpage')->with('success', 'Payment successful! Your order has been placed.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'delivery_option' => 'required|string|in:shipping,pickup',
        ]);
        $user = auth()->user();
        $cart = $user->cart;
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('viewCart')->with('error', 'Your cart is empty.');
        }

        $status = 'pending'; // default for Cash on Delivery
        $shipping_address = '';

        if ($request->delivery_option === 'shipping') {
            $shipping_address = "{$user->shipping_name}\n{$user->shipping_address}\nPhone: {$user->shipping_phone}";
        } else {
            $shipping_address = "Store Pick Up\nSoliPet Main Branch\n456 Pet Street, Barangay San Pedro\nLucena City, Calabarzon 4301\nPhone: +63 917 987 6543";
        }

        if ($request->payment_method === 'Cash on Delivery') {
            $status = 'pending';
        } elseif ($request->payment_method === 'GCash') {
            $request->validate(['gcash_number' => 'nullable|string|max:20']);
            $status = 'pending';
        }

        $total = $cart->items->sum(function($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        });

        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'payment_method' => $request->payment_method,
            'status' => $status,
            'total_amount' => $total,
            'gcash_number' => $request->payment_method === 'GCash' ? $request->gcash_number : null,
            'shipping_address' => $shipping_address,
            'delivery_option' => $request->delivery_option,
        ]);

        \App\Models\Payment::create([
            'payment_number'   => uniqid('PMT-'),
            'order_id'         => $order->id,
            'user_id'          => $user->id,
            'total_amount'     => $total,
            'discount_amount'  => 0, // or compute if applicable
            'final_amount'     => $total,
            'payment_status'   => 'pending',
            'payment_method'   => $request->payment_method,
            'transaction_id'   => null, // fill in if GCash or other gateway returns it
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price ?? 0,
            ]);
        }
        $cart->items()->delete();

        $redirect = redirect()->route('userpage')->with('success', 'Order placed successfully!');

        if ($status === 'shipping' || $status === 'pending') {
             $redirect->with('active_section', 'purchase')
                      ->with('active_purchase_tab', str_replace(' ', '-', $status));
        }

        return $redirect;
    }

    public function payOrder(Request $request, \App\Models\Order $order)
    {
        if (auth()->user()->id !== $order->user_id) {
            abort(403);
        }

        $request->validate([
            'gcash_number' => 'required|string|regex:/^09\d{9}$/',
        ], [
            'gcash_number.regex' => 'Please enter a valid 11-digit GCash number starting with 09.',
        ]);

        $order->status = 'to ship';
        $order->payment_method = 'GCash';
        $order->gcash_number = $request->gcash_number;
        $order->save();

        return redirect()->route('userpage')
            ->with('success', "Payment for Order #{$order->id} successful! Your order will be shipped soon.")
            ->with('active_section', 'purchase')
            ->with('active_purchase_tab', 'to-ship');
    }
} 