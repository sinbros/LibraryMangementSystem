<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Student;
use App\Book;
use App\Accession;
use Illuminate\Http\Request;
use DB;

class CtransactionController extends Controller
{
    public function c_index()
    {
        $student_id = "";
        $havedata="False";
        $transaction = Transaction::where('student_id',$student_id)->get();
        return view('c_transaction.index',compact('transaction','havedata'));
    }

    public function get_transaction(Request $request)
    {
        $student_id = $request->student_id;
        $student_dob = $request->student_dob;

        $students = Student::where('student_id',$student_id)->get();
        $accessions = Accession::all();
        $books = Book::all();

        foreach ($students as $data) {
            // echo $data->student_dob;
            $date = date('d', strtotime($data->student_dob));
            $month = date('m', strtotime($data->student_dob));
            $year = date('Y', strtotime($data->student_dob));
            $id=$data->id;

            $dob = $date.$month.$year;

            if((int)$dob==$student_dob)
            {
              $havedata="True";
              $transaction = Transaction::where('student_id',$id)->get();
              return view('c_transaction.index',compact('transaction','students','accessions','books','havedata'));
            }
            else
            {
              return redirect()->back()
                        ->with('delete_success','Invalid Input');
            }
        
        }

    }
}
