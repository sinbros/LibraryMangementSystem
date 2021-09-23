<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all();
        return view('gallery.index',compact('gallery'));
    }

    public function indexClient()
    {
        $gallery = Gallery::all();
        return view('c_gallery.index',compact('gallery'));
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
            'gallery_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_name' => 'required',
            'gallery_category' => 'required',
            'gallery_status' => 'required'
        ]);

        $imageName=$request->gallery_image->getClientOriginalName();
            request()->gallery_image->move(public_path('images'), $imageName);

        $form_data = array(
            'gallery_image' => $imageName,
            'gallery_name' => $request->gallery_name,
            'gallery_category' => $request->gallery_category,
            'gallery_status' => $request->gallery_status
        );
       
        Gallery::create($form_data); 
   
        return redirect()->route('gallery.index')
                        ->with('success','Image Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'gallery_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_name' => 'required',
            'gallery_category' => 'required',
            'gallery_status' => 'required'
        ]);

        $imageName=$request->gallery_image; 
       if($imageName=="")
       {
            $form_data = array(
            'gallery_name' => $request->gallery_name,
            'gallery_category' => $request->gallery_category,
            'gallery_status' => $request->gallery_status
        );
       }
       else
       {
            $imageName=$request->gallery_image->getClientOriginalName();
            request()->gallery_image->move(public_path('images'), $imageName);
            $form_data = array(
            'gallery_image' => $imageName,
            'gallery_name' => $request->gallery_name,
            'gallery_category' => $request->gallery_category,
            'gallery_status' => $request->gallery_status
        );
       }

        

        $gallery->update($form_data);
  
        return redirect()->route('gallery.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('gallery.index')
                        ->with('delete_success','Deleted successfully');
    }
}
