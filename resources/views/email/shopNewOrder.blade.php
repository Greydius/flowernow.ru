<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <img src="https://floristum.ru/assets/front/img/logo_floristum.png" alt="floristum.ru">

        <div style="font-size:10pt;font-family:Verdana,Geneva,sans-serif">
            <p>Здравствуйте!</p>
            @if($order->payment != 'cash')
                <p><span style="color: green">Клиент оплатил</span> заказ товара из Вашего магазина!</p>
            @else
                <p>Поступил заказ на доставку букета с оплатой наличными.<br><span style="color: red; font-weight: bold">Вы получите оплату от клиента при вручении букета!</span></p>
            @endif
            <p>Пожалуйста, подтвердите заказ из личного кабинета- <a href="{{ $link }}">{{ $link }}</a></p>
            <p></p>
            <p>С Уважением,</p>
            <p>Александр Александрович Ельченинов</p>
            <p>Менеджер по работе с партнерами</p>
            <br>

            <p>С Уважением,<br>
                Александр Александрович Ельченинов<br>
                Менеджер по работе с партнерами</p>

            <p>+7 (965) 009-24-50<br>
            +7 (812) 982-23-83 - офис<br>
            <a href="mailto:service@floristum.ru">service@floristum.ru</a><br>
            <a href="https://www.floristum.ru/">www.floristum.ru</a></p>
        </div>

    </body>
</html>