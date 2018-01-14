@extends('layouts.site')

@section('content')

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

<div class="bg-white">
    <div class="container">
        <h3><strong>Преимущества доставки букетов floristum.ru:</strong></h3>
        <br>
        <div class="row text-center">
            <div class="col-sm-3">
                <figure>
                    <img src="{{ asset('assets/front/img/na-odnom-sayte.png') }}" alt="...">
                </figure>
                <br>
                <h4>Цветочные магазины<br>г. {{ $current_city->name }}<br>на одном сайте!</h4>
            </div>
            <div class="col-sm-3">
                <figure>
                    <img src="{{ asset('assets/front/img/dostavka.png') }}" alt="...">
                </figure>
                <br>
                <h4>Доставка цветов<br>от 15 минут!</h4>
            </div>
            <div class="col-sm-3">
                <figure>
                    <img src="{{ asset('assets/front/img/zashita.png') }}" alt="...">
                </figure>
                <br>
                <h4>Защита каждой<br>доставки цветов!</h4>
            </div>
            <div class="col-sm-3">
                <figure>
                    <img src="{{ asset('assets/front/img/otzivy.png') }}" alt="...">
                </figure>
                <br>
                <h4>Рейтинги доставок букетов,<br>отзывы покупателей!</h4>
            </div>
        </div>
    </div>
    <br>
</div>

<br>

<div class="container">

    <div class="row">
        <div class="col-md-5 hidden-xs hidden-sm">
            <h3 class="margin-top-null"><strong>Популярные букеты</strong></h3>
        </div>
        <div class="col-md-7">
            <ul class="list-inline list-sort text-right">
                <li>Сортировать:</li>
                <li><a href="#">по цене</a></li>
                <li><a href="#">по новизне</a></li>
            </ul>
        </div>
    </div>

    <br>

    <div class="row">

        <div class="col-md-3 col-md-push-9">
                <p class="h3 margin-top-null">Уточнить категорию</p>
                <br>

                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default" type="button" data-toggle="collapse" data-target="#filter3" aria-expanded="false" aria-controls="filter3"><span class="pull-left">Тип букета</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse in" id="filter3">
                        <ul class="list-unstyled">
                            @foreach ($productTypes as $type)
                                <li><img src="{{ asset('assets/front/img/ico/'.$type->icon) }}" alt="..."> {{ $type->name }}</li>
                            @endforeach
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
                                            <input type="checkbox" value="{{ $flower->id }}"> {{ $flower->name }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter1" aria-expanded="false" aria-controls="filter1"><span class="pull-left">Цены</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter1">
                        <ul class="list-unstyled">
                            @foreach ($prices as $price)
                                <li><a href="#">{{ $price->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter5" aria-expanded="false" aria-controls="filter5"><span class="pull-left">Цвет</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter5">
                        <div class="row">
                            @foreach ($colors as $color)
                                <div class="col-2-5">
                                    <div class="selected-color {{ $color->css_class }}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>



        <div class="col-md-9 col-md-pull-3" ng-controller="mainPage">
            <br class="hidden-lg hidden-md"><br class="hidden-lg hidden-md">
                <h3 class="margin-top-null hidden-lg hidden-md"><strong>Популярные букеты</strong></h3>
                <br class="hidden-lg hidden-md">

                <div class="row" ng-cloak>

                    <div class="col-sm-4" ng-repeat="product in popularProduct">
                        <div class="media-item">
                            <a href="/flowers/<% product.slug %>/">
                                <figure>
                                    <img class="img-responsive"  ng-src="/uploads/products/632x632/<% product.shop_id %>/<% product.photo %>" alt="...">
                                    <figcaption>
                                        <ul class="list-inline text-center">
                                            <li>Ширина <% product.width %> см</li>
                                            <li>Высота <% product.height %> см</li>
                                        </ul>
                                    </figcaption>
                                </figure>
                            </a>

                            <div class="description-media-item">
                                <div class="row">
                                    <div class="col-xs-11">
                                        <p><strong class="price-media-item"><% product.clientPrice %> руб.</strong> <a href="#"><% product.name %></a></p>
                                        <p><% product.shop_name %> &nbsp;<img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="..."> 2 ч 20 мин</p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </div>


    </div>




    <br><br>

<h3 class="text-center"><strong>О доставке цветов с Floristum.ru</strong></h3>
<br>
        <hr>
<p>Floristum.ru - сервис доставки букетов из популярных цветочных магазинов вашего города. <br><br>
На Floristum.ru вы можете выбрать и заказать букет с доставкой с оптимальным соотношением цена-качество, сравнив его с предлажениями многих магазинов цветов, представленных в Вашем городе. <br><br>
Заказывая букет у нас, Вы всегда получаете гарантировано свежие цветы с доставкой в кратчайшие сроки в полном соответствии с указанной на странице букета информацией и с фотографиями. Магазины представленные у нас заинтересованы в том, чтобы клиент был доволен и оставил хороший отзыв на страницах системы, отзывы влияют на рейтинг магазина и частоту заказов цветов.<br><br>
Каждая доставка защищена системой Floristum.ru с гарантией возврата оплаченной суммы покупателю в форсмажорных случаях при исполнении заказа цветов. Поэтому, не стесняйтесь обращаться в службу поддержки Флористум при возникновении вопросов.



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
        jsonData.popularProduct = {!! $popularProduct->makeHidden('price')->toJson() !!};
    </script>

    <script src="{{ asset('assets/front/js/typeahead.js/bloodhound.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/typeahead.js/typeahead.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/index.js') }}"></script>
    <script src="{{ asset('assets/front/ng/mainPage.js') }}" type="text/javascript"></script>
@stop