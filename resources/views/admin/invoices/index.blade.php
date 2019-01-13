@extends('layouts.admin')

@section('content')

<div ng-controller="ordersList" id="ordersListContainer">


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

            <div class="table-responsive" ng-cloak>
                <table class="table table-bordered table-hover" style="min-width: 972px;">
                    <thead>
                        <tr>
                            <th style="width: 125px;">Дата</th>
                            <th>Магазин</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->created_at }}</td>
                                <td>{{ $invoice->shop->name }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>
                                    @if($invoice->status)
                                        <span class="m-badge m-badge--success m-badge--wide">
                                                Выполнен
                                            </span>
                                    @else
                                        <span class="m-badge m-badge--warning m-badge--wide">
                                                Новый
                                            </span>
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






@endsection

@section('footer')
@stop