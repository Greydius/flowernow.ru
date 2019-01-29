@extends('layouts.site')

@section('pageTitle', $pageTitle)
@section('pageDescription', $pageDescription)
@section('pageKeywords', $pageKeywords)

@section('content')



    <div class="container">
       

        

        <div class="row"> 
            <div class="col-md-12 m-b-4">

                <br><br><br>
        <h1 class="h2 margin-top-null m-b-1">Доставка цветов для юр лиц по безналичному расчету в {{ $current_city->name_prepositional }}.</h1>
<div style="background-color: #fff; padding: 15px;"><h2 style="font-size: 20px; font-weight: bold;">Хотите заказывать цветы как юр. лицо с оплатой с расчетного счета в {{ $current_city->name_prepositional }}? </h2> 

<img src="http://floristum.ru/images/dostavka_tsvetov_po_beznalu_white.png" alt="Доставка цветов по безналу юр лицам" align="left"  vspace="15" hspace="35"><strong><br>Заказывать по безналу просто!</strong> <br><br><b>Желаете заказать цветы прямо сейчас?</b> — просто выберите букет на <a href="/">Floristum.ru в  {{ $current_city->name_prepositional }}</a>, а на странице заказа выберите способ оплаты "Безнал для юр. лиц", заполните реквизиты и на Вашу почту будет мгновенно отправлен договор и выставлен счет. <br>
<br><b>Предпочитаете заключить договор заблаговременно и заказывать цветы по предоплате?</b> —  пожалуйста, напишите нам о своих намерениях: <b>corporate@floristum.ru</b> или позвоните: <b>8 (812) 982-23-83</b>. <br> <br> Ассортимент букетов по ценам представленным на сайте предлагается как публичное <b>коммерческое предложение на цветы</b> для юридических лиц. 
       <br> <br> <br> <br></div><br> <br>

                <div class="row">
                    <div class="col-md-12">
                        @include('front.product-types')
                    </div>
                </div>
        <ul> <h3>Преимущества работы с <a href="/">Floristum.ru в  {{ $current_city->name_prepositional }}</a> для юр лиц<br>(коммерческое предложение на цветы с доставкой):</h3><br>
                      <li><img src="http://floristum.ru/images/dostavka_tsvetov_v_ofis1.png" alt="Доставка цветов и букетов" align="right" 
  vspace="10" hspace="25">
                        <p><strong>Букеты с доставкой день в день по {{ $current_city->name_prepositional }} и любой город России по единому договору.</strong></p>
                        <p>Заключив один договор, вы можете заказывать цветы и подарки в любой город России, в котором работает Floristum.ru, а это сотни населенных пунктов, в которых живут Ваши клиенты и коллеги!</p>
                    </li>
                    <li>
                        <p><strong>Оплата цветов с расчетного счета организации.</strong></p>
                        <p>Простая автоматическая система выставления счетов с ООО "ФЛН"(Floristum.ru) на реквизиты Вашего юридического лица, через форму заказа букета. Не нужно никуда писать, звонить и простить счет, система сама выставит счет на указанный Вами электронный адрес.</p>
                    </li>
<li>
                        <p><strong>Тысячи букетов в наличии на <a href="/">Floristum.ru</a> в {{ $current_city->name_prepositional }}!</strong></p>
                        <p>Заказывайте доставку из любого горада в любой город России! Всё что нужно — указать город, выбрать подходящий букет цветов и указать параматры для доставки.</p>
                    </li>
                    <li>
                        <p><strong>Низкая стоимость букетов.</strong></p>
                        <p>Floristum.ru — это ресурс, где свои профессиональные букеты и композиции предлагают Вашему вниманию цветочные магазины и оптовые компании. Делая покупку здесь, вы можете быть уверены, что получите отличный букет от профессионалов по привлекательной цене.</p>
                    </li>
                     
                    <li>
                        <p><strong>Один договор для заказа из тысяч магазинов цветов.</strong></p>
                        <p>Заключив один договор, вы получаете возможность приобретать цветы из пяти тысяч торговых точек. На портале действительно огромный выбор букетов на любой вкус. Представьте себе — больше ста тысяч. И покупать вы их можете в два клика. Вам всего лишь раз нужно будет внести свои реквизиты в удобную форму, в дальнейшем они будут добавляться в форму заказа на автомате.</p>
                    </li>
                    <li>
                        <p><strong>Защита от мошенников и не качественных услуг.</strong></p>
                        <p>При заказе и оплате услуг через интернет, не сложно попасть на уловки мошенников и впустую потратить свои деньги, или просто приобрести не качественную услугу. На портале Floristum.ru действует система защиты клиентов. Пока ваш заказ не будет выполнен, флорист не получит за него деньги. Это гарантирует качество выполненной работы, безопасность расчетов и 100% гарантию возврата средств клиенту.</p>
                    </li>

                    <li>
                        <p><strong>Закрывающие документы без хлопот.</strong></p>
                        <p>Еще одно преимущество - документы, закрывающие сделку отправляются Вашему бухгалтеру без напоминаний автоматически.  Забудьте о сборе чеков, сканах, отчетах за покупки. Теперь, Вы просто получаете оригиналы на Ваш почтовый адрес и сканы на email. Это просто и очень удобно!</p>
                    </li>
                </ul>

            </div>
        </div>

        <div class="hidden-lg hidden-md hidden-xs">
            <br><br>
        </div>
        <strong>У Нас нет наценок при оплате с расчетного счета.</strong><h3 class="margin-top-null"><strong>Цены на цветы такие же, как для физ. лиц:</strong></h3></br></br>

        @if(!empty($popularProducts))
            @foreach($popularProducts as $item)
                @if(!empty($item['productType']) && $item['productType']->id != 2 && $item['popularProductCount'] >= 3)
                    <div data-ng-hide="isFiltered">
                        <div class="hidden-lg hidden-md hidden-xs">
                            <br><br>
                        </div>
                        <h2 class="margin-top-null"><strong>{{ $item['productType']->alt_name }}</strong></h2>
                        <br class="hidden-lg hidden-md">

                        <div class="row">
                            @foreach($item['popularProduct'] as $key => $_item)
                                @if($key < 3 || $item['popularProductCount'] == 8)

                                    @include('front.product.list-item', ['col' => 3])

                                @endif
                            @endforeach

                            <br clear="all">
                            @if($item['popularProduct']->total() > 6)
                                <div class="col-md-6 col-md-offset-3 bottom30">
                                    <a href="/catalog/{{ $item['productType']->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все {{ mb_strtolower($item['productType']->alt_name) }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        @if(count($lowPriceProducts))
            <!--
            <div ng-hide="isFiltered">

                <br class="hidden-lg hidden-md">

                @foreach($lowPriceProducts as $_item)
                    @include('front.product.list-item')
                @endforeach

                <br clear="all">
                <div class="col-md-6 col-md-offset-3 bottom30">
                    <a href="/catalog/?order=price" class="btn btn-block btn-more">Смотреть все букеты с низкими ценами</a>
                </div>

                <br clear="all">
            </div>
            -->
        @endif



        <br><br><br>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop