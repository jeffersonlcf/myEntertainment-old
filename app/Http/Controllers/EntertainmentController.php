<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entertainment;
use App\Models\EntertainmentType;
use App\Models\EntertainmentDetail;
use App\Models\URL;

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
        //
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
        $classname="summary_text";
        $dom = new \DOMDocument();
        $dom->loadHTMLFile('https://www.imdb.com/title/tt0133093');
        $h1 = $dom->getElementsByTagName('h1')->item(0)->textContent;
        $title = strtok($h1,'(');

        $finder = new \DOMXPath($dom);
        $summary_text = $finder->query("//*[contains(@class, '$classname')]");
        $description = $summary_text->item(0)->nodeValue;
        preg_match('#\((.*?)\)#', $h1, $match);

        $entertainmentType = EntertainmentType::find('film');
        $entertainment = $entertainmentType->entertainments()->save(new Entertainment);

        $entertainmentDetail = new EntertainmentDetail();
        $entertainmentDetail->title = $title;
        $entertainmentDetail->description = $description;
        $entertainmentDetail->is_original = true;

        $entertainment->entertainmentDetails()->save($entertainmentDetail);

        $url = new URL();
        $url->url = 'https://www.imdb.com/title/tt0133093';

        $entertainment->urls()->save($url);
        
        return back()->with('message', 'message|Record updated.');
        //dd($title,$match[1],trim($description),$entertainment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
