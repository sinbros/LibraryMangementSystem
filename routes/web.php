<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('c_home/index');
// });



Auth::routes();


Route::get('/', 'CHomeController@index')->name('home');
Route::resource('/contact','ContactController');
Route::resource('/admin/gallery','GalleryController');
Route::resource('/admin/ebook','EbookController');
Route::resource('/admin/news','NewsController');
Route::get('/admin/contact', 'ContactController@indexadmin')->name('contact.indexadmin');
Route::get('/gallery', 'GalleryController@indexClient');
Route::get('/ebooks', 'EbookController@indexClient');
Route::get('/books', 'CbookController@indexClient');
Route::get('/news', 'NewsController@indexClient');
Route::get('/news/view-news', 'NewsController@view_news')->name('news.view_news');
Route::get('/books', 'CbookController@search')->name('book.search');
Route::post('/ebooks', 'EbookController@search')->name('ebook.search');


Route::get('/transaction/get-transaction', 'CtransactionController@get_transaction')->name('transaction.get_transaction');


Route::get('/transaction', 'CtransactionController@c_index')->name('transaction.cindex');


Route::get('/about', function () {
    return view('c_about.index');
});



Route::get('/admin', 'HomeController@index')->name('home');

Route::post('/admin/student/import', 'StudentController@import')->name('student.import');
Route::get('/admin/student/export', 'StudentController@export')->name('student.export');
Route::get('/admin/student/export_pdf', 'StudentController@export_pdf')->name('student.export_pdf');

Route::post('/admin/book/import', 'BookController@import')->name('book.import');
Route::get('/admin/book/export', 'BookController@export')->name('book.export');
Route::get('/admin/book/export_pdf', 'BookController@export_pdf')->name('book.export_pdf');

// Route::get('/admin/student/id_card',function(){
// 	$pdf = PDF::loadView('student.student_id');
// 	return $pdf->download('student_id.pdf');
// })->name('student.id_card');


Route::get('/admin/batch/export_pdf', 'BatchController@export_pdf')->name('batch.export_pdf');


Route::get('/admin/student/id_card', 'StudentController@id_card')->name('student.id_card');
Route::get('/admin/book/qr_code', 'BookController@qr_code')->name('book.qr_code');
Route::get('/admin/book/qty', 'BookController@qty')->name('book.qty');
Route::get('/admin/transaction/report', 'TransactionController@report')->name('transaction.report');
Route::get('/admin/transaction/return_book', 'TransactionController@return_book')->name('transaction.return_book');
Route::get('/admin/transaction/transactions', 'TransactionController@transactions')->name('transaction.transactions');
Route::get('/admin/transaction/book_transactions', 'TransactionController@book_transactions')->name('transaction.book_transactions');
Route::get('/admin/transaction/accession_transactions', 'TransactionController@accession_transactions')->name('transaction.accession_transactions');
Route::post('/admin/transaction/search', 'TransactionController@search')->name('transaction.search');


Route::post('/admin/batch/delete', 'BatchController@mul_delete')->name('batch.mul_delete');
Route::post('/admin/student/delete', 'StudentController@mul_delete')->name('student.mul_delete');
Route::post('/admin/department/delete', 'DepartmentController@mul_delete')->name('department.mul_delete');
Route::post('/admin/college/delete', 'CollegeController@mul_delete')->name('college.mul_delete');
Route::post('/admin/category/delete', 'CategoryController@mul_delete')->name('category.mul_delete');
Route::post('/admin/author/delete', 'AuthorController@mul_delete')->name('author.mul_delete');
Route::post('/admin/publisher/delete', 'PublisherController@mul_delete')->name('publisher.mul_delete');
Route::post('/admin/book/delete', 'BookController@mul_delete')->name('book.mul_delete');
Route::post('/admin/admin/delete', 'AdminController@mul_delete')->name('admin.mul_delete');
Route::post('/admin/transaction/delete', 'TransactionController@mul_delete')->name('transaction.mul_delete');
Route::post('/admin/accession/delete', 'AccessionController@mul_delete')->name('accession.mul_delete');


Route::resource('/admin/batch','BatchController');
Route::resource('/admin/department','DepartmentController');
Route::resource('/admin/college','CollegeController');
Route::resource('/admin/student','StudentController');
Route::resource('/admin/category','CategoryController');
Route::resource('/admin/author','AuthorController');
Route::resource('/admin/publisher','PublisherController');
Route::resource('/admin/book','BookController');
Route::resource('/admin/admin','AdminController');
Route::resource('/admin/transaction','TransactionController');
Route::resource('/admin/accession','AccessionController');


Route::get('qr-code-g', function () {
  \QrCode::size(500)
            ->format('png')
            ->generate('sinbros.com', public_path('images/qrcode.png'));
    
  return view('qrCode');
    
});


Route::get('/admin/mail','MailController@basic_email')->name('mail.sendmail');
Route::get('/admin/custom_mail','MailController@custom_email')->name('mail.sendcustomemail');
Route::get('/admin/multiple-mail','MailController@mul_mail');

Route::get('/admin/transaction/return_book', 'TransactionController@return_book')->name('transaction.return_book');
// Route::get('sendhtmlemail','MailController@html_email');
// Route::get('sendattachmentemail','MailController@attachment_email');

// Route::get('/admin/mail', function () {
//     $to_name="sinbros";
//     $to_email="sinbrostechnology@gmail.com";
//     $data= array('name' =>'sumit','body'=>'Sumit test mail' );
//     Mail::send('mail',$data,function($message) use ($to_name,$to_email){
//     	$message->to($to_email)->subject('Mail Testing');
//     });
//     echo "email has been send";

// });





