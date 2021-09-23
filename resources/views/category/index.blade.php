@extends('layout')

@section('navCategoryListing','kt-menu__item--active')
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
                            Category Datatable
                           
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                
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

                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <form id="del_form" action="{{ route('category.mul_delete') }}" method="post">
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
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($category as $data)
                            <tr>
                                <td>
                                    <label class="kt-checkbox">
                                        <input class="delete_check" onchange="valueChanged()" form="del_form" type="checkbox" name="delid[]" value="{{ $data->id}}"> {{ $data->id}}
                                        <span></span>
                                    </label>
                                </td>
                                <td>{{ $data->category_name }}</td>
                                <td>{{ $data->category_status }}</td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#view_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i style="font-size: 20px" class="la la-eye"></i></a>
                        
                                    <a href="" data-toggle="modal" data-target="#update_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i style="font-size: 20px" class="la la-edit"></i></a>

                                    <a href="" data-toggle="modal" data-target="#delete_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i style="font-size: 20px" class="la la-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="view_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                View Category
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <pre style="font-size: 16px;font-family: arial">ID:             {{ $data->id }}</pre>
                                            <hr>
                                            <pre style="font-size: 16px;font-family: arial">Year:         {{ $data->category_name }}</pre>
                                            <hr>
                                            @if($data->category_status=='1')
                                                <pre style="font-size: 16px;font-family: arial">Status:      Active</pre>
                                            @else
                                                <pre style="font-size: 16px;font-family: arial">Status:      Deactive</pre>
                                            @endif

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
                                                Delete Category
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('category.destroy',$data->id) }}" enctype="multipart/form-data">
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
                                                Update Category
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('category.update',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Category Name:</strong>
                                                    <input type="text" value="{{ $data->category_name }}" name="category_name" class="form-control" placeholder="Category Name">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Category Status:</strong>
                                                    <select class = "form-control" name="category_status">
                                                        <option value="1" {{$data->category_status == '1' ? 'selected' : ''}}>Active</option>
                                                        <option value="2" {{$data->category_status == '2' ? 'selected' : ''}}>Deactive</option>
                                                    </select>
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
                    Add Category
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Name:</strong>
                        <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Status:</strong>
                        <select class = "form-control kt-selectpicker" name="category_status">
                            <option value="1">Active</option>
                            <option value="2">Deactive</option>
                        </select>
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
@endsection