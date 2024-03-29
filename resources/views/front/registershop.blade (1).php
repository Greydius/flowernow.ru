﻿@extends('layouts.site')

@section('content')

    <div class="container">
        <br>

        <div class="row  m-b-4">
            <div class="col-md-3">
                <p class="text-center"><img src="{{ asset('assets/front/img/key.png') }}" height="150px"></p>
            </div>
            <div class="col-md-9">
                <h1 class="h2 margin-top-null m-b-1"><strong>Приглашаем магазины цветов на площадку Floristum.ru</strong></h1>
                <h2>– новые клиенты без затрат!</h2>

            </div>
        </div>



        <p class="m-b-4">Floristum.ru предоставляет эффективные инструменты для привлечения новых покупателей для магазинов цветов и флористов без затрат.</p>

        <div class="row  m-b-4">
            <div class="col-md-8">
                <p><strong>Пользоваться сервисом очень просто:</strong></p>
                <ol>
                    <li><a href="{{ route('register') }}">Зарегистрируйтесь.</a> </li>
                    <li>Загрузите букеты в систему.</li>
                    <li>Получайте новые заказы.</li>
                </ol>
            </div>
            <div class="col-md-4">
                <p class="text-center"><img src="{{ asset('assets/front/img/zakaz_cvetov_floristum.png') }}" height="150px"></p>
            </div>
        </div>

        <div class="row  m-b-4">
            <div class="col-md-12">
                <p><strong>Преимущества Floristum.ru:</strong></p>
                <ol>
                    <li>
                        <p><strong>Регистрация и работа в системе не требует никаких оплат.</strong></p>
                        <p>В систему не нужно вводить деньги, более того, функция ввода средств не предусмотрена.</p>
                    </li>
                    <li>
                        <p><strong>Простая регистрация,</strong></p>
                        <p>которая занимает не больше минуты, и Вы сразу можете загружать свои букеты на Floristum.ru и получать новые заказы.</p>
                    </li>
                    <li>
                        <p><strong>Минимальные требования к техническому оснащению флористов и курьеров.</strong></p>
                        <p>Всё что нужно для работы с системой и для выполнения заказа- любой телефон, даже самый простой кнопочный. Это возможно, благодаря простой эргономичной системе уведомлений и управления заказами, построенной на смс сообщениях, не требующей установки приложений на телефонах флористов и курьеров.</p>
                    </li>
                    <li>
                        <p><strong>Обратная связь от клиентов в отзывах.</strong></p>
                        <p>Для увеличения продаж крайне важно понимать насколько удовлетворен клиент доставкой цветов. Floristum.ru стимулирует каждого клиента оставить отзыв о полученном букете.</p>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row  m-b-4">
            <div class="col-md-8">
                <p><strong>Вы можете продавать букеты на площадке Floristum.ru, если:</strong></p>
                <ul>
                    <li>Вы готовы работать как юридическое лицо по безналичному расчету.</li>
                    <li>Вы имеете свою службу доставки либо являетесь партнером каких-либо служб доставки.</li>
                    <li>Согласны с комиссией системы: 20% на букеты, 10% на цветы поштучно.</li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="text-center"><img src="{{ asset('assets/front/img/dostavka_tsvetov.png') }}" height="150px"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 m-b-4">
                <p>Мы видим наши магазины-партнеры так:</p>
                <p>Партнеры Floristum.ru совершенно точно не оставят своего клиента без цветов, еще они всегда вежливы и не боятся никаких трудностей. Магазины нацелены на то, чтобы повышать постоянно качество своей работы, качество обслуживания, готовы развиваться вместе с порталом.</p>
            </div>
        </div>

        <div class="row  m-b-4">
            <div class="col-md-8">
                <p>Мы поощряем магазины с хорошими отзывами:</p>
                <p>На Floristum.ru заказчики могут оставить отзывы о том, насколько им понравилась работа, насколько они довольны качеством доставки. Также они могут поставить соответствующую оценку. По статистике, это делают более половины клиентов.Так формируется рейтинг магазинов и мастеров. А на его основании, мастера и магазины цветов <strong>с высоким рейтингом первыми отображаются в поисковой выдаче на сайте.</strong></p>
            </div>
            <div class="col-md-4">
                <p class="text-center"><img src="{{ asset('assets/front/img/diplom_dostavke_tsvetov.png') }}" height="150px"></p>
            </div>
        </div>


        <p><strong><a href="{{ route('register') }}">Регистрируйтесь</a> прямо сейчас!</strong></p>

        <br><br><br>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop