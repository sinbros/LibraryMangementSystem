@extends('c_layout')

@section('c_content')

<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area bg-image--6">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title" style="color: black">Books in Library</h2>
							<nav class="bradcaump-content">
								<a class="breadcrumb_item" href="/" style="color: black">Home</a>
								<span class="brd-separetor" style="color: black">/</span>
								<span class="breadcrumb_item active">Book</span>
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
							<form method="GET" action="{{ route('book.search') }}">
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
						@foreach ($book as $data)
                             <?php
                                $current=0;
                            ?>
                            @foreach ($book_current_qty as $current_qty)
                                @if($data->id == $current_qty->book_id)
                                    <?php $current=$current_qty->total; ?>
                                @endif
                            @endforeach
						<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
							<div class="product__thumb">
								<a class="first__img" href=''><img width="100%" height="350px" 
										src='{{URL::to("/")}}/images/{{ $data->book_image}}' alt="book image"></a>
								<div class="hot__box">
									<span class="hot-label">
										@if ($current>0)
											Available
										@else
											Not Available
										@endif
									</span>
								</div>
							</div>
							<div class="content text-center">
								<h5><a href=''>{{$data->book_name}}</a></h5>
								<p>By:{{$data->author->author_name}}</p>
							</div>

						</div>
						@endforeach
						<!-- End Single Product -->

					</div>
					<div class="col-sm-12 text-center">
						<center>{!! $book->links() !!}</center>
					</div>
				</div>
				</div>
				</div>
			</div>
			
		</section>
		<!-- End Portfolio Area -->
		@endsection