@extends('layouts.admin')

@section('content')

    <div ng-controller="rejectionList" id="rejectionListContainer">


        <div class="m-portlet m-portlet--mobile">
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



                <div class="table-responsive" ng-cloak>
                    <table class="table table-bordered table-hover" style="min-width: 972px;">
                        <thead>
                        <tr>
                            <th>№ заказа</th>
                            <th>Дата доставки</th>
                            <th>Товар/<br>Цена с доставк.</th>
                            <th style="width: 400px">Адрес доставки</th>
                            <th style="width: 150px;"></th>

                        </tr>
                        </thead>

                        <tbody>

                            <tr ng-repeat="order in orders" >
                                <td>
                                    <span style="font-weight: bold"><% order.id %></span>
                                </td>
                                <td>
                                    <% order.receivingDateFormat %>
                                    <br>
                                    <% order.receiving_time %>
                                </td>
                                <td>
                                        <span ng-repeat="orderList in order.order_lists" style="font-size: 10px">
                                            <a href="<% orderList.product.url %>" target="_blank"><% orderList.product.name %></a> - <% orderList.qty %> шт.
                                        </span>
                                    <br>
                                    <% order.amountShop %> ₽
                                </td>
                                <td style="word-break: break-all;">
                                    <% order.recipient_address + (order.recipient_flat ? ', кв./оф. ' + order.recipient_flat : '') %>
                                    <br>
                                    <% order.delivery_out_distance > 0 ? 'за город: ' + order.delivery_out_distance + ' км. оплачена' : '' %>
                                </td>
                                <td>
                                    <a href  class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only pull-right" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Принять заказ">
                                        <i class="la la-times-circle-o"></i>
                                    </a>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>






@endsection

@section('footer')
    <script src="{{ asset('assets/admin/ng/rejectionList.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>
    <script type="text/javascript">
            jsonData.orders = [];
    </script>
@stop