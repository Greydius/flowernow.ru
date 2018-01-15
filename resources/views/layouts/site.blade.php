<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
                <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Floristum</title>

		<link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=cyrillic" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('assets/front/css/fonts.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/front/css/media.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/front/css/custom.css') }}">

		<!--[if lt IE 9]>
			<script src="{{ asset('assets/front/css/js/html5shiv.min.js') }}"></script>
			<script src="{{ asset('assets/front/css/js/respond.min.js') }}"></script>
		<![endif]-->

		@yield('head')

		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/front/css/img/ico/apple-touch-icon-precomposed.png') }}">
		<link rel="icon" href="{{ asset('assets/front/css/img/ico/favicon.ico') }}">

		<script type="text/javascript">
			var cityId = {{ $current_city ? $current_city->id : null }};
			var jsonData={};
			var routes = {};
		</script>
	</head>

	<body ng-app="flowApp">
		<!--[if lt IE 9]>
			<p class="chromeframe text-center">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите ваш браузер</a>.</p>
		<![endif]-->
		<div class="preloader-wrapper">
			<div class="preloader">
				<img src="{{ asset('assets/front/img/loading.gif') }}" alt="...">
			</div>
		</div>
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainMenu" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand logo" href="index.html"></a>
						<div class="slogan text-primary hidden-xs">Доставка цветов везде и всегда!</div>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="mainMenu">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown link-city">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $current_city->name }}</a>
								<ul class="dropdown-menu dropdown-currency">
									<li><a href="#">Санкт-петербург</a></li>
									<li><a href="#">Самара</a></li>
									<li><a href="#">Ростов</a></li>
									<li><a href="#">Краснодар</a></li>
								</ul>
							</li>
							<li class="dropdown link-support">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Помощь</a>
								<div class="dropdown-menu dropdown-support">
									<form class="form-support-search">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Чем мы можем вам помочь?">
										</div>
									</form>
									<div class="asqed-block">
										<p><strong>Рекомендуем почитать</strong></p>
										<ul class="list-unstyled">
											<li><a href="#">Как оплатить заказ?</a></li>
											<li><a href="#">Как оформить заказ?</a></li>
											<li><a href="#">Когда смогут доставить?</a></li>
											<li><a href="#">Свежесть цветов</a></li>
											<li><a href="#">Что такое Flowwow?</a></li>
											<li><a href="#">Сохранность денежныйх средств</a></li>
											<li><a href="#">Соответсвует ли букет изображению на сайте?</a></li>
										</ul>
									</div>
									<a href="#" class="btn btn-block btn-support">Центр помощи</a>
								</div>
							</li>
							<li class="dropdown link-login">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Вход</a>
								<div class="dropdown-menu dropdown-login">
									<form class="form-login-phone">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="+79196665555">
										</div>
										<button type="submit" class="btn btn-default">Получить код</button>
									</form>
									<p>На телефон будет отправлено СМС с кодом для входа в ваш кабинет</p>
									<br>
									<p class="text-muted">Или <a class="text-muted" href="#">войти с помощью эл. почты</a></p>
									<br>
									<p class="h6 text-muted">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="#">политикой конфиденциальности</a> и <a class="text-muted" href="#">соглашением об обработке персональных данных</a></p>
								</div>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div> <!-- /.container -->
			</nav>
		</header>

		<section>
            @yield('content')
		</section>

		<footer>
			<div class="container">
				<br><hr>
				<div class="row">
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-3">
								<p class="foot-h"><strong>&copy; 2017 - {{ date('Y') }} Floristum</strong></p>
								<br>
								<ul class="list-inline list-social">
									<li><a href="#" class="fb"></a></li>
									<li><a href="#" class="vk"></a></li>
									<li><a href="#" class="ok"></a></li>
									<li><a href="#" class="ig"></a></li>
									<li><a href="#" class="tw"></a></li>
								</ul>
							</div>
							<div class="col-md-3">
								<p class="foot-h"><strong>Покупателям</strong></p>
								<ul class="list-unstyled list-foot">
									<li><a href="#">Оплата и доставка</a></li>
									<li><a href="#">Отзывы</a></li>
									<li><a href="#">Карта сайта</a></li>
									<li><a href="#">Блог</a></li>
								</ul>
							</div>
							<div class="col-md-3">
								<p class="foot-h"><strong>Компаниям</strong></p>
								<ul class="list-unstyled list-foot">
									<li><a href="#">Магазинам</a></li>
									<li><a href="#">Корпоративным клиентам</a></li>
									<li><a href="#">Партнеры</a></li>
									<li><a href="#">Для прессы</a></li>
								</ul>
							</div>
							<div class="col-md-3">
								<p class="foot-h"><strong>Правила</strong></p>
								<ul class="list-unstyled list-foot">
									<li><a href="#">Конфиденциальность</a></li>
									<li><a href="#">Персональные данные</a></li>
									<li><a href="#">Публичная оферта</a></li>
									<li><a href="#">Публичная оферта о заключении договора купли-продажи</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						<p>Есть вопросы, пишите: <br> <span class="h4"><a href="mailto:hello@floristum.ru"><strong>hello@floristum.ru</strong></a> <br> <a href="tel:88005551615"><strong>8 (800) 555-16-15</strong></a></span></p>
					</div>
					<div class="col-sm-6 text-right">
						<img src="{{ asset('assets/front/img/google-safe.png') }}" alt="...">
					</div>
				</div>
				<br>
			</div>
		</footer>
		<script src="{{ asset('assets/front/js/jquery-3.2.0.min.js') }}"></script>
                <script src="{{ asset('assets/front/js/jquery.cookie.js') }}"></script>
                <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
                <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
                <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"  ></script>
                <script src="{{ asset('assets/admin/ng/angular-modal-service.min.js') }}" type="text/javascript"></script>
                <script src="{{ asset('assets/admin/ng/ngApp.js') }}" type="text/javascript"></script>
                <script src="{{ asset('assets/front/js/main.js') }}"></script>
                <script src="{{ asset('assets/front/js/holder.min.js') }}"></script>
                <script src="{{ asset('assets/front/js/custom.js') }}"></script>
                @yield('footer')
	</body>
</html>