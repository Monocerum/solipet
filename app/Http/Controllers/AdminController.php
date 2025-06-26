<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get dashboard statistics
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('is_admin', false)->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalCustomers', 'totalRevenue'));
    }

    public function orders(Request $request)
    {
        $status = $request->get('status', 'placed');
        
        $orders = Order::with(['user', 'product'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders', compact('orders', 'status'));
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function inventory()
    {
        $products = Product::all();
        return view('admin.inventory', compact('products'));
    }

    public function customers()
    {
        $customers = User::where('is_admin', false)->get();
        return view('admin.customers', compact('customers'));
    }

    public function payments()
    {
        return view('admin.payments');
    }

    public function promotions()
    {
        return view('admin.promotions');
    }
}