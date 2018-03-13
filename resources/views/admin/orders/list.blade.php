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
                            <th style="width: 65px;">№</th>
                            <th style="width: 125px;">Дата оплаты</th>
                            <th style="width: 125px;">Дата доставки</th>
                            <th>Адрес</th>
                            <th>Состав</th>
                            <th style="width: 110px;">Оплачено, руб</th>
                            <th style="width: 150px;">Статус</th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr ng-repeat="order in orders" >
                            <td><% order.id %></td>
                            <td><% order.payed_at %></td>
                            <td>
                                <% order.receiving_date %>
                                <br>
                                <% order.receiving_time %>
                            </td>
                            <td style="word-break: break-all;">
                                <% order.recipient_address + (order.recipient_flat ? ', кв./оф. ' + order.recipient_flat : '') %>
                                <br>
                                <% order.delivery_out_distance ? 'доставка за город: ' + order.delivery_out_distance + ' км. оплачена' : '' %>
                            </td>
                            <td>
                                <span ng-repeat="orderList in order.order_lists">
                                    <a href="<% orderList.product.url %>" target="_blank"><% orderList.product.name %></a> - <% orderList.qty %> шт.
                                </span>
                            </td>
                            <td>
                                <% order.amountShop %>
                            </td>
                            <td>
                                <select class="form-control" id="change-status-<% order.id %>" ng-model="order.status" ng-change="changeStatus(order, '<% order.status %>')" ng-hide="order.status == 'completed'">
                                    <option value="new" ng-show="order.status == 'new'">Новый</option>
                                    <option value="accepted" ng-show="order.status == 'new' || order.status == 'accepted'">Принят</option>
                                    <option value="completed" ng-show="order.status == 'completed' || order.status == 'accepted'">Выполнен</option>
                                </select>

                                <span class="m-badge  m-badge--info m-badge--wide" ng-show="order.status == 'completed'">Выполнен</span>

                                <!--
                                <span class="m-badge  m-badge--success m-badge--wide" ng-show="order.status == 'new'"><a href="#">Новый</a></span>
                                <span class="m-badge  m-badge--warning m-badge--wide" ng-show="order.status == 'accepted'"><a href="#">Принят</a></span>

                                -->
                            </td>
                            <td>
                                <a href="/admin/order/<% order.id %>" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Просмотр">
                                    <i class="la la-edit"></i>
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
    <script src="{{ asset('assets/admin/ng/ordersList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
@stop