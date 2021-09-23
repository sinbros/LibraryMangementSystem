<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('news.index',compact('news'));
    }

    public function indexClient()
    {
        $news = News::all();
        return view('c_news.index',compact('news'));
    }

    public function view_news(Request $request)
    {
        $id = $request->input('id');
        $news = News::where('id',$id)->get();
        
        return view('c_news.view_news',compact('news'));
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
            'news_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_title' => 'required',
            'news_des' => 'required',
            'news_status' => 'required'
        ]);

        $imageName=$request->news_image->getClientOriginalName();
            request()->news_image->move(public_path('images'), $imageName);

        $form_data = array(
            'news_image' => $imageName,
            'news_title' => $request->news_title,
            'news_des' => $request->news_des,
            'news_status' => $request->news_status
        );
       
        News::create($form_data); 
   
        return redirect()->route('news.index')
                        ->with('success','News Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'news_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_title' => 'required',
            'news_des' => 'required',
            'news_status' => 'required'
        ]);

        $imageName=$request->news_image; 
       if($imageName=="")
       {
            $form_data = array(
            'news_title' => $request->news_title,
            'news_des' => $request->news_des,
            'news_status' => $request->news_status
        );
       }
       else
       {
            $imageName=$request->news_image->getClientOriginalName();
            request()->news_image->move(public_path('images'), $imageName);
            $form_data = array(
            'news_image' => $imageName,
            'news_title' => $request->news_title,
            'news_des' => $request->news_des,
            'news_status' => $request->news_status
        );
       }

        

        $news->update($form_data);
  
        return redirect()->route('news.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')
                        ->with('delete_success','Deleted successfully');
    }
}
