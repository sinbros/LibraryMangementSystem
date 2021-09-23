@extends('c_layout')
@section('c_content')
<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">News</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">News</span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-blog-details section-padding--lg bg--white">
			<div class="container">
				<div class="row">
					@foreach ($news as $data)
					<div class="col-lg-9 col-12">
						<div class="blog-details content">
							<article class="blog-post-details">
								<div class="post-thumbnail">
									<img src='{{URL::to("/")}}/images/{{ $data->news_image}}' alt="blog images">
								</div>
								<div class="post_wrapper">
									<div class="post_header">
										<h2>{{$data->news_title}}</h2>
										<div class="blog-date-categori">
											<ul>
												<li>{{$data->created_at}}</li>
											</ul>
										</div>
									</div>
									<div class="post_content">
										<pre>{{$data->news_des}}</pre>
									</div>
								</div>
							</article>
							
						</div>
					</div>
					@endforeach
					<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
						
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
		
		@endsection