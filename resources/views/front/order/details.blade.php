@extends('layouts.site')

@section('content')

    <div class="container order-details bottom30">

        <br>
        @if($order->payed)
            <div class="row bottom20">
                <div class="col-md-12">
                    <figure class="highlight">

                        <div class="pre">
                            <p class="text-danger">
                                <strong>
                                    @if($order->payment != App\Model\Order::$PAYMENT_CASH)
                                        Заказ №{{ $order->id }} оплачен!
                                    @else
                                        Заказ №{{ $order->id }} оформлен!
                                    @endif
                                </strong>
                            </p>
                            <p>Отслеживание заказа: <a href="{{ $order->getDetailsLink() }}">{{ $order->getDetailsLink() }}</a></p>
                            @if(!empty($order->email))
                                <p>На Ваш email отправлено информационное сообщение о заказе.</p>
                            @endif
                            @if($order->payment == App\Model\Order::$PAYMENT_CASH)
                                <p><strong>Пожалуйста, по возможности, приготовьте деньги для оплаты курьеру без сдачи.</strong></p>
                            @endif
                        </div>

                    </figure>
                </div>
            </div>
        @endif

        @if($order->payment == App\Model\Order::$PAYMENT_RS && $order->invoicePath)
            <div class="row bottom20">
                <div class="col-md-12">
                    <figure class="highlight">

                        <div class="pre">
                            <p>
                                @if($order->email || $order->ur_email)
                                    <h3>Счет на оплату отправлен на указанный Вами e-mail</h3> также
                                @endif
                                Вы можете скачать счет здесь
                            </p>
                            <p><a class="text-danger" style="font-size: 18px;" href="{{ route('order.getInvoice', ['key' => $order->key]) }}">Скачать счет на оплату</a></p>
                        </div>

                    </figure>
                </div>
            </div>
        @endif

        <div class="row bottom20">
            <div class="col-md-12">
                <h1 class="h3 title-media-item-opened"><strong>Заказ №{{ $order->id }}</strong></h1>
            </div>
        </div>

        @foreach($order->orderLists as $items)
            <div class="row media-item-opened">
                <div class="col-md-3">
                    <figure class="main-picture">
                        <img class="img-responsive" src="{{ asset($items->product->photoUrl) }}" alt="{{ html_entity_decode(strip_tags($items->product->name)) }}">
                        <figcaption><span class="glyphicon glyphicon-resize-vertical text-muted" aria-hidden="true"></span> {{ $items->product->height }} см <span class="glyphicon glyphicon-resize-horizontal text-muted" aria-hidden="true"></span> {{ $items->product->width }} см</figcaption>
                    </figure>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-6 col-md-7">

                            <h1 class="h3 title-media-item-opened"><strong>{{ $items->product->name }}</strong></h1>

                            <p class="h3 title-media-item-opened"><i class="fa fa-rub"></i> <strong>{{ $items->client_price }}</strong></p>



                            <ul class="text-info">
                                <li>Букет и исполнитель проверены</li>
                            </ul>

                        </div>
                        <div class="col-sm-6 col-md-5">
                            @if($items->product->width || $items->product->height)
                                <ul class="list-unstyled">
                                    @if($items->product->width)
                                        <li>Ширина {{ $items->product->width }} см</li>
                                    @endif
                                    @if($items->product->height)
                                        <li>Высота {{ $items->product->height }} см</li>
                                    @endif
                                </ul>
                            @endif
                            @if(!empty($items->product->compositions))
                                <p><strong>Состав</strong></p>
                                <ul class="list-unstyled">
                                    @foreach($items->product->compositions as $composition)
                                        <li>{{ $composition->flower->name }} {{ $composition->qty ? ' - '.$composition->qty.' шт.' : null }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <br>


                        </div>
                    </div>
                </div>

            </div>
        @endforeach

        <div class="row">
            <div class="col-md-6">
                <p>Время доставки: {{ $order->receiving_date  }} {{ $order->receiving_time  }}</p>
                <p>По адресу: {{ $order->recipient_address  }}</p>
                <p>Получатель: {{ $order->recipient_phone  }} {{ $order->recipient_name  }}</p>
                <p>Заказчик: {{ $order->phone  }} {{ $order->name  }}</p>
            </div>
            <div class="col-md-6">
                <figure class="highlight">

                    <div class="pre">
                        @if($order->status == 'new')
                            <p>Телефон горячей линии: <a href="tel:{{ config('site.phones.hot_normalized') }}" class="text-danger"><strong>{{ config('site.phones.hot') }}</strong></a> </p>
                            <p>- обращайтесь по любым вопросам заказа</p>
                        @else
                            <p>Телефон, назначенного на Ваш заказ, флориста: <a href="tel:{{ $order->shop->copy_id != null ? '88006005497' : $order->shop->getContactPhones()[0] }}" class="text-danger"><strong>{{ $order->shop->copy_id != null ? '8 800 600-54-97' : $order->shop->getContactPhones()[0] }}</strong></a> </p>
                            <p>- обращайтесь по любым вопросам заказа</p>
                        @endif
                    </div>

                </figure>
            </div>
        </div>

        <br><br>

        <p class="h3" id="chto-posle"><strong>Стадии выполнения заказа:</strong></p>
        <br>
        <div class="row media-item-opened">
            <div class="col-md-12 order-steps order-step-first">
                <figure class="after-ord-icn">
                    <span class="digital one">1</span>
                    <h4 style="color: #da2a13;">Заказ оплачен</h4>
                    <p class="text-muted">После оплаты, на заказ назначается флорист, который проверяет все параметры заявки и принимает ее к исполнению</p>
                </figure>
            </div>
            <div class="col-md-12 order-steps order-step-second {{ $order->status == 'new' ? 'no-active' : null }}">
                <figure class="after-ord-icn">
                    <span class="digital two">2</span>
                    <h4>Заказ подтвержден и выполняется</h4>
                    <p class="text-muted">Ожидайте курьера в указанный в заказе временной интервал</p>
                </figure>
            </div>
            <div class="col-md-12 order-steps order-step-third {{ $order->status != 'completed' ? 'no-active' : null }}">
                <figure class="after-ord-icn">
                    <span class="digital three">3</span>
                    <h4>Заказ доставлен</h4>
                </figure>
            </div>
        </div>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop