<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $author = Author::all();
        return view('author.index',compact('author'));
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
        $request->validate([
            'author_name' => 'required',
            'author_status' => 'required'
        ]);
        
       
        Author::create($request->all()); 
   
        return redirect()->route('author.index')
                        ->with('success','Author Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'author_name' => 'required',
            'author_status' => 'required'
        ]);

        $author->update($request->all());
  
        return redirect()->route('author.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('author.index')
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        Author::whereIn('id',$data['delid'])->delete();
  
        return redirect()->route('author.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
    }
}
