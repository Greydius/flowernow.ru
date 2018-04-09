@extends('layouts.admin')

@section('content')

    <div class="row" ng-cloak  ng-controller="single-products">


            <div class="col-xl-3" ng-repeat="product in products">

                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head" style="height: 40px; padding: 0 5px">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    <% product.name %>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <form class="m-form m-form--fit">

                        <div class="m-portlet__body" style="padding-top: 0; padding-bottom: 0;">
                            <div class="row">
                                <div class="col-xl-12 products-img-wraper">

                                    <img ng-src="/uploads/single/<% product.photo %>" width="100%" />
                                </div>
                            </div>

                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions" style="padding: 5px; font-weight: bold">
                                <p>Кол-во <% product.qty_from %> - <% product.qty_to %></p>
                                <p ng-show="!product.edit_mode">Цена за шт.: <% product.price ? product.price : 0 %> руб.
                                    <a href class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only" ng-click="product.edit_mode = true">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </p>
                                <div class="row" ng-show="product.edit_mode">
                                    <div class="col-md-6">
                                        <input type="number" class="form-control form-control-sm" ng-model="product.price" placeholder="Цена за шт.">
                                    </div>
                                    <div class="col-md-6">
                                        <a href class="btn btn-success btn-sm btn-block" ng-click="savePrice(product)">Сохранить</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>

                </div>

            </div>

    </div>

@endsection

@section('head')

@stop

@section('footer')

    <script src="{{ asset('assets/admin/ng/single.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>
    <script type="text/javascript">
            jsonData.products = {!! $products->makeHidden('shop')->toJson() !!};
    </script>
@stop