<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = \App\Models\Product::where('title', 'LIKE', "%$query%")->get();

        return view('search.results', compact('results', 'query'));
    }
}
