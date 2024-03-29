﻿@extends('layouts.site')

@section('content')

    <div class="container">
        <br>
        <h1 class="h2 margin-top-null m-b-1"><strong>Оплата доставки букетов.</strong></h1>

        <h2>На сегодняшний день доступно два варианта оплаты заказа цветов:</h2>

        <div class="row">
            <div class="col-md-12 m-b-4">
                <p><strong>1. Банковские карты</strong></p>
                <p>Вы можете рассчитаться картами VISA, VisaElectron, MasterCard, Maestro, МИР, а кроме того, картами международных платежных систем - это VisaInternational, MasterCardInternational, DinersClubInternational, AmericanExpress.</p>
                <p>Интерфейс оплаты заказа прост и интуитивно понятен:</p>
                <p class="text-center"><img src="{{ asset('assets/front/img/visa2.png') }}" height="100%"></p>

                <p>Оплата картами осуществляется посредством автоматизированной системы платежей «CloudPayments». В течение десяти минут вы можете отказаться от оплаты заказа. Если время будет превышено, а решение о заказе вы так и не приняли - то заявка аннулируется.</p>
                <p>Сертификат соответствия требованиям PCIDSS«CloudPayments»:</p>
                <p class="text-center"><img src="{{ asset('assets/front/img/Cloudpayments.jpg') }}" height="100%"></p>

                <p>Не отступая от требований международных систем оплаты для того, чтобы повысить уровень безопасности используется новейшая технология - 3D Secure/SecureCodе. Вы заполняете форму, подтверждаете свою оплату при помощи специальной кнопки и вводите в соответствующую графу код, полученный из СМС. Вам могут отказать в оплате лишь в том случае, если у вашего банка отсутствует сертификат на использование этой технологии.</p>
                <p>Если вы хотите получить более подробные данные об оплате заказов вашей карточкой в Интернете, решить проблемы с оплатой, звоните в службу поддержки банка по номеру, указанному на карте.</p>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 m-b-4">
                <p><strong>2. Безналичный расчёт для юридических лиц</strong></p>
                <p>Юридические лица оплачивают заказы с расчетного счета, по выставленным системой счетам.</p>
                <p>Для получения счета на оплату, при оформлении заказа выберите способ оплаты для юридических лиц и впишите реквизиты Вашей организации в лаконичную форму и система вышлет автоматически сформированный счет на указанный электронный адрес:</p>
                <p class="text-center"><img src="{{ asset('assets/front/img/rekviziti_ur.png') }}" height="100%"></p>

                <p>После получения оплаты, Вы получите смс, email и оповещение в личном кабинете, о том, что заказ взят в работу.</p>

            </div>
        </div>



        <br><br><br>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop