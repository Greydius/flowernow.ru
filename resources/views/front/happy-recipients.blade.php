@extends('layouts.site')


@section('content')

    <div class="container">

        <h1 class="h3 title-media-item-opened"><strong>Счастливые получатели в {{ $current_city->name_prepositional }}</strong></h1>

        <div class="row">
            @foreach($orders as $order)

                @foreach($order->orderLists as $key => $item)
                    @if($item->product)
                        <div class="col-sm-{{ !empty($col) ? $col : '4' }} col-xs-6 {{ !empty($class) ? $class : '' }}">
                            <div class="media-item">
                                <a href="/flowers/{{ $item->product->slug }}">
                                    <figure>
                                        <img class="img-responsive" src="{{ \Storage::disk('orders')->url($order->photo) }}" alt="...">
                                    </figure>
                                </a>

                                <div class="description-media-item">
                                    <div class="row">
                                        <div class="col-xs-12 buy">
                                            <a href="/flowers/{{ $item->product->slug }}" class="btn btn-danger btn-outline buy-btn">Заказать</a>
                                            <a href="/flowers/{{ $item->product->slug }}" class="name">{{ $item->product->name }}</a></p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach

            @endforeach

            {{ $orders->appends(request()->query())->links() }}

        </div>

    </div>


@endsection