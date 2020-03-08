<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="other" content="{{ Auth::user() && Auth::user()->id === 427 ? 'можно' : 'нельзя' }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle', 'Доставка букетов цветов в '.$current_city->name_prepositional.'')</title>

    <meta name="description" content="@yield('pageDescription', 'Выбрать красивый букет цветов с доставкой в '.$current_city->name_prepositional.', области и всей России. Свежесть цветов и их сохранность, а главное круглосуточную доставку обеспечивает Федеральная курьерская служба доставки')">
    <meta name="keywords" content="@yield('pageKeywords', 'доставка цветов '.$current_city->name.', купить букет цветов недорого, купить цветы с доставкой в '.$current_city->name_prepositional.' дешево')">
    <meta name="yandex-verification" content="bdbc1bcf29169555" />

    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" type="image/x-icon">
    <meta name="apple-mobile-web-app-title" content="Floristum">
    <link rel="apple-touch-startup-image" href="{{ asset('images/icons/touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icons/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('images/icons/touch-icon-ipad-retina.png') }}">

    <meta property='og:image' content='@yield('pageImage', 'https://floristum.ru/assets/front/img/og_logo_floristum_ru_s.png')' />
    <meta property='og:image:width' content='@yield('pageImageWidth', 200)' />
    <meta property='og:image:height' content='@yield('pageImageHeight', 200)' />
    <meta property='og:title' content='@yield('pageTitle', 'Доставка цветов в г '.$current_city->name.'. Заказ букетов на дом, в офис.')' />
    <meta property='og:description' content='@yield('pageDescription', 'Служба доставки цветов в г '.$current_city->name.'. Заказ букетов от лучших флористов из каталога.')' />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ \Request::url() }}" />

    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap-3.3.4.min.css') }}">

    <script type='text/javascript'>
            //<![CDATA[
            function loadCSS(e, t, n) { "use strict"; var i = window.document.createElement("link"); var o = t || window.document.getElementsByTagName("script")[0]; i.rel = "stylesheet"; i.href = e; i.media = "only x"; o.parentNode.insertBefore(i, o); setTimeout(function () { i.media = n || "all" }) }
            
            loadCSS("https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=cyrillic");
            loadCSS("//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css");
            //]]>
    </Script>

    <!--
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=cyrillic" rel="stylesheet">
    
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/media.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom.css?v=201900900') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom_media.css?v=20190825') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/front/css/cards.css?v=20200209') }}">
    @if(request()->get('app') === 'true')
      <link rel="stylesheet" href="{{ asset('assets/front/css/coupon-popup.css?v=202003021518') }}">
    @endif

    <!--[if lt IE 9]>
    <script src="{{ asset('assets/front/css/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/front/css/js/respond.min.js') }}"></script>
    <![endif]-->

    @yield('head')

    <script>
            var cityId = {{ $current_city ? $current_city->id : null }};
            var detectedCity = {!! !empty($detected_city) ? $detected_city->toJson() : $current_city->toJson() !!};
            var jsonData = {};
            var routes = {};
    </script>
    
    	<style>
		*,*:after,*:before {
			box-sizing: border-box;
		}
		.dowloadAppIcons {
		    position: fixed;
		    top: 210px;
		    left: -99px;
		    width: 130px;
        	z-index: 9999;
        	display: none;
		}
	
		.dowloadAppIcons__item {
		    display: block;
		    opacity: 0.6;
		    border-radius: 5px;
		    border-top-left-radius: 0;
        	border-bottom-left-radius: 0;
        	transition: .3s;
		}
		.dowloadAppIcons__item:hover {
		    opacity: 1;
		    transform: translateX(99px);
		}
		.dowloadAppIcons__item:nth-child(2) {
		    margin-top: 10px;
		    
		    /* display: none; временно */
		}
		.dowloadAppIcons__item  img {
		    display: block;
		    width: 100%;
		    height: auto;
		}
		
		.dowloadAppBanner {
		    position: absolute;
		    top: 0;
		    left: 0;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			-webkit-flex-direction: column;
			-moz-flex-direction: column;
			-ms-flex-direction: column;
			-o-flex-direction: column;
			flex-direction: column;
			-ms-align-items: center;
			align-items: center;
			justify-content: center;
		    width: 100%;
		    height: 100vh;
		    padding: 0 20%;
		    background: #fff;
		    z-index: 9999999;
		    display: none;
		}
		.dowloadAppBanner__img {
		    display: block;
		    width: 100%;
		    height: auto;
		}
		.dowloadAppBanner__logo {
		    display: block;
		    -ms-align-self: flex-start;
			align-self: flex-start;
		    width: 100%;
		    max-width: 205px;
		    height: auto;
		    margin: -20px 0 20px 20px;
		}
		.dowloadAppBanner__text {
		    margin-bottom: 20px;
		    color: #df291e;
            font-family: Tahoma;
            font-size: 44px;
            line-height: 110%;
            font-weight: 700;
            text-align: center;
		}
		.dowloadAppBanner__link {
		    display: block;
		    width: 100%;
		    max-width: 300px;
		    margin-bottom: 30px;
		    padding: 15px 10px;
		    font-size: 24px;
		    line-height: 24px;
		    text-decoration: none;
		    color: #fff;
            font-family: Tahoma;
		    text-align: center;
		    border-radius: 50px;
		    background: #97cf26;
		    box-shadow: 0 0 9px 0px rgb(57, 111, 26);
		}
		.dowloadAppBanner__close {
		    margin: 0;
		    padding: 0;
		    border: none;
		    outline: none;
		    background: none;
		    color : #1aa2e5;
		    font-size: 18px;
		    cursor: pointer;
		}
		.downloadApp {
			position: fixed;
			top: 0;
			left: 0;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			-ms-align-items: center;
			align-items: center;
			width: 100%;
			padding: 10px 15px;
			background: #fff;
			box-shadow: 0px 0px 10px 0px rgba(0,0,0,.3);
			z-index: 9999;
			display: none;
		}
		.downloadApp__close,
		.dowloadAppBanner__closeBtn {
			position: relative;
			display: block;
			width: 25px;
			height: 25px;
			margin-right: 15px;
			padding: 0;
			background: none;
			border: none;
			outline: none;
			cursor: pointer;
		}
		.downloadApp__close:before,
		.downloadApp__close:after,
		.dowloadAppBanner__closeBtn:before,
		.dowloadAppBanner__closeBtn:after {
			content: "";
			position: absolute;
			top: 50%;
			left: 50%;
			width: 20px;
			height: 2px;
			background: #453e3e;
		}
		.downloadApp__close:before,.dowloadAppBanner__closeBtn:before {
			transform: translate(-50%, -50%) rotate(45deg);
		}
		.downloadApp__close:after,.dowloadAppBanner__closeBtn:after {
			transform: translate(-50%, -50%) rotate(-45deg);
		}
		.dowloadAppBanner__closeBtn {
		    position: absolute;
		    top: 15px;
		    right: 15px;
		    margin: 0;
		}
		.downloadApp__logo,
		.downloadApp__logoOS {
			display: block;
			width: 100%;
			max-width: 40px;
			height: auto;
			margin-right: 10px;
		}
		.downloadApp__link {
			display: block;
			color: #df291e;
			font-family: Tahoma;
			font-size: 18px;
			line-height: 22px;
			font-weight: 400;
			text-decoration: none;
		}
		.downloadApp__link span {
			display: block;
			text-decoration: underline;
		}
		@media (orientation: landscape) {
		    .dowloadAppBanner__img {
		        display: none;
		    }
		    .dowloadAppBanner__logo {
		        -ms-align-self: center;
    			align-self: center;
    		    margin: 0 0 20px;
		    }
		}
		@media (max-width: 768px) {
		    .dowloadAppBanner {
		        padding: 0;
		    }
		}
		@media (max-width: 420px) {
			.downloadApp__link {
				font-size: 14px;
				line-height: 18px;
			}
		}
		@media (max-width: 390px) {
		    .dowloadAppBanner__logo {
            	max-width: 150px;
            }
            .dowloadAppBanner__text {
                font-size: 24px;
            }
            .dowloadAppBanner__link {
                max-width: 250px;
            	font-size: 18px;
            	line-height: 18px;
            }
			.downloadApp {
				padding: 10px;
			}
			.downloadApp__close {
				margin-right: 10px;
			}
			.downloadApp__logo,
			.downloadApp__logoOS {
				max-width: 30px;
			}
		}
		
		#bg_popup{
            position: fixed;
            z-index: 9999999;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: none;
		}
		#bg_popup2 {
            position: fixed;
            z-index: 99999;
            top: 0;
            left: 0;
            display: none;
    }
    
    .product-image {
      display: block;
      position: relative;
    }
    .product-image__like {
      display: block;
      width: 33px;
      height: 33px;
      position: absolute;
      right: 5px;
      bottom: 5px;
      background-image: url(/images/white_heart.png);
      cursor: pointer;
      z-index: 2;
    }
    @media all and (max-width: 991px) and (min-width: 0) {
      .product-image__like {
        bottom: 20px;
      }
    }
    @media all and (min-width: 1025px){
        .product-image__like:hover {
          background-image: url(/images/red_heart.png);
        }
    }
    .product-image__like.active {
      background-image: url(/images/red_heart.png);
    }

    .product-image__close {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 33px;
      height: 33px;
      position: absolute;
      top: 5px;
      right: 5px;
      border-radius: 50%;
      background-color: #fff;
      font-weight: 600;
      font-size: 20px;
      cursor: pointer;
    }

    .favorites-heart {
      position: fixed;
      bottom: 15px;
      left: 30px;
      width: 68px;
      height: 66px;
      background-image: url(/images/big_heart.png);
      display: none;
      align-items: center;
      justify-content: center;
      font-size: 33px;
      color: #000 !important;
      font-weight: 500;
      text-decoration: none;
    }
    .favorites-heart:hover {
      text-decoration: none;
    }
    .favorites-heart.active {
      display: flex;
    }

    .product-card-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .product-wrapper {
      position: relative;
    }

    .add-favorites {
      position: absolute;
      right: 50%;
      bottom: 5px;
      flex: 1;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin-right: -11.5px;
    }

    .add-favorites__like {
      display: inline-block;
      width: 33px;
      height: 33px;
      background-image: url(/images/white_heart.png);
      cursor: pointer;
    }
    @media all and (min-width: 1025px){
        .add-favorites:hover .add-favorites__like {
          background-image: url(/images/red_heart.png);
        }
    }
    .add-favorites.active .add-favorites__like {
      background-image: url(/images/red_heart.png);
    }

    .add-favorites__text,
    .add-favorites__text--remove {
      cursor: pointer;
      text-decoration: underline;
    }
    .add-favorites__text--remove {
      display: none;
    }
    .add-favorites:hover .add-favorites__text,
    .add-favorites:hover .add-favorites__text--remove {
      color: red;
    }

    .add-favorites.active .add-favorites__text--remove {
      display: block;
    }
    .add-favorites.active .add-favorites__text {
      display: none;
    }
	</style>
	<script>
		var userDeviceArray = [
		{device: 'Android', platform: /Android/},
		{device: 'iPhone', platform: /iPhone/},
		{device: 'iPad', platform: /iPad/},
		{device: 'Symbian', platform: /Symbian/},
		{device: 'Windows Phone', platform: /Windows Phone/},
		{device: 'Tablet OS', platform: /Tablet OS/},
		{device: 'Linux', platform: /Linux/},
		{device: 'Windows', platform: /Windows NT/},
		{device: 'Macintosh', platform: /Macintosh/}
		];

		var platform = navigator.userAgent;

		function getPlatform() {
			for (var i in userDeviceArray) {
				if (userDeviceArray[i].platform.test(platform)) {
					return userDeviceArray[i].device;
				}
			}
			return 'Неизвестная платформа!' + platform;
		}

	</script>
</head>

<body>
    <div id="bg_popup2">
        <div class="downloadApp">
            <button id="setCookie" class="downloadApp__close" onclick="document.getElementById('bg_popup2').style.display='none'; return false;"></button>
            <img src="http://floristum.ru/assets/front/img/logo_mobile.png" alt="" class="downloadApp__logo">
            <img src="http://floristum.ru/assets/front/img/android.png" alt="" class="downloadApp__logoOS">
            <a href="https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US" class="downloadApp__link">
                Скидка 100р в приложении!
                <span>Скачать приложение</span>
            </a>
        </div>
    </div>
    @if(request()->get('app') !== 'true' && request()->cookie('app') !== 'true')
    <div id="bg_popup">
        <div class="dowloadAppBanner">
            <button class="dowloadAppBanner__closeBtn setCookie" onclick="document.getElementById('bg_popup').style.display='none'; return false;"></button>
            <img src="http://floristum.ru/assets/front/img/downloadAppBannerImg.jpg" alt="" class="dowloadAppBanner__img">
            <img src="http://floristum.ru/assets/front/img/downloadAppBannerLogo.png" alt="" class="dowloadAppBanner__logo">
            <div class="dowloadAppBanner__text">Скидка 100р в приложении!</div>
            <a href="https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US" class="dowloadAppBanner__link">Скачать приложение</a>
            <button class="dowloadAppBanner__close setCookie" onclick="document.getElementById('bg_popup').style.display='none'; return false;">Спасибо, не нужно</button>
        </div>
    </div>
    @endif
    <div class="dowloadAppIcons">
      <a target="_blank" href="https://apps.apple.com/ru/app/floristum/id1454760508" class="dowloadAppIcons__item">
          <img src="http://floristum.ru/assets/front/img/appstore.png" alt="">
      </a>
       <a target="_blank" href="https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US" class="dowloadAppIcons__item">
           <img src="http://floristum.ru/assets/front/img/playmarket.png" alt="">
       </a>
    </div>

<div data-ng-app="flowApp">
    <!--[if lt IE 9]>
    <p class="chromeframe text-center">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите ваш браузер</a>.</p>
    <![endif]-->
    <!--
    <div class="preloader-wrapper">
        <div class="preloader">
            <img src="{{ asset('assets/front/img/loading.gif') }}" alt="Загрузка цветов">
        </div>
    </div>
    -->
    <header class="{{ !empty($detected_city) ? 'mobile-city-confirm-showed-' : null }}">


            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container2">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">

                        @if(!empty($detected_city))
                            <div class="visible-xs visible-sm mobile-top-header static on-top" style="display: none !important;">
                                <div class="confirm-city-mobile-widget" data-role="confirm-city-mobile-widget">
                            <span class="city-name">
                                <!--googleoff: all--><!--noindex-->
                                <a href="javascript:" onclick="chooseCity(); return false;" class="city-select w-choose-city-widget" data-city-id="ec54f012-3053-11e1-ae41-001517c526f0" rel="nofollow noopener">
                                    <i class="location-icon fa fa-map-marker"></i><?=$detected_city->name?>
                                    <i class="icon-right" data-role="close-mobile-menu"></i>
                                </a>
                                <!--/noindex--><!--googleon: all-->
                            </span>
                                    <span class="close-btn" data-id="ec54f012-3053-11e1-ae41-001517c526f0"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        @endif
                            <div class="link-filter hidden-md hidden-lg">
                                <a href="#" onclick="$('.filters-container').addClass('active'); $('body').addClass('blocked'); return false;">
                                    Фильтр букетов
                                    <i class="fa fa-reorder"></i>
                                </a>
                            </div>

                        <div class="link-city hidden-md hidden-lg">
                            <a href="#" onclick="chooseCity(); return false;">
                                <i class="fa fa-map-marker"></i>
                                {{ $current_city->name }}
                            </a>
                        </div>


                        <ul class="nav navbar-nav hidden-xs hidden-sm" id="header-right-bar">
                            <li class="dropdown link-city">
                                <a href="#" onclick="chooseCity(); return false;">{{ $current_city->name }}</a>
                                @if(!empty($detected_city))
                                    <div class="popover fade bottom in" role="tooltip" id="link-city-popover">
                                        <div class="arrow"></div>
                                        <div class="popover-content">
                                            <button type="button" class="close" onclick="$('#link-city-popover').hide();">×</button>
                                            <div class="dropdown-city" id="dropdownCity">
                                                <p>Ваш город:<br><b><i class="fa fa-map-marker"></i>{{ $detected_city->name }}</b>?</p>
                                                <a class="btn btn-info" href="http://{{ ($detected_city->slug != 'moskva' ? $detected_city->slug.'.' : '') . \Config::get('app.domain') }}" rel="nofollow noopener">Да</a>
                                                <a class="choose-link pull-right" href="#" onclick="chooseCity(); return false;">Выбрать другой</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li class="slogan-li  hidden-xs hidden-sm">
                                Федеральная служба<br>доставки цветов
                            </li>
                        </ul>
                    </div>

                    <div class="nav-city-wraper">

                        @if(!empty($holiday_icon))
                            <a class="" href="/">
                              <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[0].'.png') }}" alt="" class="holiday-img visible-xs visible-sm">
                            </a>
                            
                            <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[1].'.png') }}" alt="" class="holiday-img visible-md visible-lg">
                            <a class="navbar-brand logo visible-md visible-lg" href="/"></a>
                        @else
                            <a class="navbar-brand logo" href="/"></a>
                        @endif

                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="mainMenu">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown {{ (!empty(request()->product_type_filter) && request()->product_type_filter != 'vse-cvety' && request()->product_type_filter != 'all') || !empty(request()->single) ? 'active' : ''}}" id="productTypesMenuItem">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Тип букета
                                </a>
                                @if(!empty($_productTypes ))
                                    <div class="dropdown-menu dropdown-support">
                                        <div class="collapse in filter-block filter-product-checker filter-product-type" id="filter-product-type">
                                            <ul class="list-unstyled filter">
                                                @foreach ($_productTypes as $type)
                                                    <li data-id="{{ $type->id }}" data-slug="{{ $type->slug }}" class="{{ !empty(request()->product_type_filter) && request()->product_type_filter == $type->slug ? 'active' : null }}"><img src="{{ asset('assets/front/img/ico/'.$type->icon) }}" alt="{{ $type->alt_name }}"> {{ $type->name }}</li>
                                                @endforeach
                                                <!-- <li data-id="" data-slug="single" class="{{ !empty(request()->single) ? 'active' : null }}">
                                                    <img src="{{ asset('assets/front/img/ico/poshtuchno.png') }}" alt=""> Поштучно
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li class="dropdown {{ !empty(request()->flowers) ? 'active' : ''}}" id="flowersMenuItem">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Цветы в букете
                                </a>
                                @if(!empty($_flowers ))
                                    <div class="dropdown-menu dropdown-support">
                                        <div class="filter-block">
                                            <ul class="list-unstyled">
                                                @foreach ($_flowers as $flower)
                                                    <li>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" value="{{ $flower->id }}" data-slug="{{ $flower->slug }}" name="flowers[]" {{ !empty(request()->flowers) && in_array($flower->id, request()->flowers) ? 'checked' : null }}> {{ $flower->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li class="dropdown {{ !empty(request()->price_from) && !empty(request()->price_to) ? 'active' : ''}}" id="priceMenuItem">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Цены
                                </a>
                                @if(!empty($_prices))
                                    <div class="dropdown-menu dropdown-support">
                                        <div class="filter-block filter-product-checker" id="filter-product-price">
                                            <ul class="list-unstyled">
                                                @foreach ($_prices as $price)
                                                    <li data-id="{{ $price->id }}" data-from="{{ $price->price_from }}" data-to="{{ $price->price_to }}" class="{{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == $price->price_from && request()->price_to == $price->price_to ? 'active' : null }}">{{ $price->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li class="dropdown {{ !empty(request()->color) ? 'active' : ''}}" id="colorMenuItem">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Цвет
                                </a>
                                @if(!empty($_colors))
                                    <div class="dropdown-menu dropdown-support">
                                        <div class="filter-block" id="filter-product-color">
                                            <div class="row">
                                                @foreach ($_colors as $color)
                                                    <div class="col-md-6 color-item {{ !empty(request()->color) && request()->color == $color->id ? 'active' : null }}" data-id="{{ $color->id }}">
                                                        <div class="selected-color {{ $color->css_class }}"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li class="dropdown link-support">
                                <form method="get" action="{{ route('product.search') }}">
                                    <div class="flexbox">
                                        <div class="search">
                                            <div>
                                                <input type="text" name="q" placeholder="Поиск..." value="{{ !empty(request()->q) ? request()->q : '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div> <!-- /.container -->
            </nav>
    </header>


    <div class="filters-container mainPage" ng-controller="mainPage">
        <div class="mobile-crumbs">
            <a href="javascript:" data-ng-click="closeMobileFilter()" rel="nofollow noopener">
                <span class="fa fa-times" aria-hidden="true"></span>
                <span>Скрыть фильтры</span>
            </a>


        </div>
        <div class="filter-list" data-role="filter-list" id="shop-catalog">
            <form method="get" name="filter-list-shop-catalog" data-role="filter-list-form">
                <div class="filter-block">
                    <label class="filter-block-title spoiler ">
                        <a href="#_filter-product-type" aria-expanded="false" data-toggle="collapse" rel="nofollow" class="collapsed">
                            <i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>
                            <span>Тип букета</span>
                        </a>
                    </label>
                    <div class="filter-block-items collapse" id="_filter-product-type" aria-expanded="false" role="note">
                        <ul class="list-unstyled filter">
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="1" data-slug="klassika" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'klassika' ? 'checked' : null }}> Классика
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="2" data-slug="avtorskie" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'avtorskie' ? 'checked' : null }}> Авторские
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="3" data-slug="korobki" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'korobki' ? 'checked' : null }}> Коробки
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="4" data-slug="korziny" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'korziny' ? 'checked' : null }}> Корзины
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="9" data-slug="frukty" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'frukty' ? 'checked' : null }}> Фрукты
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="10" data-slug="lakomstva" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'lakomstva' ? 'checked' : null }}> Лакомства
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="8" data-slug="igrushki" name="m-filter-product-type" {{ !empty(request()->product_type_filter) && request()->product_type_filter == 'igrushki' ? 'checked' : null }}> Игрушки
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="filter-block">
                    <label class="filter-block-title spoiler ">
                        <a href="#_filter-flowers" aria-expanded="false" data-toggle="collapse" rel="nofollow" class="collapsed">
                            <i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>
                            <span>Цветы в букете</span>
                        </a>
                    </label>
                    <div class="filter-block-items collapse" id="_filter-flowers" aria-expanded="false" role="note">
                        <ul class="list-unstyled filter">
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="228" data-slug="roza" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(228, request()->flowers) ? 'checked' : null }}> Роза
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="267" data-slug="tyulpan" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(267, request()->flowers) ? 'checked' : null }}> Тюльпан
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="612" data-slug="pion" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(612, request()->flowers) ? 'checked' : null }}> Пион
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="781" data-slug="gerbera" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(781, request()->flowers) ? 'checked' : null }}> Гербера
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="407" data-slug="gvozdika" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(407, request()->flowers) ? 'checked' : null }}> Гвоздика
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="464" data-slug="iris" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(464, request()->flowers) ? 'checked' : null }}> Ирис
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="336" data-slug="anemona-vetrenitsa" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(336, request()->flowers) ? 'checked' : null }}> Анемона
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="753" data-slug="alstromeriya" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(753, request()->flowers) ? 'checked' : null }}> Альстромерия
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="checkbox" value="19" data-slug="amarillis" name="m-flowers[]" {{ !empty(request()->flowers) && in_array(19, request()->flowers) ? 'checked' : null }}> Амариллис
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="filter-block">
                    <label class="filter-block-title spoiler ">
                        <a href="#_filter-price" aria-expanded="false" data-toggle="collapse" rel="nofollow" class="collapsed">
                            <i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>
                            <span>Цена</span>
                        </a>
                    </label>
                    <div class="filter-block-items collapse" id="_filter-price" aria-expanded="false" role="note">
                        <ul class="list-unstyled filter">
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="1" data-from="100" data-to="1999" name="m-price" {{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == 100 && request()->price_to == 1999 ? 'checked' : null }}> До 2000 руб
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="2" data-from="2000" data-to="2999" name="m-price" {{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == 2000 && request()->price_to == 2999 ? 'checked' : null }}> 2 000 - 3 000 руб
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="3" data-from="3000" data-to="4999" name="m-price" {{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == 3000 && request()->price_to == 4999 ? 'checked' : null }}> 3 000 - 5 000 руб
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="4" data-from="5000" data-to="8999" name="m-price" {{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == 5000 && request()->price_to == 8999 ? 'checked' : null }}> 5 000 - 9 000 руб
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="5" data-from="9000" data-to="12999" name="m-price" {{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == 9000 && request()->price_to == 12999 ? 'checked' : null }}> 9 000 - 13 000 руб
                                </label>
                            </li>
                            <li class="checkbox">
                                <label>
                                    <input type="radio" value="6" data-from="13000" data-to="9999999" name="m-price" {{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == 13000 && request()->price_to == 9999999 ? 'checked' : null }}> От 13000 руб
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="filter-block">
                    <label class="filter-block-title spoiler ">
                        <a href="#_filter-color" aria-expanded="false" data-toggle="collapse" rel="nofollow" class="collapsed">
                            <i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>
                            <span>Цветовая гамма</span>
                        </a>
                    </label>
                    <div class="filter-block-items collapse" id="_filter-color" aria-expanded="false" role="note">
                        <div class="row">
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color red"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="1" {{ !empty(request()->color) && request()->color == 1 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color pink"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="2" {{ !empty(request()->color) && request()->color == 2 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color orange"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="3" {{ !empty(request()->color) && request()->color == 3 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color yellow"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="4" {{ !empty(request()->color) && request()->color == 4 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color green"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="5" {{ !empty(request()->color) && request()->color == 5 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color blue"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="6" {{ !empty(request()->color) && request()->color == 6 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color purple"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="7" {{ !empty(request()->color) && request()->color == 7 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color black"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="8" {{ !empty(request()->color) && request()->color == 8 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color white"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="9" {{ !empty(request()->color) && request()->color == 9 ? 'checked' : null }}>
                                </label>
                            </div>
                            <div class="col-2-5 color-item">
                                <label>
                                    <div class="selected-color mix"></div>
                                    <br>
                                    <input type="radio" name="m-filter-color" value="10" {{ !empty(request()->color) && request()->color == 10 ? 'checked' : null }}>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="filter-block">
                <label class="filter-block-title ">
                    <form method="get" action="{{ route('product.search') }}" class="">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Поиск..." value="{{ !empty(request()->q) ? request()->q : '' }}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">Найти</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </label>
            </div>

        </div>
        <div class="mobile-filter-buttons">
            <button class="btn btn-default"  data-ng-click="mobileFilterReset()"><span>Сбросить</span></button>
            <button class="btn btn-additional" data-ng-click="mobileFilter()"><span>Показать</span></button>
        </div>
    </div>



    <section>


        @yield('content')

        <div class="container">



            <div class="row">
                <div class="col-md-8">
                    <strong>Популярные города:</strong>
                    <hr>
                    <div class="row">
                        @if(count($popular_city))
                            <div class="col-xs-6 col-md-3">
                                @endif

                                @foreach($popular_city as $key => $city_item)
                                    <div class="city-popular">
                                        <p><a href="http://<?=$city_item->slug?>.floristum.ru"><?=$city_item->name?></a></p>
                                        <p class="text-muted"></p>
                                    </div>

                                    @if(($key + 1) == count($popular_city) || ($key + 1) % 3 == 0)
                                        @if(($key + 1) == count($popular_city))
                                            <div class="city-popular">
                                                <p><a href="{{ route('city.popular') }}">Все города…</a></p>
                                            </div>
                                        @endif
                            </div>
                        @endif
                        @if(($key + 1) < count($popular_city) && ($key + 1) % 3 == 0)
                            <div class="col-xs-6 col-md-3">
                            @endif
                            @endforeach
                            <!--
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[0]->slug?>.floristum.ru"><?=$popular_city[0]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[1]->slug?>.floristum.ru"><?=$popular_city[1]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[2]->slug?>.floristum.ru"><?=$popular_city[2]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[3]->slug?>.floristum.ru"><?=$popular_city[3]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[4]->slug?>.floristum.ru"><?=$popular_city[4]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[5]->slug?>.floristum.ru"><?=$popular_city[5]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[6]->slug?>.floristum.ru"><?=$popular_city[6]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[7]->slug?>.floristum.ru"><?=$popular_city[7]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[8]->slug?>.floristum.ru"><?=$popular_city[8]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[9]->slug?>.floristum.ru"><?=$popular_city[9]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[10]->slug?>.floristum.ru"><?=$popular_city[10]->name?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="{{ route('city.popular') }}">Все города…</a></p>
                        </div>
                    </div>
                    -->
                            </div>
                            <br class="hidden-lg hidden-md hidden-sm">
                    </div>
                    <div class="col-md-4">
                        <strong>Популярные цветы:</strong>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                <p class="world-popular"><a href="/catalog/all/roza">Розы</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/liliya">Лилии</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/gerbera">Герберы</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/tyulpan">Тюльпаны</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/kalla-zantedeskhiya">Каллы</a>, <span class="text-muted"></span></p>
                            </div>
                            <div class="col-xs-6">
                                <p class="world-popular"><a href="/catalog/all/romashka-nivyanik">Ромашки</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/fialka-viola">Фиалки</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/khrizantema">Хризантемы</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/gibiskus-kitayskaya-roza">Гибискус</a>, <span class="text-muted"></span></p>
                                <p class="world-popular"><a href="/catalog/all/vse-cvety">Все цветы...</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <footer>
        <div class="container">
            <br>
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="foot-h"><strong>&copy; Floristum.ru</strong></p>
                            <ul class="list-unstyled list-foot">
                                  <li><a href="https://apps.apple.com/ru/app/floristum/id1454760508"  target="_blank"><img src="{{ asset('assets/front/img/appstore.png') }}" alt="Скачать приложение Флористум в App Store"   width="120"></a><!--</br><img src="http://floristum.ru/images/facebook.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/googleplus.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/twit.png" alt="Доставка цветов Вконтакте"> -->
                                <!-- <li><a href="#"><img src="http://floristum.ru/images/appstore_floristum.ru.png" alt="Скачать приложение Флористум в Apple Store"   width="120"></a> --></li>
                                <li><a href="https://play.google.com/store/apps/details?id=ru.floristum.app"  target="_blank"><img src="{{ asset('assets/front/img/playmarket.png') }}" alt="Скачать приложение Флористум в Google Play"   width="120"></a></li>
                                <li>&nbsp;<a href="https://www.instagram.com/rozamir.floristum.ru/" target="_blank"><img src="{{ asset('images/instagram.png') }}" alt="Доставка цветов в Инстаграм"></a> <a href="https://www.instagram.com/rozamir.floristum.ru/">Instagram</a></li>
                                <li>&nbsp;<a href="https://vk.com/floristum" target="_blank"><img src="{{ asset('images/vk.png') }}" alt="Доставка цветов Вконтакте"></a> <a href="https://vk.com/floristum">Vkontakte</a> <!--</br><img src="http://floristum.ru/images/facebook.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/googleplus.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/twit.png" alt="Доставка цветов Вконтакте"> -->
                                <li><a href="https://floristum.ru/articles/Otkrit_magazin_cvetov_1">Как открыть магазин</a>
                            
                                </li>
                            </ul> </div>
                        <div class="col-md-3">
                            <p class="foot-h"><strong>Клиентам</strong></p>
                            <ul class="list-unstyled list-foot">
                                <li><a href="{{ route('front.delivery') }}">Доставка</a></li>
                                <li><a href="https://floristum.ru/payment">Оплата</a></li>
                                <li><a href="https://floristum.ru/faq">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <p class="foot-h"><strong>Организациям</strong></p>
                            <ul class="list-unstyled list-foot">
                                <li><a href="https://floristum.ru/registershop">Магазинам</a></li>
                                <li><a href="{{ route('front.corporate') }}">Корпоративным клиентам</a></li>
                                <li><strong><a href="https://floristum.ru/login">Вход в личный кабинет</a></strong></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <p class="foot-h"><strong>Правовая&nbsp;информация</strong></p>
                            <ul class="list-unstyled list-foot">
                                <li><a href="https://floristum.ru/info/privacy">Конфиденциальность</a></li>
                                <li><a href="https://floristum.ru/info/personldata">Персональные данные</a></li>
                                <li><a href="https://floristum.ru/info/oferta">Публичная оферта</a></li>
                                <li><a href="https://floristum.ru/info/agreement">Публичная оферта о заключении договора купли-продажи</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row last-row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Служба поддержки:</strong></p>
                            <p>
                                <span class="h4 m-t-10">

                                    <a href="mailto:service@floristum.ru"><strong>service@floristum.ru</strong></a>
                                    <br>
                                    <a class="footer-phone" href="tel:{{ config('site.phones.hot_normalized') }}">{{ config('site.phones.hot') }}</a>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-8">
                            @if(!empty($globalAgent) && !empty($globalAgent->shop) && count($globalAgent->shop->address))
                                <p><strong>Цветочный магазин в {{$current_city->name_prepositional}}:</strong></p>
                                <p>{{$current_city->name}}, {{ $globalAgent->shop->address[0]->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    <a href="https://floristum.ru"><img src="{{ asset('assets/front/img/logo_floristum.png') }}" alt="Заказ доставки цветов и букетов на дом"></a>
                    <br><a href="https://floristum.ru"  style="color: grey">Доставка цветов</a>
                    @if(!empty($holiday_icon))
                        <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[0].'.png') }}" alt="" class="holiday-img-footer visible-xs visible-sm">
                        <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[1].'.png') }}" alt="" class="holiday-img-footer visible-md visible-lg" style="width: 275px">
                    @endif
                </div>
            </div>
            <br>
        </div>
    </footer>

    @if(Route::currentRouteName() != 'favorites.show')
      <a href="{{ route('favorites.show') }}" class="favorites-heart"></a>
    @endif

    <div class="app-sms-modal">
      <div class="app-sms-modal__wrapper">
        <a href="" class="app-sms-modal__close">
          <img src="{{ asset('assets/front/images/close.svg') }}" />
        </a>
        <div class="app-sms-modal__block">
          <div class="app-sms-modal__title">В приложении выгоднее и удобнее!</div>
          <div class="app-sms-modal__title app-sms-modal__title-red">Скидка 100 с букета в приложении!</div>

          <form class="app-sms-modal__input-form">
            <span class="app-sms-modal__input-title">Скачайте приложение Floristum по ссылке в смс:</span>
            <div class="app-sms-modal__input-wrapper">
              <input class="app-sms-modal__input phone" type="text" placeholder="+7 912 555 55 55">
              <button class="app-sms-modal__input-button" type="submit">отправить ссылку по смс*</button>
            </div>
          </form>

          <div class="app-sms-modal__qr-wrapper">
            <span class="app-sms-modal__qr-title">Скачайте приложение отсканировав QR-код:</span>
            <div class="app-sms-modal__qr qr-item">
              <div class="qr-item__image">
                <img src="{{ asset('assets/front/images/qr-code.svg') }}" />
              </div>
              <div class="qr-item__description">
                <div class="qr-item__download app-download">
                  <a href="https://apps.apple.com/ru/app/floristum/id1454760508" target="_blank" class="app-download__item ios">
                    <img src="{{ asset('assets/front/images/downloadIOS.svg') }}" alt="" class="">
                  </a>
                  <a href="https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US" target="_blank" class="app-download__item andorid">
                    <img src="{{ asset('assets/front/images/downloadAndroid.svg') }}" alt="" class="">
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="app-sms-modal__description">
            *Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="{{ route('front.privacy') }}" target="_blank">Политикой конфиденциальности</a>, <a class="text-muted" href="{{ route('front.personldata') }}" target="_blank">Соглашением о персональных данных</a> и <a class="text-muted" href="{{ route('front.agreement') }}" target="_blank">Публичной офертой</a>
          </div>

        </div>
        <img class="app-sms-modal__image" src="/assets/front/images/iphoto.png">
      </div>
    </div>

    @if(request()->get('app') === 'true')
      @include('front.app.coupon-popup')
    @endif


    <script src="{{ asset('assets/front/js/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.0.0/dist/lazyload.min.js"></script>
    <script src="{{ asset('assets/plugins/angular/angular.min.js') }}"></script>
    <script src="{{ asset('assets/admin/ng/angular-modal-service.min.js') }}"></script>
    <script src="{{ asset('assets/admin/ng/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('assets/admin/ng/ngApp.js') }}"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    <script src="{{ asset('assets/front/js/holder.min.js') }}"></script>
    <script src="{{ asset('assets/front/ng/mainPage.js?v=20190123') }}"></script>
    <script src="{{ asset('assets/front/js/custom.js?v=20190717') }}"></script>
    <script src="{{ asset('assets/front/js/easy.qrcode.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/front/js/cards.js?v=20200209') }}"></script>
    @if(request()->get('app') === 'true')
      <script src="{{ asset('assets/front/js/coupon-popup.js?v=20200302') }}"></script>
    @endif
@yield('footer')

<!-- BEGIN JIVOSITE CODE {literal} -->
    <script>
            (function(){ var widget_id = 'QL9dJzdl8D';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>
    <!-- {/literal} END JIVOSITE CODE -->

    <!-- Yandex.Metrika counter -->
    <script>
            (function (d, w, c) {
                    (w[c] = w[c] || []).push(function () {
                            try {
                                    w.yaCounter47326329 = new Ya.Metrika({
                                            id: 47326329,
                                            clickmap: true,
                                            trackLinks: true,
                                            accurateTrackBounce: true,
                                            webvisor: true
                                    });
                            } catch (e) {
                            }
                    });

                    var n = d.getElementsByTagName("script")[0],
                            s = d.createElement("script"),
                            f = function () {
                                    n.parentNode.insertBefore(s, n);
                            };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                            f();
                    }
            })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/47326329" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115529108-1"></script>
    <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-115529108-1');
			var current_lang = '';
    </script>
</div>

<?php
/*
use Illuminate\Support\Facades\Input;
$get_input = Input::all();
print_r($get_input);
*/
if( substr_count($_SERVER['HTTP_HOST'],'.') == 1){
?>
<!--lang switcher-->
<style>
.translate_div{-moz-transform: rotate(-90deg);
-webkit-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
-ms-transform: rotate(-90deg);
transform: rotate(-90deg);
position:fixed; top:140px; left:-28px; z-index:999999; background:#666; color:white; padding: 8px;
border-radius: 0 0 5px 5px; cursor:pointer;}
.translate_div:hover{opacity:0.8}
.translate_div a{color:white;}
.translate_div a:hover{color:white; text-decoration:none;}
.translate_div img{-moz-transform: rotate(-270deg);
-webkit-transform: rotate(-270deg);
-o-transform: rotate(-270deg);
-ms-transform: rotate(-270deg);
transform: rotate(-270deg);}

@media(max-width:480px){
	.translate_div{-moz-transform: rotate(-90deg);
-webkit-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
-ms-transform: rotate(-90deg);
transform: rotate(-90deg);
position:fixed; top:80px; left:auto; right:-28px; z-index:999999; background:#666; color:white; padding: 8px;
border-radius:  5px 5px 0 0 ; cursor:pointer;}
	
}

</style>

<div class="translate_div">
 <a href="#"><span>English</span> <img src="/images/eng_translate.png"></a>
</div>
<script>
function strpos (haystack, needle, offset) {
  var i = (haystack+'').indexOf(needle, (offset || 0));
  return i === -1 ? false : i;
}
 
if(strpos(location.href, '/en/')){
	$('.translate_div a').attr('href', location.href.replace("/en/", '/'));
	$('.translate_div span').html('Русский');
	$('.translate_div img').attr('src', '/images/ru_translate.png');
	current_lang = 'en';
}else{
	$('.translate_div a').attr('href', location.href.replace(".ru", '.ru/en'));
	$('.translate_div span').html('English');
	$('.translate_div img').attr('src', '/images/eng_translate.png');
	current_lang = 'ru';
}

</script>

<!--lang switcher end-->
<?php } ?>

@if(request()->get('app') !== 'true' && request()->cookie('app') !== 'true')
<script>

		if ($(window).width() <= 991 && getPlatform() == 'Android') { // проверка на Андроид временна
    		$(document).ready(function(){
                $(".setCookie").click(function () {
                $.cookie("dowloadAppBanner", "", { expires:1, path: '/' });
                $("#bg_popup").hide();
                });
                 
                if ( $.cookie("dowloadAppBanner") == null )
                {
                setTimeout(function(){
                $("#bg_popup").show();
                }, 0)
                }
                else { $("#bg_popup").hide();
                }
            });
            $(document).ready(function(){
                $("#setCookie").click(function () {
                $.cookie("dowloadApp", "", { expires:1, path: '/' });
                $("#bg_popup2").hide();
                });
                 
                if ( $.cookie("dowloadApp") == null )
                {
                setTimeout(function(){
                $('body').css('padding-top', '87px')
                $("#bg_popup2").show();
                }, 0)
                }
                else {
                    $('.navbar-fixed-top').css('top', '0')
        			$('.modal').css('top', '0')
        			$('.translate_div').css('top', '80px')
        			$('body').css('padding-top', '35px')
                    $("#bg_popup2").hide()
                }
            });
		}

        if (getPlatform() == 'Android') { // проверка на Андроид временна
        		if ($(window).width() <= 991 && getPlatform() !== 'Windows' && getPlatform() !== 'iPad') {
        			$('.dowloadAppBanner').css('display','flex')
        			$('.dowloadAppIcons').hide()
        			$('.downloadApp').css('display', 'flex')
        			$('.navbar-fixed-top').css('top', '58px')
        			$('.translate_div').css('top', '120px')
        			$('.modal').css('top', '58px')
        			$('body').css('padding-top', '87px')
        		//	$('body').css('overflowY', 'hidden')
        		}
            
        }
		
		if (getPlatform() == 'iPhone' || getPlatform() == 'iPad') {
			$('.downloadApp__link').attr('href', 'https://apps.apple.com/us/app/floristum-shop/id1490079810?ign-mpt=uo%3D4').html('Скидка 100р в приложении! <span>Скачать приложение</span>')
			$('.downloadApp__logoOS').attr('src', 'http://floristum.ru/assets/front/img/iOS.png')
			$('.dowloadAppBanner__link').attr('href', 'https://apps.apple.com/us/app/floristum-shop/id1490079810?ign-mpt=uo%3D4')
			$('.dowloadAppBanner__text').html('Скидка 100р в приложении!')
			// $('.dowloadAppBanner').css('display','flex')
		}
		if (getPlatform() == 'Windows') {
			$('.dowloadAppBanner').hide()
			if ($(window).width() > 991) {
			    $('.dowloadAppIcons').show()
			}
    	}
		$('.downloadApp__close').click(function(event) {
			$(this).parent().hide()
			$('.navbar-fixed-top').css('top', '0')
			$('.modal').css('top', '0')
			$('.translate_div').css('top', '80px')
			$('body').css('padding-top', '35px')
		});
		$('.dowloadAppBanner__close').click(function(event) {
		    $(this).parent().hide()
			$('body').css({
			    'overflowY': 'auto',
			    'padding-top': '87px'
			})
			
		});
		$('.dowloadAppBanner__closeBtn').click(function(event) {
		    $(this).parent().hide()
			$('body').css({
			    'overflowY': 'auto',
			    'padding-top': '87px'
			})
		});

		
</script>
@endif

<script>
function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(cname, cvalue, exdays) {
  var domainLink = window.location.host;
  if(domainLink.split('.').length > 2){
    var city = window.location.host.split('.', 1)[0];
    domainLink = window.location.host.split(city)[1];
  }
  
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  var domain = "domain=" + domainLink;
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;" + domain;
}
if($(window).width() >= 1025){
  var favoritesButtons = $(".product-image__like, .add-favorites");
  favoritesButtons.tooltip();  
}


function updateFavorites(obj = null) {
  var elements = $(".product-image__like, .add-favorites");
  var heart = $(".favorites-heart");
  var idsString = getCookie('favorites');
  if(idsString != '' && idsString != undefined){
    var ids = idsString.split(',');
    heart.addClass('active');
    heart.text(ids.length);
    elements.each(function(i, el){
      var id = el.dataset.productId;
      if(ids.includes(id)){
        $(el).addClass('active');
        $(el).attr('data-original-title', 'Убрать из избранного');
        if(obj !== null){
          obj.hide();
          setTimeout(() => {
            obj.show();
          }, 300);
        }
      }else{
        $(el).removeClass('active');
        $(el).attr('data-original-title', 'Добавить в избранное');
        if(obj !== null){
          obj.hide();
          setTimeout(() => {
            obj.show();
          }, 300);
        }
      }
    })
  }else {
    heart.removeClass('active');
    elements.removeClass('active');
  }
  
}
$(".product-image__like, .add-favorites").click(function(){
  var id = this.dataset.productId;
  var idsString = getCookie('favorites');
  if(idsString != undefined){
    var ids = idsString.split(',');
    if(ids.includes(id)){
      var newIds = ids.filter((el) => el !== id )
      setCookie('favorites', newIds, 365)
    }else {
      if(idsString == '') {
        setCookie('favorites', id, 365)
      }else {
        ids.push(id);
        setCookie('favorites', ids, 365)
      }
    }
  }else {
    setCookie('favorites', id, 365)
  }
  updateFavorites($(this))
})

$(".product-image__close").click(function(){
  var id = this.dataset.productId;
  var idsString = getCookie('favorites');
  if(idsString != ''){
    var ids = idsString.split(',');
    if(ids.includes(id)){
      var newIds = ids.filter((el) => el !== id )
      setCookie('favorites', newIds, 365);
      document.location.reload();
    }
  }
  updateFavorites()
})
updateFavorites(null)
</script>

@if(Auth::user() && Auth::user()->id === 427)
<style src="/assets/test.css"></style>
<script src="/assets/test.js"></script>
@endif
</bod