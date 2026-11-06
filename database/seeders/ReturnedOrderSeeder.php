<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ReturnedOrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Find the demo customer.
            $user = DB::table('users')
                ->where('email', 'customer@solipet.demo')
                ->first();

            if (!$user) {
                throw new RuntimeException(
                    'Demo customer account was not found. Run DemoAccountsSeeder first.'
                );
            }

            // Get three available products.
            $products = DB::table('products')
                ->orderBy('id')
                ->limit(3)
                ->get();

            if ($products->count() < 3) {
                throw new RuntimeException(
                    'At least three products are required to seed returned orders.'
                );
            }

            // First returned order.
            $orderNumber1 = 'DEMO-RETURNED-0001';

            DB::table('orders')->updateOrInsert(
                ['order_number' => $orderNumber1],
                [
                    'user_id' => $user->id,
                    'payment_method' => 'GCash',
                    'status' => 'returned',
                    'total_amount' => 849.97,
                    'gcash_number' => '09123456789',
                    'shipping_address' => '123 Test Street, Test City, Test Province',
                    'delivery_option' => 'shipping',
                    'created_at' => now()->subDays(5),
                    'updated_at' => now()->subDays(2),
                ]
            );

            $order1 = DB::table('orders')
                ->where('order_number', $orderNumber1)
                ->first();

            DB::table('order_items')
                ->where('order_id', $order1->id)
                ->delete();

            foreach ($products as $index => $product) {
                DB::table('order_items')->insert([
                    'order_id' => $order1->id,
                    'product_id' => $product->id,
                    'quantity' => $index + 1,
                    'price' => $product->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Second returned order.
            $orderNumber2 = 'DEMO-RETURNED-0002';

            $firstProduct = $products->first();

            DB::table('orders')->updateOrInsert(
                ['order_number' => $orderNumber2],
                [
                    'user_id' => $user->id,
                    'payment_method' => 'Cash on Delivery',
                    'status' => 'returned',
                    'total_amount' => 199.99,
                    'shipping_address' => '456 Another Street, Another City, Another Province',
                    'delivery_option' => 'pickup',
                    'created_at' => now()->subDays(10),
                    'updated_at' => now()->subDays(7),
                ]
            );

            $order2 = DB::table('orders')
                ->where('order_number', $orderNumber2)
                ->first();

            DB::table('order_items')
                ->where('order_id', $order2->id)
                ->delete();

            DB::table('order_items')->insert([
                'order_id' => $order2->id,
                'product_id' => $firstProduct->id,
                'quantity' => 1,
                'price' => $firstProduct->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
