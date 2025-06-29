<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'image' => 'assets/sample-product.jpg',
            'name' => 'PetFace Buddies Noodle Cow Plush Dog Toy',
            'price' => 499.99,
            'ratings' => 4.8,
            'rating_text' => '1,234 SOLD',
            'savings' => 'Save 20%! PHP 599.99',
            'features' => json_encode([
                'Fun, Farmyard-Themed plush dog toy',
                'Rope cord legs help clean teeth',
                'Durable with built-in squeaker',
                'Promotes healthy gums',
                'Soft and safe for pets'
            ]),
            'description' => 'The PetFace Buddies Noodle Cow Plush Dog Toy is a fun, Farmyard-Themed plush dog Toy with rope cord legs. The rope can also help to clean your pups teeth, reducing plaque build up and promoting healthy gums. Durable with a built in squeaker for long lasting interactive fun.',
            'material' => 'Outer: 100% Polyester. Filling: 100% Polyester. Squeaker: 100% EVA. Rope: 85% cotton + 15% polyester.',
            'dimensions' => 'L: 20 cm x W: 3 cm x H: 3 cm',
            'care_instructions' => 'Pets should be supervised when playing with toys. This toy is strong but not indestructible and will eventually become susceptible to chew damage. Examine regularly for wear and replace if any damage could represent a health hazard.',
            'category' => 'Dog Toy',
            'pet_type' => 'Dog',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'image' => 'assets/sample-product2.jpg',
            'name' => 'Catnip Mouse Toy',
            'price' => 199.99,
            'ratings' => 4.5,
            'rating_text' => '800 SOLD',
            'savings' => 'Save 15%! PHP 235.29',
            'features' => json_encode([
                'Filled with premium catnip',
                'Soft plush exterior',
                'Perfect for batting and pouncing',
                'Safe for all cats',
                'Lightweight and durable'
            ]),
            'description' => 'This Catnip Mouse Toy will keep your cat entertained for hours. Made with soft plush and filled with premium catnip.',
            'material' => 'Plush, Catnip',
            'dimensions' => 'L: 10 cm x W: 4 cm x H: 3 cm',
            'care_instructions' => 'Spot clean with mild soap and water. Replace if torn or damaged.',
            'category' => 'Cat Toy',
            'pet_type' => 'Cat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'image' => 'assets/sample-product3.jpg',
            'name' => 'Adjustable Dog Harness',
            'price' => 349.99,
            'ratings' => 4.7,
            'rating_text' => '950 SOLD',
            'savings' => 'Save 10%! PHP 389.99',
            'features' => json_encode([
                'Breathable mesh material',
                'Reflective strips for safety',
                'Adjustable straps for perfect fit',
                'Easy to put on and take off',
                'Available in multiple sizes'
            ]),
            'description' => 'This Adjustable Dog Harness is designed for comfort and safety. Made with breathable mesh and reflective strips for nighttime walks.',
            'material' => 'Nylon, Mesh',
            'dimensions' => 'S, M, L, XL',
            'care_instructions' => 'Hand wash with mild detergent. Air dry.',
            'category' => 'Dog Accessory',
            'pet_type' => 'Dog',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'image' => 'assets/sample-product4.jpg',
            'name' => 'Interactive Cat Feather Wand',
            'price' => 129.99,
            'ratings' => 4.6,
            'rating_text' => '1,100 SOLD',
            'savings' => 'Save 5%! PHP 136.84',
            'features' => json_encode([
                'Flexible wand for interactive play',
                'Colorful feathers attract cats',
                'Durable and safe materials',
                'Encourages exercise',
                'Lightweight design'
            ]),
            'description' => 'Keep your cat active and entertained with this Interactive Cat Feather Wand. Perfect for bonding and exercise.',
            'material' => 'Plastic, Feathers',
            'dimensions' => 'L: 45 cm',
            'care_instructions' => 'Supervise play. Replace if damaged.',
            'category' => 'Cat Toy',
            'pet_type' => 'Cat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'image' => 'assets/sample-product5.jpg',
            'name' => 'Pet Stainless Steel Food Bowl',
            'price' => 159.99,
            'ratings' => 4.9,
            'rating_text' => '2,000 SOLD',
            'savings' => 'Save 12%! PHP 181.81',
            'features' => json_encode([
                'Non-slip rubber base',
                'Rust-resistant stainless steel',
                'Easy to clean',
                'Suitable for food and water',
                'Dishwasher safe'
            ]),
            'description' => 'Durable and hygienic, this Pet Stainless Steel Food Bowl is perfect for both food and water. Non-slip base prevents spills.',
            'material' => 'Stainless Steel, Rubber',
            'dimensions' => 'Diameter: 16 cm, Height: 5 cm',
            'care_instructions' => 'Dishwasher safe. Wash regularly.',
            'category' => 'Pet Feeding',
            'pet_type' => 'Dog, Cat, Small Pet',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

