<?php

namespace App\Http\Controllers;

use App\CHome;
use Illuminate\Http\Request;

use App\Category;
use App\Author;
use App\Publisher;
use App\Book;
use App\Accession;
use App\News;

class CHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::take(5)->orderBy('id', 'DESC')->get();
        $categorys=Category::all();
        $authors=Author::all();
        $publishers=Publisher::all();
        $news = News::take(3)->orderBy('id', 'DESC')->get();
        return view('c_home.index',compact('book','categorys','authors','publishers','news'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CHome  $cHome
     * @return \Illuminate\Http\Response
     */
    public function show(CHome $cHome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CHome  $cHome
     * @return \Illuminate\Http\Response
     */
    public function edit(CHome $cHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CHome  $cHome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CHome $cHome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CHome  $cHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(CHome $cHome)
    {
        //
    }
}
