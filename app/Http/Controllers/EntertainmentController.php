<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entertainment;
use App\Models\EntertainmentType;
use App\Models\EntertainmentDetail;
use App\Models\URL;
use App\Models\Poster;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EntertainmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.entertainment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        libxml_use_internal_errors(true);
        $url = strtolower($request->input('url'));
        $path = parse_url($url,PHP_URL_PATH);
        $host = parse_url($url,PHP_URL_HOST);
        if (!(in_array('title',explode('/',$path)) && in_array('imdb',explode('.',$host)))){
            return back()->with('error', trans('entertainment.invalidUrl'));
        }
        $data = URL::where('path',$path)->get();
        if (!$data->isEmpty()){
            return back()->with('error', trans('entertainment.alreadyExists'));
        }
        
        $dom = new \DOMDocument();
        $dom->loadHTMLFile($url);
        $h1 = $dom->getElementsByTagName('h1')->item(0)->textContent;
        $title = substr($h1,0,strpos($h1,'(')-2);

        $finder = new \DOMXPath($dom);
        $summary_text = $finder->query("//*[contains(@class, 'summary_text')]");
        $poster_img = $dom->getElementsByTagName('img')->item(4)->getAttribute('src');
        $description = $summary_text->item(0)->textContent;
        preg_match('#\((.*?)\)#', $h1, $year);

        $entertainmentType = EntertainmentType::find('film');
        $entertainment = $entertainmentType->entertainments()->save(new Entertainment);

        $entertainmentDetail = new EntertainmentDetail();
        $entertainmentDetail->title = $title;
        $entertainmentDetail->description = trim($description);
        $entertainmentDetail->is_original = true;

        $entertainment->entertainmentDetails()->save($entertainmentDetail);

        $url = new URL();
        $url->url = $request->input('url');
        $url->host = $host;
        $url->path = $path;

        $entertainment->urls()->save($url);

        $poster = new Poster();
        $poster->data = base64_encode(file_get_contents($poster_img));

        $entertainment->poster()->save($poster);
        
        return back()->with('success', trans('entertainment.filmSaved'));
        //dd($title,$year[1],trim($description),$entertainment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Entertainment $entertainment)
    {
        return view('pages.entertainment.show', compact('entertainment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entertainment $entertainment)
    {
        //
    }

    private function getUser(Entertainment $entertainment){

        $user = Auth::user();

        if(!$user->entertainments->contains($entertainment)){
            $user->entertainments()->attach($entertainment);
        }

    }

    public function seen(Entertainment $entertainment)
    {
        $user = Auth::user();

        if(!$user->entertainments->contains($entertainment)){
            $user->entertainments()->attach($entertainment);
        }

        $entertainment_user = $user->entertainments()->find($entertainment->id);

        if (empty($entertainment_user->pivot->seen)) {
            $user->entertainments()->updateExistingPivot($entertainment,['seen' => now()]);
        } else {
            $user->entertainments()->updateExistingPivot($entertainment,['seen' => null]);
        }
    }

    public function search()
    {
        return view('pages.entertainment.search');
    }

    public function search_results(Request $request)
    {
        $exp = '%'.$request->query('q').'%';
        $results = EntertainmentDetail::where('title', 'like' , $exp)
        ->with('entertainment.poster:entertainment_id,data')
        ->get();
        return view('pages.entertainment.search', compact('results'));
    }
}
