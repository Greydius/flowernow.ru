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
            <h1 class="margin-top-null h2 sm-h2">Доставка цветов {{ $shop->name }} в <a href="{{ route('front.index') }}">{{ $shop->city->name_prepositional }}</a></h1>
        </div>
        @if($shop->about)
            <div class="col-md-12">
                <strong>Описание магазина цветов {{ $shop->name }}:</strong>
                <p>{!! nl2br(e($shop->about)) !!}</p>
            </div>
        @endif
        @if(!empty($shop->address) && !empty($shop->address[0]->city))
            <div class="col-md-12">
                <p><strong>Адрес:</strong> г. {{$shop->address[0]->city->name}}, {{ $shop->address[0]->name }}</p>
            </div>
        @endif


@if(count($shop->workTime) && ($shop->workTime[0]->is_work || $shop->workTime[1]->is_work || $shop->workTime[2]->is_work || $shop->workTime[3]->is_work || $shop->workTime[4]->is_work || $shop->workTime[5]->is_work || $shop->workTime[6]->is_work))
    <div class="col-md-12">
        <p>
            <strong>Часы работы:</strong><br>

            @if(!$shop->workTime[0]->is_work || ($shop->workTime[0]->work_from && $shop->workTime[0]->work_to) || $shop->workTime[0]->round_clock)
                ПН: @if($shop->workTime[0]->is_work) @if($shop->workTime[0]->round_clock) круглосуточно @else {{ $shop->workTime[0]->work_from_format }} - {{ $shop->workTime[0]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif
            @if(!$shop->workTime[1]->is_work || ($shop->workTime[1]->work_from && $shop->workTime[1]->work_to) || $shop->workTime[1]->round_clock)
                ВТ: @if($shop->workTime[1]->is_work) @if($shop->workTime[1]->round_clock) круглосуточно @else  {{ $shop->workTime[1]->work_from_format }} - {{ $shop->workTime[1]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif
            @if(!$shop->workTime[2]->is_work || ($shop->workTime[2]->work_from && $shop->workTime[2]->work_to) || $shop->workTime[2]->round_clock)
                СР: @if($shop->workTime[2]->is_work) @if($shop->workTime[2]->round_clock) круглосуточно @else  {{ $shop->workTime[2]->work_from_format }} - {{ $shop->workTime[2]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif
            @if(!$shop->workTime[3]->is_work || ($shop->workTime[3]->work_from && $shop->workTime[3]->work_to) || $shop->workTime[3]->round_clock)
                ЧТ: @if($shop->workTime[3]->is_work) @if($shop->workTime[3]->round_clock) круглосуточно @else  {{ $shop->workTime[3]->work_from_format }} - {{ $shop->workTime[3]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif
            @if(!$shop->workTime[4]->is_work || ($shop->workTime[4]->work_from && $shop->workTime[4]->work_to) || $shop->workTime[4]->round_clock)
                ПТ: @if($shop->workTime[4]->is_work) @if($shop->workTime[4]->round_clock) круглосуточно @else  {{ $shop->workTime[4]->work_from_format }} - {{ $shop->workTime[4]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif
            @if(!$shop->workTime[5]->is_work || ($shop->workTime[5]->work_from && $shop->workTime[5]->work_to) || $shop->workTime[5]->round_clock)
                СБ: @if($shop->workTime[5]->is_work) @if($shop->workTime[5]->round_clock) круглосуточно @else  {{ $shop->workTime[5]->work_from_format }} - {{ $shop->workTime[5]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif
            @if(!$shop->workTime[6]->is_work || ($shop->workTime[6]->work_from && $shop->workTime[6]->work_to) || $shop->workTime[6]->round_clock)
                ВС: @if($shop->workTime[6]->is_work) @if($shop->workTime[6]->round_clock) круглосуточно @else  {{ $shop->workTime[6]->work_from_format }} - {{ $shop->workTime[6]->work_to_format }}@endif @else<span class="text-danger">выходной</span> @endif<br>
            @endif

        </p>
    </div>
@endif

@if(count($shop->feedbacks))
    <div class="col-md-12">
        <h3>Отзывы о работе магазина {{ $shop->name }}</h3>

        @if(count($feedbacks))

            @foreach($feedbacks as $feedback)

                <div class="media media-item-opened">
                    <div class="media-left">
                        <img class="media-object" width="54" height="54" src="{{ asset('assets/front/img/reviews-5.png') }}" alt="...">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><strong>Заказчик букета {{ $feedback->name }}</strong> <? if($feedback->feedback_date != '0000-00-00 00:00:00') { ?><span class="text-muted feedback-date">{{ Carbon\Carbon::parse($feedback->feedback_date)->format('d-m-Y') }}</span><? } ?></h4>
                        <p>{{ $feedback->feedback }}</p>
                        <ul class="list-inline">
                            <li>
                                <div class="rating-green"><span style="width:{{ $feedback->rating * 20 }}%;"></span></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>

            @endforeach
        @else
            <p><i>Отзыв о работе магазина цветов еще не оставляли</i></p>
        @endif

    </div>
@endif
</div>

<br class="hidden-xs hidden-sm">

<div class="row" id="products-container">



<div class="col-md-12">

    <h2 class="margin-top-null">Витрина букетов цветочного магазина {{ $shop->name }}:</h2>

    @if(count($singleProducts))

        @if(!empty($singleProducts))
            <div class="row">
                @foreach($singleProducts as $_item)

                    @include('front.product.list-item', ['col' => 3, 'isNeedShopName' => true])

                @endforeach
            </div>
        @endif

    @endif

    @if(count($products))

        @if(!empty($products))
            <div class="row">
                @foreach($products as $_item)

                    @include('front.product.list-item', ['col' => 3, 'isNeedShopName' => false])

                @endforeach
            </div>
        @endif

        {{ $products->links() }}

    @endif

    @if(!count($products) && !count($singleProducts))
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