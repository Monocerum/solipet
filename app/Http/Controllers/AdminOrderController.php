<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // Update order status
    public function updateStatus(Request $request, $id)
    {
        try {
            return \DB::transaction(function () use ($request, $id) {
                $order = Order::with('items.product')->findOrFail($id);
                $oldStatus = $order->status;
                $newStatus = $request->input('order_status');
                
                // Handle stock restoration for cancelled/returned orders
                if (in_array($newStatus, ['cancelled', 'returned']) && !in_array($oldStatus, ['cancelled', 'returned'])) {
                    // Restore stock for cancelled/returned orders
                    foreach ($order->items as $item) {
                        if ($item->product) {
                            $item->product->stock += $item->quantity;
                            $item->product->save();
                        }
                    }
                }
                
                // Handle stock reduction for orders that were previously cancelled/returned but are now being processed
                if (!in_array($newStatus, ['cancelled', 'returned']) && in_array($oldStatus, ['cancelled', 'returned'])) {
                    // Reduce stock again for orders that are being reactivated
                    foreach ($order->items as $item) {
                        if ($item->product) {
                            $newStock = $item->product->stock - $item->quantity;
                            
                            // Safety check to prevent negative stock
                            if ($newStock < 0) {
                                throw new \Exception("Stock error: Cannot reduce stock below 0 for {$item->product->name}.");
                            }
                            
                            $item->product->stock = $newStock;
                            $item->product->save();
                        }
                    }
                }
                
                $order->status = $newStatus;
                $order->save();

                return redirect()->back()->with('success', 'Order status updated.');
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }

    // Delete an order
    public function destroy($id)
    {
        try {
            return \DB::transaction(function () use ($id) {
                $order = Order::with('items.product')->findOrFail($id);
                
                // Restore stock if order is being deleted and wasn't already cancelled/returned
                if (!in_array($order->status, ['cancelled', 'returned'])) {
                    foreach ($order->items as $item) {
                        if ($item->product) {
                            $item->product->stock += $item->quantity;
                            $item->product->save();
                        }
                    }
                }
                
                $order->delete();

                return redirect()->back()->with('success', 'Order deleted successfully.');
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
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
