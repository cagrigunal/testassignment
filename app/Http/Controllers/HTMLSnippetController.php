<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHTMLSnippetRequest;
use App\Http\Requests\UpdateHTMLSnippetRequest;
use App\Models\HTMLSnippet;

class HTMLSnippetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HTMLSnippet::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHTMLSnippetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHTMLSnippetRequest $request)
    {
        $html = new HTMLSnippet();
        $html->title = $request->title;
        $html->description = $request->description;
        $html->html = $request->html;

        return $html->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HTMLSnippet  $hTMLSnippet
     * @return \Illuminate\Http\Response
     */
    public function show(HTMLSnippet $hTMLSnippet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HTMLSnippet  $hTMLSnippet
     * @return \Illuminate\Http\Response
     */
    public function edit(HTMLSnippet $hTMLSnippet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHTMLSnippetRequest  $request
     * @param  \App\Models\HTMLSnippet  $hTMLSnippet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHTMLSnippetRequest $request, $id)
    {
        $item=HTMLSnippet::find($id);


        $item->title = $request->title;
        $item->description = $request->description;
        $item->html = $request->html;


        return $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HTMLSnippet  $hTMLSnippet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=HTMLSnippet::find($id);

        $item->delete();
    }
}
