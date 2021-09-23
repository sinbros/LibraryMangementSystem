<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Student;
use App\Book;
use App\Accession;
use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;

use App\Exports\TransactionExportCustom;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
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
        $transaction = Transaction::all();
        $students = Student::all();
        $accessions = Accession::all();
        return view('transaction.index',compact('transaction','students','accessions'));
    }

    public function transactions(Request $request)
    {
        $id = $request->input('id');
        $transaction = Transaction::where('student_id',$id)->get();
        $students = Student::all();
        $accessions = Accession::all();
        return view('transaction.index',compact('transaction','students','accessions'));
    }

    public function book_transactions(Request $request)
    {
        $id = $request->input('id');
        $students = Student::all();
        $accessions = Accession::all();

        $accession_id[]="";

        foreach ($accessions as $data) {
            if($data->book_id==$id)
            {
                $accession_id[]=$data->id;
            }
        }

        $transaction = Transaction::whereIn('accession_id',$accession_id)->get();
        
        return view('transaction.index',compact('transaction','students','accessions'));
    }

    public function accession_transactions(Request $request)
    {
        $id = $request->input('id');
        $transaction = Transaction::where('accession_id',$id)->get();
        $students = Student::all();
        $accessions = Accession::all();
        return view('transaction.index',compact('transaction','students','accessions'));
    }

    public function search(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $transaction = Transaction::where([
                                        ['from_date', '>=', $start],
                                        ['from_date', '<=', $end],
                                    ])->get();
        $students = Student::all();
        $accessions = Accession::all();
        return view('transaction.index',compact('transaction','students','accessions'));
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
            'accession_id' => 'required',
            'student_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'issued_by' => 'required',
        ]);
        Transaction::create($request->all());

        DB::table('accessions')
              ->where('id', $request->accession_id)
              ->update(['status' => '6']);

        return redirect()->route('transaction.index')
                        ->with('success','Transaction Added Successfully.');
    }

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'accession_id' => 'required',
            'student_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $transactions = Transaction::where('id','=',$request->id)->get();

        foreach ($transactions as $data) {
            if($data->id==$request->id)
            {
                $accession_id=$data->accession_id;
            }
        }

        if($accession_id!=$request->accession_id)
        {
            DB::table('accessions')
              ->where('id', $accession_id)
              ->update(['status' => '5']);

            DB::table('accessions')
              ->where('id', $request->accession_id)
              ->update(['status' => '6']);
        }
        
        $transaction->update($request->all());
        return redirect()->route('transaction.index')
                        ->with('success','Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $transactions = Transaction::all();
        foreach($transactions as $data)
        {
            if($data->id==$id)
            {
                $accession_id=$data->accession_id;
            }
        }

        DB::table('accessions')
              ->where('id', $accession_id)
              ->update(['status' => '5']);

        Transaction::destroy($id);

        return redirect()->route('transaction.index')
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $id_data = $request->all();
        $ids = $request->delid;
        $action = $request->action;

        if($action=="delete")
        {
            $transactions = Transaction::all();
            $books = Book::all();

            foreach($transactions as $data)
            {
                foreach ($ids as $id) {
                  if($data->id==$id)
                  {
                      $accession_id=$data->accession_id;
                      DB::table('accessions')
                        ->where('id', $accession_id)
                        ->update(['status' => '5']);
                  }
                }
            }
            
            Transaction::whereIn('id',$id_data['delid'])->delete();
      
            return redirect()->route('transaction.index')
                            ->with('delete_success','Multiple Data Deleted successfully');   
        }
        else if($action=="excel")
        {
            return Excel::download(new TransactionExportCustom($ids), 'Transaction.xlsx');
            
        }
        else if($action=="mail")
        {
            return app('App\Http\Controllers\MailController')->mul_mail($ids);
        }

        
    }

    public function report(Request $request)
    {
        $transaction = Transaction::all();
        $students = Student::all();
        $accessions = Accession::all();

        $id = $request->input('id');

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadView('transaction.report',compact('id','transaction','students','accessions'));
        return $pdf->download('Transaction_Report_'.$id.'.pdf');
    }

    public function return_book(Request $request)
    {
        $transaction = Transaction::all();
        $students = Student::all();
        $books = Book::all();

        $id = $request->input('id');
        $taken_by= Auth::user()->name;
        $date= date("Y-m-d H:i:s");

        DB::table('transactions')
              ->where('id', $id)
              ->update(['status' => '4']);
        DB::table('transactions')
              ->where('id', $id)
              ->update(['actual_return_date' => $date]);
        DB::table('transactions')
              ->where('id', $id)
              ->update(['taken_by' => $taken_by]);

        foreach($transaction as $data)
        {
            if($data->id==$id)
            {
                $accession_id=$data->accession_id;
            }
        }

        DB::table('accessions')
              ->where('id', $accession_id)
              ->update(['status' => '5']);

        return redirect()->route('transaction.index')
                        ->with('success','Book Returned successfully');
    }
}
