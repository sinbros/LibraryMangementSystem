<?php

namespace App\Http\Controllers;

use App\Department;
use App\College;
use App\Batch;
use App\Student;
use App\Transaction;

use Illuminate\Http\Request;

use App\Exports\StudentExport;
use App\Exports\StudentExportCustom;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;

class StudentController extends Controller
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

        $student = Student::all();
        $colleges = College::all();
        $departments = Department::all();
        $batches = Batch::all();
        $transactions = Transaction::all();
        return view('student.index',compact('transactions','student','colleges','departments','batches'));
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
            'student_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'student_id' => 'required|unique:students',
            'student_name' => 'required',
            'student_gender' => 'required',
            'student_dob' => 'required',
            'student_contact' => 'required',
            'student_email' => 'required',
            'student_college_id' => 'required',
            'student_department_id' => 'required',
            'student_batch_id' => 'required',
            'student_status' => 'required'
        ],
        [
            'student_id.required' => '"$request->student_id" This Student ID has Already Been Taken',
        ]
    );
       $imageName=$request->student_image; 
       if($imageName=="")
       {
            $imageName="user.png";
       }
       else
       {
            $imageName=$request->student_image->getClientOriginalName();
            request()->student_image->move(public_path('images'), $imageName);
       }

        $form_data = array(
            'student_image' => $imageName,
            'student_id' => $request->student_id,
            'student_name' => $request->student_name,
            'student_gender' => $request->student_gender,
            'student_dob' => $request->student_dob,
            'student_contact' => $request->student_contact,
            'student_email' => $request->student_email,
            'student_college_id' => $request->student_college_id,
            'student_department_id' => $request->student_department_id,
            'student_batch_id' => $request->student_batch_id,
            'student_status' => $request->student_status
        );

        Student::create($form_data); 
   
        return redirect()->route('student.index')
                        ->with('success','Student Added Successfully.');
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'student.xlsx');
    }

    public function export_pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $customPaper = array(0,0,600.00,1000.00);
        $pdf->loadHTML($this->convert_customer_data_to_html())->setPaper($customPaper,'landscape');
        return $pdf->download('student.pdf');
    }
    function convert_customer_data_to_html()
    {
         $student = Student::all();
         $colleges = College::get();
        $departments = Department::get();
        $batches = Batch::get();
         $output = '
         <h3 align="center">Student Data</h3>
         <table width="100%" style="border-collapse: collapse; border: 0px;">
          <tr>
        <th style="border: 1px solid; padding:12px;">ID</th>
        <th style="border: 1px solid; padding:12px;">Image</th>
        <th style="border: 1px solid; padding:12px;">Name</th>
        <th style="border: 1px solid; padding:12px;">Gender</th>
        <th style="border: 1px solid; padding:12px;">DOB</th>
        <th style="border: 1px solid; padding:12px;">Contact</th>
        <th style="border: 1px solid; padding:12px;">Email</th>
        <th style="border: 1px solid; padding:12px;">College</th>
        <th style="border: 1px solid; padding:12px;">Department</th>
        <th style="border: 1px solid; padding:12px;">Batch</th>
        <th style="border: 1px solid; padding:12px;">Status</th>
       </tr>
         ';  
         foreach($student as $data)
         {
            if($data->student_status=="1")
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
           <td style="border: 1px solid; padding:12px;"><img src="'. public_path() .'/images/'.$data->student_image.'" width="100px" height="100px"></td>
           <td style="border: 1px solid; padding:12px;">'.$data->student_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->student_gender.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->student_dob.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->student_contact.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->student_email.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->college->college_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->department->department_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->batch->batch_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$status.'</td>
          </tr>
          ';
         }
         $output .= '</table>';
         return $output;
        }
    

    public function import(Request $request)
    {
        //return Excel::download(new CollegeExport, 'college.xlsx');
        
        $college=$request->student_college_id;
        $department=$request->student_department_id;
        $batch=$request->student_batch_id;

        if($request->hasFile('excel_file')){
            // Excel::toArray(new StudentImport($college,$department,$department), request()->file('excel_file'));
            Excel::import(new StudentImport($college,$department,$department),request()->file('excel_file'));
            return redirect()->route('student.index')
                ->with('success','Uploaded Excel File Successfully');
            
        }else{
            return redirect()->route('student.index')
                ->with('File_Not_Found','Excel File Not Found');
        }
           
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'student_name' => 'required',
            'student_gender' => 'required',
            'student_dob' => 'required',
            'student_contact' => 'required',
            'student_email' => 'required',
            'student_college_id' => 'required',
            'student_department_id' => 'required',
            'student_batch_id' => 'required',
            'student_status' => 'required'
        ]);

        $imageName=$request->student_image; 
       if($imageName=="")
       {
            $form_data = array(
            'student_name' => $request->student_name,
            'student_gender' => $request->student_gender,
            'student_dob' => $request->student_dob,
            'student_contact' => $request->student_contact,
            'student_email' => $request->student_email,
            'student_college_id' => $request->student_college_id,
            'student_department_id' => $request->student_department_id,
            'student_batch_id' => $request->student_batch_id,
            'student_status' => $request->student_status
        );
       }
       else
       {
            $imageName=$request->student_image->getClientOriginalName();
            request()->student_image->move(public_path('images'), $imageName);
            $form_data = array(
            'student_image' => $imageName,
            'student_name' => $request->student_name,
            'student_gender' => $request->student_gender,
            'student_dob' => $request->student_dob,
            'student_contact' => $request->student_contact,
            'student_email' => $request->student_email,
            'student_college_id' => $request->student_college_id,
            'student_department_id' => $request->student_department_id,
            'student_batch_id' => $request->student_batch_id,
            'student_status' => $request->student_status
        );
       }
        $student->update($form_data);
  
        return redirect()->route('student.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')
                        ->with('delete_success','Deleted successfully');
    }
    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        $action = $request->action;
        $data2 = $request->delid;

        if($action=="delete")
        {
            Student::whereIn('id',$data['delid'])->delete();
            return redirect()->route('student.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
        }
        else if($action=="active")
        {
            $data2 = $request->delid;
            foreach ($data2 as $id) {
                DB::table('students')
                  ->where('id', $id)
                  ->update(['student_status' => '1']);
            }
            return redirect()->route('student.index')
                            ->with('success','Multiple Active successfully');
        }
        else if($action=="deactive")
        {
            
            foreach ($data2 as $id) {
                DB::table('students')
                  ->where('id', $id)
                  ->update(['student_status' => '2']);
            }
            return redirect()->route('student.index')
                            ->with('success','Multiple Deactive successfully');
        }

        else if($action=="excel")
        {
            return Excel::download(new StudentExportCustom($data2), 'student.xlsx');
            
        }
    }

    public function id_card(Request $request)
    {
        $student = Student::all();
        $colleges = College::get();
        $departments = Department::get();
        $batches = Batch::get();

        $id = $request->input('id');

        $pdf = \App::make('dompdf.wrapper');
        $customPaper = array(0,0,480.00,300.00);
        $pdf->loadView('student.student_id',compact('id','student','colleges','departments','batches'))->setPaper($customPaper,'landscape');
        // $pdf->loadHTML($this->convert_customer_data_to_html2($id))->setPaper($customPaper,'landscape');
        return $pdf->download('student_id_'.$id.'.pdf');


        // return redirect()->route('student.index')
                        // ->with('delete_success','id card '.$id.'');
    }
    function convert_customer_data_to_html2($id)
    {
        $id_no=$id;
         $student = Student::all();
         $colleges = College::get();
        $departments = Department::get();
        $batches = Batch::get();
        $coma="'s";
        foreach($student as $data)
         {
            if($data->id==$id_no)
            {
         $output = '
         <div style="margin:-20px;margin-top:-30px;margin-botton:-30px">
         <img  src="'. public_path() .'/images/sdj_logo.png" width="100%">
         <hr>
         <table width="100%" style="text-center border-collapse: collapse; border: 0px;">
          <tr>
            <td style="text-align:center">
                <img style="border-radius:10px" src="'. public_path() .'/images/'.$data->student_image.'" width="120px" height="140px">
            </td>
            <td style="text-align:center">
                <img style="border-radius:10px" src="'. public_path() .'/images/'.$data->student_image.'" width="120px" height="140px">
            </td>
        </tr>
        <tr>
            <td  style="text-transform: uppercase;color:#751A11;text-align:center;font-size:22px;" colspan="2">'.$data->student_name.'</td>
        </tr>
        </table>
        <table style="margin-top:10px">
        <tr >
            <td style="text-align:left">ID</td>
            <td style="text-align:left"> : '.$data->id.'</td>
        </tr>
        
        <tr>
            <td style="text-align:left">Gender</td>
            <td style="text-align:left"> : '.$data->student_gender.'</td>
        </tr>
        <tr>
            <td style="text-align:left">DOB</td>
            <td style="text-align:left"> : '.$data->student_dob.'</td>
        </tr>
        <tr>
            <td style="text-align:left">Contact</td>
            <td style="text-align:left"> : '.$data->student_contact.'</td>
        </tr>
        <tr>
            <td style="text-align:left">College</td>
            <td style="text-align:left"> : '.$data->college->college_name.'</td>
        </tr>
        <tr>
            <td style="text-align:left">Department</td>
            <td style="text-align:left"> : '.$data->department->department_name.'</td>
        </tr>

        </table>
        <p style="text-align:left;color:red">Validity '.$data->batch->batch_name.' <span style="color:black"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Director'.$coma.' Sign_______</span>
        </p>
        <hr>
        <center>
            <p style="margin-top:0px">
                Plot No. : 166, Opp IDI, B/h Someshwara Bungalows,<br>Vesu, Surat, Gujarat-395007 <br>Tel : +91 261 656 9800 | Fax : +91 261 400 9222<br>Email : admin@sdjgroup.org <br>Website : www.sdjgroup.orc
            </p>
        </center>
        </div>
         ';  
         }
         }
         
         return $output;
        }
}
