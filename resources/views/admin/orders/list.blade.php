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
                            <th style="width: 125px;">Дата</th>
                            <th>Состав</th>
                            <th style="width: 110px;">Цена</th>
                            <th style="width: 150px;">Статус</th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr ng-repeat="order in orders" >
                            <td><% order.id %></td>
                            <td>
                                <% order.receiving_date %>
                                <br>
                                <% order.receiving_time %>
                            </td>
                            <td>
                                <span ng-repeat="orderList in order.order_lists">
                                    <a href="<% orderList.product.url %>" target="_blank"><% orderList.product.name %></a> - <% orderList.qty %> шт.
                                </span>
                            </td>
                            <td>
                                <b><% order.amount %></b>р.
                                    <br>
                                <span style="font-weight: bold;">Вам:</span> <% order.amountShop %>р.
                            </td>
                            <td>
                                <span class="m-badge  m-badge--success m-badge--wide" ng-show="order.status == 'new'">Новый</span>
                                <span class="m-badge  m-badge--warning m-badge--wide" ng-show="order.status == 'accepted'">Принят</span>
                                <span class="m-badge  m-badge--info m-badge--wide" ng-show="order.status == 'completed'">Выполнен</span>
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