@extends('c_layout')

@section('c_content')

<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">Contact Us</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">Contact Us</span>
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
							<h2 class="contact__title">Get in touch</h2>
							<form method="POST" action="{{ route('contact.store') }}">
								@csrf
								<div class="single-contact-form space-between">
									<input type="text" name="contact_name" placeholder="Enter Name*">
									<input type="number" name="contact_no" placeholder="Contact No*">
								</div>
								<div class="single-contact-form space-between">
									<input type="email" name="contact_email" placeholder="Email*">
									<input type="text" name="contact_sub" placeholder="Subject*">
								</div>
								<div class="single-contact-form message">
									<textarea name="contact_msg" placeholder="Type your message here.."></textarea>
								</div>
								<div class="contact-btn">
									<button type="submit">Send</button>
								</div>
							</form>
						</div>
						<div class="form-output">
							<p class="form-messege">
						</div>
					</div>
					<div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
						<div class="wn__address">
							<h2 class="contact__title">Get office info.</h2>
							<div class="wn__addres__wreapper">

								<div class="single__address">
									<i class="icon-location-pin icons"></i>
									<div class="content">
										<span>address:</span>
										<p>Near Indian Diamond Institute, City Center, Someshwara Enclave, Vesu, Surat, Gujarat 395007.</p>
									</div>
								</div>

								<div class="single__address">
									<i class="icon-phone icons"></i>
									<div class="content">
										<span>Phone Number:</span>
										<p>+91 261 2218175</p>
									</div>
								</div>

								<div class="single__address">
									<i class="icon-envelope icons"></i>
									<div class="content">
										<span>Email address:</span>
										<p>contact@sdjic.com</p>
									</div>
								</div>

								<div class="single__address">
									<i class="icon-globe icons"></i>
									<div class="content">
										<span>website address:</span>
										<p>www.sdjic.org</p>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="google__map pb--80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div id="googleMap">
								<iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.1829090220135!2d72.77638131476536!3d21.145117985935386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be05274e362b3e3%3A0x672dfe4f512e4d87!2sSDJ%20International%20College!5e0!3m2!1sen!2sin!4v1595854563029!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact Area -->
		@endsection