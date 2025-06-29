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

    $results = Product::query();

    if ($query) {
        $results->where('name', 'LIKE', "%$query%");
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
                break;
        }
        $results->where('pet_type', 'LIKE', "%$pet%");
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
