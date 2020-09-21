@extends('layouts.admin')

@section('content')


    <div class="row" ng-controller="orderView">
        <div class="col-lg-8 col-print-8">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon hidden-print">
                                <a href="javascript:window.print();">
                                    <i class="la la-print"></i>
                                </a>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Заказ № {{ $order->id }}
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">



                                <div class="m-widget4">


                                                @if($user->admin && $order->payment == App\Model\Order::$PAYMENT_RS && $order->invoicePath)

                                                    <div class="m-widget4__item">

                                                        <div class="m-widget4__img m-widget4__img--logo">&nbsp;</div>

                                                        <div class="m-widget4__info">
                                                            <span class="m-widget4__title">
                                                                <a class="text-danger" style="font-size: 18px;" href="{{ route('order.getInvoice', ['key' => $order->key]) }}">Скачать счет на оплату</a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                @endif

                                                <div class="m-widget4__item">

                                                    <div class="m-widget4__img m-widget4__img--logo">&nbsp;</div>

                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            @if($order->payment == 'cash' && $order->confirmed && $order->status != 'completed')
                                                                <span class="text-danger"><strong>Получите {{ $order->amount() }} ₽ наличными с заказчика!</strong></span>
                                                            @endif

                                                            @if($order->payed && $order->payment != 'cash')
                                                                <span class="text-success"><strong>Заказ оплачен онлайн.</strong></span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                @foreach($order->orderLists as $key => $item)
                                                    @if($item->product)

                                                        <div class="m-widget4__item">

                                                            <div class="m-widget4__img m-widget4__img--logo">
                                                                <a href="/flower/{{ $order->shop->city->id }}/{{ $item->product->slug }}" target="_blank">
                                                                    <img src="{{ $item->product->photoUrl }}" alt="">
                                                                </a>
                                                            </div>

                                                            <div class="m-widget4__info">
                                                                <span class="m-widget4__title">
                                                                    {{ $item->product->name }} (id: {{ $item->product->id }}) {!! $item->qty > 1 ? (
                                                                        $item->product->single ? (
                                                                            $item->product->singleProduct->qty_from != $item->qty ?
                                                                                '<br><span class="text-danger"><strong>В букете изменено кол-во цветов на '.$item->qty.' шт.</strong></span>'
                                                                                : ''
                                                                        ) : '<span class="text-danger"><strong>x'.$item->qty.' шт.</strong></span>'

                                                                        ) : ''  !!}
                                                                </span>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endforeach

                                                @if($user->admin && !empty($order->shop))
                                                    <div class="m-widget4__item hidden-print">
                                                        <div class="m-widget4__info">
                                                            <span class="m-widget4__title">
                                                                Магазин:
                                                            </span>
                                                            <br>
                                                            <span class="m-widget4__sub">
                                                                г. {{ $order->shop->city->name }}<br>
                                                                <a href="{{ route('admin.shop.profile_edit', ['id' => $order->shop->id]) }}" target="_blank">{{ $order->shop->name }}</a>
                                                                <br>
                                                                @if($order->shop->workers->count())
                                                                    @foreach($order->shop->workers as $worker)
                                                                        <p>{{ $worker->name }} ({{ $worker->position_id == 1 ? 'Руководитель' : 'Флорист-менеджер' }}) - {{ $worker->phone }}</p>
                                                                    @endforeach
                                                                @endif

                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-calendar-2 m--font-brand"  ></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Дата и время доставки
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">
                                                            <p class="lead" ng-show="mode == 'view'">
                                                                {!! $order->receiving_date ?  \Carbon::parse($order->receiving_date)->format('d.m.Y').'<br>' : '' !!}
                                                                {!! $order->receiving_time ?  $order->receiving_time : '' !!}

                                                                @if($shop->city->region->tz != 'UTC+3:00' && !empty($order->receiving_time_msk))
                                                                    <br>
                                                                    <span class="text-bold text-danger">с {{ $order->receiving_time_msk->from }} до {{ $order->receiving_time_msk->to }} по МСК</span>
                                                                @endif

                                                            </p>

                                                            <div ng-show="mode == 'edit'" ng-cloak>
                                                                <input type="text" class="form-control" ng-model="order.receiving_date">
                                                                <br>
                                                                <select class="form-control" name="receiving_time" ng-model="order.receiving_time">
                                                                    <option value="Время согласовать">Согласовать</option>
                                                                    <option value="с 08:00 до 09:00">с 08:00 до 09:00</option>
                                                                    <option value="с 09:00 до 10:00">с 09:00 до 10:00</option>
                                                                    <option value="с 10:00 до 11:00">с 10:00 до 11:00</option>
                                                                    <option value="с 11:00 до 12:00">с 11:00 до 12:00</option>
                                                                    <option value="с 12:00 до 13:00">с 12:00 до 13:00</option>
                                                                    <option value="с 13:00 до 14:00">с 13:00 до 14:00</option>
                                                                    <option value="с 14:00 до 15:00">с 14:00 до 15:00</option>
                                                                    <option value="с 15:00 до 16:00">с 15:00 до 16:00</option>
                                                                    <option value="с 16:00 до 17:00">с 16:00 до 17:00</option>
                                                                    <option value="с 17:00 до 18:00">с 17:00 до 18:00</option>
                                                                    <option value="с 18:00 до 19:00">с 18:00 до 19:00</option>
                                                                    <option value="с 19:00 до 20:00">с 19:00 до 20:00</option>
                                                                    <option value="с 20:00 до 21:00">с 20:00 до 21:00</option>
                                                                    <option value="с 21:00 до 22:00">с 21:00 до 22:00</option>
                                                                    <option value="с 22:00 до 23:00">с 22:00 до 23:00</option>
                                                                    <option value="с 23:00 до 24:00">с 23:00 до 24:00</option>
                                                                </select>
                                                            </div>

                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-user-ok m--font-brand"  ></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Отправитель
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">
                                                            <p class="lead" ng-show="mode == 'view'">
                                                            {!! $order->name ?  $order->name.'<br>' : '' !!}
                                                            {!! $order->phone ?  $order->phone.'<br>' : '' !!}
                                                            {{ $user->admin && $order->email ?  $order->email.' ' : ''}}
                                                            </p>

                                                            <div ng-show="mode == 'edit'" ng-cloak>
                                                                <input type="text" class="form-control" ng-model="order.name" placeholder="Имя">
                                                                <br>
                                                                <input type="text" class="form-control" ng-model="order.phone" placeholder="Телефон">
                                                                <br>
                                                                <input type="text" class="form-control" ng-model="order.email" placeholder="Email">

                                                            </div>

                                                        </span>
                                                    </div>
                                                </div>



                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-user-add m--font-brand"  ></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Получатель
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            <div ng-show="mode == 'view'">
                                                                @if($order->recipient_self)
                                                                    <p class="lead">сам отправитель</p>
                                                                @else
                                                                    <p class="lead">
                                                                    {!! $order->recipient_name ?  $order->recipient_name.'<br>' : '' !!}
                                                                    {!! $order->recipient_phone ?  $order->recipient_phone : '' !!}
                                                                    </p>
                                                                @endif
                                                            </div>

                                                            <div ng-show="mode == 'edit'" ng-cloak>
                                                                <label class="m-checkbox">
                                                                    <input type="checkbox" ng-model="order.recipient_self" ng-true-value="1" ng-false-value="0">
                                                                    сам отправитель
                                                                    <span></span>
                                                                </label>

                                                                <div ng-show="!order.recipient_self">
                                                                    <br>
                                                                    <input type="text" class="form-control" ng-model="order.recipient_name" placeholder="Имя">
                                                                    <br>
                                                                    <input type="text" class="form-control" ng-model="order.recipient_phone" placeholder="Телефон">
                                                                </div>
                                                            </div>




                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-attachment m--font-brand"  ></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Открытка с букетом
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            <div ng-show="mode == 'view'">
                                                                @if(!$order->text)
                                                                    <p class="lead">НЕТ</p>
                                                                @else
                                                                    <p class="lead">{{ $order->text }}</p>
                                                                @endif
                                                            </div>

                                                            <div ng-show="mode == 'edit'" ng-cloak>
                                                                <textarea class="form-control" ng-model="order.text" placeholder="Текст открытки"></textarea>
                                                            </div>




                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-map-location m--font-brand"  ></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Адрес
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            <div ng-show="mode == 'view'">
                                                                <p class="lead">
                                                                    {{ $shop->city->name }}<br>
                                                                    {{ $order->recipient_address.' '.$order->recipient_flat }}
                                                                </p>

                                                                @if($order->delivery_out_distance)
                                                                    <p class="lead">
                                                                        доставка за город: {{ $order->delivery_out_distance }} км.
                                                                    </p>
                                                                @endif
                                                            </div>

                                                            <div ng-show="mode == 'edit'" ng-cloak>
                                                                <input type="text" class="form-control" ng-model="order.recipient_address">
                                                            </div>


                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-notes m--font-brand"  ></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Дополнительная информация
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            <p class="lead" ng-show="mode == 'view'">
                                                            {{ $order->recipient_info ? $order->recipient_info : 'НЕТ' }}
                                                            </p>


                                                            <div ng-show="mode == 'edit'" ng-cloak>
                                                                <textarea class="form-control" ng-model="order.recipient_info"></textarea>
                                                            </div>


                                                        </span>
                                                    </div>
                                                </div>

                                                @if($user->admin && $order->payment == \App\Model\Order::$PAYMENT_RS)
                                                    <div class="m-widget4__item">
                                                        <span class="m-widget17__icon">
                                                            <i class="flaticon-notes m--font-brand"  ></i>
                                                        </span>
                                                        <div class="m-widget4__info">
                                                            <span class="m-widget4__title">
                                                                Данные Юр. лица
                                                            </span>
                                                            <br>
                                                            <span class="m-widget4__sub">

                                                                <ul>
                                                                    <li>Название юр. лица: {{ $order->ur_name }}</li>
                                                                    <li>ИНН: {{ $order->ur_inn }}</li>
                                                                    <li>КПП: {{ $order->ur_kpp }}</li>
                                                                    <li>Юридический адрес: {{ $order->ur_address }}</li>
                                                                    <li>Название банка: {{ $order->ur_bank }}</li>
                                                                    <li>Email: {{ $order->ur_email }}</li>
                                                                </ul>


                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>



                            </div>
                        </div>

                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit hidden-print">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="{{ route('admin.orders') }}" class="btn btn-info m-btn m-btn--icon m-btn--wide">
                                        <span>
                                            <i class="la la-angle-left"></i>
                                            <span>
                                                Назад
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                @if($user->admin)
                                    <div class="col-lg-6" ng-show="mode == 'view'">
                                        <button class="btn btn-info m-btn m-btn--icon m-btn--wide" ng-click="mode='edit'">
                                            <span>
                                                <i class="la la-pencil"></i>
                                                <span>
                                                    Редактировать
                                                </span>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-lg-6" ng-show="mode == 'edit'" ng-cloak>
                                        <button class="btn btn-success m-btn m-btn--icon m-btn--wide" ng-click="save()">
                                            <span>
                                                <i class="la la-check"></i>
                                                <span>
                                                    Сохранить
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="reset" class="btn btn-primary">
                                        Save
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        Cancel
                                    </button>
                                </div>
                                <div class="col-lg-6 m--align-right">
                                    <button type="reset" class="btn btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->

        </div>

        <div class="col-lg-4 col-print-4">

            <div class="row">

                @if($user->admin || $order->payment == 'cash')

                    <div class="col-lg-6">
                        <div class="m-portlet  m-portlet--border-bottom-brand ">
                            <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                <div class="m-widget26">
                                    <div class="m-widget26__number m--font-info" style="font-size: 1.8rem;">
                                        <div class="m-demo-icon__preview">
                                            <i class="flaticon-coins"   style="font-size: 2.5rem;"></i>
                                        </div>
                                        @if($order->report_price == 0 || $order->report_price == null)
                                          {{ round($order->amount()) }} р.
                                        @else
                                          <span title="оригинальная: {{$order->amount()}} р.">{{ round($order->report_price) }} р.</span>
                                        @endif
                                        <small>
                                            Цена
                                        </small>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endif

                <div class="col-lg-6">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <div class="m-widget26">

                                <div class="m-widget26__number m--font-success" style="font-size: 1.8rem;">
                                    <div class="m-demo-icon__preview">
                                        <i class="flaticon-coins"   style="font-size: 2.5rem;"></i>
                                    </div>
                                    @if($order->payment != 'cash')
                                        {{ round($order->amountShop()) }} р.
                                        <small>
                                            Вам
                                        </small>
                                    @else
                                        <small>
                                            Со счета удерживается комиссия
                                        </small>
                                        {{ round($order->amountShop()*(-1)) }} р.
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @if($user->admin)

                <div class="col-lg-12 hidden-print">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <div class="m-widget26">
                                Доставка: {{ $order->delivery_price }}<br>
                                @if($order->delivery_out_distance)
                                    Доставка за город: {{ $order->delivery_out_distance * $order->delivery_out_price }}<br>
                                @endif

                                @foreach($order->orderLists as $key => $item)
                                    @if($item->product)

                                        @if(!$item->product->dop)
                                            Товар: {{ $item->product->name }} - {{ $item->client_price - $order->delivery_price }}<br>
                                        @else
                                            Товар: {{ $item->product->name }} - {{ $item->shop_price * $item->qty }}<br>
                                        @endif
                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>

                @endif

                @if(!empty($order->recipient_photo))

                    <div class="col-lg-12 hidden-print">
                        <div class="m-portlet  m-portlet--border-bottom-brand ">
                            <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                <div class="m-widget26">
                                    <p class="text-warning">Клиент просил, при возможности, сделать фото вручения букета: клиент будет рад, а у Вас улучшится выдача товаров</p>
                                    @if($order->photo)
                                        <figure>
                                            <img class="img-responsive" src="{{ \Storage::disk('orders')->url($order->photo) }}" alt="..." width="100%">
                                        </figure>
                                    @endif
                                    <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form" enctype="multipart/form-data" >
                                        {{ csrf_field() }}
                                        <input type="file" class="form-control" name="order_photo">
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-primary">
                                                    Сохранить
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                @endif

                @if($order->shop_id != -1)
                    <div class="col-lg-12 hidden-print">
                        <div class="m-portlet  m-portlet--border-bottom-brand ">
                            <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                <div class="m-widget26">

                                    <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form">
                                        {{ csrf_field() }}
                                        <div class="form-group ">

                                            <label class="" style="font-weight: bold">
                                                Статус:
                                            </label>

                                            @if(!$user->admin && $order->status == \App\Model\Order::$STATUS_COMPLETED)
                                                <br><br>
                                                <span class='m-badge m-badge--info m-badge--wide m-badge--rounded'>Выполнен</span>
                                            @else

                                                <select class="form-control m-bootstrap-select m_selectpicker" name="status">
                                                    @if(!$user->admin)
                                                        @if($order->status == \App\Model\Order::$STATUS_NEW)
                                                            <option {{ $order->status == \App\Model\Order::$STATUS_NEW ? 'selected' : '' }} value="{{ \App\Model\Order::$STATUS_NEW }}" data-content="<span class='m-badge m-badge--success m-badge--wide m-badge--rounded'>Новый</span>">
                                                                Новый
                                                            </option>
                                                        @endif
                                                        @if($order->status == \App\Model\Order::$STATUS_NEW)
                                                            <option {{ $order->status == \App\Model\Order::$STATUS_ACCEPTED ? 'selected' : '' }} value="{{ \App\Model\Order::$STATUS_ACCEPTED }}" data-content="<span class='m-badge m-badge--warning m-badge--wide m-badge--rounded'>Принят</span>">
                                                                Принят
                                                            </option>
                                                        @endif
                                                        @if($order->status == \App\Model\Order::$STATUS_ACCEPTED)
                                                            <option {{ $order->status == \App\Model\Order::$STATUS_COMPLETED ? 'selected' : '' }} value="{{ \App\Model\Order::$STATUS_COMPLETED }}" data-content="<span class='m-badge m-badge--info m-badge--wide m-badge--rounded'>Выполнен</span>">
                                                                Выполнен
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option {{ $order->status == \App\Model\Order::$STATUS_NEW ? 'selected' : '' }} value="{{ \App\Model\Order::$STATUS_NEW }}" data-content="<span class='m-badge m-badge--success m-badge--wide m-badge--rounded'>Новый</span>">
                                                            Новый
                                                        </option>
                                                        <option {{ $order->status == \App\Model\Order::$STATUS_ACCEPTED ? 'selected' : '' }} value="{{ \App\Model\Order::$STATUS_ACCEPTED }}" data-content="<span class='m-badge m-badge--warning m-badge--wide m-badge--rounded'>Принят</span>">
                                                            Принят
                                                        </option>
                                                        <option {{ $order->status == \App\Model\Order::$STATUS_COMPLETED ? 'selected' : '' }} value="{{ \App\Model\Order::$STATUS_COMPLETED }}" data-content="<span class='m-badge m-badge--info m-badge--wide m-badge--rounded'>Выполнен</span>">
                                                            Выполнен
                                                        </option>
                                                    @endif
                                                </select>

                                            @endif

                                        </div>

                                        @if(!$user->admin && $order->status == \App\Model\Order::$STATUS_COMPLETED)

                                        @else

                                            <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">
                                                            Сохранить
                                                        </button>
                                                    </div>
                                            </div>

                                        @endif


                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                @endif
                @if($user->admin)
                @if($order->shop_id != -1 && $order->status != \App\Model\Order::$STATUS_COMPLETED)
                        <div class="col-lg-12 hidden-print">
                            <div class="m-portlet  m-portlet--border-bottom-brand ">
                                <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                    <div class="m-widget26">

                                        <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form">
                                            {{ csrf_field() }}


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejection_modal">
                                                        Отказаться
                                                    </button>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                        @include('admin.orders.modals.rejection')
                @endif
                @endif

                <div class="col-lg-12 hidden-print print-widget">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <div class="m-widget26">

                                <div class="m-form">
                                    {{ csrf_field() }}


                                    <div class="row">
                                        <a href="javascript:window.print();" class="col-lg-12 print-widget__wrapper">
                                            <span class="m-portlet__head-icon hidden-print print-widget__icon">
                                                <span>
                                                    <i class="la la-print"></i>
                                                </span>
                                            </span>
                                            <h3 class="m-portlet__head-text print-widget__text">
                                                Распечатать
                                            </h3>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                @if($user->admin)
                <div class="col-lg-12 hidden-print print-widget">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <form action="{{ route('admin.order.changePrice', ['id' => $order->id]) }}" method="POST" class="m-widget26">

                                <div class="m-form">
                                    {{ csrf_field() }}


                                    <div class="">
                                        <div>Корректировка цены:</div>
                                        <div class="report__price">
                                          <span>Цена: </span>
                                          <input min="-999999" max="999999" name="price" value="{{ $order->report_price == null && $order->report_price == 0 ? $order->amount() : $order->report_price }}" type="number">
                                        </div>
                                        <div class="report__price">
                                          <span>Магазину: </span>
                                          <input name="shop_price" value="{{ $order->report_shop_price == null && $order->report_shop_price == 0 ? $order->amountShop() : $order->report_shop_price }}" min="-999999" max="999999" type="number">
                                        </div>
                                        <div>
                                          <button>Изменить</button>
                                        </div>
                                    </div>


                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                @endif

                @if($user->admin)
                    @if($order->payed)
                        <div class="col-lg-12 hidden-print">
                            <div class="m-portlet  m-portlet--border-bottom-brand ">
                                <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                    <div class="m-widget26">

                                        <h2>Выставить доплату</h2>

                                        <form method="post" action="{{ route('admin.order.charge', ['order_id' => $order->id]) }}" class="m-form" id="order-charge-frm">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="form-group">
                                                <label class="col-md-12" for="charge_ammount">
                                                    Сумма<span class="text-danger">*</span>:
                                                </label>
                                                <div class="col-md-12">
                                                    <input type="text" id="charge_ammount" name="amount" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12" for="charge_desc">
                                                    Назначение платежа<span class="text-danger">*</span>:
                                                </label>
                                                <div class="col-md-12">
                                                    <input type="text" id="charge_desc" name="description" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12" for="charge_email">
                                                    Email:
                                                </label>
                                                <div class="col-md-12">
                                                    <input type="email" id="charge_email" name="email" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12" for="charge_phone">
                                                    Телефон:
                                                </label>
                                                <div class="col-md-12">
                                                    <input type="phone" id="charge_phone" name="phone" class="form-control phone">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 errors text-danger" >

                                                </div>
                                                <div class="col-lg-12 success text-success" style="font-size: 10px;" >

                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        Сохранить
                                                    </button>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                    @if($order->status != \App\Model\Order::$STATUS_COMPLETED)
                        <div class="col-lg-12 hidden-print">
                            <div class="m-portlet  m-portlet--border-bottom-brand ">
                                <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                    <div class="m-widget26">

                                        <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form">
                                            {{ csrf_field() }}
                                            <div class="form-group ">

                                                <label class="" style="font-weight: bold">
                                                    Передать магазину:
                                                </label>

                                                <select class="form-control" name="shop_id">
                                                    @foreach($shops as $shop)
                                                        <option value="{{ $shop->id }}">{{ $shop->id }} - {{ $shop->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        Сохранить
                                                    </button>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                    @if($order->payment == \App\Model\Order::$PAYMENT_RS && !$order->payed)
                        <div class="col-lg-12 hidden-print">
                            <div class="m-portlet  m-portlet--border-bottom-brand ">
                                <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                    <div class="m-widget26">

                                        <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form">
                                            {{ csrf_field() }}
                                            <div class="form-group ">

                                                <label class="" style="font-weight: bold">
                                                    Изменить статус оплаты на:
                                                </label>

                                                <select class="form-control" name="payed">
                                                    <option value="1">Оплачен</option>
                                                </select>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        Сохранить
                                                    </button>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif




                    <div class="col-lg-12 hidden-print">
                        <div class="m-portlet  m-portlet--border-bottom-brand ">
                            <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                                <div class="m-widget26">

                                    <h2>Комментарий для бухгалтера</h2>

                                    <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control" rows="7" name="finance_comment">{{ $order->finance_comment }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 errors text-danger" >

                                            </div>
                                            <div class="col-lg-12 success text-success" style="font-size: 10px;" >

                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-primary">
                                                    Сохранить
                                                </button>
                                            </div>
                                        </div>


                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>




                @endif

            </div>

        </div>


    </div>


@endsection

@section('head')
    <link href="{{ asset('assets/admin/css/print.css') }}" rel="stylesheet" type="text/css"/>
    <style>
      .print-widget {

      }

      .print-widget__wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .print-widget__icon {

      }

      .print-widget__icon i {
        font-size: 30px;
      }

      .print-widget__text {
        display: inline-block;
        margin: 0;
        margin-left: 10px;
        color: #575962;
      }
      .report__price {
        display: flex;
        justify-content: space-between;
        padding: 5px;
      }

      .report__price span {
        width: 80px;
        text-align: left;
      }

      .report__price input {
        flex: 1;
      }
    </style>
@stop

@section('footer')
    <script src="{{ asset('assets/admin/ng/ordersList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/order-view.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/ng/order-view.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        jsonData.order = {!! $user->admin ? $order->toJson() : "{}" !!};
        jsonData.orderUpdateUrl = '{{ route('admin.order.update', ['id' => $order->id]) }}';
    </script>
@stop