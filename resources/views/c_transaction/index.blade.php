@extends('c_layout')

@section('c_content')

<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">Transaction</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">Transaction</span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
		<!-- Start Contact Area -->
		<section class="wn_contact_area bg--white pt--80 pb--80">
			
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
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
						<div class="contact-form-wrap">
							<h2 class="contact__title">Get Your Transactions Details</h2>
							<form method="GET" action="{{ route('transaction.get_transaction') }}">
								@csrf
								<div class="single-contact-form space-between">
									<input type="number" name="student_id" placeholder="Enter Student ID*">
									<input type="number" name="student_dob" placeholder="Enter Your DOB : DDMMYYYY*">
								</div>
								
								<div class="contact-btn">
									<button type="submit">Get</button>
								</div>
							</form>
						</div>
						<div class="form-output">
							<p class="form-messege">
						</div>
					</div>
					
				</div>
			</div>
			@if($havedata=="True")
			<div class="container-fluid" style="margin-top: 20px">
				<div class="row">
					<div class="col-md-12 col-sm-12 ol-lg-12">
						<div class="table-content wnro__table table-responsive">
							<table>
								<thead>
									<tr class="title-top">
										<th>Transaction ID</th>
										<th>Image</th>
										<th>BookID/Accession No</th>
										<th>Book Name</th>
										<th>Issue Date</th>
										<th>Return Date</th>
										<th>Delay Days</th>
										<th>Fine Aount</th>
										<th>Actual Return Date</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($transaction as $data)
									<tr>
										<td>{{ $data->id}}</td>
										<td>
											<img style="border-radius:10px" src='{{URL::to("/")}}/images/{{ $data->accession->book->book_image}}' width="100px" height="100px">
										</td>
										<td>{{ $data->accession->book->book_id}}/{{ $data->accession->accession_no}}</td>
										<td>{{ $data->accession->book->book_name}}</td>
										<td>{{ $data->from_date}}</td>
										<td>{{ $data->to_date}}</td>
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

                                		@if($data->status=="3")
										<td>{{$days}}</td>
										<td>{{$days*10}}</td>					
										@else
										<td>Returned</td>
										<td>Returned</td>
										@endif

										<td>
											@if($data->actual_return_date)
											{{ $data->actual_return_date}}
											@else
											<strong style="color:red">Pending</strong>
											@endif
										</td>

									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			@endif
		</section>
		<!-- End Contact Area -->
		@endsection