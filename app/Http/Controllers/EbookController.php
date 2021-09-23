<?php

namespace App\Http\Controllers;

use App\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebook = Ebook::all();
        return view('ebook.index',compact('ebook'));
    }

    public function indexClient()
    {
        $ebook = Ebook::latest()->paginate(9);
        return view('c_ebook.index',compact('ebook'))->with('i',(request()->input('page',1)-1)*9);
    }

    public function search(Request $request)
    {


        $search = $request->search;


        $ebook = Ebook::Where('ebook_name', 'like', '%' . $search . '%')->latest()->paginate(9);
        if($search="")
        {
            $ebook = Ebook::latest()->paginate(9);
        }
        return view('c_ebook.index',compact('ebook'))->with('i',(request()->input('page',1)-1)*9);
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
            'ebook_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ebook_pdf' => 'required',
            'ebook_name' => 'required',
            'ebook_author' => 'required',
            'ebook_status' => 'required'
        ]);

        $imageName=$request->ebook_image->getClientOriginalName();
        request()->ebook_image->move(public_path('images'), $imageName);

        $pdfName=$request->ebook_pdf->getClientOriginalName();
        request()->ebook_pdf->move(public_path('ebook'), $pdfName);

        $form_data = array(
            'ebook_image' => $imageName,
            'ebook_pdf' => $pdfName,
            'ebook_name' => $request->ebook_name,
            'ebook_author' => $request->ebook_author,
            'ebook_status' => $request->ebook_status
        );
       
        Ebook::create($form_data); 
   
        return redirect()->route('ebook.index')
                        ->with('success','Ebook Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        $request->validate([
            'ebook_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ebook_name' => 'required',
            'ebook_author' => 'required',
            'ebook_status' => 'required'
        ]);

        $imageName=$request->ebook_image; 
       if($imageName=="")
       {
            $form_data = array(
            'ebook_name' => $request->ebook_name,
            'ebook_author' => $request->ebook_author,
            'ebook_status' => $request->ebook_status,
            
        );
       }
       else
       {
            $imageName=$request->ebook_image->getClientOriginalName();
            request()->ebook_image->move(public_path('images'), $imageName);
            $form_data = array(
            'ebook_image' => $imageName,
            'ebook_name' => $request->ebook_name,
            'ebook_author' => $request->ebook_author,
            'ebook_status' => $request->ebook_status,
        );
       }

        

        $ebook->update($form_data);
  
        return redirect()->route('ebook.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        $ebook->delete();
        return redirect()->route('ebook.index')
                        ->with('delete_success','Deleted successfully');
    }
}
