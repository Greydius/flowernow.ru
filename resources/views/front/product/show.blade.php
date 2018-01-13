@extends('layouts.site')

@section('head')

@stop

@section('footer')

@stop

@section('content')

<div class="container">

    <br>
    <ol class="breadcrumb">
        <li><a href="#">Цветы в {{ $product->shop->city->name_prepositional }}</a></li>
        <li><a href="#">Магазин {{ $product->shop->name }}</a></li>
        <li class="active">{{ $product->name }}</li>
    </ol>

    <div class="row media-item-opened">
        <div class="col-md-5">
            <figure class="main-picture">
                <img class="img-responsive" src="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$product->photo) }}" alt="...">
                <figcaption><span class="glyphicon glyphicon-resize-vertical text-muted" aria-hidden="true"></span> {{ $product->height }} см <span class="glyphicon glyphicon-resize-horizontal text-muted" aria-hidden="true"></span> {{ $product->width }} см</figcaption>
            </figure>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-sm-6 col-md-7">
                    <h1 class="h3 title-media-item-opened"><strong>{{ $product->name }}, {{ $product->price }} руб.</strong></h1>


                    <br><br>
                    <a href="{{ route('order.add', ['product_id' => $product->id]) }}" target="_blank" class="btn btn-lg btn-warning btn-block"><strong>Оформить заказ</strong></a>
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

                </div>
                <div class="col-sm-6 col-md-5">
                    @if($product->width || $product->height)
                        <ul class="list-unstyled">
                            @if($product->width)
                            <li>Ширина {{ $product->width }} см</li>
                            @endif
                            @if($product->height)
                            <li>Высота {{ $product->height }} см</li>
                            @endif
                        </ul>
                    @endif
                    @if(!empty($product->compositions))
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

            <ul class="nav nav-tabs links-media-item-open">
                <li role="presentation"><a href="#ispolnitel">Исполнитель</a></li>
                <li role="presentation"><a href="#opisanie">Описание</a></li>
                <li role="presentation"><a href="#chto-posle">Что после?</a></li>
            </ul>

            <br><br>

            <div class="media">
                <div class="media-body">
                    <p class="h3 margin-top-null" id="ispolnitel"><strong>Исполнитель <a href="#">{{ $product->shop->name }}</a></strong></p>
                    <ul class="list-inline list-checked-shop">
                        <li>Премиум</li>
                        <li>Проверен</li>
                    </ul>
                    <p>Работает пн-пт с 8 ч до 22 ч, сб-вс с 9 ч до 21 ч</p>

                </div>
                <div class="media-right">
                    <img class="media-object img-circle" src="{{ asset('assets/front/images/1490109791_54681584.jpg') }}" alt="...">
                </div>
            </div>

            <br>

            <p class="h3" id="opisanie"><strong>Описание</strong></p>
            <p>{{ $product->description }}</p>

            <br><br>

            <div class="white-block">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="{{ asset('assets/front/img/ico/secure.svg') }}" alt="...">
                    </div>
                    <div class="media-body media-middle">
                        <p class="h4"><strong>Защита покупателя</strong> <br>100% возврат средств.</p>
                    </div>
                </div>
            </div>

            <br><br>

            <p class="h3" id="chto-posle"><strong>Что после оформления заказа?</strong></p>
            <br>
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <img src="{{ asset('assets/front/img/ico/timer.svg') }}" alt="...">
                        <figcaption>Магазин примет ваш заказ</figcaption>
                    </figure>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <img src="{{ asset('assets/front/img/ico/buket.svg') }}" alt="...">
                        <figcaption>Соберёт букет и пришлёт фото до доставки</figcaption>
                    </figure>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <img src="{{ asset('assets/front/img/ico/pointmap.svg') }}" alt="...">
                        <figcaption>Увидите передвижение курьера на карте</figcaption>
                    </figure>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <figure class="after-ord-icn">
                        <img src="{{ asset('assets/front/img/ico/feeds.svg') }}" alt="...">
                        <figcaption>Оставляете отзыв о работе исполнителя</figcaption>
                    </figure>
                </div>
            </div>

            <br><br>

            <p>Поделитесь этим букетом</p>
            <ul class="list-inline list-shared">
                <li><a class="fb" href="#">Поделиться</a></li>
                <li><a class="vk" href="#">Поделиться</a></li>
                <li><a class="pn" href="#">Запинить</a></li>
            </ul>
        </div>
    </div>

</div>

@endsection