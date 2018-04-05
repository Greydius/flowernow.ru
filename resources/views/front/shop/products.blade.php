@extends('layouts.site')

@section('pageImage', (!empty($meta) && !empty($meta['image']) ? $meta['image'] : null))
@section('pageTitle', (!empty($meta) && !empty($meta['title']) ? $meta['title'] : null))
@section('pageDescription', (!empty($meta) && !empty($meta['description']) ? $meta['description'] : null))
@section('pageKeywords', (!empty($meta) && !empty($meta['keywords']) ? $meta['keywords'] : null))

@section('content')

<div class="container">

    <br class="hidden-xs hidden-sm">

    <div class="row">
        <div class="col-md-12">
            <h3 class="margin-top-null"><strong>{{ $shop->name }} г. {{ $shop->city->name }}</strong></h3>
        </div>
        <div class="col-md-12">
            <p>{!! nl2br(e($shop->about)) !!}</p>
        </div>
    </div>

    <br class="hidden-xs hidden-sm">

    <div class="row" id="products-container">



        <div class="col-md-12">

            @if(count($products))

                @if(!empty($products))
                    <div class="row">
                        @foreach($products as $_item)

                            @include('front.product.list-item', ['col' => 3])

                        @endforeach
                    </div>
                @endif

                {{ $products->links() }}

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

@stop

@section('footer')

@stop