<!DOCTYPE html><!--
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
			<div class="m-login m-login--singin  m-login--5" id="m_login" style="background-image: url({{ asset('assets/admin/app/media/img/bg/bg-3.jpg') }});">
				<div class="m-login__wrapper-1 m-portlet-full-height">
					<div class="m-login__wrapper-1-1">
						<div class="m-login__contanier">
							<div class="m-login__content">
								<div class="m-login__logo">
									<a href="/">
										<img src="{{ asset('assets/admin/img/logo_square_min.png') }}">
									</a>
								</div>
								<div class="m-login__title">
									<h3>
										Регистрация нового цветочного магазина на floristum.ru
									</h3>
								</div>
								<div class="m-login__desc">
									Быстрая и удобная
								</div>
								<div class="m-login__form-action">
									<a href="{{ route('register') }}" class="btn btn-outline-focus m-btn--pill">
										Регистрация
									</a>
								</div>
							</div>
						</div>
						<div class="m-login__border">
							<div></div>
						</div>
					</div>
				</div>
				<div class="m-login__wrapper-2 m-portlet-full-height">
					<div class="m-login__contanier">
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Вход
								</h3>
							</div>
                            <form class="m-login__form m-form {{ !$errors ?:'has-danger' }} " method="POST" action="{{ route('login') }}" id="login_form">
                                {{ csrf_field() }}
								<div class="form-group m-form__group has-error">
									<input class="form-control m-input phone" type="text" placeholder="Телефон" name="phone" autocomplete="on" value="{{ old('phone') }}">
									@if ($errors->has('phone'))
										<div id="email-error" class="form-control-feedback">{{ $errors->first('phone') }}</div>
									@endif
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Пароль" name="password" >
									@if ($errors->has('password'))
										<div id="email-error" class="form-control-feedback">{{ $errors->first('password') }}</div>
									@endif
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--focus">
											<input type="checkbox" name="remember">
											Запомнить
											<span></span>
										</label>
									</div>
									<div class="col m--align-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">
											Забыли пароль ?
										</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Авторизоваться
									</button>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Забыли пароль ?
								</h3>
								<div class="m-login__desc">
									Введите номер телефона для востановления пароля:
								</div>
							</div>
							<form class="m-login__form m-form" action="{{ route('recover.sendCode') }}" id="" method="post">
								{{ csrf_field() }}
								<div class="form-group m-form__group">
									<input class="form-control m-input phone" type="text" placeholder="Номер телефона" name="recover_phone" id="m_phone" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Востановить
									</button>
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom ">
										Отмена
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->

		<!--begin::Modal-->
		<div class="modal fade" id="recover_pwd_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Востановление пароля
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">
								&times;
							</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="m-form" method="post" action="{{ route('recover.setPassword') }}" autocomplete="off">
							<span class="m-form__help">
								На Ваш телефон был выслан код, для востановления пароля
							</span>
							{{ csrf_field() }}
							<input type="hidden" name="phone" value="">
							<div class="form-group">
								<label for="recover-code">Введите код</label>
								<input type="text" class="form-control" id="recover-code" name="recover_code" placeholder="Код" autocomplete="nope">
							</div>
							<div class="form-group">
								<label for="new-pwd">Введите новый пароль</label>
								<input type="password" class="form-control" id="new-pwd" name="password" placeholder="Новый пароль" autocomplete="new-password">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Закрыть
						</button>
						<button type="button" class="btn btn-primary" id="confirm_recover_code">
							Подтвердить
						</button>
					</div>
				</div>
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
		<script src="{{ asset('assets/admin/js/login.js') }}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>