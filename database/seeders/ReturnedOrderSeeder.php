<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class ReturnedOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user and products
        $user = User::first();
        $products = Product::take(3)->get();

        if (!$user || $products->isEmpty()) {
            return;
        }

        // Create a returned order
        $returnedOrder = Order::create([
            'user_id' => $user->id,
            'payment_method' => 'GCash',
            'status' => 'returned',
            'total_amount' => 849.97,
            'gcash_number' => '09123456789',
            'shipping_address' => '123 Test Street, Test City, Test Province',
            'delivery_option' => 'shipping',
            'order_number' => 'ORD0001',
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(2),
        ]);

        // Add order items
        foreach ($products as $index => $product) {
            OrderItem::create([
                'order_id' => $returnedOrder->id,
                'product_id' => $product->id,
                'quantity' => $index + 1,
                'price' => $product->price,
            ]);
        }

        // Create another returned order
        $returnedOrder2 = Order::create([
            'user_id' => $user->id,
            'payment_method' => 'Cash on Delivery',
            'status' => 'returned',
            'total_amount' => 199.99,
            'shipping_address' => '456 Another Street, Another City, Another Province',
            'delivery_option' => 'pickup',
            'order_number' => 'ORD0002',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(7),
        ]);

        // Add order items for second order
        OrderItem::create([
            'order_id' => $returnedOrder2->id,
            'product_id' => $products->first()->id,
            'quantity' => 1,
            'price' => $products->first()->price,
        ]);
    }
} 