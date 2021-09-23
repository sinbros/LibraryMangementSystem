@extends('c_layout')

@section('c_content')

<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">About Us</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">About Us</span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
		<!-- Start About Area -->
		<div class="page-about about_area bg--white section-padding--lg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title--3 text-center pb--30">
							<h2>About Library</h2>
						</div>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col-lg-6 col-sm-12 col-12">
						<div class="content text-left text_style--2">
							<h2>we have skills to show</h2>
							<div class="skill-container">
								<!-- Start single skill -->
								<div class="single-skill">
									<p>Student Favorites</p>
									<div class="progress">
										<div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
											data-wow-delay=".5s" role="progressbar" aria-valuenow="90" aria-valuemin="0"
											aria-valuemax="100" style="width:90%"><span class="pen-lable"></span>
										</div>
									</div>
								</div>
								<!-- End single skill -->
								<!-- Start single skill -->
								<div class="single-skill">
									<p>Popular Authors</p>
									<div class="progress">
										<div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
											data-wow-delay=".5s" role="progressbar" aria-valuenow="95" aria-valuemin="0"
											aria-valuemax="100" style="width:95%"><span class="pen-lable"></span>
										</div>
									</div>
								</div>
								<!-- End single skill -->
								<!-- Start single skill -->
								<div class="single-skill">
									<p>Bestselling Series</p>
									<div class="progress">
										<div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
											data-wow-delay=".5s" role="progressbar" aria-valuenow="93" aria-valuemin="0"
											aria-valuemax="100" style="width:93%"><span class="pen-lable"></span>
										</div>
									</div>
								</div>
								<!-- End single skill -->
								<!-- Start single skill -->
								<div class="single-skill">
									<p>Bargain Books</p>
									<div class="progress">
										<div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
											data-wow-delay=".5s" role="progressbar" aria-valuenow="90" aria-valuemin="0"
											aria-valuemax="100" style="width:90%"><span class="pen-lable"></span>
										</div>
									</div>
								</div>
								<!-- End single skill -->
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-12">
						<div class="content">
							<h3>Read Book</h3>
							<h2>Different Knowledge</h2>
							<p class="mt--20 mb--20">A library is a curated collection of sources of information and similar resources, selected by experts and made accessible to a defined community for reference or borrowing, often in a quiet environment conducive to study.</p>
							<strong>College Address</strong>
							<p>Near Indian Diamond Institute, City Center, Someshwara Enclave, Vesu, Surat, Gujarat 395007.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End About Area -->
		<!-- Start Team Area -->
		<section class="wn__team__area pb--75 bg--white">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title--3 text-center">
							<h2>Meet our team of experts</h2>
							<p>the right people for your project</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Start Single Team -->
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="wn__team">
							<div class="thumb">
								<img src="{{ asset('images/Vaibhav-Desai.jpg')}}" alt="Team images">
							</div>
							<div class="content text-center">
								<h4>Prof. Vaibhav Desai</h4>
								<p>HOD</p>
							</div>
						</div>
					</div>
					<!-- End Single Team -->
					<!-- Start Single Team -->
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="wn__team">
							<div class="thumb">
								<img src="{{ asset('images/Vimal-Vaiwala.jpg')}}" alt="Team images">
							</div>
							<div class="content text-center">
								<h4>Prof. Vimal Vaiwala</h4>
								<p>ASSISTANT PROFESSOR</p>
							</div>
						</div>
					</div>
					<!-- End Single Team -->
					<!-- Start Single Team -->
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="wn__team">
							<div class="thumb">
								<img src="{{ asset('images/Sanjay-Bhatt.jpg')}}" alt="Team images">
							</div>
							<div class="content text-center">
								<h4>Mr. Sanjay Bhatt</h4>
								<p>LIBRARIAN</p>
							</div>
						</div>
					</div>
					<!-- End Single Team -->
					
				</div>
			</div>
		</section>
		<!-- End Team Area -->
		@endsection