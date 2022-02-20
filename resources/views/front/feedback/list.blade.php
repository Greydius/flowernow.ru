@extends('layouts.site')

@section('content')
    <div class="container">
        <h1 class="h3 title-media-item-opened"><strong>Отзывы о салонах в {{ $current_city->name_prepositional }}</strong></h1>

        @foreach($feedbacks as $feedback)

            <div class="media">
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

        {{ $feedbacks->appends(request()->query())->links() }}
    </div>

@endsection