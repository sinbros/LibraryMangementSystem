@extends('layout')

@section('navStudentListing','kt-menu__item--active')
@section('navStudentsMenu','kt-menu__item--active')
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
                            Student Datatable
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> Export
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">Choose an option</span>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="{{ route('student.export') }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="{{ route('student.export_pdf') }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                &nbsp;
                                <a data-toggle="modal" data-target="#m_modal_1" href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Import Excel
                                </a>
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
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                    <option value="">All</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                                        
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

                                    <div class="col-md-10 kt-margin-b-20-tablet-and-mobile">
                                        <form id="del_form" action="{{ route('student.mul_delete') }}" method="post">
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
                                                <button name="action" value="active" type="submit" class="kt-nav__link btn">
                                                    <i class="kt-nav__link-icon la la-arrow-circle-o-up"></i>
                                                    <span class="kt-nav__link-text">Active</span>
                                                </button>
                                            </li>
                                            <li class="kt-nav__item">
                                                <button name="action" value="deactive" type="submit" class="kt-nav__link btn">
                                                    <i class="kt-nav__link-icon la la-arrow-circle-o-down"></i>
                                                    <span class="kt-nav__link-text">Deactive</span>
                                                </button>
                                            </li>
                                            <li class="kt-nav__item">
                                                <button name="action" value="excel" type="submit" class="kt-nav__link btn">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
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
                                <th>ID</th>
                                <th>Image</th>
                                <th>Student Name</th>
                                <th>College</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($student as $data)
                            <tr>
                                <td>
                                    <label class="kt-checkbox">
                                        <input class="delete_check" onchange="valueChanged()" form="del_form" type="checkbox" name="delid[]" value="{{ $data->id}}"> {{ $data->student_id}}
                                        <span></span>
                                    </label>
                                </td>
                                <td><img style="border-radius:10px" src='{{URL::to("/")}}/images/{{ $data->student_image}}' width="100px" height="100px"> </td>
                                <td>{{ $data->student_name }}</td>
                                <td>{{ $data->college->college_name }}</td>
                                <td>{{ $data->student_email }}</td>
                                <td>{{ $data->student_status }}</td>
                                <td>
                                 <div class="dropdown dropdown-inline">
                                    
                                    <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        
                                        <a data-toggle="modal" data-target="#update_modal_{{ $data->id }}" title="Update" class="dropdown-item" href="#"><i class="la la-edit"></i> Update</a>

                                        <a data-toggle="modal" data-target="#delete_modal_{{ $data->id }}" title="Delete" class="dropdown-item" href="#"><i class="la la-trash"></i> Delete</a>
                                        

                                        <div class="dropdown-divider"></div>

                                        <a title="ID Card" class="dropdown-item" href="{{ route('student.id_card',['id'=>$data->id]) }}"><i class="la la-file-text"></i> Genetate ID Card</a>

                                        <a data-toggle="modal" data-target="#mail_modal_{{ $data->id }}" title="Custome Mail" class="dropdown-item" href="#"><i class="la la-mail-reply-all"></i> Custom Mail</a>

                                        <a title="Transactions" class="dropdown-item" href="{{ route('transaction.transactions',['id'=>$data->id]) }}"><i class="la la-exchange"></i> Transactions</a>

                                        
                                    </div>
                                    </div>
                                    <a href="" data-toggle="modal" data-target="#view_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i style="font-size: 20px" class="la la-eye"></i></a>
                        
                                </td>
                                <td>{{ $data->student_contact }}</td>
                            </tr>

                            <div class="modal fade" id="view_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                View Student
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <center><img src='{{URL::to("/")}}/images/{{ $data->student_image}}' width="200px" height="200px" style="border-radius: 10px">
                                                {!! QrCode::size(250)->generate(
                                                 'ID : '.$data->id.
                                                 '      Name : '.$data->student_name .
                                                 '      Gender : '.$data->student_gender .
                                                 '      DOB : '.$data->student_dob .
                                                 '      Contact : '.$data->student_contact .
                                                 '      College : '.$data->college->college_name .
                                                 '      Department : '.$data->department->department_name.
                                                 '      Batch : '.$data->batch->batch_name); !!}
                                            </center>
                                            <br>

                                            <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <pre style="font-size: 16px;font-family: arial">Name:               {{ $data->student_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Gender:             {{ $data->student_gender }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">DOB:                {{ $data->student_dob }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Contact:            {{ $data->student_contact }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Email ID:            {{ $data->student_email }}</pre>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <pre style="font-size: 16px;font-family: arial">College:            {{ $data->college->college_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Department:      {{ $data->department->department_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Batch:               {{ $data->batch->batch_name }}</pre>
                                                <hr>
                                                @if($data->student_status=='1')
                                                    <pre style="font-size: 16px;font-family: arial">Status:              Active</pre>
                                                @else
                                                    <pre style="font-size: 16px;font-family: arial">Status:              Deactive</pre>
                                                @endif
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
                                                <input type="text" name="student_name" value="{{ $data->student_name }}" class="form-control" placeholder="Student Name" style="display: none">
                                                <input type="text" name="student_email" value="{{ $data->student_email }}" class="form-control" placeholder="Student Email" style="display: none">
                                            

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Email ID:</strong>
                                                <input type="text" name="" value="{{ $data->student_email }}" class="form-control" placeholder="Student Email" disabled="disabled">
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

                            <div class="modal fade" id="delete_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Delete Student
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('student.destroy',$data->id) }}" enctype="multipart/form-data">
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
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Update Student
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('student.update',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                             <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <center>
                                                    <div class="form-group">
                                                    <img style="border-radius:10px" id="pro_img2" class="pro_img2" width="180px" height="200px" src='{{URL::to("/")}}/images/{{ $data->student_image}}' alt="image">
                                                    </div>
                                                </center>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Select Image :</strong>
                                                        <input onchange="readURL2(this);" type="file" name="student_image" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Student Name:</strong>
                                                        <input type="text" name="student_name" value="{{ $data->student_name }}" class="form-control" placeholder="Student Name">
                                                    </div>
                                                </div>

                                                <div class="row" style="width: 100%;margin-left: 0px">
                                                <div class="col-xs-6 col-sm-6 col-md-6" >
                                                    <div class="form-group">
                                                        <strong>Date of Birth:</strong>
                                                        <input value="{{ $data->student_dob }}" type="text" name="student_dob" class="form-control" id="kt_datepicker_1_modal" data-date-format='yyyy-mm-dd' readonly placeholder="Select date" />
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Gender:</strong><br>

                                                        <input type="radio" name="student_gender" value="Male" style="margin-top: 15px" {{$data->student_gender=='Male' ? 'checked' : ''}}> Male
                                                        <input type="radio" name="student_gender" value="Female" {{$data->student_gender=='Female' ? 'checked' : ''}}> Female
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Contact:</strong>
                                                        <input type="text" name="student_contact" value="{{ $data->student_contact }}" class="form-control" placeholder="Contact">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Email:</strong>
                                                        <input type="text" name="student_email" value="{{ $data->student_email }}" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>College:</strong>
                                                        <select class = "form-control" name="student_college_id">
                                                          
                                                            @foreach($colleges as $college)
                                                            @if($college->college_status=='1')    
                                                            <option value="{{ $college->id }}"  {{$data->student_college_id == $college->id ? 'selected' : ''}}>{{ $college->college_name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row" style="width: 100%;margin-left: 0px">
                                                    <div class="col-xs-6 col-sm-6 col-md-6" >
                                                        <div class="form-group" >
                                                            <strong>Department:</strong>
                                                            <select class = "form-control" name="student_department_id">
                                                            @foreach($departments as $department)
                                                            @if($department->department_status=='1')         
                                                            <option value="{{ $department->id }}" {{$data->student_department_id == $department->id ? 'selected' : ''}} >{{ $department->department_name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <strong>Batch:</strong>
                                                            <select class = "form-control" name="student_batch_id">
                                                            @foreach($batches as $batch)
                                                            @if($batch->batch_status=='1')        
                                                            <option value="{{ $batch->id }}"  {{$data->student_batch_id == $batch->id ? 'selected' : ''}}>{{ $batch->batch_name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Student Status:</strong>
                                                        <select class = "form-control" name="student_status">
                                                            <option value="1" {{$data->student_status == '1' ? 'selected' : ''}}>Active</option>
                                                            <option value="2" {{$data->student_status == '2' ? 'selected' : ''}}>Deactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            @csrf
                                            @method('PUT')
                                            
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
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Import Excel
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('student.import') }}" enctype="multipart/form-data">
            <div class="modal-body">
                
                @csrf
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>College:</strong>
                                    <select class = "form-control kt-selectpicker" name="student_college_id">
                                        @foreach($colleges as $data)
                                            @if($data->college_status=='1') 
                                                <option value="{{ $data->id }}"  >{{ $data->college_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="width: 100%;margin-left: 0px">
                                <div class="col-xs-6 col-sm-6 col-md-6" >
                                    <div class="form-group" >
                                        <strong>Department:</strong>
                                        <select class = "form-control kt-selectpicker" name="student_department_id">
                                        @foreach($departments as $data)
                                                 
                                        @if($data->department_status=='1') 
                                                <option value="{{ $data->id }}"  >{{ $data->department_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Batch:</strong>
                                        <select class = "form-control kt-selectpicker" name="student_batch_id">
                                        @foreach($batches as $data)
                                            @if($data->batch_status=='1') 
                                                <option value="{{ $data->id }}"  >{{ $data->batch_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Select Excel File:</strong>
                            <input type="file" name="excel_file" class="form-control">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add College
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <center>
                            <div class="form-group">
                            <img style="border-radius:10px" id="pro_img" width="180px" height="200px" src="{{ asset('images/user.png') }}" alt="image">
                            </div>
                        </center>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Select Image :</strong>
                                <input onchange="readURL(this);" type="file" name="student_image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Student ID:</strong>
                                    <input type="number" name="student_id" class="form-control" placeholder="Student ID">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Student Name:</strong>
                                    <input type="text" name="student_name" class="form-control" placeholder="Student Name">
                                </div>
                            </div>
                            <div class="row" style="width: 100%;margin-left: 0px">
                                <div class="col-xs-6 col-sm-6 col-md-6" >
                                    <div class="form-group">
                                        <strong>Date of Birth:</strong>
                                        <input type="text" readonly name="student_dob" class="form-control" id="kt_datepicker_2_modal" data-date-format='yyyy-mm-dd' placeholder="Select date" />
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Gender:</strong><br>
                                        <input type="radio" name="student_gender" value="Male" style="margin-top: 15px"> Male
                                        <input type="radio" name="s_gender" value="Female"> Female
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Contact:</strong>
                                    <input type="text" name="student_contact" class="form-control" placeholder="Contact">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="Email" name="student_email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <script type="text/javascript">
                            $(document).ready(function() {
                                $(".js-example-basic-multiple").select2();
                            });
                            </script>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>College:</strong> 
                                    <select class = "form-control kt-selectpicker" name="student_college_id">
                                        @foreach($colleges as $data)
                                            @if($data->college_status=='1') 
                                                <option value="{{ $data->id }}"  >{{ $data->college_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="width: 100%;margin-left: 0px">
                                <div class="col-xs-6 col-sm-6 col-md-6" >
                                    <div class="form-group" >
                                        <strong>Department:</strong>
                                        <select class = "form-control kt-selectpicker" name="student_department_id">
                                        @foreach($departments as $data)
                                                 
                                        @if($data->department_status=='1') 
                                                <option value="{{ $data->id }}"  >{{ $data->department_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Batch:</strong>
                                        <select class = "form-control kt-selectpicker" name="student_batch_id">
                                        @foreach($batches as $data)
                                            @if($data->batch_status=='1') 
                                                <option value="{{ $data->id }}"  >{{ $data->batch_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Student Status:</strong>
                                    <select class = "form-control kt-selectpicker" name="student_status">
                                        <option value="1">Active</option>
                                        <option value="2">Deactive</option>
                                    </select>
                                </div>
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