<?php
namespace App\Http\Controllers;

use App\Category;
use App\Author;
use App\Publisher;
use App\Book;
use App\Accession;

use Illuminate\Http\Request;
use DB;


class CbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

}
