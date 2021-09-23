@extends('layout')

@section('navBookListing','kt-menu__item--active')
@section('navBooksMenu','kt-menu__item--active')
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
                            Book Datatable
                           
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
                                                <a href="{{ route('book.export') }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="{{ route('book.export_pdf') }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                &nbsp;
                                <!-- <a data-toggle="modal" data-target="#m_modal_1" href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Import Excel
                                </a> -->
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
                                        <form id="del_form" action="{{ route('book.mul_delete') }}" method="post">
                                            {{ csrf_field() }}
                                        <button style="display: none;" type="submit" class="delete_btn btn btn-brand btn-elevate btn-icon-sm btn-danger">
                                        <i class="la la-trash"></i>
                                        Multiple Delete
                                        </button>
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
                                <th>Book Name</th>
                                <th>Category</th>
                                <th>Total Qty</th>
                                <th>Current Qty</th>
                                <th>Action</th>
                                <th>Author</th>

                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($book as $data)
                             <?php
                                $current=0;
                            ?>
                            @foreach ($book_current_qty as $current_qty)
                                @if($data->id == $current_qty->book_id)
                                    <?php $current=$current_qty->total; ?>
                                @endif
                            @endforeach

                            <?php
                                $total=0;
                            ?>
                            @foreach ($book_total_qty as $total_qty)
                                @if($data->id ==$total_qty->book_id)
                                    <?php $total=$total_qty->total; ?>
                                @endif
                            @endforeach
                            <tr>
                                <td>
                                    <label class="kt-checkbox">
                                        <input class="delete_check" onchange="valueChanged()" form="del_form" type="checkbox" name="delid[]" value="{{ $data->id}}"> {{ $data->book_id}}
                                        <span></span>
                                    </label>
                                </td>
                                <td><img style="border-radius:10px" src='{{URL::to("/")}}/images/{{ $data->book_image}}' width="100px" height="100px"> </td>
                                <td>{{ $data->book_name }}</td>
                                <td>{{ $data->category->category_name }}</td>
                                <?php
                                    $flag=0;
                                ?>
                                <td>{{$total}}</td>
                                <td>{{$current}}</td>
                                <td>
                                    <div class="dropdown dropdown-inline">
                                    
                                    <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        
                                        <a data-toggle="modal" data-target="#update_modal_{{ $data->id }}" title="Update" class="dropdown-item" href="#"><i class="la la-edit"></i> Update</a>

                                        <a data-toggle="modal" data-target="#delete_modal_{{ $data->id }}" title="Delete" class="dropdown-item" href="#"><i class="la la-trash"></i> Delete</a>

                                        <div class="dropdown-divider"></div>

                                        <a title="No of Qty" class="dropdown-item" href="{{ route('book.qty',['id'=>$data->id]) }}"><i class="la la-cart-plus"></i> No of Qty</a>

                                        <a title="Transactions" class="dropdown-item" href="{{ route('transaction.book_transactions',['id'=>$data->id]) }}"><i class="la la-exchange"></i> Transactions</a>

                                        
                                    </div>
                                    <a href="" data-toggle="modal" data-target="#view_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i style="font-size: 20px" class="la la-eye"></i></a>
                        
                                    
                                </td>
                                <td>{{ $data->author->author_name }}</td>
                            </tr>
                            <div class="modal fade" id="view_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                View Book
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <center><img src='{{URL::to("/")}}/images/{{ $data->book_image}}' width="200px" height="200px" style="border-radius: 10px">
                                            </center>
                                            <br>

                                            <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <pre style="font-size: 16px;font-family: arial">Name:               {{ $data->book_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Category:          {{ $data->category->category_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Author:             {{ $data->author->author_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Publisher:         {{ $data->publisher->publisher_name }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Edition:            {{ $data->book_edition }}</pre>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <pre style="font-size: 16px;font-family: arial">Description:  {{ $data->book_description }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Price:            {{ $data->book_price }}</pre>
                                                <hr>
                                                

                                                <pre style="font-size: 16px;font-family: arial">Total Qty:      {{ $total }}</pre>
                                                <hr>
                                                <pre style="font-size: 16px;font-family: arial">Current Qty:  {{ $current }}</pre>
                                                <hr>
                                                @if($data->book_status=='1')
                                                    <pre style="font-size: 16px;font-family: arial">Status:           Active</pre>
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

                            <div class="modal fade" id="delete_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Delete Book
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('book.destroy',$data->id) }}" enctype="multipart/form-data">
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
                                                Update Book
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('book.update',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <center>
                                                        <div class="form-group">
                                                        <img style="border-radius:10px" class="pro_img2" id="pro_img" width="180px" height="200px" src='{{URL::to("/")}}/images/{{ $data->book_image}}' alt="image">
                                                        </div>
                                                    </center>
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Select Image :</strong>
                                                            <input onchange="readURL2(this);" type="file" name="book_image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8 col-sm-8 col-md-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Book Name:</strong>
                                                            <input value="{{$data->book_name}}" type="text" name="book_name" class="form-control" placeholder="Book Name">
                                                        </div>
                                                    </div>
                                                    <div class="row" style="width: 100%;margin-left: 0px">
                                                        <div class="col-xs-6 col-sm-6 col-md-6" >
                                                            <div class="form-group" >
                                                                <strong>Category:</strong>
                                                                <select class = "form-control" name="book_category_id">
                                                                @foreach($categorys as $category)
                                                                         
                                                                @if($category->category_status=='1') 
                                                                        <option value="{{ $category->id }}" {{$data->book_category_id == $category->id ? 'selected' : ''}} >{{ $category->category_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <strong>Author:</strong>
                                                                <select class = "form-control" name="book_author_id">
                                                                @foreach($authors as $author)
                                                                    @if($author->author_status=='1') 
                                                                        <option value="{{ $author->id }}" {{$data->book_author_id == $author->id ? 'selected' : ''}} >{{ $author->author_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="width: 100%;margin-left: 0px">
                                                        <div class="col-xs-6 col-sm-6 col-md-6" >
                                                            <div class="form-group" >
                                                                <strong>Publisher:</strong>
                                                                <select class = "form-control" name="book_publisher_id">
                                                                @foreach($publishers as $publisher)     
                                                                    @if($publisher->publisher_status=='1') 
                                                                        <option value="{{ $publisher->id }}" {{$data->book_publisher_id == $publisher->id ? 'selected' : ''}} >{{ $publisher->publisher_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <strong>Book Edition:</strong>
                                                                <input value="{{$data->book_edition}}" type="text" name="book_edition" class="form-control" placeholder="Book Edition">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Book Description:</strong>
                                                            <input value="{{$data->book_description}}" type="text" name="book_description" class="form-control" placeholder="Book Description">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12" >
                                                       <div class="form-group">
                                                            <strong>Price:</strong>
                                                            <input value="{{$data->book_price}}" type="number" name="book_price" class="form-control" placeholder="Book Price">
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
            <form method="POST" action="{{ route('book.import') }}" enctype="multipart/form-data">
            <div class="modal-body">
                
                @csrf
                 <div class="row">
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
                    Add Book
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <center>
                            <div class="form-group">
                            <img style="border-radius:10px" class="pro_img" id="pro_img" width="180px" height="200px" src="{{ asset('images/user.png') }}" alt="image">
                            </div>
                        </center>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Select Image :</strong>
                                <input onchange="readURL(this);" type="file" name="book_image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Book ID:</strong>
                                    <input type="number" name="book_id" class="form-control" placeholder="Book ID">
                                </div>
                            </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Book Name:</strong>
                                <input type="text" name="book_name" class="form-control" placeholder="Book Name">
                            </div>
                        </div>
                        <div class="row" style="width: 100%;margin-left: 0px">
                            <div class="col-xs-6 col-sm-6 col-md-6" >
                                <div class="form-group" >
                                    <strong>Category:</strong>
                                    <select class = "form-control kt-selectpicker" name="book_category_id">
                                    @foreach($categorys as $data)
                                             
                                    @if($data->category_status=='1') 
                                            <option value="{{ $data->id }}"  >{{ $data->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Author:</strong>
                                    <select class = "form-control kt-selectpicker" name="book_author_id">
                                    @foreach($authors as $data)
                                        @if($data->author_status=='1') 
                                            <option value="{{ $data->id }}"  >{{ $data->author_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%;margin-left: 0px">
                            <div class="col-xs-6 col-sm-6 col-md-6" >
                                <div class="form-group" >
                                    <strong>Publisher:</strong>
                                    <select class = "form-control kt-selectpicker" name="book_publisher_id">
                                    @foreach($publishers as $data)     
                                        @if($data->publisher_status=='1') 
                                            <option value="{{ $data->id }}"  >{{ $data->publisher_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Book Edition:</strong>
                                    <input type="text" name="book_edition" class="form-control" placeholder="Book Edition">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Book Description:</strong>
                                <input type="text" name="book_description" class="form-control" placeholder="Book Description">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                           <div class="form-group">
                                <strong>Price:</strong>
                                <input type="number" name="book_price" class="form-control" placeholder="Book Price">
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
                $('.pro_img')
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