<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
        body, td, input, textarea, select {
            margin: 0;
            font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
            font-size: 26px;
        }
    </style>
</head>
<body style="margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%" >
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="#f8f8f8" style="padding: 40px 0 30px 0;">
                        <a href="https://floristum.ru/">
                            <img src="https://floristum.ru/assets/front/img/logo_floristum_160x34.png" alt="floristum.ru" width="160" height="34" style="display: block;" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #153643; font-size: 26px;">
                                    Здравствуйте!
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    @if($shop->delivery_price == 0 && empty($shop->delivery_free))
                                        <p>Вы зарегистрировали магазин <strong>{{ $shop->name }}</strong> на Floristum.ru, но не полностью заполнили данные магазина, а именно: <a href="{{ route('admin.shop.profile') }}">цена доставки</a>. Пожалуйста, заполните указанные поля для активации товаров в системе и получения заказов на них.</p>
                                    @endif

                                    @if(!$totalProductsCount)
                                            <p>Пожалуйста, загрузите товары в <a href="{{ route('admin.products') }}">Личном кабинете</a> и получайте заказы уже сегодня! У Вас не загружено ни одного букета.</p>
                                    @endif

                                    @if(count($products))
                                        <p>В вашем магазине <strong>{{ $shop->name }}</strong> есть товары, которые не могут быть представлены на Floristum.ru. Ознакомьтесь, пожалуйста, со списком проблемных товаров и устраните недочеты в <a href="{{ route('admin.products') }}">личном кабинете</a></p>


                                        <table width="94%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="20%" align="left" bgcolor="#2c2e3e" style="font-family: Verdana, Geneva, Helvetica, Arial, sans-serif; font-size: 12px; color: #EEEEEE; padding:10px; padding-right:0;">

                                                </td>
                                                <td width="40%" align="right" bgcolor="#2c2e3e" style="font-family: Verdana, Geneva, Helvetica, Arial, sans-serif; font-size: 12px; color: #EEEEEE; padding:10px; padding-left:0;">

                                                </td>
                                                <td width="40%" align="right" bgcolor="#2c2e3e" style="font-family: Verdana, Geneva, Helvetica, Arial, sans-serif; font-size: 12px; color: #EEEEEE; padding:10px; padding-left:0;">

                                                </td>
                                            </tr>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td width="20%" align="left" bgcolor="#{{ $loop->iteration  % 2 == 0 ? 'FFFFFF' : 'EEEEEE' }}" style="font-family: Verdana, Geneva, Helvetica, Arial, sans-serif; font-size: 12px; color: #252525; padding:10px; padding-right:0;">
                                                        <img src="https://floristum.ru/uploads/products/632x632/{{$product->shop_id}}/{{$product->photo}}" alt="" width="60px"/>
                                                    </td>
                                                    <td width="40%" align="left" bgcolor="#{{ $loop->iteration  % 2 == 0 ? 'FFFFFF' : 'EEEEEE' }}" style="font-family: Verdana, Geneva, Helvetica, Arial, sans-serif; font-size: 12px; color: #252525; padding:10px; padding-left:0;">
                                                        <a href="https://floristum.ru/admin/products?s={{$product->id}}" style="color:#007aff;font-weight:normal;text-decoration:none">{{$product->name}}</a>
                                                    </td>
                                                    <td width="40%" align="left" bgcolor="#{{ $loop->iteration  % 2 == 0 ? 'FFFFFF' : 'EEEEEE' }}" style="font-family: Verdana, Geneva, Helvetica, Arial, sans-serif; font-size: 12px; color: red; padding:10px; padding-left:0;">
                                                        {{ $product->status == 0 ? 'Не запонены обязательные поля!' : ($product->status == 3 ? ($product->status_comment ? $product->status_comment : 'Не одобрен администратором!') : '') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif

                                    @if($totalProductsCount && !count($products) && ($shop->delivery_price > 0 || $shop->delivery_free))
                                        <p>Рады работать с Вами на Floristum.ru!<br>
                                            Мы провели сравнение Вашего магазина <strong>{{ $shop->name }}</strong> с конкурентами и теперь можем предложить рекомендации для увеличения продаж.<br>
                                            Анализ товаров <strong>{{ $shop->name }}</strong> по сравнению с лидерами продаж на Floristum.ru показал, что, в среднем, у магазинов товаров больше на 30-40 позиций, чем в <strong>{{ $shop->name }}</strong>.</p>
                                    @endif

                                    <p>С Уважением,<br>
                                        Александр Александрович Ельченинов<br>
                                        Менеджер по работе с партнерами</p>

                                    <p>+7 (965) 009-24-50<br>
                                        +7 (812) 982-23-83 - офис<br>
                                        <a href="mailto:service@floristum.ru">service@floristum.ru</a><br>
                                        <a href="https://www.floristum.ru/">www.floristum.ru</a></p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="widht: 75%; color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                    &reg; Floristum.ru
                                </td>
                                <td align="right">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>