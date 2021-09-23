@extends('c_layout')

@section('c_content')

<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">Ebook</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">Ebook</span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
		<!-- Start Portfolio Area -->
		<section class="wn__portfolio__area gallery__masonry__activation bg--white mt--40 pb--100">
			<div class="tab__container">
				<div class="row">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
					<div class="wn__sidebar">
							<!-- Start Single Widget -->
						<aside class="widget search_widget">
							<h3 class="widget-title">Search</h3>
							<form method="GET" action="{{ route('ebook.search') }}">
								<div class="form-input">
									<input name="search" type="text" placeholder="Search...">
									<button><i class="fa fa-search"></i></button>
								</div>
							</form>
						</aside>
					</div>
				<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
					<div class="row">
						<!-- Start Single Product -->
						@foreach ($ebook as $data)
						@if($data->ebook_status==1)
						<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
							<div class="product__thumb">
								<a class="first__img" href='{{URL::to("/")}}/ebook/{{ $data->ebook_pdf}}' target="_blank"><img
										src='{{URL::to("/")}}/images/{{ $data->ebook_image}}' alt="product image" width="100%" height="350px" ></a>
							</div>
							<div class="content text-center">
								<h5><a href='{{URL::to("/")}}/ebook/{{ $data->ebook_pdf}}' target="_blank">{{$data->ebook_name}}</a></h5>
								<p>By:{{$data->ebook_author}}</p>
							</div>
						</div>
						@endif
						@endforeach
						<!-- End Single Product -->
					</div>
					<div class="col-sm-12 text-center">
						<center>{!! $ebook->links() !!}</center>
					</div>
				</div>
				</div>
				</div>
			</div>
			
		</section>
		<!-- End Portfolio Area -->
		@endsection