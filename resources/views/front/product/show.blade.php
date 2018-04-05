@section('content')

@section('pageImage', $pageImage)
@section('pageTitle', $pageTitle)
@section('pageDescription', $pageDescription)
@section('pageKeywords', $pageKeywords)

<div class="container">

    <br>
    <ol class="breadcrumb">
        <li><a href="/">Цветы в {{ $product->shop->city->name_prepositional }}</a></li>
        <li><a href="{{ route('shop.products', ['id' => $product->shop->id]) }}">Магазин {{ $product->shop->name }}</a></li>
        <li class="active">{{ $product->name }}</li>
    </ol>

    <div class="row media-item-opened">
        <div class="col-md-5">

            @if(count($product->photos) == 1)

                <figure class="main-picture">
                    <img class="img-responsive" src="{{ asset($product->photoUrl) }}" alt="{{ html_entity_decode(strip_tags($product->name)) }}">
                    <figcaption><span class="glyphicon glyphicon-resize-vertical text-muted" aria-hidden="true"></span> {{ $product->height }} см <span class="glyphicon glyphicon-resize-horizontal text-muted" aria-hidden="true"></span> {{ $product->width }} см</figcaption>
                </figure>


            @else


                <figure class="main-picture main-picture2">


                    <div class="demo">
                        <ul id="lightSlider">
                            <li data-thumb="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$product->photo) }}">
                                <img src="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$product->photo) }}" />
                            </li>
                            @foreach($product->photos as $photo)
                                <li data-thumb="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$photo->photo) }}">
                                    <img src="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$photo->photo) }}" />
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <figcaption><span class="glyphicon glyphicon-resize-vertical text-muted" aria-hidden="true"></span> {{ $product->height }} см <span class="glyphicon glyphicon-resize-horizontal text-muted" aria-hidden="true"></span> {{ $product->width }} см</figcaption>
                </figure>

            @endif

        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-sm-6 col-md-7">

                    <h1 class="h3 title-media-item-opened"><strong>{{ $product->name }}</strong></h1>

                    <p><strong>Доставка {{ ($product->deliveryTime ? '~'.$product->deliveryTime : '') }}</strong>, бесплатно в {{ $product->shop->city->name_prepositional }}</p>

                    <p class="h3 title-media-item-opened"><i class="fa fa-rub"></i> <strong>{{ $product->clientPrice }}</strong></p>

                    <br><br>
                    @if($shopIsAvailable)
                        <a href="{{ route('order.add', ['product_id' => $product->id]) }}" target="_blank" class="btn btn-lg btn-warning btn-block"><strong>Оформить заказ</strong></a>
                    @endif
                    <ul class="list-inline">
                        <li>
                            <img src="{{ asset('assets/front/img/ico/visa.svg') }}" alt="visa">
                        </li>
                        <li>
                            <img src="{{ asset('assets/front/img/ico/mastercard.svg') }}" alt="mastercard">
                        </li>
                        <li>
                            <img src="{{ asset('assets/front/img/ico/maestro.svg') }}" alt="maestro">
                        </li>
                        <li>
                            <img src="{{ asset('assets/front/img/ico/americaexpress.svg') }}" alt="americaexpress">
                        </li>
                        <li>
                            <img src="{{ asset('assets/front/img/ico/otherpay.svg') }}" alt="otherpay">
                        </li>
                        <!--
                        <li>и наличные</li>
                        -->
                    </ul>
                    <br>

                    <ul class="text-info">
                        <li>Букет и исполнитель проверены</li>
                    </ul>

                    @if($product->id == 2461)
                        @if($product->shop->workTimeIsSet())
                            <p>График работы:</p>
                        <ul class="text-info">
                            <li class="{{ !$product->shop->workTime[0]->is_work ? 'text-danger' : '' }}">
                                <span>Пн:</span> {{ !$product->shop->workTime[0]->is_work ? 'выходной' : ($product->shop->workTime[0]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[0]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[0]->work_to)) }}
                            </li>
                            <li class="{{ !$product->shop->workTime[1]->is_work ? 'text-danger' : '' }}">
                                <span>Вт:</span> {{ !$product->shop->workTime[1]->is_work ? 'выходной' : ($product->shop->workTime[1]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[1]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[1]->work_to)) }}
                            </li>
                            <li class="{{ !$product->shop->workTime[2]->is_work ? 'text-danger' : '' }}">
                                <span>Ср:</span> {{ !$product->shop->workTime[2]->is_work ? 'выходной' : ($product->shop->workTime[2]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[2]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[2]->work_to)) }}
                            </li>
                            <li class="{{ !$product->shop->workTime[3]->is_work ? 'text-danger' : '' }}">
                                <span>Чт:</span> {{ !$product->shop->workTime[3]->is_work ? 'выходной' : ($product->shop->workTime[3]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[3]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[3]->work_to)) }}
                            </li>
                            <li class="{{ !$product->shop->workTime[4]->is_work ? 'text-danger' : '' }}">
                                <span>Пт:</span> {{ !$product->shop->workTime[4]->is_work ? 'выходной' : ($product->shop->workTime[4]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[4]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[4]->work_to)) }}
                            </li>
                            <li class="{{ !$product->shop->workTime[5]->is_work ? 'text-danger' : '' }}">
                                <span>Сб:</span> {{ !$product->shop->workTime[5]->is_work ? 'выходной' : ($product->shop->workTime[5]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[5]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[5]->work_to)) }}
                            </li>
                            <li class="{{ !$product->shop->workTime[6]->is_work ? 'text-danger' : '' }}">
                                <span>Вс:</span> {{ !$product->shop->workTime[6]->is_work ? 'выходной' : ($product->shop->workTime[6]->round_clock ? 'круглосуточно' : \App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[6]->work_from).'-'.\App\Helpers\AppHelper::formatMinutesToTime($product->shop->workTime[6]->work_to)) }}
                            </li>
                        </ul>
                        @endif
                    @endif

                </div>
                <div class="col-sm-6 col-md-5">
                    @if($product->width || $product->height)
                        <ul class="list-unstyled">
                            <li>ID: {{ $product->id }}</li>
                            @if($product->width)
                            <li>Ширина {{ $product->width }} см</li>
                            @endif
                            @if($product->height)
                            <li>Высота {{ $product->height }} см</li>
                            @endif
                        </ul>
                    @endif
                    @if(count($product->compositions))
                        <p><strong>Состав</strong></p>
                        <ul class="list-unstyled">
                            @foreach($product->compositions as $composition)
                                <li>{{ $composition->flower->name }} {{ $composition->qty ? ' - '.$composition->qty.' шт.' : null }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <br>

                        <!--
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">-</div>
                                        <input type="text" class="form-control text-center" id="inputAmount" value="1">
                                    <div class="input-group-addon">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                        -->


                </div>
            </div>


            <br><br>

            <p class="h3" id="opisanie"><strong>Описание</strong></p>
            <p>{{ $product->description }}</p>

            <br><br>

            <div class="white-block">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="{{ asset('assets/front/img/zashita.png') }}" alt="Каждая доставка цветов страхуется">
                    </div>
                    <div class="media-body media-middle">
                        <p class="h4">Доставка каждого букета гарантирована Floristum.ru<br>Исполнитель не получит оплату, в случае притензии к качеству.<br>100% возврат средств</p>
                    </div>
                </div>
            </div>

            <br><br>

            <p class="h3" id="chto-posle"><strong>Что после оплаты заказа?</strong></p>
            <br>
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <span class="digital one">1</span>
                        <figcaption>Флорист отправит Вам подтверждение заказа</figcaption>
                    </figure>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <span class="digital two">2</span>
                        <figcaption>Соберёт букет из свежих цветов</figcaption>
                    </figure>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <span class="digital three">3</span>
                        <figcaption>Доставка цветов получателю</figcaption>
                    </figure>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <span class="digital four">4</span>
                        <figcaption>Пожалуйста, оставте отзыв о доставке цветов</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@extends('layouts.site')

@section('head')

<link rel="stylesheet" href="{{ asset('assets/plugins/lightslider/css/lightslider.min.css') }}">

<style>
    .demo {
        width:100%
    }
    .demo ul {
        list-style: none outside none;
        padding-left: 0;
        margin-bottom:0;
    }
    .demo li {
        display: block;
        float: left;
        margin-right: 6px;
        cursor:pointer;
    }
    .demo img {
        display: block;
        height: auto;
        max-width: 100%;
    }

    .lSSlideOuter .lSPager.lSGallery li.active, .lSSlideOuter .lSPager.lSGallery li:hover {
        border-radius: 0px !important;
    }

    .media-item-opened .main-picture2 figcaption {
        bottom: 60px !important;
    }
</style>

@stop

@section('footer')
    <script src="{{ asset('assets/plugins/lightslider/js/lightslider.min.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
                $('#lightSlider').lightSlider({
                        gallery: true,
                        item: 1,
                        loop: true,
                        slideMargin: 0,
                        thumbItem: 9
                });
        })
    </script>
@stop