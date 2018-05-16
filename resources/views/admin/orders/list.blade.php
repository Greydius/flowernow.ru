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

            @if($user->admin)
                <form class="m-form m-form--fit m-form--label-align-right" method="get" action="">
                    <div class="col-md-12">
                        <div class="m-input-icon m-input-icon--left">
                            <input type="text" class="form-control m-input m-input--solid" placeholder="Поиск..." id="m_form_search" ng-keypress="search($event)">
                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                <span>
                                    <i class="la la-search"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Период
                        </label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="input-daterange input-group" id="m_datepicker_5">
                                <input type="text" class="form-control m-input" name="dateFrom" ng-model="dateFrom" value="{{ app('request')->input('dateFrom') }}"/>
                                <span class="input-group-addon">
                                 <i class="la la-ellipsis-h"></i>
                             </span>
                                <input type="text" class="form-control" name="dateTo" ng-model="dateTo" value="{{ app('request')->input('dateTo') }}"/>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <button type="button" class="btn btn-info" ng-click="getOrders()">
                                Применить
                            </button>
                        </div>
                    </div>
                </form>
                <br><br>
            @endif

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
                                    <% order.receiving_date_dt | date:'MM.dd' %>
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
                                    <% order.receiving_date_dt | date:'MM.dd' %>
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
                                    <div ng-show="order.promo_code_id" class="text-danger" style="font-size: 10px">
                                        Скидка по промо: <% order.promo.text %>
                                    </div>
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
    <script src="{{ asset('assets/admin/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/ng/ordersList.js?v=3') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
@stop