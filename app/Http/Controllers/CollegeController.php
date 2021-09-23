<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
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

        $college = College::all();
        return view('college.index',compact('college'));
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
            'college_name' => 'required',
            'college_address' => 'required',
            'college_contact' => 'required',
            'college_email' => 'required',
            'college_status' => 'required'
        ]);
        
       
        College::create($request->all()); 
   
        return redirect()->route('college.index')
                        ->with('success','College Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show(College $college)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, College $college)
    {
        $request->validate([
            'college_name' => 'required',
            'college_address' => 'required',
            'college_contact' => 'required',
            'college_email' => 'required',
            'college_status' => 'required'
        ]);

        $college->update($request->all());
  
        return redirect()->route('college.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(College $college)
    {
        $college->delete();
        return redirect()->route('college.index')
                        ->with('delete_success','Deleted successfully');
    }
    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        College::whereIn('id',$data['delid'])->delete();
  
        return redirect()->route('College.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
    }
}
