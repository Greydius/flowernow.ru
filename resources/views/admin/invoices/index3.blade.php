@extends('layouts.admin')

@section('content')

    <div id="ordersListContainer">


        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Запросы на вывод
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <ul class="nav nav-tabs">
                    <li><a href="#tabs-new" role="tab" data-toggle="tab" class="nav-link active">Новые</a></li>
                    <li><a href="#tabs-old" role="tab" data-toggle="tab" class="nav-link">Выполненные</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-new">
                        <div class="table-responsive" ng-cloak>
                            <table class="table table-bordered table-hover" style="min-width: 972px;">
                                <thead>
                                <tr>
                                    <th>Магазин</th>
                                    <th>Заморожено</th>
                                    <th>К выводу</th>
                                    <th>Заказано</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($invoicesNew as $invoice)
                                    <tr>
                                        <td>{{ $invoice->shop->name }} ({{ $invoice->shop->id }})</td>
                                        <td>{{ $invoice->shop->frozenBalance }}</td>
                                        <td>{{ $invoice->shop->availableOutBalance }}</td>
                                        <td>
                                            {{ $invoice->amount }} руб.<br>
                                            {{ $invoice->created_at }}
                                        </td>
                                        <td>
                                            @if($invoice->realized == 1)
                                                <span class="m-badge m-badge--success m-badge--wide">
                                                Выполнен
                                        </span>
                                            @elseif($invoice->realized == 2)
                                                <span class="m-badge m-badge--warning m-badge--wide">
                                                Отклонен
                                        </span>
                                            @elseif(empty($invoice->realized))
                                                <a href="#"  data-toggle="modal" data-target="#status_modal" data-id="{{ $invoice->id }}">
                                            <span class="m-badge m-badge--warning m-badge--wide">
                                                    Новый
                                            </span>
                                                </a>
                                            @endif

                                            @if($invoice->comment)
                                                <br>{{ $invoice->comment }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th class="text-bold">Итого</th>
                                    <th>{{ $frozenBalance }}</th>
                                    <th>{{ $availableOutBalance }}</th>
                                    <th>{{ $amount }}</th>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-old">
                        <div class="table-responsive" ng-cloak>
                            <table class="table table-bordered table-hover" style="min-width: 972px;">
                                <thead>
                                <tr>
                                    <th>Магазин</th>
                                    <th>Заморожено</th>
                                    <th>К выводу</th>
                                    <th>Заказано</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($invoicesOld as $invoice)
                                    <tr>
                                        <td>{{ $invoice->shop->name }}</td>
                                        <td>{{ $invoice->shop->frozenBalance }}</td>
                                        <td>{{ $invoice->shop->availableOutBalance }}</td>
                                        <td>
                                            {{ $invoice->amount }} руб.<br>
                                            {{ $invoice->created_at }}
                                        </td>
                                        <td>
                                            @if($invoice->realized == 1)
                                                <span class="m-badge m-badge--success m-badge--wide">
                                                Выполнен
                                        </span>
                                            @elseif($invoice->realized == 2)
                                                <span class="m-badge m-badge--warning m-badge--wide">
                                                Отклонен
                                        </span>
                                            @elseif(empty($invoice->realized))
                                                <a href="#"  data-toggle="modal" data-target="#status_modal" data-id="{{ $invoice->id }}">
                                            <span class="m-badge m-badge--warning m-badge--wide">
                                                    Новый
                                            </span>
                                                </a>
                                            @endif

                                            @if($invoice->comment)
                                                <br>{{ $invoice->comment }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>



        <hr />

        <br><br>

        <form class="m-form m-form--fit m-form--label-align-right" method="get" action="{{ route('admin.invoices2') }}">
            <div class="form-group m-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">
                    Период
                </label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-daterange input-group" id="m_datepicker_5">
                        <input type="text" class="form-control m-input" name="dateFrom" value="{{ app('request')->input('dateFrom') }}"/>
                        <span class="input-group-addon">
                     <i class="la la-ellipsis-h"></i>
                 </span>
                        <input type="text" class="form-control" name="dateTo" value="{{ app('request')->input('dateTo') }}"/>
                    </div>
                </div>

                <div class="col-lg-4 col-md-9 col-sm-12">
                    <button type="submit" class="btn btn-info">
                        Применить
                    </button>
                </div>
            </div>
        </form>

        <br>



        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Продано
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <div class="table-responsive" ng-cloak>
                    <table class="table table-bordered table-hover" style="min-width: 972px;">
                        <thead>
                        <tr>
                            <th>Магазин</th>
                            <th>Заморожено</th>
                            <th>К выводу</th>
                            <th>Заказано</th>
                            <th>Всего на балансе</th>
                            <th>Всего</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($shops as $shop)
                            <tr>
                                <td>{{ $shop->name }}</td>
                                <td><a href="#"  data-toggle="modal" data-target="#info_modal" data-shop_id="{{ $shop->id }}" data-type="frozen">{{ $shop->frozenBalance }}</a></td>
                                <td><a href="#"  data-toggle="modal" data-target="#info_modal" data-shop_id="{{ $shop->id }}" data-type="available">{{ $shop->availableOutBalance }}</a></td>
                                <td><a href="#"  data-toggle="modal" data-target="#info_modal" data-shop_id="{{ $shop->id }}">{{ $shop->invoiceAmount }}</a></td>
                                <td>{{ $shop->totalBalance }}</td>
                                <td>{{ $shop->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>


    <!--begin::Modal-->
    <div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="m-form m-form--fit m-form--label-align-right" method="post" action="">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Изменить статус заявки
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="invoice_status">
                                Статус
                            </label>
                            <select class="form-control m-input" id="invoice_status" name="status">
                                <option value="1">Выполнен</option>
                                <option value="2">Отклонен</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="invoice_comment">
                                Коментарий
                            </label>
                            <textarea class="form-control m-input" id="invoice_comment" name="comment" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Modal-->
    <div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelInfo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="m-form m-form--fit m-form--label-align-right" method="get" action="{{ route('admin.shop.balance') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelInfo">
                            Информация
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Modal-->





@endsection

@section('footer')
    <script src="{{ asset('assets/admin/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/invoices.js?v=2') }}" type="text/javascript"></script>
@stop