@extends('layouts.site')

@section('content')

    <div class="container">
        <h1 class="h2">Доставка цветов в <a href="#" class="choose-city-link" onclick="chooseCity(); return false;">{{ $current_city->name_prepositional }}</a></h1>
        <br>
    </div>
<!--
<div class="container">
    <h1 class="h2">Доставка цветов в {{ $current_city->name_prepositional }} <small>или <a href="#">укажите город</a>.</small></h1>

    <div class="adress-form">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputCity1">Город</label>
                    <input type="text" class="form-control" id="inputCity" value="{{ $current_city ? $current_city->name : null }}">
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
-->
@if(count($popularProducts) || count($singleProducts))

<div class="container" ng-controller="mainPage">

@if(empty($popularProducts))
    <div class="row hidden-xs hidden-sm">
        <div class="col-md-5">
            <h3 class="margin-top-null"><strong>{{ !empty($currentType) ? $currentType->alt_name : null }}</strong></h3>
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

        <div class="col-md-3 col-md-push-9 hidden-xs hidden-sm">
                <p class="h3 margin-top-null">Уточнить категорию</p>
                <br>

                <div class="filter-block filter-product-checker">
                    <button class="btn btn-lg btn-block btn-default" type="button" data-toggle="collapse" data-target="#filter-product-type" aria-expanded="false" aria-controls="filter3"><span class="pull-left">Тип букета</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse in" id="filter-product-type">
                        <ul class="list-unstyled filter">
                            @foreach ($productTypes as $type)
                                @foreach($popularProducts as $item)
                                    @if($item['productType']->id == $type->id && $item['popularProductCount'])
                                        <li data-id="{{ $type->id }}" data-slug="{{ $type->slug }}" class="{{ !empty(request()->product_type) && request()->product_type == $type->slug ? 'active' : null }}"><img src="{{ asset('assets/front/img/ico/'.$type->icon) }}" alt="{{ $type->alt_name }}"> {{ $type->name }}</li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter4" aria-expanded="false" aria-controls="filter4"><span class="pull-left">Цветы в букете</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter4">
                        <ul class="list-unstyled">
                            @foreach ($flowers as $flower)
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

                <div class="filter-block filter-product-checker">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter-product-price" aria-expanded="false" aria-controls="filter1"><span class="pull-left">Цена</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter-product-price">
                        <ul class="list-unstyled">
                            @foreach ($prices as $price)
                                <li data-id="{{ $price->id }}" data-from="{{ $price->price_from }}" data-to="{{ $price->price_to }}" class="{{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == $price->price_from && request()->price_to == $price->price_to ? 'active' : null }}">{{ $price->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter-product-color" aria-expanded="false" aria-controls="filter5"><span class="pull-left">Цветовая гамма</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter-product-color">
                        <div class="row">
                            @foreach ($colors as $color)
                                <div class="col-2-5 color-item {{ !empty(request()->color) && request()->color == $color->id ? 'active' : null }}" data-id="{{ $color->id }}">
                                    <div class="selected-color {{ $color->css_class }}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button class="btn btn-info btn-block" ng-show="isFiltered" ng-click="resetFilter()">Сбросить фильтр</button>
        </div>



        <div class="col-md-9 col-md-pull-3" style="background-color: #fff; padding-top: 10px;"  >

                @if(count($singleProducts))
                    <div ng-hide="isFiltered">
                        <div class="hidden-lg hidden-md hidden-xs">
                            <br><br>
                        </div>

                        <h3 class="margin-top-null"><strong>Букеты цветов поштучно</strong></h3>
                        <br class="hidden-lg hidden-md">

                        @foreach($singleProducts as $_item)
                            @include('front.product.list-item')
                        @endforeach

                        <div class="col-md-6 col-md-offset-3 bottom30">
                            <a href="/catalog/single" class="btn btn-block btn-more">Смотреть все букеты поштучно</a>
                        </div>

                        <br clear="all">
                    </div>
                @endif

                @if(count($lowPriceProducts))
                    <div ng-hide="isFiltered">
                        <div class="hidden-lg hidden-md hidden-xs">
                            <br><br>
                        </div>
                        <h3 class="margin-top-null"><strong>Самые низкие цены</strong></h3>
                        <br class="hidden-lg hidden-md">

                        @foreach($lowPriceProducts as $_item)
                            @include('front.product.list-item')
                        @endforeach

                        <div class="col-md-6 col-md-offset-3 bottom30">
                            <a href="/catalog/?order=price" class="btn btn-block btn-more">Смотреть все букеты с низкими ценами</a>
                        </div>

                        <br clear="all">
                    </div>
                @endif

                @if(!empty($specialOffers) && !empty($specialOfferProducts))
                    @foreach($specialOffers as $specialOffer)
                        <div ng-hide="isFiltered">
                            <div class="hidden-lg hidden-md hidden-xs">
                                <br><br>
                            </div>
                            <h3 class="margin-top-null"><strong>{{ $specialOffer->name }}</strong></h3>
                            <br class="hidden-lg hidden-md">

                            @foreach($specialOfferProducts[$specialOffer->id] as $_item)
                                @include('front.product.list-item')
                            @endforeach

                            <div class="col-md-6 col-md-offset-3 bottom30">
                                <a href="/catalog/" class="btn btn-block btn-more">Перейти в каталог букетов</a>
                            </div>
                            @endforeach
                            <br clear="all">
                        </div>
                @endif


                @include('front.product.search')

                @if(!empty($popularProducts))
                    @foreach($popularProducts as $item)
                        @if($item['popularProductCount'] >= 3)
                            <div ng-hide="isFiltered">
                                <div class="hidden-lg hidden-md hidden-xs">
                                    <br><br>
                                </div>
                                <h3 class="margin-top-null"><strong>{{ $item['productType']->alt_name }}</strong></h3>
                                <br class="hidden-lg hidden-md">

                                <div class="row">
                                    @foreach($item['popularProduct'] as $key => $_item)
                                        @if($key < 3 || $item['popularProductCount'] == 6)

                                            @include('front.product.list-item')

                                        @endif
                                    @endforeach

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

                        <div class="col-sm-4">
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
                <h4 class="md-mt-30 md-mb-50 text-left"><strong>В ближайшее время сервис доставки букетов Флористум (floristum.ru) заработает в городе {{ $current_city->name_prepositional }}.</strong></h4>

                <h3 class="text-left"><strong>Вы представитель магазина?</strong></h3>

                <h4 class="md-mb-40">Если Вы — представитель магазина цветов, а {{ $current_city->name }} — территория работы Вашей службы доставки, то <a href="{{ route('register') }}">регистрируйтесь</a> прямо сейчас и получайте заказы уже завтра!</h4>
            </div>
        </div>
    </div>

@endif

<br class="hidden-xs hidden-sm">

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



<div class="container">

<h3 class="text-left"><strong>О доставке цветов с Floristum.ru</strong></h3>
<hr>
    <p><b>Флористум — сервис заказа доставки цветов по городу {{ $current_city->name }} и всей России</b></b>.  </br>   На Флористум.ру вы можете заказать букеты в офис или на дом из популярных цветочных магазинов с оптимальным соотношением цена—качество, сравнив предложение с аналогичными композициями флористов и магазинов, представленных в городе {{ $current_city->name }}. <br><br>
        Заказывая букет у нас, Вы всегда получаете гарантировано свежие цветы с доставкой в кратчайшие сроки в полном соответствии с указанной на странице букета информацией и фотографиями. Цветочные магазины и флористы, представленные у нас, заинтересованы в том, чтобы клиент был доволен и оставил хороший отзыв на страницах системы, который повлияет на рейтинг магазина и частоту заказов цветов у флориста.<br><br>
        Каждая доставка защищена системой Флористум с гарантией возврата оплаченной суммы покупателю в форсмажорных случаях при исполнении заказа цветов. Поэтому, незамедлительно обращайтесь в службу поддержки Флористум при возникновении любых вопросов.


        <br><br>


        Мы готовы доставить, практически, любые цветы для Вас и ваших близких: подсолнухи, лилии, герберы, альстромерии, ромашки, ирисы, розы, каллы, гиацинты, пионы, амариллисы, тюльпаны, орхидеи, хризантемы и другие, даже самые экзотические цветы.

    </p>


    <br><br>

</div>

@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('assets/front/js/typeahead.js/typeaheadjs.css') }}">
@stop

@section('footer')
    <script type="text/javascript">

        routes.products = '{!! route('api.products.popular') !!}';
    </script>

    <script src="{{ asset('assets/front/js/typeahead.js/bloodhound.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/typeahead.js/typeahead.jquery.js') }}"></script>
    <script src="{{ asset('assets/front/js/index.js?v=2_3') }}"></script>
    <script src="{{ asset('assets/front/ng/mainPage.js?v=2_3') }}" type="text/javascript"></script>
@stop