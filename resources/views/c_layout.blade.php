<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/boighor-preview/boighor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Mar 2020 18:19:02 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Libary</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('client/images/favicon.ico') }}">
	<link rel="apple-touch-icon" href="{{ asset('client/images/icon.png') }}">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('client/css/plugins.css') }}">
	<link rel="stylesheet" href="{{ asset('client/style.css') }}">

	<!-- Cusom css -->
	<link rel="stylesheet" href="{{ asset('client/css/custom.css') }}">

	<!-- Modernizer js -->
	<script src="{{ asset('client/js/vendor/modernizr-3.5.0.min.js') }}"></script>
</head>

<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="wn__header" class="header__area header__absolute sticky__header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-1 col-sm-1 col-1 col-lg-1">
						<div class="logo">
							<a href="index.html">
								<img src="{{ asset('client/images/logo/logo.png') }}" alt="logo images">
							</a>
						</div>
					</div>
					<div class="col-lg-8 d-none d-lg-block">
						<nav class="mainmenu__nav">
							<ul class="meninmenu d-flex justify-content-start">
								<li class="drop with--one--item"><a href="{{ url('/') }}">Home</a></li>
								<li><a href="{{ url('/books') }}">Book</a></li>
								<li><a href="{{ url('/ebooks') }}">EBook</a></li>
								<li><a href="{{ url('/news') }}">News</a></li>
								<li><a href="{{ url('/gallery') }}">Gallery</a></li>
								<li><a href="{{ url('/about') }}">About</a></li>
								<li><a href="{{ route('contact.index') }}">Contact</a></li>
								<li><a href="{{ route('transaction.cindex') }}">Tansactions</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- Start Mobile Menu -->
				<div class="row d-none">
					<div class="col-lg-12 d-none">
						<nav class="mobilemenu__nav">
							<ul class="meninmenu">
								<li class="drop with--one--item"><a href="{{ url('/') }}">Home</a></li>
								<li><a href="{{ url('/books') }}">Books</a></li>
								<li><a href="{{ url('/ebooks') }}">E Books</a></li>
								<li><a href="{{ url('/news') }}">News</a></li>
								<li><a href="{{ url('/gallery') }}">Gallery</a></li>
								<li><a href="{{ url('/about') }}">About</a></li>
								<li><a href="{{ route('contact.index') }}">Contact</a></li>
								<li><a href="">Get Tansaction Detail</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- End Mobile Menu -->
				<div class="mobile-menu d-block d-lg-none">
				</div>
				<!-- Mobile Menu -->
			</div>
		</header>
		<!-- //Header -->
		<!-- Start Search Popup -->
		<div class="brown--color box-search-content search_active block-bg close__top">
			<form id="search_mini_form" class="minisearch" action="#">
				<div class="field__search">
					<input type="text" placeholder="Search entire store here...">
					<div class="action">
						<a href="#"><i class="zmdi zmdi-search"></i></a>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
		</div>
		<!-- End Search Popup -->
		@yield('c_content')
		<!-- QUICKVIEW PRODUCT -->

		<!-- Footer Area -->
		<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
			<div class="footer-static-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="footer__widget footer__menu">
								<div class="ft__logo">
									<a href="index.html">

										<img src="{{ asset('client/images/logo/3.png') }}" alt="logo">
									</a>
								</div>
								<div class="footer__content">
									<ul class="social__net social__net--2 d-flex justify-content-center">
										<li><a href="#"><i class="bi bi-facebook"></i></a></li>
										<li><a href="#"><i class="bi bi-google"></i></a></li>
										<li><a href="#"><i class="bi bi-twitter"></i></a></li>
										<li><a href="#"><i class="bi bi-linkedin"></i></a></li>
										<li><a href="#"><i class="bi bi-youtube"></i></a></li>
									</ul>
									<ul class="mainmenu d-flex justify-content-center">
										<li><a href="/books">Books</a></li>
										<li><a href="/ebooks">EBooks</a></li>
										<li><a href="/news">News</a></li>
										<li><a href="/gallery">Gallery</a></li>
										<li><a href="/about">About</a></li>
										<li><a href="/contact">Contact</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright__wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="copyright">
								<div class="copy__right__inner text-center">
									<p>Copyright <i class="fa fa-copyright"></i> <a href="https://www.sinbros.com">Sinbros.</a> All Rights
										Reserved</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="payment text-right">
								<img src="images/icons/payment.png" alt="" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- //Footer Area -->
		
	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="{{ asset('client/js/vendor/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('client/js/popper.min.js') }}"></script>
	<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('client/js/plugins.js') }}"></script>
	<script src="{{ asset('client/js/active.js') }}"></script>

</body>


<!-- Mirrored from demo.hasthemes.com/boighor-preview/boighor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Mar 2020 18:20:39 GMT -->
</html>