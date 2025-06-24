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
            'title' => 'PetFace Buddies Noodle Cow Plush Dog Toy',
            'price' => 499.99,
            'stars' => 4.8,
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'image' => 'assets/sample-product2.jpg',
            'title' => 'Catnip Mouse Toy',
            'price' => 199.99,
            'stars' => 4.5,
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
