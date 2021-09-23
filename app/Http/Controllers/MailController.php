<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Transaction;
use App\Student;
use App\Book;
use App\Accession;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email(Request $request) {
   		$id = $request->input('id');

   		$transaction = Transaction::all();
        $students = Student::all();
        $accessions = Accession::all();
        $books = Book::all();

        foreach($transaction as $data)
        {
            if($data->id==$id)
            {
                $student_id=$data->student_id;
                $accession_id=$data->accession_id;
                $from_date=$data->from_date;
                $return_date=$data->to_date;
                $no_of_reminder=$data->no_of_reminder;
                date_default_timezone_set("Asia/Kolkata");                         
                $date1 = $data->to_date;
                $date2 = date('Y-m-d');
                $days=0;
                if($date2>$date1)
                {
                $diff = abs(strtotime($date2) - strtotime($date1));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                }
              }
        }


        foreach($accessions as $data)
        {
            if($data->id==$accession_id)
            {
                $accession_no=$data->accession_no;
                $book_id=$data->book_id;
            }
        }

        foreach($books as $data)
        {
            if($data->id==$book_id)
            {
                $book_name=$data->book_name;
                $book_image=$data->book_image;
                $book_author=$data->author->author_name;
            }
        }

        foreach($students as $data)
        {
            if($data->id==$student_id)
            {
                $student_name=$data->student_name;
                $student_email=$data->student_email;
            }
        }

        if($student_email!="")
        {
          $to_name=$student_name;
  	      $to_email=$student_email;
  	      $data= array('name' =>$to_name,
  	    			'book_id'=>$book_id,
  	    			'book_image'=>$book_image,
  	    			'accession_no' =>$accession_no,
  	    			'book_name'=>$book_name,
  	    			'author_name'=>$book_author,
  	    			'issue_date'=>$from_date,
  	    			'return_date'=>$return_date,
  	    			'transaction_id'=>$id,
              'delay_days'=>$days,
              'fine_amt'=>$days*10);
  	      Mail::send('mail.mail',$data,function($message) use ($to_name,$to_email){
  	    	  $message->to($to_email)->subject('Book Return Reminder');
  	    	  $message->from('sumit114433@gmail.com','SDJ International College Library');
  	      });

          date_default_timezone_set("Asia/Kolkata");
          $no_of_reminder=$no_of_reminder+1;

          DB::table('transactions')
              ->where('id', $id)
              ->update(['no_of_reminder' => $no_of_reminder]);

          DB::table('transactions')
              ->where('id', $id)
              ->update(['last_mail_date' => date('Y-m-d H:i:s')]);

  	      return redirect()->route('transaction.index')
                          ->with('success','Mail Send successfully');
        }
        else
        {
            return redirect()->route('transaction.index')
                          ->with('delete_success','Email Not Found');

        }
   }


   public function mul_mail($mul_mail_id) {
      // $id = $request->input('id');
      $ids = $mul_mail_id;
      $transaction = Transaction::all();
        $students = Student::all();
        $accessions = Accession::all();
        $books = Book::all();

        foreach($ids as $id)
        {

          foreach($transaction as $data)
          {
              if($data->id==$id)
              {
                $student_id=$data->student_id;
                $accession_id=$data->accession_id;
                $from_date=$data->from_date;
                $return_date=$data->to_date;
                $no_of_reminder=$data->no_of_reminder;
                date_default_timezone_set("Asia/Kolkata");                         
                $date1 = $data->to_date;
                $date2 = date('Y-m-d');
                $days=0;
                if($date2>$date1)
                {
                $diff = abs(strtotime($date2) - strtotime($date1));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                }
              }
          }

          foreach($accessions as $data)
          {
              if($data->id==$accession_id)
              {
                  $accession_no=$data->accession_no;
                  $book_id=$data->book_id;
              }
          }

          foreach($books as $data)
          {
              if($data->id==$book_id)
              {
                  $book_name=$data->book_name;
                  $book_image=$data->book_image;
                  $book_author=$data->author->author_name;
              }
          }

          foreach($students as $data)
          {
              if($data->id==$student_id)
              {
                  $student_name=$data->student_name;
                  $student_email=$data->student_email;
              }
          }

          if($student_email!="")
          {
            $to_name=$student_name;
            $to_email=$student_email;
            $data= array('name' =>$to_name,
                'book_id'=>$book_id,
                'book_image'=>$book_image,
                'accession_no' =>$accession_no,
                'book_name'=>$book_name,
                'author_name'=>$book_author,
                'issue_date'=>$from_date,
                'return_date'=>$return_date,
                'transaction_id'=>$id,
              'delay_days'=>$days,
              'fine_amt'=>$days*10);
            Mail::send('mail.mail',$data,function($message) use ($to_name,$to_email){
              $message->to($to_email)->subject('Book Return Reminder');
              $message->from('sumit114433@gmail.com','SDJ International College Library');
            });

            date_default_timezone_set("Asia/Kolkata");
            $no_of_reminder=$no_of_reminder+1;

            DB::table('transactions')
                ->where('id', $id)
                ->update(['no_of_reminder' => $no_of_reminder]);

            DB::table('transactions')
                ->where('id', $id)
                ->update(['last_mail_date' => date('Y-m-d H:i:s')]);
            
          }
        }
        return redirect()->route('transaction.index')
                          ->with('success','Multiple Mail Send successfully');
   }

   public function custom_email(Request $request) {
        $name = $request->student_name;
        $email = $request->student_email;
        $subject = $request->mail_subject;
        $text = $request->input('mail_text');

        if($email!="")
        {
          $to_name=$name;
          $to_email=$email;
          $data= array('name' =>$to_name,
                        'text'=>$text);
          Mail::send('mail.custom_mail',$data,function($message) use ($to_name,$to_email,$subject){
            $message->to($to_email)->subject($subject);
            $message->from('sumit114433@gmail.com','SDJ International College Library');
          });
          return redirect()->back()
                          ->with('success','Custom Mail Send successfully');
        }
        else
        {
            return redirect()->back()
                          ->with('delete_success','Email Not Found');

        }
   }

   // public function html_email() {
   //    $data = array('name'=>"Virat Gandhi");
   //    Mail::send('mail', $data, function($message) {
   //       $message->to('abc@gmail.com', 'Tutorials Point')->subject
   //          ('Laravel HTML Testing Mail');
   //       $message->from('xyz@gmail.com','Virat Gandhi');
   //    });
   //    echo "HTML Email Sent. Check your inbox.";
   // }
   // public function attachment_email() {
   //    $data = array('name'=>"Virat Gandhi");
   //    Mail::send('mail', $data, function($message) {
   //       $message->to('abc@gmail.com', 'Tutorials Point')->subject
   //          ('Laravel Testing Mail with Attachment');
   //       $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
   //       $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
   //       $message->from('xyz@gmail.com','Virat Gandhi');
   //    });
   //    echo "Email Sent with attachment. Check your inbox.";
   // }
}