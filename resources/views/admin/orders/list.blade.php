@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-xl-12">


            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Заказы
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="min-width: 972px;">
                                    <thead>
                                        <tr>
                                            <th style="width: 65px;">№</th>
                                            <th style="width: 125px;">Дата</th>
                                            <th>Состав</th>
                                            <th style="width: 110px;">Цена</th>
                                            <th style="width: 150px;">Статус</th>
                                            <th style="width: 134px;"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($orders as $order)

                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>
                                                    {{ $order->receiving_date }}
                                                    <br>
                                                    {{ $order->receiving_time }}
                                                </td>
                                                <td>
                                                    @foreach($order->orderLists as $item)
                                                        @if($item->product)
                                                            <a href="{{ route('product.show', ['slug' => $item->product->slug]) }}" target="_blank">{{ $item->product->name }}</a> - {{ $item->qty }} шт.
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <b>{{ $order->amount() }}</b>р.
                                                    <br>
                                                    <span style="font-weight: bold;">Вам:</span> {{ $order->amountShop() }}р.
                                                </td>
                                                <td>
                                                    <select class="form-control m-bootstrap-select m_selectpicker">
                                                        <option {{ $order->status == \App\Model\Order::$STATUS_NEW ? 'selected' : '' }} data-content="<span class='m-badge m-badge--success m-badge--wide m-badge--rounded'>Новый</span>">
                                                            Новый
                                                        </option>
                                                        <option {{ $order->status == \App\Model\Order::$STATUS_ACCEPTED ? 'selected' : '' }} data-content="<span class='m-badge m-badge--warning m-badge--wide m-badge--rounded'>Принят</span>">
                                                            Принят
                                                        </option>
                                                        <option {{ $order->status == \App\Model\Order::$STATUS_COMPLETED ? 'selected' : '' }} data-content="<span class='m-badge m-badge--info m-badge--wide m-badge--rounded'>Выполнен</span>">
                                                            Выполнен
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn m-btn--square  btn-outline-info">Подробнее</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Form-->
            </div>


        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
@stop