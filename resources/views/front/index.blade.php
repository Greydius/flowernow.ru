@extends('layouts.site')

@section('content')

    <div class="container">
        <div class="logo-container-wraper hidden-lg hidden-md hidden-xs" style="position: relative; display: none">
            <a class="logo-container" href="/"></a>
            @if(!empty($holiday_icon))
                <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[0].'.png') }}" class="holiday-img">
            @endif
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-4">
                <h1 class="h2 sm-h2">Доставка цветов<br>в <a href="#" class="choose-city-link" onclick="chooseCity(); return false;">{{ $current_city->name_prepositional }}</a></h1>
                <span id="filtr" name="filtr"></span>
            </div>
            <div class="col-md-8 hidden-xs hidden-sm">
                @include('front.product-types')

            </div>
        </div>
        <br>
    </div>

    @if(count($popularProducts) || count($singleProducts))

        <div class="container" data-ng-controller="mainPage">

            @if(empty($popularProducts))
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-5">
                        <h2 class="margin-top-null">{{ !empty($currentType) ? $currentType->alt_name : null }}</h2>
                    </div>
                    <div class="col-md-7">
                        <ul class="list-inline list-sort text-right">
                            <li>Сортировать:</li>
                            <li><a href="#">по цене</a></li>
                            <li><a href="#">по новизне</a></li>
                        </ul>
                    </div>
                </div>

                <br class="hidden-xs hidden-sm">

            @endif

            <div class="row" id="products-container">


                <div class="col-md-12" style="background-color: #fff; padding-top: 10px;"  >
                    <div class="free_phone hidden-xs">
                      <b>8 800 600-54-97</b>
                        <span>Звонок бесплатный</b> </br></br></br></span>
                    </div>

                    @if(!empty($popularProducts))
                        @foreach($popularProducts as $item)
                            @if(!empty($item['productType']) && $item['productType']->id == 2 && $item['popularProductCount'] >= 3)
                                <div data-ng-hide="isFiltered">
                                    <div class="hidden-lg hidden-md hidden-xs">
                                        <br><br>
                                    </div>
                                    <h2 class="margin-top-null">{{ $item['productType']->alt_name }} с доставкой в {{ $current_city->name_prepositional }}</h2>
                                    <br class="hidden-lg hidden-md">

                                    <div class="row">
                                        @foreach($item['popularProduct'] as $key => $_item)
                                            @if($key < 3 || $item['popularProductCount'] == 8)

                                                @include('front.product.list-item', ['col' => 3])

                                            @endif
                                        @endforeach

                                        <br clear="all">
                                        @if($item['popularProduct']->total() > 8)
                                            <div class="col-md-6 col-md-offset-3 bottom30">
                                                <a href="/catalog/{{ $item['productType']->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все {{ mb_strtolower($item['productType']->alt_name) }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    @endif

                        @if(count($singleProducts))
                            <div data-ng-hide="isFiltered">
                                <div class="hidden-lg hidden-md hidden-xs">
                                    <br><br>
                                </div>

                                <h2 class="margin-top-null">Букеты цветов поштучно</h2>
                                <br class="hidden-lg hidden-md">

                                <div class="row">
                                    @foreach($singleProducts as $_item)
                                        @include('front.product.list-item', ['col' => 3])
                                    @endforeach
                                </div>

                                <br clear="all">
                                <div class="col-md-6 col-md-offset-3 bottom30">
                                    <a href="/catalog/single" class="btn btn-block btn-more">Смотреть все букеты поштучно</a>
                                </div>

                                <br clear="all">
                            </div>
                        @endif

                        @if(!empty($lowPriceProducts) && count($lowPriceProducts))
                            <div data-ng-hide="isFiltered">
                                <div class="hidden-lg hidden-md hidden-xs">
                                    <br><br>
                                </div>
                                <h2 class="margin-top-null">Самые низкие цены</h2>
                                <br class="hidden-lg hidden-md">

                                <div class="row">
                                    @foreach($lowPriceProducts as $_item)
                                        @include('front.product.list-item', ['col' => 3])
                                    @endforeach
                                </div>

                                <br clear="all">
                                <div class="col-md-6 col-md-offset-3 bottom30">
                                    <a href="/catalog/?order=price" class="btn btn-block btn-more">Смотреть все букеты с низкими ценами</a>
                                </div>

                                <br clear="all">
                            </div>
                        @endif

                        <div class="bg-white hidden-xs hidden-sm">
                            <div class="container">
                                <h3><strong>Преимущества доставки букетов floristum.ru:</strong></h3>
                                <br>
                                <div class="row text-center">
                                    <div class="col-sm-3">
                                        <figure>
                                            <img src="{{ asset('assets/front/img/na-odnom-sayte.png') }}" alt="Все цветочные магазины г {{$current_city->name}}">
                                        </figure>
                                        <br>
                                        <h4>Цветочные магазины<br>г. {{ $current_city->name }}<br>на одном сайте!</h4>
                                    </div>
                                    <div class="col-sm-3">
                                        <figure>
                                            <img src="{{ asset('assets/front/img/dostavka.png') }}" alt="Быстрая доставка по г {{$current_city->name}}">
                                        </figure>
                                        <br>
                                        <h4>Доставка цветов<br>от 15 минут!</h4>
                                    </div>
                                    <div class="col-sm-3">
                                        <figure>
                                            <img src="{{ asset('assets/front/img/zashita.png') }}" alt="Каждая доставка цветов страхуется">
                                        </figure>
                                        <br>
                                        <h4>Защита каждой<br>доставки цветов!</h4>
                                    </div>
                                    <div class="col-sm-3">
                                        <figure>
                                            <img src="{{ asset('assets/front/img/otzivy.png') }}" alt="Отзывы о магазинах цветов">
                                        </figure>
                                        <br>
                                        <h4>Рейтинги доставок букетов,<br>отзывы покупателей!</h4>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>



                        @if(!empty($specialOffers) && !empty($specialOfferProducts))
                            @foreach($specialOffers as $specialOffer)
                                <div data-ng-hide="isFiltered">
                                    <div class="hidden-lg hidden-md hidden-xs">
                                        <br><br>
                                    </div>
                                    <h2 class="margin-top-null specialOffer">{{ $specialOffer->name }}</h2>
                                    <br class="hidden-lg hidden-md">

                                    <div class="row">
                                        @foreach($specialOfferProducts[$specialOffer->id] as $_item)
                                            @include('front.product.list-item', ['col' => 3])
                                        @endforeach
                                    </div>

                                    <br clear="all">
                                    <div class="col-md-6 col-md-offset-3 bottom30">
                                        <a href="/catalog/" class="btn btn-block btn-more">Перейти в каталог букетов</a>
                                    </div>
                                    <br clear="all">
                                </div>
                            @endforeach
                        @endif


                        @include('front.product.search', ['col' => 3])

                        @if(!empty($popularProducts))
                            @foreach($popularProducts as $item)
                                @if(!empty($item['productType']) && $item['productType']->id != 2 && $item['popularProductCount'] >= 3)
                                    <div data-ng-hide="isFiltered">
                                        <div class="hidden-lg hidden-md hidden-xs">
                                            <br><br>
                                        </div>
                                        <h2 class="margin-top-null">{{ $item['productType']->alt_name }}</h2>
                                        <br class="hidden-lg hidden-md">

                                        <div class="row">
                                            @foreach($item['popularProduct'] as $key => $_item)
                                                @if($key < 3 || $item['popularProductCount'] == 8)

                                                    @include('front.product.list-item', ['col' => 3])

                                                @endif
                                            @endforeach

                                            <br clear="all">
                                            @if($item['popularProduct']->total() > 6)
                                                <div class="col-md-6 col-md-offset-3 bottom30">
                                                    <a href="/catalog/{{ $item['productType']->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все {{ mb_strtolower($item['productType']->alt_name) }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @if(!empty($popularProduct))
                            @foreach($popularProduct as $_item)

                                <div class="col-sm-3">
                                    <div class="media-item">
                                        <a href="/flowers/{{ $_item['slug'] }}">
                                            <figure>
                                                <img class="img-responsive" src="{{ $_item['photoUrl'] }}" alt="...">
                                                <figcaption>
                                                    <ul class="list-inline text-center">
                                                        <li>Ширина {{ $_item['width'] }} см</li>
                                                        <li>Высота {{ $_item['height'] }} см</li>
                                                    </ul>
                                                </figcaption>
                                            </figure>
                                        </a>

                                        <div class="description-media-item">
                                            <div class="row">
                                                <div class="col-xs-11">
                                                    <p><strong class="price-media-item">{{ $_item['clientPrice'] }} руб.</strong> <a href="/flowers/{{ $_item['slug'] }}" class="name">{{ $_item['name'] }}</a></p>
                                                    <p>{{ $_item['shop_name'] }}> &nbsp;<img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки цветов"> 2 ч 20 мин</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach
                        @endif

                </div>


            </div>




        </div>



    @else

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="md-mt-30 md-mb-50 text-left"><strong>В ближайшее время сервис доставки букетов Флористум (floristum.ru) заработает и в {{ $current_city->name_prepositional }}.</strong></h4>

                    <h2 class="text-left"><strong>Вы представитель магазина?</strong></h2>

                    <h4 class="md-mb-40">Если Вы — представитель магазина цветов, а {{ $current_city->name }} — территория работы Вашей службы доставки, то <a href="{{ route('register') }}">регистрируйтесь</a> прямо сейчас и получайте заказы уже завтра!</h4>
                </div>
            </div>
        </div>

    @endif


    @if(count($feedbacks))

        <div class="container">
            <br class="hidden-xs hidden-sm">
            <center>
                <h3>Отзывы о доставке букетов в городе {{ $current_city->name }}</h3>
            </center>
            <br class="hidden-xs hidden-sm">
            <div class="row owl-carousel owl-theme">

        @foreach($feedbacks as $key => $feedback)

            <div class=" col-md-12">
                <div class="media-left">
                    <img class="media-object" width="54" height="54" src="{{ asset('assets/front/img/reviews-5.png') }}" alt="...">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                            <strong> {{ $feedback->name }}</strong>
                            <? if($feedback->feedback_date != '0000-00-00 00:00:00') { ?><br><span class="text-muted feedback-date">{{ Carbon\Carbon::parse($feedback->feedback_date_tmp)->format('d.m.Y') }}</span><? } ?>
                    </h4>
                    <p>{{ $feedback->feedback }}</p>
                    <ul class="list-inline">
                        <li>
                            <div class="rating-green"><span style="width:{{ $feedback->rating * 20 }}%;"></span></div>
                        </li>
                    </ul>
                </div>
            </div>

        @endforeach
            </div>
        </div>

    @endif

    <br class="hidden-xs hidden-sm">





    <div class="container">
        <br><br>
        <img src="http://floristum.ru/images/dostavka_tsvetov_v_ofis1.png" alt="Доставка цветов и букетов" align="left"
             vspace="20" hspace="25"><h3 class="text-left">О доставке цветов в {{ $current_city->name_prepositional }} с Floristum.ru</h3>

        <p><b>Флористум — сервис заказа доставки цветов в {{ $current_city->name_prepositional }} и по всей России</b>.  </br>   На Флористум.ру вы можете заказать букеты в офис или на дом из популярных цветочных магазинов с оптимальным соотношением цена — качество, сравнив предложение с аналогичными композициями флористов и магазинов, представленных в {{ $current_city->name_prepositional }}. <br><br>
            Заказывая букет у нас, Вы всегда получаете гарантировано свежие цветы с доставкой в кратчайшие сроки в полном соответствии с указанной на странице букета информацией и фотографиями. Цветочные магазины и флористы, представленные у нас, заинтересованы в том, чтобы клиент был доволен и оставил хороший отзыв на страницах системы, который повлияет на рейтинг магазина и частоту заказов цветов у флориста.<br><br>
            Каждая доставка защищена системой Флористум с гарантией возврата оплаченной суммы покупателю в форсмажорных случаях при исполнении заказа цветов. Поэтому, незамедлительно обращайтесь в службу поддержки Флористум при возникновении любых вопросов. Мы готовы доставить, практически, любые цветы для Вас и ваших близких от недорогих (дешевых) до элитных (VIP): подсолнухи, лилии, герберы, альстромерии, ромашки, ирисы, розы, каллы, гиацинты, пионы, амариллисы, тюльпаны, орхидеи, хризантемы и другие, даже самые экзотические цветы.

        </p>
        <p> <br><br>
            <img src="http://floristum.ru/images/dostavka_tsvetov_po_beznalu1.png" alt="Доставка цветов по безналу" align="right"  vspace="15" hspace="25"> <h3>Доставка цветов для юр лиц по безналичному расчету</h3>


        <p><b>Доставка букетов цветов с оплатой по безналу в {{ $current_city->name_prepositional }}</b> юридическим лицам, для сотрудников организаций и их клиентов в офисы и на дом — одно из основных направлений нашей работы. Ассортимент букетов по ценам представленным на сайте предлагается как публичное <b>коммерческое предложение на цветы</b> для юридических лиц.<br><br>С Floristum.ru процесс выбора букета или цветочной композиции для поздравления коллег, сотрудников и клиентов станет простым, интересным и не займет много времени. Забудьте о тратах наличных на букеты для корпоративных нужд и об очередях в магазинах — заказывайте доставку цветов и оплачивайте с расчетного счета юр лица! <br><br>Мы предоставляем полный пакет закрывающих документов на заказанные у нас букеты цветов. Подробнее в разделе <a href="{{ route('front.corporate') }}">доставка цветов по безналу</a> в {{ $current_city->name_prepositional }}.</p>



        <br><br>

    </div>

@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/plugins/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/OwlCarousel2-2.3.4/assets/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/js/typeahead.js/typeaheadjs.css') }}" />
@stop

@section('footer')

    <script src="{{ asset('assets/plugins/OwlCarousel2-2.3.4/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/typeahead.js/bloodhound.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/typeahead.js/typeahead.jquery.js') }}"></script>
    <script src="{{ asset('assets/front/js/index.js?v=2_3') }}"></script>
    <script src="{{ asset('assets/front/ng/mainPage.js?v=2_3') }}" type="text/javascript"></script>

    <script type="text/javascript">

            routes.products = '{!! route('api.products.popular') !!}';
            $('.owl-carousel').owlCarousel({

                    nav:true,

            })
    </script>
@stop