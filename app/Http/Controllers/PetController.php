<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PetController extends Controller
{
    public function showByType($pet_type)
    {
        // You can filter pets by type from your database
        $pets = Product::where('category', $pet_type)->get();

        return view('petpage', [
            'pet_type' => $pet_type,
            'pets' => $pets
        ]);
    }
}
