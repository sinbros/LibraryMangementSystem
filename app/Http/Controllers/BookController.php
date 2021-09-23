<?php

namespace App\Http\Controllers;


use App\Category;
use App\Author;
use App\Publisher;
use App\Book;
use App\Accession;

use Illuminate\Http\Request;

use App\Exports\BookExport;
use App\Imports\BookImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;


class BookController extends Controller
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

        $book_total_qty = DB::table('accessions')
                 ->select('book_id', DB::raw('count(*) as total'))
                 ->groupBy('book_id')
                 ->get();

        $book_current_qty = DB::table('accessions')
                 ->select('book_id', DB::raw('count(*) as total'))
                 ->where('status','5')
                 ->groupBy('book_id')
                 ->get();


        $book = Book::all();
        $categorys=Category::all();
        $authors=Author::all();
        $publishers=Publisher::all();
        return view('book.index',compact('book_total_qty','book_current_qty','book','categorys','authors','publishers'));
    }

    public function indexClient()
    {

        $book_current_qty = DB::table('accessions')
                 ->select('book_id', DB::raw('count(*) as total'))
                 ->where('status','5')
                 ->groupBy('book_id')
                 ->get();


        $book = Book::latest()->paginate(9);
        $categorys=Category::all();
        $authors=Author::all();
        $publishers=Publisher::all();
        return view('c_book.index',compact('book_current_qty','book','categorys','authors','publishers'))->with('i',(request()->input('page',1)-1)*9);
    }

    public function search(Request $request)
    {

        $book_current_qty = DB::table('accessions')
                 ->select('book_id', DB::raw('count(*) as total'))
                 ->where('status','5')
                 ->groupBy('book_id')
                 ->get();

        $search = $request->search;


        $book = Book::Where('book_name', 'like', '%' . $search . '%')->latest()->paginate(9);
        if($search="")
        {
            $book = Book::latest()->paginate(9);
        }
        $categorys=Category::all();
        $authors=Author::all();
        $publishers=Publisher::all();
        return view('c_book.index',compact('book_current_qty','book','categorys','authors','publishers'))->with('i',(request()->input('page',1)-1)*9);
    }

    public function qty(Request $request)
    {
        $id = $request->input('id');

        // $total_qty = DB::table('accessions')
        //          ->select('id', DB::raw('count(*) as total'))
        //          ->groupBy('browser')
        //          ->get();

        // $total_qty = DB::table("accessions")
        //         ->where("book_id", "=", $id)
        //         ->get();

        $book = Book::where('id',$id)->get();
        $accession = Accession::where('book_id',$id)->get();
        $total_qty=count($accession);

        $current_qty = Accession::where('book_id',$id)
                        ->where('status','5')
                        ->get();
        $current_qty = count($current_qty);

        $categorys=Category::all();
        $authors=Author::all();
        $publishers=Publisher::all();

        return view('book.qty',compact('current_qty','total_qty','book','accession','categorys','authors','publishers'));
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
            'book_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_id' => 'required|unique:books',
            'book_name' => 'required',
            'book_category_id' => 'required',
            'book_author_id' => 'required',
            'book_publisher_id' => 'required',
            'book_edition' => 'required',
            'book_description' => 'required',
            'book_price' => 'required'
        ]);

        $imageName=$request->book_image; 
       if($imageName=="")
       {
            $imageName="user.png";
       }
       else
       {
            $imageName=$request->book_image->getClientOriginalName();
            request()->book_image->move(public_path('images'), $imageName);
       }

        $form_data = array(
            'book_image' => $imageName,
            'book_id' => $request->book_id,
            'book_name' => $request->book_name,
            'book_category_id' => $request->book_category_id,
            'book_author_id' => $request->book_author_id,
            'book_publisher_id' => $request->book_publisher_id,
            'book_edition' => $request->book_edition,
            'book_description' => $request->book_description,
            'book_price' => $request->book_price
        );
       
        Book::create($form_data); 
   
        return redirect()->route('book.index')
                        ->with('success','Book Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    public function export()
    {
        return Excel::download(new BookExport, 'book.xlsx');
    }

    public function export_pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $customPaper = array(0,0,1000.00,1000.00);
        $pdf->loadHTML($this->convert_customer_data_to_html())->setPaper($customPaper,'landscape');
        return $pdf->download('book.pdf');
    }
    function convert_customer_data_to_html()
    {
         $book = Book::all();
        $categorys=Category::all();
        $authors=Author::all();
        $publishers=Publisher::all();
         $output = '
         <h3 align="center">Book Data</h3>
         <table width="100%" style="border-collapse: collapse; border: 0px;">
          <tr>
        <th style="border: 1px solid; padding:12px;">ID</th>
        <th style="border: 1px solid; padding:12px;">Image</th>
        <th style="border: 1px solid; padding:12px;">Name</th>
        <th style="border: 1px solid; padding:12px;">Category</th>
        <th style="border: 1px solid; padding:12px;">Author</th>
        <th style="border: 1px solid; padding:12px;">Publisher</th>
        <th style="border: 1px solid; padding:12px;">Edition</th>
        <th style="border: 1px solid; padding:12px;">Description</th>
        <th style="border: 1px solid; padding:12px;">Price</th>
       </tr>
         ';  
         foreach($book as $data)
         {
          $output .= '
          <tr>
           <td style="border: 1px solid; padding:12px;">'.$data->id.'</td>
           <td style="border: 1px solid; padding:12px;"><img src="'. public_path() .'/images/'.$data->book_image.'" width="100px" height="100px"></td>
           <td style="border: 1px solid; padding:12px;">'.$data->book_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->category->category_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->author->author_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->publisher->publisher_name.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->book_edition.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->book_description.'</td>
           <td style="border: 1px solid; padding:12px;">'.$data->book_price.'</td>
           
          </tr>
          ';
         }
         $output .= '</table>';
         return $output;
        }
    public function import(Request $request)
    {
        //return Excel::download(new CollegeExport, 'college.xlsx');
        
        

        if($request->hasFile('excel_file')){
            Excel::import(new BookImport,request()->file('excel_file'));
            return redirect()->route('book.index')
                ->with('success','Uploaded Excel File Successfully');
            
        }else{
            return redirect()->route('book.index')
                ->with('File_Not_Found','Excel File Not Found');
        }
           
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_name' => 'required',
            'book_category_id' => 'required',
            'book_author_id' => 'required',
            'book_publisher_id' => 'required',
            'book_edition' => 'required',
            'book_description' => 'required',
            'book_price' => 'required'
        ]);

        $imageName=$request->book_image; 
       if($imageName=="")
       {
            $form_data = array(
            'book_name' => $request->book_name,
            'book_category_id' => $request->book_category_id,
            'book_author_id' => $request->book_author_id,
            'book_publisher_id' => $request->book_publisher_id,
            'book_edition' => $request->book_edition,
            'book_description' => $request->book_description,
            'book_price' => $request->book_price
        );
       }
       else
       {
            $imageName=$request->book_image->getClientOriginalName();
            request()->book_image->move(public_path('images'), $imageName);
            $form_data = array(
            'book_image' => $imageName,
            'book_name' => $request->book_name,
            'book_category_id' => $request->book_category_id,
            'book_author_id' => $request->book_author_id,
            'book_publisher_id' => $request->book_publisher_id,
            'book_edition' => $request->book_edition,
            'book_description' => $request->book_description,
            'book_price' => $request->book_price
        );
       }

        

        $book->update($form_data);
  
        return redirect()->route('book.index')
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')
                        ->with('delete_success','Deleted successfully');
    }

    public function mul_delete(Request $request)
    {
        // $delid=$request->input('delid');
        // Batch::whereIn('id',$request->input('delid'))->delete();
        $data = $request->all();
        Book::whereIn('id',$data['delid'])->delete();
  
        return redirect()->route('book.index')
                        ->with('delete_success','Multiple Data Deleted successfully');
    }

    public function qr_code(Request $request)
    {
        $accession = Accession::all();

        $id = $request->input('id');

        $pdf = \App::make('dompdf.wrapper');
        $customPaper = array(0,0,220.00,200.00);
        $pdf->loadView('book.book_qr_code',compact('id','accession'))->setPaper($customPaper,'landscape');
        // $pdf->loadHTML($this->convert_customer_data_to_html2($id))->setPaper($customPaper,'landscape');
        return $pdf->download('Book_QR_Code_'.$id.'.pdf');


        // return redirect()->route('student.index')
                        // ->with('delete_success','id card '.$id.'');
    }
}
