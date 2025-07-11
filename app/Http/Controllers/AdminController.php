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
        $this->middleware('admin');
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
        $status = $request->get('status', 'pending');
        $orders = Order::with(['user', 'items.product'])
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
    
    // Product CRUD Functions
    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // Customer Management Functions
    public function showCustomer($id)
    {
        $customer = User::where('is_admin', false)->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    public function editCustomer($id)
    {
        $customer = User::where('is_admin', false)->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = User::where('is_admin', false)->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $customer->id,
            'email' => 'required|email|max:255|unique:users,email,' . $customer->id,
            'phonenumber' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers')
            ->with('success', 'Customer details updated successfully!');
    }

    public function deleteCustomer($id)
    {
        $customer = User::where('is_admin', false)->findOrFail($id);
        
        // Check if customer has orders - prevent deletion if they do
        if ($customer->orders()->count() > 0) {
            return redirect()->route('admin.customers')
                ->with('error', 'Cannot delete customer with existing orders.');
        }

        $customer->delete();

        return redirect()->route('admin.customers')
            ->with('success', 'Customer deleted successfully!');
    }
}