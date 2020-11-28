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
                <div class="row">
                    <div class="col-md-6">
                        <h3>Прошедший месяц</h3>
                        <p>Средний заказ: {{ $stat['lastMonth']['avgOrderPrice'] }} ₽</p>
                        <p>Среднее кол-во заказов: {{ $stat['lastMonth']['avgPayedOrders'] }} шт.</p>
                        <p>Оборот: {{ $stat['lastMonth']['ordersSumForPeriod'] }} ₽</p>
                    </div>
                    <div class="col-md-6">
                        <h3>Текущий месяц</h3>
                        <p>Средний заказ: {{ $stat['currentMonth']['avgOrderPrice'] }} ₽</p>
                        <p>Среднее кол-во заказов: {{ $stat['currentMonth']['avgPayedOrders'] }} шт.</p>
                        <p>Оборот: {{ $stat['currentMonth']['ordersSumForPeriod'] }} ₽</p>
                    </div>
                </div>
            @endif

            @if($user->admin)
                <form class="m-form m-form--fit m-form--label-align-right" method="get" action="">
                    <div class="col-md-12">
                        <div class="form-group m-form__group">
                            <label class="m-checkbox">

                                <input type="checkbox" value="1" ng-model="ur_only" name="ur_only" id="ur_only" {{ app('request')->input('ur_only') ? 'checked' : '' }} ng-change="changeUr()">
                                Только заказы Юр.Лиц
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group m-form__group">
                            <label class="m-checkbox">

                                <input type="checkbox" value="1" ng-model="new_only" name="new_only" id="new_only" {{ app('request')->input('new_only') ? 'checked' : '' }} ng-change="changeUr()">
                                Только новые
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control m-input m-input--solid" placeholder="Поиск..." id="m_form_search" ng-keypress="search($event)">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" ng-click="filterOrders()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
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

            @include('admin.orders.table')


            <div class="m-datatable--default m-datatable" ng-cloak>
                <div class="m-datatable__pager m-datatable--paging-loaded clearfix" style="margin-top: 0">

                    <ul class="m-datatable__pager-nav">
                        <li ng-show="currentPage > 1"><a ng-click="getOrdersPage(currentPage-1)" title="Previous" class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="5"><i class="la la-angle-left"></i></a></li>
                        <li ng-repeat="n in ranges(1,totalPages)">
                            <a ng-click="getOrdersPage(n)" class="m-datatable__pager-link m-datatable__pager-link-number <% currentPage == n ? 'm-datatable__pager-link--active' : '' %>" data-page="<% n %>"><% n %></a>
                        </li>
                        <li ng-show="currentPage < totalPages"><a ng-click="getOrdersPage(currentPage+1)" title="Next" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="7"><i class="la la-angle-right"></i></a></li>
                    </ul>

                </div>
            </div>

        </div>
    </div>

</div>






@endsection

@section('footer')
    <script src="{{ asset('assets/admin/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/ng/ordersList.js?v=20190114') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/orders-list.js') }}" type="text/javascript"></script>
@stop