<?php

namespace App\Http\Controllers;

use App\Accession;
use Illuminate\Http\Request;

class AccessionController extends Controller
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
        $request->validate([
            'accession_no' => 'required|unique:accessions',
            'book_id' => 'required'
        ]);
        
       
        Accession::create($request->all()); 
   
        return redirect()->back()
                        ->with('success','Qty Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accession  $accession
     * @return \Illuminate\Http\Response
     */
    public function show(Accession $accession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accession  $accession
     * @return \Illuminate\Http\Response
     */
    public function edit(Accession $accession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accession  $accession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accession $accession)
    {
         $request->validate([
            'accession_no' => 'required|unique:accessions,accession_no,'.$accession->id,
            'book_id' => 'required'
        ]);

        $accession->update($request->all());
  
        return redirect()->back()
                        ->with('success','Qty Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accession  $accession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accession $accession)
    {
        $accession->delete();
        return redirect()->back()
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        Accession::whereIn('id',$data['delid'])->delete();
  
        return redirect()->back()
                        ->with('delete_success','Multiple Data Deleted successfully');
    }
}
