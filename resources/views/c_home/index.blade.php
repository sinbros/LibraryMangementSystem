@extends('c_layout')

@section('c_content')

<!-- Start Slider area -->
		<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
			<!-- Start Single Slide -->
			<div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider__content">
								<div class="contentbox">
									<h2>Read <span>your </span></h2>
									<h2>favourite <span>Book </span></h2>
									<h2>from <span>Here </span></h2>
									<a class="shopbtn" href="/ebooks">Read now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Slide -->
			<!-- Start Single Slide -->
			<div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider__content">
								<div class="contentbox">
									<h2>Read <span>your </span></h2>
									<h2>favourite <span>Book </span></h2>
									<h2>from <span>Here </span></h2>
									<a class="shopbtn" href="/ebooks">Read now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Slide -->
		</div>
		<!-- End Slider area -->
		<!-- Start BEst Seller Area -->
		<section class="wn__product__area brown--color pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">New <span class="color--theme">Books</span></h2>
						</div>
					</div>
				</div>
				<!-- Start Single Tab Content -->
				<div class="furniture--4 border--round arrows_style owl-carousel owl-theme mt--50">
					<!-- Start Single Product -->
					@foreach ($book as $data)
					<div class="product product__style--3">
						<div class="product__thumb">
							<a class="first__img" href="single-product.html"><img src='{{URL::to("/")}}/images/{{ $data->book_image}}'
									alt="product image" width="200px" height="300px"></a>
							
						</div>
						<div class="product__content content--center">
							<h4><a href="single-product.html">{{ $data->book_name}}</a></h4>
							<ul class="prize d-flex">
								<li>By:{{ $data->author->author_name}}</li>
							</ul>
						</div>
					</div>
					@endforeach
				</div>
				<!-- End Single Tab Content -->
			</div>
		</section>
		<!-- Start BEst Seller Area -->
		<!-- Start NEwsletter Area -->
		<section class="wn__newsletter__area bg-image--2">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
						<div class="section__title text-center">
							<h2>Stay With Us</h2>
						</div>
						<div class="newsletter__block text-center">
							<p>Subscribe to our newsletters now and stay up-to-date with new collections, the latest
								lookbooks and exclusive offers.</p>
							<form action="#">
								<div class="newsletter__box">
									<input type="email" placeholder="Enter your e-mail">
									<button>Subscribe</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End NEwsletter Area -->
		
		<!-- Start Recent Post Area -->
		<section class="wn__recent__post bg--gray ptb--80">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">Latest <span class="color--theme">News</span></h2>
						</div>
					</div>
				</div>
				<div class="row mt--20">
					@foreach ($news as $data)
					@if($data->news_status==1)
					<div class="col-md-6 col-lg-4 col-sm-12" style="margin-bottom: 20px">
						<div class="post__itam">
							<div class="content">
								<img src='{{URL::to("/")}}/images/{{ $data->news_image}}' alt="product image" width="100%" height="250px">
								<h3><a href="{{ route('news.view_news',['id'=>$data->id]) }}">{{$data->news_title}}</a></h3>
								<div class="post__time">
									<span class="day">{{$data->created_at}}</span>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endforeach
				</div>
				<div class="row text-center">
					<div class="col-sm-12">
						<a href="/news" class="text-center" style="font-size: 18px">View More</a>
					</div>
				</div>
			</div>
		</section>
		<!-- End Recent Post Area -->
		
		@endsection