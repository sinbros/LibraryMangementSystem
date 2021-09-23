<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Library</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
		
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent">

		<!-- begin::Page loader -->

		<!-- end::Page Loader -->

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="index.html">
					<img alt="Logo" src="assets/media/logos/logo-2-sm.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
						<div class="kt-header__top">
							<div class="kt-container ">

								<!-- begin:: Brand -->
								<div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
									<div class="kt-header__brand-logo">
										<a href="index.html">
											<img alt="Logo" src="{{ asset('assets/media/logos/logo-2.png')}}" class="kt-header__brand-logo-default" />
											<img alt="Logo" src="{{ asset('assets/media/logos/logo-2-sm.png')}}" class="kt-header__brand-logo-sticky" />
										</a>
									</div>
									<div class="m-stack__item m-stack__item--middle m-brand__logo">
										<a  href="{{ url('/admin') }}" class="m-menu__link m-menu__toggle" style="color: white;font-size: 22px;text-decoration:none ">
											
											<span class="m-menu__link-text">
												  &nbsp&nbsp Library
											</span>
										</a>
									</div>
								</div>

								<!-- end:: Brand -->

								<!-- begin:: Header Topbar -->
								<div class="kt-header__topbar">

									<!--begin: User bar -->
									<div class="kt-header__topbar-item kt-header__topbar-item--user">
										<div  class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px" aria-expanded="false">
											<span class="kt-header__topbar-welcome">Hi,</span>
											<span class="kt-header__topbar-username">{{ Auth::user()->name }}</span>

											<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
											<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden-" style="text-transform: uppercase;">{{ Auth::user()->name[0] }}</span>
										</div>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

											<!--begin: Head -->
											<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg')}})">
												<div class="kt-user-card__avatar">
													<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

													<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
													<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success" style="text-transform: uppercase;">{{ Auth::user()->name[0] }}</span>
												</div>
												<div class="kt-user-card__name">
													{{ Auth::user()->name }}
												</div>
											</div>

											<!--end: Head -->

											<!--begin: Navigation -->
											<div class="kt-notification">
												
												<div class="kt-notification__custom kt-space-between">
													<a href="{{ route('logout') }}" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
													<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				                                        @csrf
				                                    </form>
												</div>
											</div>

											<!--end: Navigation -->
										</div>
									</div>

									<!--end: User bar -->
								</div>

								<!-- end:: Header Topbar -->
							</div>
						</div>
						<div class="kt-header__bottom">
							<div class="kt-container ">

								<!-- begin: Header Menu -->
								<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
								<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
									<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
										<ul class="kt-menu__nav ">
											<li class="@yield('navDashboardMenu') kt-menu__item  " data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{ url('/admin') }}" class="kt-menu__link"><span class="kt-menu__link-text">Dashboards</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												
											</li>
											<li class="@yield('navMasterTableMenu') kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Master Tables</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
													<ul class="kt-menu__subnav">
														<li class="@yield('navStudentsMenu') kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg></span><span class="kt-menu__link-text">Students</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
															<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
																<ul class="kt-menu__subnav">
																	<li class="@yield('navStudentListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('student.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Student</span></a></li>
																	<li class="@yield('navCollegeListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('college.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">College</span></a></li>
																	<li class="@yield('navDepartmentListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('department.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Department</span></a></li>
																	<li class="kt-menu__item @yield('navBatchListing')" aria-haspopup="true"><a href="{{ route('batch.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Batch</span></a></li>
																	
																</ul>
															</div>
														</li>
														<li class="@yield('navBooksMenu') kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"/>
													        <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"/>
													        <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"/>
													    </g>
													</svg></span><span class="kt-menu__link-text">Books</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
															<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
																<ul class="kt-menu__subnav">
																	<li class="@yield('navBookListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('book.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Book</span></a></li>
																	<li class="@yield('navPublisherListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('publisher.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Publisher</span></a></li>
																	<li class="@yield('navAuthorListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('author.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Author</span></a></li>
																	<li class="kt-menu__item @yield('navCategoryListing')" aria-haspopup="true"><a href="{{ route('category.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Category</span></a></li>
																	
																</ul>
															</div>
														</li>
														<li class="@yield('navStaffMenu') kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <polygon points="0 0 24 0 24 24 0 24"/>
													        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
													        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
													    </g>
													</svg></span><span class="kt-menu__link-text">Staff</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
															<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
																<ul class="kt-menu__subnav">
																	
																	<li class="@yield('navAdminListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('admin.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Admin</span></a></li>
																</ul>
															</div>
														</li>

														<li class="@yield('navTransactionsMenu') kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <polygon points="0 0 24 0 24 24 0 24"/>
													        <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
													        <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
													        <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
													        <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
													    </g>
													</svg></span><span class="kt-menu__link-text">Transaction</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
															<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
																<ul class="kt-menu__subnav">
																	<li class="@yield('navTransactionsListing') kt-menu__item " aria-haspopup="true"><a href="{{ route('transaction.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Transactions</span></a></li>
																</ul>
															</div>
														</li>
													</ul>
												</div>
											</li>

											<li class="@yield('navContactMenu') kt-menu__item  " data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{ route('contact.indexadmin') }}" class="kt-menu__link"><span class="kt-menu__link-text">Contact</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>

											<li class="@yield('navGalleryMenu') kt-menu__item  " data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{ route('gallery.index') }}" class="kt-menu__link"><span class="kt-menu__link-text">Gallery</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>

											<li class="@yield('navEbookMenu') kt-menu__item  " data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{ route('ebook.index') }}" class="kt-menu__link"><span class="kt-menu__link-text">E Book</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											<li class="@yield('navNewsMenu') kt-menu__item  " data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{ route('news.index') }}" class="kt-menu__link"><span class="kt-menu__link-text">News</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											
										</ul>
									</div>
									<div class="kt-header-toolbar">
										<div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact" id="kt_quick_search_inline">
											<form method="get" class="kt-quick-search__form">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
													<input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
													<div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close" style="display: none;"></i></span></div>
												</div>
											</form>
											<div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,10px"></div>
											<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
												<div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- end: Header Menu -->
							</div>
						</div>
					</div>

					<!-- end:: Header -->
					@yield('content')

					<!-- begin:: Footer -->
					<div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer">
						<div class="kt-footer__top">
							<div class="kt-container ">
								<div class="row">
									<div class="col-lg-4">
										<div class="kt-footer__section">
											<h3 class="kt-footer__title">About</h3>
											<div class="kt-footer__content">
												A library is a curated collection of sources of information and similar resources, selected by experts and made accessible to a defined community for reference or borrowing, often in a quiet environment conducive to study.
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="kt-footer__section">
											<h3 class="kt-footer__title">Quick Links</h3>
											<div class="kt-footer__content">
												<div class="kt-footer__nav">
													<div class="kt-footer__nav-section">
														<a href="/">Go to Website</a>
														<a href="/admin">Dashboard</a>
														<a href="/admin/student">Students</a>
													</div>
													<div class="kt-footer__nav-section">
														<a href="/admin/book">Books</a>
														<a href="/admin/news">News</a>
														<a href="/admin/gallery">Gallery</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-footer__bottom">
							<div class="kt-container ">
								<div class="kt-footer__wrapper">
									<div class="kt-footer__logo">
										<a href="index.html">
											<img alt="Logo" src="{{asset('assets/media/logos/logo-2-sm.png')}}">
										</a>
										<div class="kt-footer__copyright">
											2020&nbsp;&copy;&nbsp;
											<a href="https://www.sinbros.com" target="_blank">sinbros.com</a>
										</div>
									</div>
									<div class="kt-footer__menu">
										<a href="https://www.sinbros.com" target="_blank">About</a>
										<a href="https://www.sinbros.com" target="_blank">Team</a>
										<a href="https://www.sinbros.com" target="_blank">Contact</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->


		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#374afb",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->
		<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="{{ asset('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/js/pages/crud/metronic-datatable/base/html-table.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
		
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>