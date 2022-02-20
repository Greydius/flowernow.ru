<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <img src="https://floristum.ru/assets/front/img/logo_floristum.png" alt="floristum.ru">

        <div style="font-size:10pt;font-family:Verdana,Geneva,sans-serif">
            <p>Здравствуйте!</p>
            <p>Создан новый новый запрос на вывод средств от магазина {{ $shop->name }}</p>

            <p><a href="{{ route('admin.invoices') }}">{{ route('admin.invoices') }}</a></p>

            

            <p>+7 (965) 009-24-50<br>
            +7 (812) 982-23-83 - офис<br>
            <a href="mailto:service@floristum.ru">service@floristum.ru</a><br>
            <a href="https://www.floristum.ru/">www.floristum.ru</a></p>
        </div>

    </body>
</html>