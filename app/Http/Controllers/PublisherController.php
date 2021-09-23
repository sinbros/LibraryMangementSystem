<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
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
        $publisher = Publisher::all();
        return view('publisher.index',compact('publisher'));
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
            'publisher_name' => 'required',
            'publisher_status' => 'required'
        ]);
        
       
        Publisher::create($request->all()); 
   
        return redirect()->route('publisher.index')
                        ->with('success','Publisher Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'publisher_name' => 'required',
            'publisher_status' => 'required'
        ]);

        $publisher->update($request->all());
  
        return redirect()->route('publisher.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('publisher.index')
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        Publisher::whereIn('id',$data['delid'])->delete();
  
        return redirect()->route('publisher.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
    }
}
