<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <img src="https://floristum.ru/assets/front/img/logo_floristum.png" alt="floristum.ru">

        <div style="font-size:10pt;font-family:Verdana,Geneva,sans-serif">
            <p>Здравствуйте!</p>
            <p>Создан новый заказ №{{ $order->id }}</p>
            <p><a href="{{ route('admin.order.view', ['id' => $order->id]) }}">{{ route('admin.order.view', ['id' => $order->id]) }}</a></p>

            <p>Город: {{ $shop->city->name }}</p>

            <p>Магазин: <a href="{{ route('shop.products', ['id' => $shop->id]) }}">{{ $shop->name }}</a></p>

            <p>Цена: {{ $order->amountF }} руб.</p>

            <p>Адрес доставки: {{ $order->recipient_address }}</p>

            <p>Время доставки: {{ $order->receiving_date.' '.$order->receiving_time }}</p>

            @if($order->name)
                <p>Отправитель: {{ $order->name }}</p>
            @endif

            @if($order->phone)
                <p>Тел. отправителя: {{ $order->phone }}</p>
            @endif

            <p>Получатель: {{ $order->recipient_name }}</p>

            @if($order->recipient_phone)
                <p>Тел. получателя: {{ $order->recipient_phone }}</p>
            @endif

            @if($order->text)
                <p>Текст открытки: {{ $order->text }}</p>
            @endif


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