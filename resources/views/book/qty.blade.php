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
                                <a title="Go Back" class="btn btn-danger" style="font-size: 16px;margin: 20px" href="{{ route('book.index') }}"><i class="la la-angle-double-left"></i>Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-sm-8">
                            @foreach ($book as $data)
                            <br><br>
                            <?php 
                                $book_id = $data->id;
                            ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <td rowspan="4"><img src='{{URL::to("/")}}/images/{{ $data->book_image}}' width="200px" height="200px" style="border-radius: 10px"></td>
                                        <td>ID : {{ $data->id }}</td>
                                        <td>Name : {{ $data->book_name }}</td>
                                        <td>Category : {{ $data->category->category_name }}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Author : {{ $data->author->author_name }}</td>
                                        <td>Publisher : {{ $data->publisher->publisher_name }}</td>
                                        <td>Edition : {{ $data->book_edition }}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Price : {{ $data->book_price }}</td>
                                        <td>Total Qty : {{ $total_qty }}</td>
                                        <td>Current Qty : {{ $current_qty }}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3">Description : {{ $data->book_description }}</td>
                                    </tr>
                                </table>
                                <br><br>
                                @endforeach
                        </div>
                    </div>
                    
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
                                                    <option value="5">Available</option>
                                                    <option value="6">Not Available</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                    </div>

                                    <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
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
                                        <form id="del_form" action="{{ route('accession.mul_delete') }}" method="post">
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
                                <th>Accession No</th>
                                <th>Place</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($accession as $data)
                            <tr>
                                <td>
                                    <label class="kt-checkbox">
                                        <input class="delete_check" onchange="valueChanged()" form="del_form" type="checkbox" name="delid[]" value="{{ $data->id}}"> {{ $data->id}}
                                        <span></span>
                                    </label>
                                </td>
                                <td>{{ $data->accession_no }}</td>
                                <td>{{ $data->place }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <div class="dropdown dropdown-inline">
                                    
                                    <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        
                                        <a data-toggle="modal" data-target="#update_modal_{{ $data->id }}" title="Update" class="dropdown-item" href="#"><i class="la la-edit"></i> Update</a>

                                        <div class="dropdown-divider"></div>

                                        <a title="QR Code" class="dropdown-item" href="{{ route('book.qr_code',['id'=>$data->id]) }}"><i class="la la-qrcode"></i> Genetate QR Code</a>

                                        <a title="Transactions" class="dropdown-item" href="{{ route('transaction.accession_transactions',['id'=>$data->id]) }}"><i class="la la-exchange"></i> Transactions</a>
                                        
                                    </div>
                                    <a href="" data-toggle="modal" data-target="#delete_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i style="font-size: 20px" class="la la-trash"></i></a>
                        
                                    
                                </td>
                                <td></td>
                            </tr>
                            

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
                                        <form method="POST" action="{{ route('accession.destroy',$data->id) }}" enctype="multipart/form-data">
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
                                                Update Book Qty
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('accession.update',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Accession No:</strong>
                                                    <input value="{{$data->accession_no}}" type="text" name="accession_no" class="form-control" placeholder="Accession No">
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Place:</strong>
                                                    <input value="{{$data->place}}" type="text" name="place" class="form-control" placeholder="Place">
                                                </div>
                                            </div>
                                            <input value="{{ $book_id }}" type="text" name="book_id" hidden>  
                                            @csrf
                                            @method('PUT') 
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Book Qty
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('accession.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Accession No:</strong>
                        <input type="text" name="accession_no" class="form-control" placeholder="Accession No">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Place:</strong>
                        <input type="text" name="place" class="form-control" placeholder="Place">
                    </div>
                </div>
                <input value="{{ $book_id }}" type="text" name="book_id" hidden>   
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