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
		<!-- End Bradcaump area -->
		<section class="wn__recent__post bg--gray ptb--40">
			<div class="container">
				<div class="row">
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
			</div>
		</section>
		@endsection