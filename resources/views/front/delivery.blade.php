@extends('layouts.site')

@section('content')

    <div class="container">
        <br>
        <h1 class="h2 margin-top-null m-b-1"><strong>Доставка букетов</strong></h1>

        <div class="row m-b-3">
            <div class="col-md-10">
                <p>После того, как заказ оформляется на сайте, информация об этом моментально попадает в службу доставки торговой точки или частного флориста, который вы выбрали. Вы можете наблюдать за тем, на какой стадии находится ваш заказ при помощи данных в вашем кабинете на сайте.</p>
            </div>
            <div class="col-md-2">
                <img src="{{ asset('assets/front/img/zakaz_cvetov_floristum.png') }}" height="100px">
            </div>
        </div>

        <div class="row m-b-3">
            <div class="col-md-10">
                <p>Доставка в рамках одного города осуществляется бесплатно. В Москве доставка также бесплатная, если она не выходит за пределы МКАД. Если букет нужно доставить за пределы города, стоимость услуги устанавливается цветочным магазином или непосредственно флористом. Зависеть она будет от расстояния.</p>
            </div>
            <div class="col-md-2">
                <img src="{{ asset('assets/front/img/dostavka_tsvetov.png') }}" height="100px">
            </div>
        </div>

        <div class="row m-b-3">
            <div class="col-md-10">
                <p>Время, в которое букет будет доставлен к вам, зависит от сложности работы. В описании товара на сайте указывается, через какое время вам могут доставить этот букет. После того, как вы оформите заказ, вам придет СМС о том, что заказ был принят. А после - что заказ доставили.</p>
            </div>
            <div class="col-md-2">
                <img src="{{ asset('assets/front/img/new_zakaz_buketov.png') }}" height="100px">
            </div>
        </div>

        <br><br><br>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop