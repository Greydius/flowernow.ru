@extends('layouts.admin')

@section('content')

<div ng-controller="ordersList" id="ordersListContainer">


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
                            @if(!$user->admin)

                                <th>№ заказа/<br>Дата оплаты</th>
                                <th>Дата доставки</th>
                                <th style="width: 400px">Адрес доставки</th>
                                <th>Товар/<br>Цена с доставк.</th>
                                <th style="width: 150px;">Статус</th>
                            @else
                                <th>№ заказа/<br>Дата оплаты</th>
                                <th>Магазин/<br>Город</th>
                                <th>Дата доставки</th>
                                <th>Товар/<br>Цена полная/магазину</th>
                                <th style="width: 150px;">Статус</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        <tr ng-repeat="order in orders" >
                            @if(!$user->admin)
                                <td><span style="font-weight: bold"><% order.id %></span><br><% order.payed_at_dt | date:'MM.dd HH:mm' %></td>
                                <td>
                                    <% order.receiving_date_dt | date:'MM.dd HH:mm' %>
                                    <br>
                                    <% order.receiving_time %>
                                    <br>
                                    <a href="/admin/order/<% order.id %>" target="_blank">
                                        Детали заказа
                                    </a>
                                </td>
                                <td style="word-break: break-all;">
                                    <% order.recipient_address + (order.recipient_flat ? ', кв./оф. ' + order.recipient_flat : '') %>
                                    <br>
                                    <% order.delivery_out_distance > 0 ? 'за город: ' + order.delivery_out_distance + ' км. оплачена' : '' %>
                                </td>
                                <td>
                                    <span ng-repeat="orderList in order.order_lists" style="font-size: 10px">
                                        <a href="<% orderList.product.url %>" target="_blank"><% orderList.product.name %></a> - <% orderList.qty %> шт.
                                    </span>
                                    <br>
                                    <% order.amountShop %> руб.
                                </td>
                                <td>
                                    <select class="form-control" id="change-status-<% order.id %>" ng-model="order.status" ng-change="changeStatus(order, '<% order.status %>')" ng-hide="order.status == 'completed'">
                                        <option value="new" ng-show="order.status == 'new'">Новый</option>
                                        <option value="accepted" ng-show="order.status == 'new' || order.status == 'accepted'">Принят</option>
                                        <option value="completed" ng-show="order.status == 'completed' || order.status == 'accepted'">Выполнен</option>
                                    </select>

                                    <span class="m-badge  m-badge--info m-badge--wide" ng-show="order.status == 'completed'">Выполнен</span>

                                </td>
                            @else
                                <td><span style="font-weight: bold"><% order.id %></span><br><% order.payed_at_dt | date:'MM.dd HH:mm' %></td>
                                <td style="font-size: 12px">
                                    <a href="/admin/shop/<% order.shop.id %>" target="_blank"><% order.shop.name %></a>
                                    <br><% order.shop.city.name %>
                                    <span ng-show="order.shop.city.region.tz != 'UTC+3:00'" style="font-weight: bold"><% order.shop.city.region.tz %></span>
                                </td>
                                <td>
                                    <% order.receiving_date_dt | date:'MM.dd HH:mm' %>
                                    <br>
                                    <% order.receiving_time %>
                                    <br>
                                    <a href="/admin/order/<% order.id %>" target="_blank">
                                        Детали заказа
                                    </a>
                                </td>
                                <td>
                                    <span ng-repeat="orderList in order.order_lists" style="font-size: 10px">
                                        <a href="<% orderList.product.url %>" target="_blank"><% orderList.product.name %></a> - <% orderList.qty %> шт.
                                    </span>
                                    <br>
                                    <% order.amount %> руб. / <% order.amountShop %> руб.
                                </td>

                                <td>
                                    <select class="form-control" id="change-status-<% order.id %>" ng-model="order.status" ng-change="changeStatus(order, '<% order.status %>')" ng-hide="order.status == 'completed'">
                                        <option value="new" ng-show="order.status == 'new'">Новый</option>
                                        <option value="accepted" ng-show="order.status == 'new' || order.status == 'accepted'">Принят</option>
                                        <option value="completed" ng-show="order.status == 'completed' || order.status == 'accepted'">Выполнен</option>
                                    </select>

                                    <span class="m-badge  m-badge--info m-badge--wide" ng-show="order.status == 'completed'">Выполнен</span>

                                </td>
                            @endif
                        </tr>

                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>






@endsection

@section('footer')
    <script src="{{ asset('assets/admin/ng/ordersList.js?v=2') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
@stop