<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $user = User::all();
        return view('admin.index',compact('user'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password'])
        );
       
        User::create($form_data); 
   
        return redirect()->route('admin.index')
                        ->with('success','Admin Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'status' => ['required'],
        ]);

        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status
        );

        $user->update($form_data);
  
        return redirect()->route('admin.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.index')
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        User::whereIn('id',$data['delid'])->delete();
  
        return redirect()->route('admin.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
    }
}
