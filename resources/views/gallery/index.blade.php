@extends('layout')

@section('navGalleryMenu','kt-menu__item--active')


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
                            Gallery Datatable
                           
                        </h3>
                    </div>

                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    
                                </div>
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
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <table class="kt-datatable table-hover" id="html_table" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gallery as $data)
                            <tr>
                                <td>{{ $data->id}}</td>
                                <td><img style="border-radius:10px" src='{{URL::to("/")}}/images/{{ $data->gallery_image}}' width="100px" height="100px"> </td>
                                <td>{{ $data->gallery_name }}</td>
                                <td>{{ $data->gallery_category }}</td>
                                <td>{{ $data->gallery_status }}</td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#update_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i style="font-size: 20px" class="la la-edit"></i></a>

                                    <a href="" data-toggle="modal" data-target="#delete_modal_{{ $data->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i style="font-size: 20px" class="la la-trash"></i></a>
                                    
                                </td>
                                
                                <th></th>
                            </tr>
                            <div class="modal fade" id="delete_modal_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Delete Gallery
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('gallery.destroy',$data->id) }}" enctype="multipart/form-data">
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
                                                Update Gallery
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('gallery.update',$data->id) }}" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <center>
                                                        <div class="form-group">
                                                        <img style="border-radius:10px" class="pro_img2" id="pro_img" width="180px" height="200px" src='{{URL::to("/")}}/images/{{ $data->gallery_image}}' alt="image">
                                                        </div>
                                                    </center>
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Select Image :</strong>
                                                            <input onchange="readURL2(this);" type="file" name="gallery_image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8 col-sm-8 col-md-8">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Gallery Name:</strong>
                                                            <input value="{{$data->gallery_name}}" type="text" name="gallery_name" class="form-control" placeholder="Gallery Name">
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Gallery Category:</strong>
                                                            <input value="{{$data->gallery_category}}" type="text" name="gallery_category" class="form-control" placeholder="Gallery Category">
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Image Status:</strong>
                                                            <select class = "form-control " name="gallery_status">
                                                                <option value="1" {{$data->gallery_status == '1' ? 'selected' : ''}}>Active</option>
                                                                <option value="2" {{$data->gallery_status == '2' ? 'selected' : ''}}>Deactive</option>
                                                            </select>
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

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Gallery
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
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
                                <input onchange="readURL(this);" type="file" name="gallery_image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Gallery Name:</strong>
                                <input type="text" name="gallery_name" class="form-control" placeholder="Gallery Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Gallery Category:</strong>
                                <input type="text" name="gallery_category" class="form-control" placeholder="Gallery Category">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Image Status:</strong>
                                <select class = "form-control kt-selectpicker" name="gallery_status">
                                    <option value="1">Active</option>
                                    <option value="2">Deactive</option>
                                </select>
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