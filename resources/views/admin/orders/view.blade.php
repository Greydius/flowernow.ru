@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-lg-8">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
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

                                                @foreach($order->orderLists as $key => $item)
                                                    @if($item->product)

                                                        <div class="m-widget4__item">

                                                            <div class="m-widget4__img m-widget4__img--logo">
                                                                <img src="{{ $item->product->photoUrl }}" alt="">
                                                            </div>

                                                            <div class="m-widget4__info">
                                                                <span class="m-widget4__title">
                                                                    {{ $item->product->name }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endforeach

                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-calendar-2 m--font-brand"  style="font-size: 3.5rem;"></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Дата и время доставки
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">
                                                            <p class="lead">
                                                            {!! $order->receiving_date ?  $order->receiving_date.'<br>' : '' !!}
                                                            {!! $order->receiving_time ?  $order->receiving_time : '' !!}
                                                            </p>


                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-user-ok m--font-brand"  style="font-size: 3.5rem;"></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Отправитель
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">
                                                            <p class="lead">
                                                            {!! $order->name ?  $order->name.'<br>' : '' !!}
                                                            {!! $order->phone ?  $order->phone.'<br>' : '' !!}
                                                            {{ $user->admin && $order->email ?  $order->email.' ' : ''}}
                                                            </p>


                                                        </span>
                                                    </div>
                                                </div>



                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-user-add m--font-brand"  style="font-size: 3.5rem;"></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Получатель
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            @if($order->recipient_self)
                                                                <p class="lead">сам отправитель</p>
                                                            @else
                                                                <p class="lead">
                                                                {!! $order->recipient_name ?  $order->recipient_name.'<br>' : '' !!}
                                                                {!! $order->recipient_phone ?  $order->recipient_phone : '' !!}
                                                                </p>
                                                            @endif




                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-attachment m--font-brand"  style="font-size: 3.5rem;"></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Открытка с букетом
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            @if(!$order->text)
                                                                <p class="lead">НЕТ</p>
                                                            @else
                                                                <p class="lead">{{ $order->text }}</p>
                                                            @endif




                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-map-location m--font-brand"  style="font-size: 3.5rem;"></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Адрес
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            <p class="lead">
                                                            {{ $order->recipient_address.' '.$order->recipient_flat }}
                                                            </p>

                                                            @if($order->delivery_out_distance)
                                                                <p class="lead">
                                                                    доставка за город: {{ $order->delivery_out_distance }} км.
                                                                </p>
                                                            @endif


                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="m-widget4__item">
                                                    <span class="m-widget17__icon">
                                                        <i class="flaticon-notes m--font-brand"  style="font-size: 3.5rem;"></i>
                                                    </span>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">
                                                            Дополнительная информация
                                                        </span>
                                                        <br>
                                                        <span class="m-widget4__sub">

                                                            <p class="lead">
                                                            {{ $order->recipient_info ? $order->recipient_info : 'НЕТ' }}
                                                            </p>


                                                        </span>
                                                    </div>
                                                </div>

                                                @if($user->admin && $order->payment == \App\Model\Order::$PAYMENT_RS)
                                                    <div class="m-widget4__item">
                                                        <span class="m-widget17__icon">
                                                            <i class="flaticon-notes m--font-brand"  style="font-size: 3.5rem;"></i>
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

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ route('admin.orders') }}" class="btn btn-info m-btn m-btn--icon m-btn--wide">
                                        <span>
                                            <i class="la la-angle-left"></i>
                                            <span>
                                                Назад
                                            </span>
                                        </span>
                                    </a>
                                </div>
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

        <div class="col-lg-4">

            <div class="row">

                <div class="col-lg-6">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <div class="m-widget26">
                                <div class="m-widget26__number m--font-info" style="font-size: 1.8rem;">
                                    <div class="m-demo-icon__preview">
                                        <i class="flaticon-coins"   style="font-size: 2.5rem;"></i>
                                    </div>
                                    {{ $order->amount() }} р.
                                    <small>
                                        Цена
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <div class="m-widget26">

                                <div class="m-widget26__number m--font-success" style="font-size: 1.8rem;">
                                    <div class="m-demo-icon__preview">
                                        <i class="flaticon-coins"   style="font-size: 2.5rem;"></i>
                                    </div>
                                    {{ $order->amountShop() }} р.
                                    <small>
                                        Вам
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="m-portlet  m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body" style="padding: 2.2rem 5px; text-align: center;">
                            <div class="m-widget26">

                                <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="m-form">
                                    {{ csrf_field() }}
                                    <div class="form-group ">

                                        <label class="" style="font-weight: bold">
                                            Статус:
                                        </label>

                                        @if($order->status == \App\Model\Order::$STATUS_COMPLETED)
                                            <br><br>
                                            <span class='m-badge m-badge--info m-badge--wide m-badge--rounded'>Выполнен</span>
                                        @else

                                            <select class="form-control m-bootstrap-select m_selectpicker" name="status">
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
                                            </select>

                                        @endif

                                    </div>

                                    @if($order->status == \App\Model\Order::$STATUS_COMPLETED)

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

                @if($user->admin)
                    @if($order->status != \App\Model\Order::$STATUS_COMPLETED)
                        <div class="col-lg-12">
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
                        <div class="col-lg-12">
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
                @endif

            </div>

        </div>


    </div>


@endsection

@section('footer')
    <script src="{{ asset('assets/admin/ng/ordersList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
@stop