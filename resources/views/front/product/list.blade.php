@extends('layouts.site')

@section('pageImage', (!empty($meta) && !empty($meta['image']) ? $meta['image'] : null))
@section('pageTitle', (!empty($meta) && !empty($meta['title']) ? $meta['title'] : null))
@section('pageDescription', (!empty($meta) && !empty($meta['description']) ? $meta['description'] : null))
@section('pageKeywords', (!empty($meta) && !empty($meta['keywords']) ? $meta['keywords'] : null))

@section('content')

<div class="container 34" ng-controller="mainPage">

    <br class="hidden-xs hidden-sm">

    <div class="row list-products" ng-hide="isFiltered">

        <div class="col-md-5">
            <h1 class="margin-top-null h2 sm-h2">{!!  !empty($title) ? $title : 'Популярные букеты' !!}</h1>
        </div>
        <div class="col-md-7 hidden-xs hidden-sm">
            @include('front.product-types')
        </div>
    </div>

    <br class="hidden-xs hidden-sm">

    <div class="row" id="products-container">



        <div class="col-md-12"  style="background-color: #fff; padding-top: 35px;">

            <div class="free_phone hidden-xs">
                <b>8 800 600-54-97</b>
                <span>Звонок бесплатный</span>
            </div>

            @include('front.product.search')

            @if(count($popularProduct))

                @if(count($popularProduct))
                    <div class="row">
                        
                        @foreach($popularProduct as $key => $_item)

                            @include('front.product.list-item', ['col' => 3, 'class' => ($key < count($popularProduct)-3 ? 'pull-right' : '')])

                        @endforeach
                    </div>
                    {{ $popularProduct->appends(request()->query())->links() }}
                @endif


                @if($popularProduct->total() <= 30 && count($lowPriceProducts))
                        <h3 class="margin-top-null top30"><strong>Самые низкие цены</strong></h3>
                        <div class="row">
                            @foreach($lowPriceProducts as $_item)

                                @include('front.product.list-item', ['col' => 3])

                            @endforeach
                        </div>

                        {{ $lowPriceProducts->withPath('/catalog?order=price')->links() }}
                @endif

            @else

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="md-mt-30 md-mb-50 text-center">К сожалению нет букетов выбранной категории.</h4>

                        @if(count($lowPriceProducts))
                            <h3 class="margin-top-null top30"><strong>Самые низкие цены</strong></h3>
                            <div class="row">
                                @foreach($lowPriceProducts as $_item)

                                    @include('front.product.list-item', ['col' => 3])

                                @endforeach
                            </div>

                            {{ $lowPriceProducts->withPath('/catalog?order=price')->links() }}
                        @endif
                    </div>
                </div>

            @endif

            @if(!empty($promoText))
                <div class="row">
                    <div class="col-md-12">
                        {!! $promoText->text !!}
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