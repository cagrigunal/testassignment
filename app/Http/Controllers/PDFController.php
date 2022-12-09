<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePDFRequest;
use App\Http\Requests\UpdatePDFRequest;
use App\Models\PDF;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return PDF::all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePDFRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePDFRequest $request)
    {

        $request->file->storeAs('/public/uploads', strval(floor(time()-999999999)));
        $url = Storage::url('/uploads/'.strval(floor(time()-999999999)));
        $pdf = new PDF();
        $pdf->title = $request->title;
        $pdf->filePath = $url;

       return $pdf->save();


    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePDFRequest  $request
     * @param  \App\Models\PDF  $PDF
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePDFRequest $request, $id)
    {

        $item=PDF::find($id);
        if($request->file!="null") {
            $file = str_replace('/storage//','public/',$item->filePath);
            Storage::delete($file);
            $request->file->storeAs('/public/uploads', strval(floor(time() - 999999999)));
            $url = Storage::url('/uploads/' . strval(floor(time() - 999999999)));
            $item->filePath = $url;
        }

        $item->title = $request->title;


        return $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PDF  $PDF
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=PDF::find($id);
        $file = str_replace('/storage//','public/',$item->filePath);
        Storage::delete($file);
        $item->delete();

    }
}
