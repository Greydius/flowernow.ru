<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<link href="{{ asset('assets/admin/fonts/raleway/raleway.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Web font -->
		<!--begin::Base Styles -->
		<link href="{{ asset('assets/admin/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/admin/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="../../../assets/demo/default/media/img/logo/favicon.ico" />
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--singin m-login--signup" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid">
							<div class="m-login__wrapper">
								<div class="m-login__logo">
									<a href="#">
										<img src="{{ asset('assets/admin/img/logo_square_min.png') }}">
									</a>
								</div>

								<div class="m-login__signup">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Регистрация
                                        </h3>
                                        <div class="m-login__desc">
                                            Введите данные для создания учетной записи:
                                        </div>
                                    </div>
                                    <form class="m-login__form m-form" method="POST" action="{{ route('register.check.data') }}" id="register_form">
                                        {{ csrf_field() }}
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="text" placeholder="Название магазина" name="shop_name">
                                        </div>

                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input phone" type="text" placeholder="Телефон(логин)" name="phone">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off">
                                        </div>
										<div class="form-group m-form__group">
											<div class="m-typeahead">
												<input class="form-control m-input f-typeahead" type="text" placeholder="Город" autocomplete="false">
												<input type="hidden" name="city_id" id="city_id" value="" class="form-control">
											</div>
										</div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="password" placeholder="Пароль" name="password">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Повторите пароль" name="password_confirmation">
                                        </div>
                                        <div class="m-login__form-sub">
                                            <label class="m-checkbox m-checkbox--focus">
                                                <input type="checkbox" name="agree" class="form-control">
                                                Я принимаю условия
                                                <a href="#" class="m-link m-link--focus">
                                                     публичной оферты
                                                </a>
                                                .
                                                <span></span>
                                            </label>
                                            <span class="m-form__help"></span>
                                        </div>
                                        <div class="m-login__form-action">
                                            <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Зарегистрироваться
                                            </button>
                                        </div>
                                    </form>
                                </div>

							</div>
						</div>
						<div class="m-stack__item m-stack__item--center">
							<div class="m-login__account" style="display: block">
								<span class="m-login__account-msg">
									Уже зарагестрированы?
								</span>
								&nbsp;&nbsp;
								<a href="{{ route('login') }}" class="m-link m-link--focus m-login__account-link">
									Авторизоваться
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{ asset('assets/admin/img/Purple-crocus-flowers-petals-macro-art-ink.jpg') }})">
					<div class="m-grid__item m-grid__item--middle">
						<h3 class="m-login__welcome">
							Join Our Community
						</h3>
						<p class="m-login__msg">
							Lorem ipsum dolor sit amet, coectetuer adipiscing
							<br>
							elit sed diam nonummy et nibh euismod
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->





		<!--begin::Modal-->
		<div class="modal fade" id="reg-code-modal" tabindex="-1" role="dialog" aria-labelledby="regCodeModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="{{ route('register') }}" id="register_code_form">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="regCodeModalLabel">
							Подтверждение телефона
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">
								&times;
							</span>
						</button>
					</div>
					<div class="modal-body">

							{{ csrf_field() }}
							<div class="form-group">
								<label for="reg-code" class="form-control-label">
									На Ваш телефон выслан код подтверждения:
								</label>
								<input type="text" class="form-control" id="reg-code" placeholder="Код" name="code">
							</div>
							<div class="fields_container"></div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">
							Подтвердить
						</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<!--end::Modal-->



		<!--begin::Base Scripts -->
		<script src="{{ asset('assets/admin/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"  ></script>
		<script src="{{ asset('assets/admin/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/admin/js/custom.js') }}" type="text/javascript"></script>
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
		<script src="{{ asset('assets/admin/snippets/pages/user/login.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/admin/js/register.js') }}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>