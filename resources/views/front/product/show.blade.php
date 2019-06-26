@section('head')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/social-likes/dist/social-likes_flat.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightslider/css/lightslider.min.css') }}">
@stop

@section('content')

@section('pageImage', $pageImage)
@section('pageImageWidth', $pageImageWidth)
@section('pageImageHeight', $pageImageHeight)
@section('pageTitle', $pageTitle)
@section('pageDescription', $pageDescription)
@section('pageKeywords', $pageKeywords)

<div class="container" data-ng-controller="product-view">

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
                    @if(empty($product->single))
                        <img class="img-responsive" src="{{ asset($product->photoUrl) }}" alt="{{ html_entity_decode(strip_tags($product->name)) }}">
                         <figcaption><span class="glyphicon glyphicon-resize-vertical text-muted" aria-hidden="true"></span> {{ $product->height }} см <span class="glyphicon glyphicon-resize-horizontal text-muted" aria-hidden="true"></span> {{ $product->width }} см</figcaption>
                    @else
                        <img class="img-responsive" data-ng-src="<% product.photoUrl %>" src="{{ asset('/uploads/single/'.$product->photo) }}" alt="{{ html_entity_decode(strip_tags($product->name)) }}">
                         <figcaption data-ng-cloak=""><span class="glyphicon glyphicon-resize-vertical text-muted" aria-hidden="true"></span> <% product.height %> см <span class="glyphicon glyphicon-resize-horizontal text-muted" aria-hidden="true"></span> <% product.width %> см</figcaption>
                    @endif

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

            <div class="social-likes social-likes_single" data-counters="no" data-single-title="Поделиться">
                <div class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</div>
                <div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
                <div class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</div>
            </div>


        </div>

        <div class="col-md-7 product-right">
            <div class="row">
                <div class="col-sm-6 col-md-7">

                    <h1 class="h3 title-media-item-opened"><strong data-ng-bind="product.name">{{ $product->name }}</strong></h1>

                    <p><strong>Доставка {{ ($product->deliveryTime ? '~'.$product->deliveryTime : '') }}</strong>, бесплатно в {{ $product->shop->city->name_prepositional }}</p>

                    @if(empty($product->deleted_at))
                        <p class="h3 title-media-item-opened"><i class="fa fa-rub"></i> <strong data-ng-cloak=""><% product.clientPrice %></strong></p>
                    @else
                        <p class="h3 title-media-item-opened text-danger">Товар закончился</p>
                        <a href="/" class="btn btn-lg btn-warning btn-block">
                            <strong>Подобрать аналогичный букет</strong>
                        </a>
                    @endif

                    @if(!empty($product->single) && empty($product->deleted_at))

                        <div class="sizes">
                            @foreach($shopSingleProducts as $shopSingleProduct)
                                <div class="" style="width: 20%; float: left">
                                    <a href="{{ $shopSingleProduct->url }}"class="btn btn-default btn-block {{ $shopSingleProduct->singleProduct->qty_from == $product->singleProduct->qty_from ? 'active' : '' }}" style="border-radius: 0">{{ $shopSingleProduct->singleProduct->qty_from }}</a>
                                </div>
                            @endforeach

                            <br clear="all">
                        </div>

                        <div class="zakaz-container" style="clear: both; display: block; float: left; position: relative;">
                            <div data-ng-click="downQty()" id="downQty" class="btn btn-xs btn-warning btn-block" style="width: auto; position: relative; float: left; line-height: 28px; border: 1px solid red; padding-top: 0px; padding-bottom: 0px; border-radius: 0;">
                                <i class="fa fa-minus"></i>
                            </div>
                            <div class="qty-container" style="width: auto; margin-top: 0; background: none !important;float:left;">
                                <input class="qty product-qty-input" style="text-align: center; margin-left: 0px;margin-right:0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); width:50px;height:30px;line-height:30px;outline:none;border:1px solid #e5e5e5;color:#000;border-radius:0px;font-size:15px;font-weight:400;" name="qty" size="3" maxlength="3" min="7" value="" data-ng-model="qty" />
                            </div>
                            <div data-ng-click="upQty()" class="btn btn-xs btn-warning btn-block " style="width: auto; position: relative; float: left; line-height: 28px; border: 1px solid red; padding-top: 0px; padding-bottom: 0px; border-radius: 0;">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div style="line-height: 28px; padding-left: 10px; float: left;">
                                - число цветка в букете
                            </div>
                        </div>

                    @endif

                    @if($product->description)

                        <p class="h3" id="opisanie"><strong>Описание</strong></p>
                        <p>{{ $product->description }}</p>

                    @endif


                    <br><br>
                    @if($shopIsAvailable && empty($product->deleted_at))
                        <a href="{{ route('order.add', ['product_id' => $product->id]) }}" id="go_to_order" class="btn btn-lg btn-warning btn-block">
                            <strong>Оформить заказ</strong>
                        </a>
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
                        
                        
                        <li>наличные и безнал для юрлиц</li>
                    
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


            @if($feedbacksCount)
                <br><br>
                <ul class="nav nav-tabs links-media-item-open">
                    <li role="presentation"><a href="#otzivy">{{ $feedbacksCount.' '.Lang::choice('отзыв|отзыва|отзывов', $feedbacksCount, [], 'ru') }}</a></li>
                </ul>

                @foreach($feedbacks as $feedback)

                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" width="54" height="54" src="{{ asset('assets/front/img/reviews-5.png') }}" alt="...">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><strong> {{ $feedback->name }}</strong> <? if($feedback->feedback_date != '0000-00-00 00:00:00') { ?><span class="text-muted feedback-date">{{ Carbon\Carbon::parse($feedback->feedback_date)->format('d-m-Y') }}</span><? } ?></h4>
                            <p>{{ $feedback->feedback }}</p>
                            <ul class="list-inline">
                                <li>
                                    <div class="rating-green"><span style="width:{{ $feedback->rating * 20 }}%;"></span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>

                @endforeach
            @endif

        </div>

        

        <div class="col-md-5 col-xs-12">

            <br><br>


            <div class="white-block">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="{{ asset('assets/front/img/zashita.png') }}" alt="Каждая доставка цветов страхуется">
                    </div>
                    <div class="media-body media-middle">
                        <p class="h4">Доставка каждого букета гарантирована Floristum.ru<br>Исполнитель не получит оплату, в случае претензии к качеству.<br>100% возврат средств</p>
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
                        <figcaption>Пожалуйста, оставьте отзыв о доставке цветов</figcaption>
                    </figure>
                </div>
            </div>

        </div>

        <br clear="all">

        @if($products->total())
            <div class="container-fluid">
                <h3 class="margin-top-null"><strong>Вам может понравиться:</strong></h3>
                <div class="row" style="position:relative;margin-left:0px;margin-right:0px;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left:0px;padding-right:0px;overflow:hidden;">

                        <div class="row" id="other_products_slider">
                            @foreach($products as $_item)
                                    @include('front.product.list-item')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
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

    .sizes {
            padding-bottom: 25px;
    }
/*
    .sizes a {
        color: #333;
        background-color: #fff;
        border-color: #eceded;
        border-radius: 0;
        width: 100%;
        display: block;
        font-weight: normal;
        text-align: center;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        white-space: nowrap;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .sizes a.active {
        background-color: #d4d4d4;
        border-color: #abafaf;
    }
*/

    .sizes a.active {
        box-shadow: none;
    }
</style>

@stop

@section('footer')
    <script src="{{ asset('assets/plugins/lightslider/js/lightslider.min.js') }}" type="text/javascript"></script>

    <script>
        $(window).on('load', function(){
                $('#lightSlider').lightSlider({
                        gallery: true,
                        item: 1,
                        loop: true,
                        slideMargin: 0,
                        thumbItem: 9
                });

                $('#other_products_slider').lightSlider({
                        pager: false,
                        item: 4,
                        responsive : [
                                {
                                        breakpoint:480,
                                        settings: {
                                                item:1
                                        }
                                }
                        ]
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/social-likes/dist/social-likes.min.js"></script>
    <script src="{{ asset('assets/front/ng/product-view.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
            jsonData.product = {!! $product->makeHidden('price')->toJson() !!};
            @if(!empty($shopSingleProducts))
                jsonData.shopSingleProducts = {!! $shopSingleProducts->makeHidden('price')->toJson() !!};
            @endif
    </script>
@stop