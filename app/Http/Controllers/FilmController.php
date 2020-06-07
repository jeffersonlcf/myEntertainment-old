<?php

namespace App\Http\Controllers;

use App\Film;
use App\Classes\Search\Imdb;
use Illuminate\Http\Request;


class FilmController extends Controller
{
    public function show(Film $film)
    {
        return view('films.show', ['film' => $film]);
    }

    public function store_from_search(Request $request)
    {
        $imdb = new Imdb($request);
       
        $data = $imdb->getResults()->first();
        
        $film = Film::updateOrCreate(
            ['imdb_id' => $data->id],
            ['title' => $data->title, 'year' => $data->year, 'type' => 1]
        );

        return redirect()->route('film.show', ['film' => $film->id]);

    }

    public function get_information_from_page($url = null)
    {
        $url = 'https://www.imdb.com/title/tt0133093';

        $dom = new \DOMDocument();
        $dom->loadHTMLFile($url);
        $finder = new \DOMXPath($dom);

        $jsonScripts = $finder->query( '//script[@type="application/ld+json"]' );
        $json = trim( $jsonScripts->item(0)->nodeValue );

        $data = json_decode(str_replace('@t', 't', $json));
        $image = str_replace('.jpg', 'UX182_CR0,0,182,268_AL_.jpg', $data->image);

        return $data;
    }
}
