@extends('c_layout')

@section('c_content')

<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">Gallery</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">Gallery</span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
		<!-- Start Portfolio Area -->
		<section class="wn__portfolio__area gallery__masonry__activation bg--white mt--40 pb--100">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="gallery__menu">
							<button data-filter="*" class="is-checked">All</button>
							<button data-filter=".cat--1">Library</button>
							<button data-filter=".cat--2">Students</button>
						</div>
					</div>
				</div>
				<div class="row masonry__wrap">
					<!-- Start Single Portfolio -->
					@foreach ($gallery as $data)
					@if($data->gallery_category=="Library" && $data->gallery_status==1)
					<div class="col-lg-4 col-md-6 col-sm-6 col-12 gallery__item cat--1">
						<div class="portfolio">
							<div class="thumb">
								<a href="">
									<img src='{{URL::to("/")}}/images/{{ $data->gallery_image}}' alt="portfolio images">
								</a>
								<div class="search">
									<a href='{{URL::to("/")}}/images/{{ $data->gallery_image}}' data-lightbox="grportimg"
										data-title="My caption"><i class="zmdi zmdi-search"></i></a>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endforeach
					<!-- End Single Portfolio -->

					<!-- Start Single Portfolio -->
					@foreach ($gallery as $data)
					@if($data->gallery_category=="Students" && $data->gallery_status==1)
					<div class="col-lg-4 col-md-6 col-sm-6 col-12 gallery__item cat--2">
						<div class="portfolio">
							<div class="thumb">
								<a href="">
									<img src='{{URL::to("/")}}/images/{{ $data->gallery_image}}' alt="portfolio images">
								</a>
								<div class="search">
									<a href='{{URL::to("/")}}/images/{{ $data->gallery_image}}' data-lightbox="grportimg"
										data-title="My caption"><i class="zmdi zmdi-search"></i></a>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endforeach
					<!-- End Single Portfolio -->
					
				</div>
			</div>
		</section>
		<!-- End Portfolio Area -->
		@endsection