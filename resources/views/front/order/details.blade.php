@extends('layouts.site')

@section('content')

    <div class="container order-details">
        <div class="row">
            <div class="col-md-12">
                <figure class="highlight">

                    <div class="pre">

                        <div class="text-center">
                            <span class="icon"><i class="fa fa-shopping-cart"></i></span>
                            <h3>Заказ № {{ $order->id }}</h3>
                            <h3><span class="label label-success">{{ $order->statusName }}</span></h3>
                        </div>

                        @foreach($order->orderLists as $items)
                            <div class="media">
                                <div class="media-left">
                                        <img alt="64x64" class="media-object" src="{{ $items->product->photoUrl }}" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $items->product->name }}</h4>
                                    {{ $items->product->description }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </figure>
            </div>
        </div>
    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop