<?php

namespace App\Http\Controllers;

use App\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
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
        $batch = Batch::all();
        return view('batch.index',compact('batch'));
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
            'batch_name' => 'required',
            'batch_status' => 'required'
        ]);
        
       
        Batch::create($request->all()); 
   
        return redirect()->route('batch.index')
                        ->with('success','Batch Added Successfully.');
    }

    public function export_pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        return $pdf->download('batch.pdf');
    }
    function convert_customer_data_to_html()
    {
        $batch = Batch::all();
         $output = '
         <h3 align="center">Batch Data</h3>
         <table width="100%" style="border-collapse: collapse; border: 0px;">
          <tr>
        <th style="border: 1px solid; padding:12px;">ID</th>
        <th style="border: 1px solid; padding:12px;">Name</th>
        <th style="border: 1px solid; padding:12px;">Status</th>
       </tr>
         ';  
         foreach($batch as $data)
         {
            if($data->batch_status=="1")
            {
                $status="Active";
            }
            else
            {
                $status="Deactive";
            }

          $output .= '
          <tr>
           <td style="border: 1px solid; padding:12px;">'.$data->id.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->batch_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$status.'</td>
          </tr>
          ';
         }
         $output .= '</table>';
         return $output;
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
         $request->validate([
            'batch_name' => 'required',
            'batch_status' => 'required'
        ]);

        $batch->update($request->all());
  
        return redirect()->route('batch.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('batch.index')
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        Batch::whereIn('id',$data['delid'])->delete();
  
        return redirect()->route('batch.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
    }
}
