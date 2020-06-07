<?php

namespace App\Classes\Search;

class Imdb 
{
    public $request;
    public $url;
    public $data;

    public function __construct($request) {
        $this->request = $request;
        $this->imdbUrl = $this->getImdbUrl();
        $this->data = $this->getData();
    }

    public function getResults()
    {
        $results = collect();

        if (!empty($this->data->d)) {
            foreach ($this->data->d as $item){
                if(!empty($item->y)){

                    $url = route('film.search.store',['q' => $item->id]);

                    $result = new Results();
                    $result->id = $item->id;
                    $result->title = $item->l;
                    $result->year = $item->y;
                    $result->type = $item->q === 'feature' ? 'Film' : $item->q;
                    $result->image = $this->getImage($item);
                    $result->setShowUrl($url);
                    $results->push($result);
                }
            }
        }

        return $results;
    }
    

    private function getData()
    {
        //$json = '{"d":[{"i":{"height":400,"imageUrl":"https://m.media-amazon.com/images/M/MV5BNTczMzk1MjU1MV5BMl5BanBnXkFtZTcwNDk2MzAyMg@@._V1_.jpg","width":276},"id":"nm0000226","l":"Will Smith (I)","rank":157,"s":"Music Department, The Fresh Prince of Bel-Air (1990-1996)","v":[{"i":{"height":720,"imageUrl":"https://m.media-amazon.com/images/M/MV5BN2RjMjcwZmItMTU4Yy00YjJiLTkwNTctYzgxMGFiZDM5ZDE3XkEyXkFqcGdeQW1yb2Njbw@@._V1_.jpg","width":1280},"id":"vi1574353433","l":"Take Five With Megan Fox","s":"2:41"},{"i":{"height":1080,"imageUrl":"https://m.media-amazon.com/images/M/MV5BNWZlM2Q0YjEtZjljNy00ZjgwLTg4MzAtZWFkOTQwNjhkMGZlXkEyXkFqcGdeQXRyYW5zY29kZS13b3JrZmxvdw@@._V1_.jpg","width":1920},"id":"vi1502854681","l":"All New Episodes","s":"0:31"},{"i":{"height":720,"imageUrl":"https://m.media-amazon.com/images/M/MV5BZGVlZmQxNTctOGRhMi00ZTZjLTliYmMtYTliOWMxZGRjMDIwXkEyXkFqcGdeQWFybm8@._V1_.jpg","width":1280},"id":"vi285195801","l":"Which Roles Did Will Smith Turn Down?","s":"2:27"}],"vt":132},{"i":{"height":400,"imageUrl":"https://m.media-amazon.com/images/M/MV5BMTMxMDIzMDEzNF5BMl5BanBnXkFtZTcwODcxMjE2Mg@@._V1_.jpg","width":276},"id":"nm0002071","l":"Will Ferrell (I)","rank":431,"s":"Producer, Talladega Nights: The Ballad of Ricky Bobby (2006)","v":[{"i":{"height":1080,"imageUrl":"https://m.media-amazon.com/images/M/MV5BZTMzOTg5YmMtNDE1MC00YjJlLTlhMmQtYjg2MDEzY2MyMTBlXkEyXkFqcGdeQXRyYW5zY29kZS13b3JrZmxvdw@@._V1_.jpg","width":1920},"id":"vi2572533529","l":"Why Julia Louis-Dreyfus F***ing Produced -Force Majeure- Remake -Downhill-","s":"2:56"},{"i":{"height":1080,"imageUrl":"https://m.media-amazon.com/images/M/MV5BMmUyMTYzNWItNmIwMS00ZTVkLWJmZTgtZGQ3MzJhOWFhOWQxXkEyXkFqcGdeQXRyYW5zY29kZS13b3JrZmxvdw@@._V1_.jpg","width":1920},"id":"vi542883609","l":"UK Trailer","s":"1:58"},{"i":{"height":864,"imageUrl":"https://m.media-amazon.com/images/M/MV5BNDBiMGIzMWMtZjA2NC00NGIyLTk0ZmEtNmNmZGNlY2JjZjY1XkEyXkFqcGdeQWRvb2xpbmhk._V1_.jpg","width":1536},"id":"vi667074073","l":"First Look","s":"1:21"}],"vt":152},{"i":{"height":1500,"imageUrl":"https://m.media-amazon.com/images/M/MV5BOTI0MzcxMTYtZDVkMy00NjY1LTgyMTYtZmUxN2M3NmQ2NWJhXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg","width":983},"id":"tt0119217","l":"Good Will Hunting","q":"feature","rank":552,"s":"Robin Williams, Matt Damon","y":1997},{"i":{"height":755,"imageUrl":"https://m.media-amazon.com/images/M/MV5BMjAxODQ4MDU5NV5BMl5BanBnXkFtZTcwMDU4MjU1MQ@@._V1_.jpg","width":510},"id":"tt0469494","l":"There Will Be Blood","q":"feature","rank":705,"s":"Daniel Day-Lewis, Paul Dano","y":2007},{"i":{"height":626,"imageUrl":"https://m.media-amazon.com/images/M/MV5BNTI0OTRkZDAtMWE2Ny00ZTc3LWE0OWItMmRiMGU3NzU2ZWUwXkEyXkFqcGdeQXVyODUxOTU0OTg@._V1_.jpg","width":424},"id":"tt0157246","l":"Will & Grace","q":"TV series","rank":1032,"s":"Eric McCormack, Debra Messing","y":1998,"yr":"1998-2020"},{"i":{"height":2048,"imageUrl":"https://m.media-amazon.com/images/M/MV5BODE5ODkwNTg4Nl5BMl5BanBnXkFtZTcwODcwMTY1OQ@@._V1_.jpg","width":1560},"id":"nm0287182","l":"Will Forte","rank":1035,"s":"Actor, Nebraska (2013)"},{"i":{"height":1753,"imageUrl":"https://m.media-amazon.com/images/M/MV5BMTQ4NTc5Njk4Nl5BMl5BanBnXkFtZTgwMjQxNjgyMjE@._V1_.jpg","width":1315},"id":"nm2401020","l":"Will Poulter (I)","rank":1717,"s":"Actor, The Maze Runner (2014)"},{"i":{"height":2048,"imageUrl":"https://m.media-amazon.com/images/M/MV5BNDkzMjEzNDMyN15BMl5BanBnXkFtZTcwNTk3ODEyOQ@@._V1_.jpg","width":1558},"id":"nm0004715","l":"Will Arnett","rank":1839,"s":"Actor, The Lego Batman Movie (2017)"}],"q":"will","v":1}';
        $json = file_get_contents($this->imdbUrl);
        return json_decode($json);
    }

    private function getImdbUrl()
    {

        $string = $this->clean($this->request->q);

        return "https://v2.sg.media-imdb.com/suggestion/".$string[0]."/".$string.".json";

    }

    private function clean($string) {
        $string = str_replace(' ', '_', $string); // Replaces all spaces with underscore.
        $string = strtolower($string);
        return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
    }

    private function getImage($item)
    {
        $image = '';
        if(!empty($item->i)){
            $image = $item->i->imageUrl;
        }
        return $image;
    }
    
}


