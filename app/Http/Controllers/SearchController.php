<?php

namespace App\Http\Controllers;

use App\Classes\Search\Imdb;
use App\Film;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        
        $imdb = new Imdb($request);

        return [
            'query' => $request->q,
            'results' => $imdb->getResults(),

        ];
    }
}
