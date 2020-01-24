@extends('layouts.site')

@section('content')

    <div class="container">
        <br>
        <h1 class="h2 margin-top-null m-b-1"><strong>Доставка букетов цветов</strong> - всегда бесплатна в {{ $current_city->name_prepositional }}</h1>

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
                <p> <img src="{{ asset('assets/front/img/dostavka_tsvetov.png') }}" height="100px" Align="left" hspace="25">Доставка в {{ $current_city->name_prepositional }} осуществляется бесплатно (в границах города). Доставка также бесплатная, если она не выходит за пределы кольцевой. Если получатель букета находится не в {{ $current_city->name_prepositional }}, стоимость услуги устанавливается цветочным магазином или непосредственно флористом и рассчитывается автоматически в зависимости от указанного вами в форме заказа количества км от кольцевой. Зависеть она будет от, соответственно, расстояния.</p>
            
               
            </div>
        </div>

        <div class="row m-b-3">
            <div class="col-md-10">
                <p>Время, в которое букет будет доставлен к вам, зависит от сложности работы и дорожной обстановки. В описании товара на сайте указывается, через какое время вам могут доставить этот букет по {{ $current_city->name_prepositional }}. После того, как вы оформите заказ, вам придет СМС о том, что заказ был принят. А после - что заказ доставили, а также вы сможете посмотреть фото доставленного букета и фото получателя, если адресат не отказался сделать фото с букетом.</p>
            </div>
            <div class="col-md-2">
                <img src="{{ asset('assets/front/img/new_zakaz_buketov.png') }}" height="100px">
            </div>
        </div>

        <br><br><br>

        <p><a href="{{ route("feedback.reviews") }}">Отзывы о салонах</a></p>
        <p><a href="{{ route("front.happyRecipients") }}">Счастливые обладатели букетов</a></p>
        <p><a href="/catalog/archive">Архив букетов</a></p>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop