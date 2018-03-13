<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <img src="https://floristum.ru/assets/front/img/logo_floristum.png" alt="floristum.ru">

        <div style="font-size:10pt;font-family:Verdana,Geneva,sans-serif">
            <p>Здравствуйте{{ !empty($order->name) ? ', '.$order->name : null }}</p>
            @if($order->payment != 'cash')
                <p>Заказ №{{ $order->id  }} оплачен.</p>
            @endif
            <p>Отслеживание  и информация о заказе: <a href="{{ $order->getDetailsLink() }}">{{ $order->getDetailsLink() }}</a></p>

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