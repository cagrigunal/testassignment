<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Termwind\Components\Li;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Link::all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLinkRequest $request)
    {
        $link = new Link();
        $link->title = $request->title;
        $link->link = $request->link;
        $link->newTab = $request->newTab;

        return $link->save();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLinkRequest  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLinkRequest $request, $id)
    {
        $item=Link::find($id);


        $item->title = $request->title;
        $item->link = $request->link;
        $item->newTab = $request->newTab;


        return $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Link::find($id);
        $item->delete();
    }
}
