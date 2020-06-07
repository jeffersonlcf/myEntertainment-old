<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $results = collect();

        $url = "https://sg.media-imdb.com/suggests/".$request->q[0]."/".$request->q.".json";
        
        $jsonp = file_get_contents($url);

        //$jsonp = 'imdb$matrix({"v":1,"q":"matrix","d":[{"l":"The Matrix","id":"tt0133093","s":"Keanu Reeves, Laurence Fishburne","y":1999,"q":"feature","vt":14,"i":["https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg",2100,3156],"v":[{"l":"The Matrix","id":"vi1032782617","s":"2:26","i":["https://m.media-amazon.com/images/M/MV5BNDQ4NTRmN2ItYjgzMS00MzY3LWEwNmYtYmE2ODllZDdhNGI1XkEyXkFqcGdeQXdvbmtpbQ@@._V1_.jpg",2048,1066]},{"l":"Movie Scavenger Hunt: Can You Find These MCU Easter Eggs?","id":"vi117227033","s":"3:45","i":["https://m.media-amazon.com/images/M/MV5BMjBlMTRjODMtMDMyYi00OGQ1LWJhNzYtYTYyMTcxOWI5MGM0XkEyXkFqcGdeQW1yb2Njbw@@._V1_.jpg",1920,1080]},{"l":"The Matrix","id":"vi3203793177","s":"0:32","i":["https://m.media-amazon.com/images/M/MV5BNTExYmY4Y2EtY2E4ZC00MWYwLWFjYmUtMzg5MzdhMmZlYWIxXkEyXkFqcGdeQXVyNzU1NzE3NTg@._V1_.jpg",250,200]}]},{"l":"The Matrix 4","id":"tt10838180","s":"Keanu Reeves, Carrie-Anne Moss","y":2021,"q":"feature","vt":1,"i":["https://m.media-amazon.com/images/M/MV5BN2I5NzlmMWYtYjIwYy00Y2ZiLWI0ODgtYjAxNDZiZGJlMjlhXkEyXkFqcGdeQXVyMzk1MDQ2MQ@@._V1_.jpg",1136,757],"v":[{"l":"What We Know About The Matrix 4 ... So Far","id":"vi2412625689","s":"3:49","i":["https://m.media-amazon.com/images/M/MV5BYTA5M2UyYjMtNWIxNy00OGQ0LTg2MWQtNzUzYTZlMTNiNGFmXkEyXkFqcGdeQWxpenpp._V1_.jpg",1919,1080]}]},{"l":"The Matrix Reloaded","id":"tt0234215","s":"Keanu Reeves, Laurence Fishburne","y":2003,"q":"feature","i":["https://m.media-amazon.com/images/M/MV5BODE0MzZhZTgtYzkwYi00YmI5LThlZWYtOWRmNWE5ODk0NzMxXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg",800,1200]},{"l":"The Matrix Revolutions","id":"tt0242653","s":"Keanu Reeves, Laurence Fishburne","y":2003,"q":"feature","i":["https://m.media-amazon.com/images/M/MV5BNzNlZTZjMDctZjYwNi00NzljLWIwN2QtZWZmYmJiYzQ0MTk2XkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_.jpg",2200,3251]},{"l":"The Matrix Revisited","id":"tt0295432","s":"Lorenzo di Bonaventura, Joel Silver","y":2001,"q":"video","i":["https://m.media-amazon.com/images/M/MV5BMTIzMTA4NDI4NF5BMl5BanBnXkFtZTYwNjg5Nzg4._V1_.jpg",348,475]},{"l":"Matrix","id":"tt0106062","s":"Nick Mancuso, Phillip Jarrett","y":1993,"yr":"1993-","q":"TV series","i":["https://m.media-amazon.com/images/M/MV5BYzUzOTA5ZTMtMTdlZS00MmQ5LWFmNjEtMjE5MTczN2RjNjE3XkEyXkFqcGdeQXVyNTc2ODIyMzY@._V1_.jpg",500,708]},{"l":"Matrix","id":"tt11749868","s":"Chris Harvey","y":2020,"q":"feature","i":["https://m.media-amazon.com/images/M/MV5BNjQyNWZiM2UtOWYyYS00MmVmLWFhZGUtY2ExMDQxNDc5YTE0XkEyXkFqcGdeQXVyMTEzMjQzMDM1._V1_.jpg",1200,1600]},{"l":"Cyber Wars","id":"tt0270841","s":"Genevieve OReilly, Luoyong Wang","y":2004,"q":"feature","i":["https://m.media-amazon.com/images/M/MV5BNzU2M2E1YmEtYjk4Yi00NTNiLWE0YTItNjA1MGNmNGI3MjcxXkEyXkFqcGdeQXVyMTY5Nzc4MDY@._V1_.jpg",1707,2560]}]})';
        $jsonp_string = preg_replace("/[^(]*\((.*)\)/", "$1", $jsonp);
        $data = json_decode($jsonp_string);

        foreach ($data->d as $result){
            if(!empty($result->y)){
                $results->push([
                    'title' => $result->l,
                    'id' => $result->id,
                    'year' => $result->y,
                    'type' => $result->q === 'feature' ? 'Film' : $result->q,
                    'image' => $result->i[0],
                ]);
            }
        }

        return [
            'query' => $request->q,
            'results' => $results

        ];
    }
}
