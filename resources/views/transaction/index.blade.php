@extends('layout')

@section('navTransactionsListing','kt-menu__item--active')
@section('navTransactionsMenu','kt-menu__item--active')
@section('navMasterTableMenu','kt-menu__item--open kt-menu__item--here')


@section('content')
<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">


        <!-- begin:: Content -->
        <div style="margin-top: 20px" class="kt-container  kt-grid__item kt-grid__item--fluid">
            
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Transaction Datatable
                           
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                
                                &nbsp;
                                <a data-toggle="modal" data-target="#add_modal" href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    New Record
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="kt-portlet__body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('delete_success'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('File_Not_Found'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!--begin: Search Form -->
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                    <option value="">All</option>
                                                    <option value="3">Pending</option>
                                                    <option value="4">Complete</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <form method="POST" action="{{ route('transaction.search') }}" enctype="multipart/form-data">
                                        @csrf
                                    </form>    -->  
                                    <div class="col-md-1 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Transaction Date:</label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input onchange="setDate()" form="search_form" id="kt_datepicker_1_modal_1"  type="text" name="start" class="form-control" data-date-format='yyyy-mm-dd'  readonly placeholder="From" />
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input form="search_form" id="kt_datepicker_1_modal_2"  type="text" name="end" class="form-control" data-date-format='yyyy-mm-dd' readonly  placeholder="To" />
                                            </div>
                                        </div>
                                    </div>
                                    <form id="search_form" method="POST" action="{{ route('transaction.search') }}" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                        <i class="la la-search"></i>
                                        Search
                                        </button>
                                    </form>
                                    
                                                         
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                        
                                        <button style="width:100%" onclick="btn_click()" id ="select_btn" type="submit" class="select_btn btn btn-brand btn-elevate btn-icon-sm btn-info">
                                        <i class="la la-check"></i>
                                        Select All
                                        </button>
                                    </div>

                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <form id="del_form" action="{{ route('transaction.mul_delete') }}" method="post">
                                            {{ csrf_field() }}
                                        <div style="display: none;" class="delete_btn dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> Multiple
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">Choose an option</span>
                                            </li>
                                            <li class="kt-nav__item">
                                                <button name="action" value="delete" type="submit" class="kt-nav__link btn">
                                                    <i class="kt-nav__link-icon la la-trash"></i>
                                                    <span class="kt-nav__link-text">Delete</span>
                                                </button>
                                            </li>
                                            
                                            <li class="kt-nav__item">
                                                <button name="action" value="excel" type="submit" class="kt-nav__link btn">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </button>
                                            </li>

                                            <li class="kt-nav__item">
                                                <button name="action" value="mail" type="submit" class="kt-nav__link btn">
                                                    <i class="kt-nav__link-icon la la-mail-reply-all"></i>
                                                    <span class="kt-nav__link-text">Reminder</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                        </form>
                                    </div>
                                    

                                                        
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--end: Search Form -->
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <table class="kt-datatable table-hover" id="html_table" width="100%">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Book Name</th>
                                <th>Student Name</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th>Delay</th>
                                <th>Last Reminded</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Student ID</th>
                                <th>Book ID</th>
                                <th>Accession No</th>
                                <th>Issed By</th>
                                <th>No of Reminder</th>
                                <th>Fine Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($transaction as $data)
                            <tr>
                                <td>
                                    <label class="kt-checkbox">
                                        <input class="delete_check" onchange="valueChanged()" form="del_form" type="checkbox" name="delid[]" value="{{ $data->id}}"> {{ $data->id}}
                                        <span></span>
                                    </label>
                                </td>
<?php
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
?>

                                <td>{{ $data->accession->book->book_name }}</td>
                                <td>{{ $data->student->student_name }}</td>
                                <td>{{ $data->from_date }}</td>
                                <td>{{ $data->to_date }}</td>
                                @if($data->status=="3")
                                    @if($days>0)
                                    <td>
                                        <strong style="color:red">{{$days}} Days</strong>
                                    </td>
                                    @else
                                    <td>
                                        {{$days}} Days
                                    </td>
                                    @endif              
                                @else
                                <td>Returned</td>
                                @endif
                                
                                <td>
                                    @if($data->last_mail_date!="")
                                    {{ $data->last_mail_date }}
                                    @else
                                    Not Reminded
                                    @endif
                                </td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <div class="dropdown dropdown-inline">
                                        
                                        <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        
                                            @if($data->status==3)
                                            <a title="Update" class="dropdown-item" href="{{ route('transaction.return_book',['id'=>$data->id]) }}"><i class="la la-undo"></i> Return Book</a>

                                            <a title="Update" class="dropdown-item" href="{{ route('mail.sendmail',['id'=>$data->id]) }}"><i class="la la-mail-reply-all"></i> Send Reminder</a>

                                            <div class="dropdown-divider"></div>
                                            @endif
                                            <a data-toggle="modal" data-target="#update_modal_{{ $data->id }}" title="Update" class="dropdown-item" href="#"><i class="la la-edit"></i> Update</a>

                                            <a data-toggle="modal" data-target="#delete_modal_{{ $data->id }}" title="Delete" class="dropdown-item" href="#"><i class="la la-trash"></i> Delete</a>

                                            <a data-toggle="modal" data-target="#mail_modal_{{ $data->id }}" title="Custome Mail" class="dropdown-item" href="#"><i class="la la-mail-reply-all"></i> Custom Mail</a>
                                            

                                            <div class="dropdown-divider"></div>

                                            <a title="Update" class="dropdown-item" href="{{ route('transaction.report',['id'=>$data->id]) }}"><i class="la la-print"></i> Genetate Report</a>

                                            
                                        </div>
                                    </div>
                                    

                                    <a href="" data-toggle="modal" data-target="#view_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i style="font-size: 20px" class="la la-eye"></i></a>
                                </td>
                                <td>{{$data->student_id}}</td>
                                <td>{{$data->accession->book_id}}</td>
                                <td>{{$data->accession->accession_no}}</td>
                                <td>{{ $data->issued_by }}</td>
                                <td>{{ $data->no_of_reminder }}</td>
                                @if($data->status=="3")
                                <td>{{$days*10}}</td>                   
                                @else
                                <td>Returned</td>
                                @endif
                            </tr>
                            <div class="modal fade" id="view_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                View Transaction
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <center><img src='{{URL::to("/")}}/images/{{ $data->accession->book->book_image}}' width="200px" height="200px" style="border-radius: 10px">
                                            <img src='{{URL::to("/")}}/images/{{ $data->student->student_image}}' width="200px" height="200px" style="border-radius: 10px">
                                            </center>
                                            <br>
                                            <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <pre style="font-size: 16px;font-family: arial">Book ID : {{$data->accession->book->id}}<br></pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Book Name : {{$data->accession->book->book_name}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">From Date : {{$data->from_date}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">To Date : {{$data->to_date}}</pre>
                                                <hr>
                                                
                                                @if($data->status=='3')
                                                    <pre style="font-size: 16px;font-family: arial">Return Date : Not Returned</pre>
                                                @else
                                                    <pre style="font-size: 16px;font-family: arial">Actual Return Date : {{$data->actual_return_date}}</pre>
                                                @endif
                                                
                                                <hr>

                                                @if($data->status=='3')
                                                    <pre style="font-size: 16px;font-family: arial">Status : Pending</pre>        
                                                @else
                                                    <pre style="font-size: 16px;font-family: arial">Status : Complete</pre>
                                                @endif

                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Issued By : {{$data->issued_by}}</pre>
                                                
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <pre style="font-size: 16px;font-family: arial">Student ID : {{$data->student->id}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Student Name : {{$data->student->student_name}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Student Contact : {{$data->student->student_contact}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Student College : {{$data->student->college->college_name}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Student Department : {{$data->student->department->department_name}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Student Batch : {{$data->student->batch->batch_name}}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Taken By : {{$data->taken_by}}</pre>
                                                
                                            </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delete_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Delete Trasaction
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('transaction.destroy',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <center>
                                            <i style="color:red;font-size: 100px" class="   flaticon-close"></i>
                                            <p style="font-size: 20px">Are You Sure Want to Delete?</p>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                Delete
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="update_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Update Transaction
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('transaction.update',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                            <input value="{{$data->id}}" type="text" name="id" hidden />
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Book Name:</strong>
                                                <select style="width:100%" type="text" name="accession_id" class=" kt-select2 form-control" id="kt_select2_1_3">

                                                    @foreach($accessions as $accession)     
                                                        @if($accession->status=='5' || $accession->id==$data->accession_id) 
                                                            <option value="{{ $accession->id }}" {{$data->accession_id == $accession->id ? 'selected' : ''}}  >{{ $accession->accession_no}}.&nbsp; {{ $accession->book->book_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Student Name:</strong>
                                                <select style="width:100%" type="text" name="student_id" class=" kt-select2 form-control" id="kt_select2_1_4">
                                                    @foreach($students as $student)     
                                                        @if($student->student_status=='1') 
                                                            <option value="{{ $student->id }}" {{$data->student_id == $student->id ? 'selected' : ''}} >{{ $student->id}}.&nbsp; {{ $student->student_name}}</option>
                                                            
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                            

                                            <div class="row" style="width: 100%;margin-left: 0px">
                                                <div class="col-xs-6 col-sm-6 col-md-6" >
                                                    <div class="form-group">
                                                        <strong>From Date:</strong>
                                                        <input value="{{$data->from_date}}" type="text" name="from_date" class="form-control" id="kt_datepicker_1" data-date-format='yyyy-mm-dd' readonly placeholder="Select Date" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>To Date:</strong>
                                                        <input value="{{$data->to_date}}" type="text" name="to_date" class="form-control" id="kt_datepicker_2" data-date-format='yyyy-mm-dd' readonly placeholder="Select Date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="mail_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Custome Mail
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="GET" action="{{ route('mail.sendcustomemail') }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <input type="text" name="student_name" value="{{ $data->student->student_name }}" class="form-control" placeholder="Student Name" style="display: none">
                                                <input type="text" name="student_email" value="{{ $data->student->student_email }}" class="form-control" placeholder="Student Email" style="display: none">
                                            

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Email ID:</strong>
                                                <input type="text" name="" value="{{ $data->student->student_email }}" class="form-control" placeholder="Student Email" disabled="disabled">
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Subject:</strong>
                                                <input type="text" name="mail_subject" value="" class="form-control" placeholder="Enter Subject">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <textarea name="mail_text" class="form-control" rows="10"></textarea>
                                            </div>
                                        </div>

                                            
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">
                                                Send Mail
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Trancation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Book Name:</strong>
                        <select style="width:100%" type="text" name="accession_id" class="kt-select2 form-control" id="kt_select2_1_1" placeholder="Book Name">
                            @foreach($accessions as $data)     
                                @if($data->status=='5') 
                                    <option value="{{ $data->id }}"  >{{ $data->accession_no}}.&nbsp; {{ $data->book->book_name}}</option>
                                @endif
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Name:</strong>
                        <select style="width:100%" type="text" name="student_id" class=" kt-select2 form-control" id="kt_select2_1_2" placeholder="Student Name" list="student_list">
                            @foreach($students as $data)     
                                @if($data->student_status=='1') 
                                    <option value="{{ $data->id }}"  >{{ $data->student_id}}.&nbsp; {{ $data->student_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <?php
                    $date1= date("Y-m-d");
                    $date2 = date('Y-m-d', strtotime($date1. ' + 15 days'))
                ?>
                <div class="row" style="width: 100%;margin-left: 0px">
                    <div class="col-xs-6 col-sm-6 col-md-6" >
                        <div class="form-group">
                            <strong>From Date:</strong>
                            <input value="{{$date1}}" type="text" name="from_date" class="form-control" id="kt_datepicker_1_modal" data-date-format='yyyy-mm-dd' readonly placeholder="Select Date" />
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>To Date:</strong>
                            <input value="{{$date2}}" type="text" name="to_date" class="form-control" id="kt_datepicker_2_modal" data-date-format='yyyy-mm-dd' readonly placeholder="Select Date" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Issued By:</strong>
                        <input type="text" name="issued_by" class="form-control kt-selectpicker" readonly placeholder="Book Name" value="{{ Auth::user()->name }}">
                    </div>
                </div>

            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


 <script type="text/javascript">
    function valueChanged()
    {
        if($('.delete_check').is(":checked"))   
            $(".delete_btn").show();
        else
            $(".delete_btn").hide();
    }
    function btn_click()
    {
        if($('.delete_check').is(":checked"))
        {   
            $('.delete_check').prop('checked', false);
            $(".delete_btn").hide();
        }
        else
        {
            $('.delete_check').prop('checked', true);
            $(".delete_btn").show();
        }
        
    }
</script> 
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pro_img')
                    .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>  
<script>
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.pro_img2')
                    .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>                   
@endsection