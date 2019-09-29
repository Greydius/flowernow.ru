<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle', 'Доставка цветов круглосуточно в '.$current_city->name_prepositional.'. Заказать букет с доставкой в '.$current_city->name_prepositional.'')</title>

    <meta name="description" content="@yield('pageDescription', 'У нас вы можете выбрать шикарный букет с доставкой по '.$current_city->name_prepositional.', области и всей России. Свежесть цветов и их сохранность, а главное круглосуточную доставку обеспечивает Федеральная курьерская служба доставки')">
    <meta name="keywords" content="@yield('pageKeywords', 'заказать букет с доставкой на дом в '.$current_city->name_prepositional.', заказ и доставка букетов цветов в '.$current_city->name_prepositional.'')">
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
</head>

<body>
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
                            <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[0].'.png') }}" alt="" class="holiday-img visible-xs visible-sm">
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
                                                <li data-id="" data-slug="single" class="{{ !empty(request()->single) ? 'active' : null }}">
                                                    <img src="{{ asset('assets/front/img/ico/poshtuchno.png') }}" alt=""> Поштучно
                                                </li>
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


    <div class="filters-container" data-ng-controller="mainPage">
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
                                  <li><a href="https://play.google.com/store/apps/details?id=ru.floristum.app"><img src="http://floristum.ru/images/playmarket_floristum.ru.png" alt="Скачать приложение Флористум в Google Play"   width="120"></a><!--</br><img src="http://floristum.ru/images/facebook.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/googleplus.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/twit.png" alt="Доставка цветов Вконтакте"> -->
                                <!-- <li><a href="#"><img src="http://floristum.ru/images/appstore_floristum.ru.png" alt="Скачать приложение Флористум в Apple Store"   width="120"></a> -->
                                <li>&nbsp;<a href="https://www.instagram.com/rozamir.floristum.ru/"><img src="http://floristum.ru/images/instagram.png" alt="Доставка цветов в Инстаграм"></a> <a href="https://www.instagram.com/rozamir.floristum.ru/">Instagram</a></li>
                                <li>&nbsp;<a href="https://vk.com/floristum"><img src="http://floristum.ru/images/vk.png" alt="Доставка цветов Вконтакте"></a> <a href="https://vk.com/floristum">Vkontakte</a> <!--</br><img src="http://floristum.ru/images/facebook.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/googleplus.png" alt="Доставка цветов Вконтакте"></br><img src="http://floristum.ru/images/twit.png" alt="Доставка цветов Вконтакте"> -->
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
    </script>
</div>
</body>
</html>