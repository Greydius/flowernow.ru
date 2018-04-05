<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<!-- CSRF Token -->
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <title>{{ config('app.name', 'Laravel') }}</title>

		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<link href="{{ asset('assets/admin/fonts/raleway/raleway.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Web font -->
		<!--begin::Base Styles -->
		<link href="{{ asset('assets/admin/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/admin/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/admin/css/custom.css?v=1') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		@yield('head')
		
		<link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" type="image/x-icon">

		<script type="text/javascript">
			var jsonData={};
			var routes = {};
			routes.shop = '{{ route('admin.api.shop.profile') }}';
			routes.products = '{{ route('admin.api.products.list') }}';
			routes.productDelete = '/admin/api/v1/product/delete/';
			routes.orders = '{{ route('admin.api.orders.list') }}';
		</script>

	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body  ng-app="flowApp" class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="/" class="m-brand__logo-wrapper">
										<img alt="floristum.ru" src="{{ asset('images/logo_rectangle_white.png') }}">
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">
									<!-- BEGIN: Left Aside Minimize Toggle -->
									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block
					 ">
										<span></span>
									</a>
									<!-- END -->
									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->

								</div>
							</div>
						</div>

						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
								<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
										<a  href="{{ route('logout') }}" class="m-menu__link">
											<i class="m-menu__link-icon flaticon-logout"></i>
											<span class="m-menu__link-text">
												Выход
											</span>
										</a>
									</li>

									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
										<a  href="{{ route('admin.shop.profile') }}" class="m-menu__link">
											<span class="m-menu__link-text">
												Магазин: {{ $user->getShop()->name . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( id:'.$user->getShop()->id.')' }}
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</header>
			<!-- END: Header -->
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
					<div
		id="m_ver_menu"
		class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
		data-menu-vertical="true"
		 data-menu-scrollable="false" data-menu-dropdown-timeout="500"
		>
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

							<li class="m-menu__item {{ in_array(\Request::route()->getName(), ['admin.orders', 'admin.order.view']) ? 'm-menu__item--active' : null }}">
								<a  href="{{ route('admin.orders') }}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-cart"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Заказы
											</span>

										</span>
									</span>

									<span class="m-menu__link-badge">
										<span class="m-badge m-badge--danger" data-toggle="tooltip" data-placement="top" data-original-title="Не завершенные">
											{{$user->totalNotCompletedOrders()}}
										</span>
									</span>
								</a>
							</li>

							<li class="m-menu__item {{ \Request::route()->getName() == 'admin.products' ? 'm-menu__item--active' : null }}">
								<a  href="{{ route('admin.products') }}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-open-box"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Товары
											</span>

										</span>
									</span>
									<span class="m-menu__link-badge">
										<span class="m-badge m-badge--info" data-toggle="tooltip" data-placement="top" data-original-title="Всего">
											{{$user->totalProducts()}}
										</span>
									</span>

									<span class="m-menu__link-badge">
										<span class="m-badge m-badge--danger" data-toggle="tooltip" data-placement="top" data-original-title="Не прошедщих модерацию">
											{{$user->totalProducts([0, 3])}}
										</span>
									</span>
								</a>
							</li>

							@if(!$user->admin)
							<li class="m-menu__item {{ \Request::route()->getName() == 'admin.shop.profile' ? 'm-menu__item--active' : null }}" >
								<a  href="{{ route('admin.shop.profile') }}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-profile-1"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Профиль
											</span>

										</span>
									</span>
								</a>
							</li>
							@endif

							@if($user->admin)
								<li class="m-menu__item {{ \Request::route()->getName() == 'admin.shop.list' ? 'm-menu__item--active' : null }}">
									<a href="{{ route('admin.shop.list') }}" class="m-menu__link ">
										<i class="m-menu__link-icon flaticon-profile-1"></i>
										<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Магазины
											</span>

										</span>
									</span>
									</a>
								</li>
							@endif

							<li class="m-menu__item {{ \Request::route()->getName() == 'admin.finance' ? 'm-menu__item--active' : null }}">
								<a href="{{ $user->admin ?  route('admin.invoices') : route('admin.finance') }}" class="m-menu__link ">
									<i class="m-menu__link-icon fa fa-money"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Финансы
											</span>

										</span>
									</span>
								</a>
							</li>
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->



				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<div class="m-content">

						@if (Session::has('layoutWarning'))



							<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-brand alert-{{ Session::get('layoutWarning')['type'] }} fade show" role="alert">
								<div class="m-alert__icon">
									<i class="flaticon-exclamation-1"></i>
									<span></span>
								</div>
								<div class="m-alert__text">
									{{ Session::get('layoutWarning')['text'] }}
								</div>
								<div class="m-alert__close">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
								</div>
							</div>

						@endif

						@yield('content')

					</div>

				</div>




			</div>
			<!-- end:: Body -->
			<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								{{ date('Y') }} &copy;
							</span>
						</div>


					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->

		<!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->

		<!--begin::Base Scripts -->
		<script src="{{ asset('assets/admin/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"  ></script>
		<script src="{{ asset('assets/admin/ng/angular-modal-service.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/admin/ng/angular-sanitize.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/admin/ng/ngApp.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/admin/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/admin/js/custom.js') }}" type="text/javascript"></script>
		@yield('footer')

		<script type="text/javascript">
			jsonData.shop = {!! $shop->toJson() !!};
			angular.module("flowApp").constant("CSRF_TOKEN", '{{ csrf_token() }}');
    	</script>
		<!--end::Base Scripts -->

	</body>
	<!-- end::Body -->
</html>
