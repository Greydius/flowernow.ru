@extends('layouts.site')

@section('pageImage', (!empty($meta) && !empty($meta['image']) ? $meta['image'] : null))
@section('pageTitle', (!empty($meta) && !empty($meta['title']) ? $meta['title'] : null))
@section('pageDescription', (!empty($meta) && !empty($meta['description']) ? $meta['description'] : null))
@section('pageKeywords', (!empty($meta) && !empty($meta['keywords']) ? $meta['keywords'] : null))

@section('content')

<div class="container" ng-controller="mainPage">

    <br class="hidden-xs hidden-sm">

    <div class="row" ng-hide="isFiltered">
        <div class="col-md-9">
            <h3 class="margin-top-null"><strong>{{ !empty($title) ? $title : 'Популярные букеты' }}</strong></h3>
        </div>
        <div class="col-md-3">
            <ul class="list-inline list-sort text-right">
                <!-- <li>Сортировать:</li>
                <li><a href="#">по цене</a></li>
                <li><a href="#">по новизне</a></li>
                -->
            </ul>
        </div>
    </div>

    <br class="hidden-xs hidden-sm">

    <div class="row" id="products-container">

        <div class="col-md-3 col-md-push-9 hidden-xs hidden-sm">
                <p class="h3 margin-top-null">Уточнить категорию</p>
                <br>

                <div class="filter-block filter-product-checker">
                    <button class="btn btn-lg btn-block btn-default" type="button" data-toggle="collapse" data-target="#filter-product-type" aria-expanded="false" aria-controls="filter3"><span class="pull-left">Тип букета</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse in" id="filter-product-type">
                        <ul class="list-unstyled filter">
                            @foreach ($productTypes as $type)
                                @foreach($popularProducts as $item)
                                    
                                    @if($item['productType']->id == $type->id && $item['popularProductCount'])
                                        <li data-id="{{ $type->id }}" data-slug="{{ $type->slug }}" class="{{ !empty(request()->product_type_filter) && request()->product_type_filter == $type->slug ? 'active' : null }}"><img src="{{ asset('assets/front/img/ico/'.$type->icon) }}" alt="{{ $type->alt_name }}"> {{ $type->name }}</li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter4" aria-expanded="false" aria-controls="filter4"><span class="pull-left">Цветы в букете</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter4">
                        <ul class="list-unstyled">
                            @foreach ($flowers as $flower)
                                <li>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="{{ $flower->id }}" data-slug="{{ $flower->slug }}" name="flowers[]" {{ !empty(request()->flowers) && in_array($flower->id, request()->flowers) ? 'checked' : null }}> {{ $flower->name }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="filter-block filter-product-checker">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter-product-price" aria-expanded="false" aria-controls="filter1"><span class="pull-left">Цены</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter-product-price">
                        <ul class="list-unstyled">
                            @foreach ($prices as $price)
                                <li data-id="{{ $price->id }}" data-from="{{ $price->price_from }}" data-to="{{ $price->price_to }}" class="{{ !empty(request()->price_from) && !empty(request()->price_to) && request()->price_from == $price->price_from && request()->price_to == $price->price_to ? 'active' : null }}">{{ $price->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="filter-block">
                    <button class="btn btn-lg btn-block btn-default collapsed" type="button" data-toggle="collapse" data-target="#filter-product-color" aria-expanded="false" aria-controls="filter5"><span class="pull-left">Цвет</span> <span class="pull-right glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                    <div class="collapse" id="filter-product-color">
                        <div class="row">
                            @foreach ($colors as $color)
                                <div class="col-2-5 color-item {{ !empty(request()->color) && request()->color == $color->id ? 'active' : null }}" data-id="{{ $color->id }}">
                                    <div class="selected-color {{ $color->css_class }}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button class="btn btn-info btn-block" ng-click="resetFilter()">Сбросить фильтр</button>
        </div>



        <div class="col-md-9 col-md-pull-3"  style="background-color: #fff; padding-top: 20px;">


            @include('front.product.search')

            @if(count($popularProduct))

                @if(!empty($popularProduct))
                    <div class="row">
                        @foreach($popularProduct as $_item)

                            @include('front.product.list-item')

                        @endforeach
                    </div>
                @endif

                {{ $popularProduct->appends(request()->query())->links() }}

            @else
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="md-mt-30 md-mb-50 text-center">К сожалению нет букетов выбранной категории.</h4>
                    </div>
                </div>
            @endif

        </div>


    </div>


    <br class="hidden-xs hidden-sm">

</div>



@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('assets/front/js/typeahead.js/typeaheadjs.css') }}">
@stop

@section('footer')
    <script type="text/javascript">

        routes.products = '{!! route('api.products.popular') !!}';
    </script>

    <script src="{{ asset('assets/front/js/typeahead.js/bloodhound.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/typeahead.js/typeahead.jquery.js') }}"></script>
    <script src="{{ asset('assets/front/js/index.js?v=3_0') }}"></script>
@stop