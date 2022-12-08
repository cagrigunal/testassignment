<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('visitor');
});


Route::get('/admin', function () {
    return view('admin');
});


Route::resource('pdf', \App\Http\Controllers\PDFController::class);
Route::resource('htmlSnippet', \App\Http\Controllers\HTMLSnippetController::class);
Route::resource('link', \App\Http\Controllers\LinkController::class);
