<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // Show orders list with status filter
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');

        $orders = Order::with(['user', 'items.product'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders', compact('orders', 'status'));
    }

    // Show single order details
    public function show(Order $order)
    {
        try {
            // Load relationships
            $order->load([
                'user', 
                'items.product', 
                'items.product.images'
            ]);

            // Calculate order statistics
            $orderStats = [
                'total_items' => $order->items->sum('quantity'),
                'total_amount' => $order->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
                'shipping_cost' => $order->delivery_option === 'delivery' ? 50 : 0,
                'tax_amount' => 0,
            ];

            $orderStats['grand_total'] = $orderStats['total_amount'] + $orderStats['shipping_cost'] + $orderStats['tax_amount'];

            // Status progression for timeline
            $statusProgression = [
                'pending' => ['label' => 'Order Pending', 'icon' => 'clock', 'completed' => false],
                'placed' => ['label' => 'Order Placed', 'icon' => 'check-circle', 'completed' => false],
                'preparing' => ['label' => 'Preparing Order', 'icon' => 'package', 'completed' => false],
                'shipping' => ['label' => 'Shipped', 'icon' => 'truck', 'completed' => false],
                'delivered' => ['label' => 'Delivered', 'icon' => 'home', 'completed' => false],
            ];

            // Mark completed statuses
            $statusOrder = ['pending', 'placed', 'preparing', 'shipping', 'delivered'];
            $currentStatusIndex = array_search($order->status, $statusOrder);
            
            if ($currentStatusIndex !== false) {
                for ($i = 0; $i <= $currentStatusIndex; $i++) {
                    if (isset($statusProgression[$statusOrder[$i]])) {
                        $statusProgression[$statusOrder[$i]]['completed'] = true;
                    }
                }
            }

            // Handle special statuses
            if (in_array($order->status, ['cancelled', 'returned'])) {
                $statusProgression = [
                    $order->status => [
                        'label' => ucfirst($order->status),
                        'icon' => $order->status === 'cancelled' ? 'x-circle' : 'arrow-left',
                        'completed' => true
                    ]
                ];
            }

            return view('admin.orders.show', compact('order', 'orderStats', 'statusProgression'));

        } catch (\Exception $e) {
            return redirect()->route('admin.orders')->with('error', 'Order not found.');
        }
    }

    // Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,placed,preparing,shipping,delivered,cancelled,returned'
        ]);

        $order->status = $request->input('order_status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete order.');
        }
    }
}
?>