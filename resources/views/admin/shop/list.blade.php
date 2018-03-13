@extends('layouts.admin')

@section('content')

    <div class="m-portlet m-portlet--mobile" ng-controller="shopsList">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Магазины
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right  m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Поиск..." id="m_form_search" ng-keypress="search($event)">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data">




                <table style=" width: 100%">
                    <thead class="">
                        <tr class="m-datatable__row" style="height: 53px;">
                            <th>#</th>
                            <th>Название</th>
                            <th style="width: 110px;">Телефон</th>
                            <th style="width: 110px;">Доставка (руб.)</th>
                            <th style="width: 160px;">Изменение товара</th>
                            <th style="width: 100px;">Статус</th>
                            <th style="width: 110px;">Действие</th>
                        </tr>
                    </thead>
                    <tbody class="" style="">
                        <tr ng-repeat="shop in shops" class="<% shop.delivery_price > 0 ? '' : 'bg-danger' %>" style="height: 55px;" ng-cloak>
                            <td><% $index + 1 %></td>
                            <td><a target="_blank" href="/admin/shop/<% shop.id %>"><% shop.name %></a><br><% shop.city.name %></td>
                            <td><% shop.users[0].phone %></td>
                            <td><% shop.delivery_price %></td>
                            <td><% shop.product_last_update %></td>
                            <td>
                                <span class="m-badge m-badge--success m-badge--wide" ng-show="shop.active">вкл.</span>
                                <span class="m-badge m-badge--danger m-badge--wide" ng-show="!shop.active">выкл.</span>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>





            </div>
            <!--end: Datatable -->
        </div>
    </div>



@endsection

@section('head')
@stop

@section('footer')
    <script src="{{ asset('assets/admin/ng/shopsList.js?v=1') }}" type="text/javascript"></script>
    <script type="text/javascript">
        routes.shopsList = '{{ route('admin.api.shops.list')  }}';
    </script>
@stop