<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'product_name' => 'PetFace Buddies Noodle Cow Plush Dog Toy',
                'reviewer_name' => 'Alice',
                'review_text' => 'My dog loves this toy! Very durable and cute.',
            ],
            [
                'product_name' => 'PetFace Buddies Noodle Cow Plush Dog Toy',
                'reviewer_name' => 'Bob',
                'review_text' => 'Good quality and fast shipping. Highly recommend.',
            ],
            [
                'product_name' => 'PetFace Buddies Noodle Cow Plush Dog Toy',
                'reviewer_name' => 'Cathy',
                'review_text' => 'My puppy chews on it all day and it still looks new!',
            ],
            [
                'product_name' => 'PetFace Buddies Noodle Cow Plush Dog Toy',
                'reviewer_name' => 'David',
                'review_text' => 'Soft and safe for my small dog. Will buy again.',
            ],
            [
                'product_name' => 'Catnip Mouse Toy',
                'reviewer_name' => 'Ella',
                'review_text' => 'Perfect for my cat, she loves to play with it!',
            ],
            [
                'product_name' => 'Catnip Mouse Toy',
                'reviewer_name' => 'Frank',
                'review_text' => 'Nice product, but shipping took a bit long.',
            ],
            [
                'product_name' => 'Catnip Mouse Toy',
                'reviewer_name' => 'Grace',
                'review_text' => 'Affordable and my pets enjoy it.',
            ],
        ];

        foreach ($reviews as $review) {
            $product = DB::table('products')
                ->where('name', $review['product_name'])
                ->first();

            if (!$product) {
                continue;
            }

            DB::table('reviews')->updateOrInsert(
                [
                    'product_id' => $product->id,
                    'reviewer_name' => $review['reviewer_name'],
                ],
                [
                    'review_text' => $review['review_text'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}