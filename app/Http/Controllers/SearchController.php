<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class SearchController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');
    $pet = $request->input('pet');
    $sort = $request->input('sort');

    // Example query builder (assuming you use Eloquent)
    $results = Product::query();

    if ($query) {
        $results->where('title', 'LIKE', "%$query%");
    }

    if ($pet) {
        $pet = strtolower($pet);
        switch ($pet) {
            case 'cat':
            case 'cats':
                $pet = 'cat';
                break;
            case 'dog':
            case 'dogs':
                $pet = 'dog';
                break;
            case 'small_animal':
                $pet = 'small pet';
                break;
            default:
                // leave as is or handle unknown types
                break;
        }
        $results->where('pet_type', 'LIKE', "%$pet%"); // adjust column name as needed
    }

    if ($sort) {
        if ($sort == 'newest') {
            $results->orderBy('created_at', 'desc');
        } elseif ($sort == 'rating_desc') {
            $results->orderBy('ratings', 'desc');
        } elseif ($sort == 'price_asc') {
            $results->orderBy('price', 'asc');
        }
    }

    return view('search.results', [
        'query' => $query,
        'results' => $results->get(),
    ]);
}

}
