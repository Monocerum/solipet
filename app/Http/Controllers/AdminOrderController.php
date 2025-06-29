<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('order_status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    // Optional: show orders by status
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');

        $orders = Order::with(['user', 'items.product'])
            ->where('status', $status)
            ->get();

        return view('admin.orders', compact('orders', 'status'));
    }
}
