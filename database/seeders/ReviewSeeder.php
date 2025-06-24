<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'product_id' => 1,
                'reviewer_name' => 'Alice',
                'review_text' => 'My dog loves this toy! Very durable and cute.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'reviewer_name' => 'Bob',
                'review_text' => 'Good quality and fast shipping. Highly recommend.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'reviewer_name' => 'Cathy',
                'review_text' => 'My puppy chews on it all day and it still looks new!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'reviewer_name' => 'David',
                'review_text' => 'Soft and safe for my small dog. Will buy again.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'reviewer_name' => 'Ella',
                'review_text' => 'Perfect for my cat, she loves to play with it!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'reviewer_name' => 'Frank',
                'review_text' => 'Nice product, but shipping took a bit long.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'reviewer_name' => 'Grace',
                'review_text' => 'Affordable and my pets enjoy it.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
