<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle', 'Доставка цветов в г '.$current_city->name.'. Заказ букетов на дом, в офис.')</title>

    <meta name="description" content="@yield('pageDescription', 'Служба доставки цветов в г '.$current_city->name.'. Заказ букетов от лучших флористов из каталога.')">
    <meta name="keywords" content="@yield('pageKeywords', 'доставка, цветов, букетов, заказ, служба, дом, офис, '.$current_city->name)">
    <meta name="yandex-verification" content="bdbc1bcf29169555" />

    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" type="image/x-icon">
    <meta name="apple-mobile-web-app-title" content="Floristum">
    <link rel="apple-touch-startup-image" href="{{ asset('images/icons/touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icons/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('images/icons/touch-icon-ipad-retina.png') }}">

    <meta property='og:image' content='@yield('pageImage', asset('assets/front/img/og_logo_floristum_ru_s.png'))' />
    <meta property='og:title' content='@yield('pageTitle', 'Доставка цветов в г '.$current_city->name.'. Заказ букетов на дом, в офис.')' />
    <meta property='og:description' content='@yield('pageDescription', 'Служба доставки цветов в г '.$current_city->name.'. Заказ букетов от лучших флористов из каталога.')' />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ \Request::url() }}" />

    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/less-space.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom.css?v=1') }}">

    <!--[if lt IE 9]>
    <script src="{{ asset('assets/front/css/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/front/css/js/respond.min.js') }}"></script>
    <![endif]-->

    @yield('head')

    <script type="text/javascript">
            var cityId = {{ $current_city ? $current_city->id : null }};
            var jsonData = {};
            var routes = {};
    </script>
</head>

<body ng-app="flowApp">
<!--[if lt IE 9]>
<p class="chromeframe text-center">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите ваш браузер</a>.</p>
<![endif]-->
<div class="preloader-wrapper">
    <div class="preloader">
        <img src="{{ asset('assets/front/img/loading.gif') }}" alt="Загрузка цветов">
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
                <a class="navbar-brand logo" href="/"></a>
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
                        <a href="{{ route('front.faq') }}" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Помощь</a>
                        <!--
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
                        -->
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
                            <!--
                            <p>На телефон будет отправлено СМС с кодом для входа в ваш кабинет</p>
                            <br>
                            <p class="text-muted">Или <a class="text-muted" href="#">войти с помощью эл. почты</a></p>
                            <br>
                            <p class="h6 text-muted">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="#">политикой конфиденциальности</a> и <a class="text-muted" href="#">соглашением об обработке персональных данных</a></p>
                            -->
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div> <!-- /.container -->
    </nav>
</header>

<section>
    @yield('content')


    <div class="container">

        

        <div class="row">
            <div class="col-md-8">
                <h5><strong>Популярные города доставки цветов:</strong></h5>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[0]['slug']?>.floristum.ru"><?=$popular_city[0]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[1]['slug']?>.floristum.ru"><?=$popular_city[1]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[2]['slug']?>.floristum.ru"><?=$popular_city[2]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[3]['slug']?>.floristum.ru"><?=$popular_city[3]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[4]['slug']?>.floristum.ru"><?=$popular_city[4]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[5]['slug']?>.floristum.ru"><?=$popular_city[5]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[6]['slug']?>.floristum.ru"><?=$popular_city[6]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[7]['slug']?>.floristum.ru"><?=$popular_city[7]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[8]['slug']?>.floristum.ru"><?=$popular_city[8]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[9]['slug']?>.floristum.ru"><?=$popular_city[9]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="http://<?=$popular_city[10]['slug']?>.floristum.ru"><?=$popular_city[10]['name']?></a></p>
                            <p class="text-muted"></p>
                        </div>

                        <div class="city-popular">
                            <p><a href="{{ route('city.popular') }}">Все города…</a></p>
                        </div>
                    </div>
                </div>
                <br class="hidden-lg hidden-md hidden-sm">
            </div>
            <div class="col-md-4">
                <h5><strong>Популярные цветы:</strong></h5>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <p class="world-popular"><a href="#">Розы</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Лилии</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Герберы</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Тюльпаны</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Каллы</a>, <span class="text-muted"></span></p>
                    </div>
                    <div class="col-xs-6">
                        <p class="world-popular"><a href="#">Ромашки</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Фиалки</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Хризантемы</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Гибискус</a>, <span class="text-muted"></span></p>
                        <p class="world-popular"><a href="#">Все цветы...</a></p>
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
                        <br>
                    </div>
                    <div class="col-md-3">
                        <p class="foot-h"><strong>Клиентам</strong></p>
                        <ul class="list-unstyled list-foot">
                            <li><a href="{{ route('front.delivery') }}">Доставка</a></li>
                            <li><a href="{{ route('front.payment') }}">Оплата</a></li>
                            <li><a href="{{ route('front.faq') }}">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="foot-h"><strong>Организациям</strong></p>
                        <ul class="list-unstyled list-foot">
                            <li><a href="{{ route('front.registershop') }}">Магазинам цветов</a></li>
                            <li><a href="{{ route('front.corporate') }}">Корпоративным клиентам</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="foot-h"><strong>Правовая&nbsp;информация</strong></p>
                        <ul class="list-unstyled list-foot">
                            <li><a href="{{ route('front.privacy') }}">Конфиденциальность</a></li>
                            <li><a href="{{ route('front.personldata') }}">Персональные данные</a></li>
                            <li><a href="{{ route('front.oferta') }}">Публичная оферта</a></li>
                            <li><a href="{{ route('front.agreement') }}">Публичная оферта о заключении договора купли-продажи</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <p>Служба поддержки: <br> <span class="h4"><a href="mailto:service@floristum.ru"><strong>service@floristum.ru</strong></a> <br> <a href="tel:88129822383"><strong>8 (812) 982-23-83</strong></a></span></p>
            </div>
            <div class="col-sm-6 text-right">
                <img src="{{ asset('assets/front/img/logo_floristum.png') }}" alt="Доставка цветов и букетов {{$current_city->name}}">
            </div>
        </div>
        <br>
    </div>
</footer>


<script src="{{ asset('assets/front/js/jquery-3.2.0.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/ng/angular-modal-service.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/ng/angular-sanitize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/ng/ngApp.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('assets/front/js/holder.min.js') }}"></script>
<script src="{{ asset('assets/front/js/custom.js') }}"></script>
@yield('footer')

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
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

</body>
</html>