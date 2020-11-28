<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <img src="https://floristum.ru/assets/front/img/logo_floristum.png" alt="floristum.ru">

        <div style="font-size:10pt;font-family:Verdana,Geneva,sans-serif">
            <p>Здравствуйте!</p>

            <p>Просим оплатить счет, прикрепленный к письму, и сообщить об оплате в ответном письме.</p>

            <p>
                Вы оформили заказ №{{ $order->id }} на букет:
                @foreach($order->orderLists as $key => $item)
                    @if($item->product)
                        <a href="{{ route('product.show', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a> <br>
                    @endif
                @endforeach
            </p>

            <p>Цена: {{ $order->amountF }} ₽</p>

            <p>Адрес доставки: {{ $order->recipient_address }}</p>

            <p>Время доставки: {{ $order->receiving_date.' '.$order->receiving_time }}</p>

            @if($order->name)
                <p>Отправитель: {{ $order->name }}</p>
            @endif

            <p>Получатель: {{ $order->recipient_name }}</p>

            @if($order->text)
                <p>Текст открытки: {{ $order->text }}</p>
            @endif

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