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

        <tr class="<% order.status == 'completed' ? '' : order.status == 'accepted' ? 'success-order' : order.status == 'new' ? 'new-order' : 'canceled-order' %>" ng-repeat="order in orders" >
            @if(!$user->admin)
                <td>
                    <span style="font-weight: bold"><% order.id %><span class="reorder-icon"><% order.reorder == 1 ? 'V' : '' %></span></span>
                    <div ng-show="order.payed_at != ''">
                        <br>
                        <% order.payedDateFormat %>
                    </div>
                    <br>
                    <span class="text-success" ng-show="order.payment == 'card'">Карта</span>
                    <span class="text-danger font-weight-bold" ng-show="order.payment == 'cash'">Наличные</span>
                </td>
                <td>
                    <% order.receivingDateFormat %>
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
                    <% order.amountShop %> ₽
                </td>
                <td>
                    <select class="form-control" id="change-status-<% order.id %>" ng-model="order.status" ng-change="changeStatus(order, '<% order.status %>')" ng-hide="order.status == 'completed'">
                        <option value="new" ng-show="order.status == 'new'">Новый</option>
                        <option value="accepted" ng-show="order.status == 'new' || order.status == 'accepted'">Принят</option>
                        <option value="completed" ng-show="order.status == 'completed' || order.status == 'accepted'">Выполнен</option>
                    </select>

                    <span class="m-badge  m-badge--info m-badge--info__green m-badge--wide" ng-show="order.status == 'completed'">Выполнен</span>

                </td>
            @else
                <td>
                                    <span style="font-weight: bold">
                                        <% order.id %><span class="reorder-icon"><% order.reorder == 1 ? 'V' : '' %></span>
                                        <i ng-show="order.finance_comment" class="la la-info text-warning" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="<% order.finance_comment %>"></i>
                                    </span>
                    <br>
                    <div ng-show="order.payed_at != '' && order.payment != 'cash'">
                        <br>
                        <% order.payedDateFormat %>
                    </div>
                    <div ng-show="order.payment == 'cash'">
                        <br>
                        <% order.createdAtFormat %>
                    </div>
                    <div ng-show="order.payment == 'cash' && order.confirmed == 0">
                        <br>
                        <span class="text-danger">Нал.-не подтвержден</span>
                    </div>
                    <br>
                    <span class="<% order.payed == 1 ? 'text-success' : '' %>" ng-show="order.payment == 'card'">Карта</span>
                    <span class="text-danger" ng-show="order.payment == 'card' && order.payed == 0 ">б.оплаты</span>
                    <span class="text-danger font-weight-bold" ng-show="order.payment == 'rs' && order.payed == 0">Юрлицо</span>
                    <span class="text-success font-weight-bold" ng-show="order.payment == 'rs' && order.payed == 1">Юрлицо</span>
                    <span class="text-danger font-weight-bold" ng-show="order.payment == 'cash' && order.confirmed == 1">Наличные</span>
                </td>
                <td style="font-size: 12px">
                    <a href="/admin/shop/<% order.shop.id %>" target="_blank"><% order.shop.name %></a>
                    <br><% order.shop.city.name %>
                    <span ng-show="order.shop.city.region.tz != 'UTC+3:00'" style="font-weight: bold"><% order.shop.city.region.tz %></span>
                </td>
                <td>
                    <% order.receivingDateFormat %>
                    <br>
                    <% order.receiving_time %>
                    <div ng-show="order.shop.city.region.tz != 'UTC+3:00'" style="font-weight: bold">
                        <br>
                        с <% order.receiving_time_msk.from %> до <% order.receiving_time_msk.to %> по МСК
                    </div>
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
                    <% order.report_price == 0 || order.report_price == null ? order.amount : order.report_price %> ₽ / <% order.amountShop %> ₽
                    <div ng-show="order.promo_code_id" class="text-danger" style="font-size: 10px">
                        Скидка по промо: <% order.promo.text %>
                    </div>
                    <br><span style="font-size: 10px" class="text-danger"><% order.ur_name %></span>
                </td>

                <td>
                    <select class="form-control" id="change-status-<% order.id %>" ng-model="order.status" ng-change="changeStatus(order, '<% order.status %>')" ng-hide="order.status == 'completed'">
                        <option value="new" ng-show="order.status == 'new'">Новый</option>
                        <option value="accepted" ng-show="order.status == 'new' || order.status == 'accepted'">Принят</option>
                        <option value="completed" ng-show="order.status == 'completed' || order.status == 'accepted'">Выполнен</option>
                    </select>

                    <span class="m-badge  m-badge--info m-badge--info__green m-badge--wide" ng-show="order.status == 'completed'">Выполнен</span>

                </td>
            @endif
        </tr>

        </tbody>
    </table>
</div>

<style>
.reorder-icon {
  color: #bfde00;
  font-weight: 600;
  font-size: 13px;
}

.success-order {
  background-color: rgb(226,239,218);
}
.new-order {
  background-color: rgb(248,203,173);
}
.canceled-order {
  background-color: rgb(255,242,204);
}
.m-badge.m-badge--info__green {
  background-color: hsla(117, 100%, 81%, 1);
}
</style>